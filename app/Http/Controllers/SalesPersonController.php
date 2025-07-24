<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\SalesCheckin;
use App\Models\SalesProfile;
use App\Models\Customer;
use App\Events\SalesCheckedIn;
use App\Events\TurnAssigned;
use App\Events\CustomerTransferred;
use App\Jobs\AssignTurnJob;
use App\Jobs\AssignCustomerJob;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SalesPersonController extends Controller
{
    public function assignCurrentTurn()
{
    // Reset all to not current
    SalesCheckin::where('is_current_turn', true)->update(['is_current_turn' => false]);

    // Get the earliest checked-in and still active salesperson
    $firstInLine = SalesCheckin::whereNull('check_out_time')
        ->orderBy('check_in_time', 'asc')
        ->first();

    if ($firstInLine) {
        $firstInLine->update(['is_current_turn' => true]);
    }
}
public function checkout(Request $request)
{
    $salespersonId = session('sales_id');

    if (!$salespersonId) {
        return response()->json(['error' => 'Unauthorized.'], 401);
    }
    $pendingCustomers = Customer::where('assigned_to', $salespersonId)
    ->whereNull('transferred_to') // means still not transferred
    ->exists();

if ($pendingCustomers) {
    return response()->json([
        'message' => 'You cannot check out while customers are still assigned to you. Please transfer them first.',
    ], 403);
}

    // $assignedCustomers = Customer::where('assigned_to', $salespersonId)
    // ->where(function ($query) use ($salespersonId) {
    //     $query->whereNull('transferred_to')
    //           ->orWhere('transferred_to', '!=', $salespersonId);
    // })
    // ->exists();


    // if ($assignedCustomers) {
    //     return response()->json(['error' => '⚠️ You still have assigned customers. Please transfer them before checking out.'], 403);
    // }

    $checkin = SalesCheckin::where('salesperson_id', $salespersonId)
        ->whereNull('check_out_time')
        ->latest()
        ->first();

    if ($checkin) {
        $checkin->check_out_time = now();
        $checkin->duration = now()->diffInSeconds($checkin->check_in_time);
        $checkin->save();
    }

    return response()->json(['message' => '✅ Checked out successfully!']);
}



public function assign(Request $request, $id)
{
    $salespersonId = Auth::id();

    // Dispatch the job to queue
    AssignCustomerJob::dispatch($id, $salespersonId);

    return response()->json(['message' => 'Assign request sent.']);
}
public function dashboard()
{
    $salespersonId = session('sales_id');

    if (!$salespersonId) {
        return redirect('/login')->withErrors(['error' => 'Unauthorized']);
    }

    $salesperson = SalesProfile::find($salespersonId);
    $salespeople = SalesProfile::where('role', 'Sales Person')->get();

    $customers = Customer::with('salesperson')
        ->where(function ($query) use ($salespersonId) {
            $query->where('salesperson_id', $salespersonId)
                  ->orWhere('transferred_to', $salespersonId);
        })
        ->latest()
        ->get();

    // Check-in status
    $checkin = SalesCheckin::where('salesperson_id', $salespersonId)
        ->whereNull('check_out_time')
        ->orderBy('created_at', 'desc')
        ->first();

    $checkedIn = $checkin !== null;

    // Determine if it's their turn
    $firstInLine = SalesCheckin::whereNull('check_out_time')
    ->orderBy('last_assigned_at')
    ->orderBy('check_in_time')
    ->lockForUpdate()
    ->first();

    $isMyTurn = $firstInLine && $firstInLine->salesperson_id == $salespersonId;

    return view('salesperson.dashboard', compact(
        'salesperson',
        'salespeople',
        'customers',
        'checkedIn',
        'isMyTurn'
    ));
}


   
    public function checkIn(Request $request)
    {
        $salesperson = auth('salesperson')->user();
    
        SalesCheckin::create([
            'salesperson_id' => $salesperson->id,
            'check_in_time' => now()
        ]);
    
        // Calculate current turn BEFORE dispatching the event
        $first = SalesCheckin::where('status', 'checked_in')
            ->whereNull('check_out_time')
            ->orderBy('check_in_time')
            ->first();
    
        // Fire Event with pre-calculated current_turn_id
        event(new SalesCheckedIn($salesperson, $first?->salesperson_id));
    
        // Dispatch turn assignment
        AssignTurnJob::dispatch();
    
        return response()->json(['message' => 'Checked in successfully']);
    }
    
   
    
    public function toggleCheckStatus(Request $request)
    {
        $currentSalespersonId = session('sales_id');
    
        if (!$currentSalespersonId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Salesperson not found in session.'
            ], 401);
        }
    
        // 🔍 Check if currently checked in (i.e. no check_out_time)
        $checkin = SalesCheckin::where('salesperson_id', $currentSalespersonId)
            ->whereNull('check_out_time')
            ->latest()
            ->first();
    
        if ($checkin) {
            // 🛑 Prevent checkout if any customer still assigned and not transferred
            $hasPendingCustomer = Customer::where('assigned_to', $currentSalespersonId)
                ->whereNull('transferred_to')
                ->exists();
    
            if ($hasPendingCustomer) {
                return response()->json([
                    'status' => 'error',
                    'message' => '⛔ You cannot check out while customers are still assigned to you. Please transfer them first.'
                ], 403);
            }
    
            // ✅ Proceed to checkout
            $checkin->check_out_time = Carbon::now();
            $checkin->save();
    
            $duration = $checkin->check_out_time->diffInSeconds($checkin->check_in_time);
            return response()->json([
                'status' => 'checked_out',
                'duration' => $duration,
                'formatted_duration' => gmdate("H:i:s", $duration),
            ]);
        } else {
            // ✅ Proceed to check-in
            $newCheckin = SalesCheckin::create([
                'salesperson_id' => $currentSalespersonId,
                'check_in_time' => now(),
            ]);
    
            return response()->json([
                'status' => 'checked_in',
                'salesperson' => session('sales_name'),
                'check_in_time' => $newCheckin->check_in_time->format('d/m/Y H:i:s'),
            ]);
        }
    }
    
    
    /**
     * Toggle check-in/check-out
     */
    public function toggleCheck(Request $request)
    {
        Log::info('🔄 toggleCheck triggered');
        Log::info('📦 Session:', session()->all());
    
        $userId = session('sales_id');
        if (!$userId) {
            return response()->json(['error' => 'No salesperson session found'], 403);
        }
    
        $lastCheck = SalesCheckin::where('salesperson_id', $userId)->latest()->first();
        $now = Carbon::now();
    
        if (!$lastCheck || $lastCheck->check_out_time) {
            // ✅ Create new check-in
            $check = SalesCheckin::create([
                'salesperson_id' => $userId,
                'check_in_time' => $now,
            ]);
    
            // ✅ Find current first-in-line salesperson BEFORE event
            $first = SalesCheckin::whereNull('check_out_time')
                ->orderBy('check_in_time')
                ->first();
    
            // ✅ Fire event with precomputed turn info
            $salesperson = SalesProfile::find($userId);
            event(new SalesCheckedIn($salesperson, $first?->salesperson_id));
    
            return response()->json([
                'status' => 'checked_in',
                'check_in_time' => $now->toDateTimeString(),
                'salesperson' => $salesperson->name,
            ]);
        } else {
            // ✅ Check-out logic
            $checkInTime = Carbon::parse($lastCheck->check_in_time);
            $duration = $checkInTime->diffInSeconds($now);
        
            $lastCheck->update([
                'check_out_time' => $now,
                'duration' => $duration,
            ]);
        
    
            return response()->json([
                'status' => 'checked_out',
                'check_out_time' => $now->toDateTimeString(),
                'duration' => $duration,
                'formatted_duration' => $this->formatDuration($duration),
            ]);
        }
    }
    
   
    public function handle(SalesCheckedIn $event)
    {
        $firstInLine = SalesCheckin::whereNull('check_out_time')
            ->orderBy('check_in_time')
            ->first();

        if ($firstInLine && $firstInLine->salesperson_id == $event->salesperson->id) {
            event(new TurnAssigned($event->salesperson->id));
        }
    }
    public function storeCustomer(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email',
                'phone' => 'nullable|string',
                'interest' => 'nullable|string',
                'notes' => 'nullable|string',
                'process' => 'nullable|array',
                'disposition' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->validator->errors()->first()
            ], 422);
        }
    
        $currentSalespersonId = session('sales_id');
        if (!$currentSalespersonId) {
            return response()->json([
                'success' => false,
                'error' => 'Unauthorized request. Please re-login.'
            ], 403);
        }
    
        $checkin = SalesCheckin::where('salesperson_id', $currentSalespersonId)
            ->whereNull('check_out_time')
            ->latest()
            ->first();
    
        if (!$checkin) {
            return response()->json([
                'success' => false,
                'error' => 'You are not checked in.'
            ], 403);
        }
    
        $firstInLine = SalesCheckin::whereNull('check_out_time')
            ->orderBy('last_assigned_at')
            ->orderBy('check_in_time')
            ->first();
    
        if (!$firstInLine || $firstInLine->salesperson_id !== $currentSalespersonId) {
            return response()->json([
                'success' => false,
                'error' => '⏳ Not your turn. Please wait until the current salesperson checks out.'
            ], 403);
        }
    
        $customer = Customer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'interest' => $validated['interest'],
            'notes' => $validated['notes'],
            'process' => json_encode($validated['process']),
            'disposition' => $validated['disposition'],
            'salesperson_id' => $currentSalespersonId,
            'assigned_to' => $currentSalespersonId,
        ]);
    
        $checkin->update([
            'last_assigned_at' => now(),
        ]);
    
        $next = SalesCheckin::whereNull('check_out_time')
            ->orderBy('last_assigned_at')
            ->orderBy('check_in_time')
            ->first();
    
        if ($next) {
            event(new TurnAssigned($next->salesperson_id));
        }
    
        return response()->json([
            'success' => true,
            'message' => '🎉 Customer saved successfully.'
        ]);
    }
    
    public function takeCustomer(Request $request)
    {
        $salespersonId = session('sales_id');
    
        if (!$salespersonId) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }
    
        // Get all eligible check-ins for today
        $eligibleCheckins = SalesCheckin::whereDate('created_at', today())
        ->whereNull('check_out_time')
        ->orderBy('last_assigned_at')
        ->orderBy('check_in_time')
        ->get();
    
    
        if ($eligibleCheckins->isEmpty()) {
            return response()->json(['error' => 'No one is currently checked in.'], 403);
        }
    
        // The person whose turn it is
        $nextInLine = $eligibleCheckins->first();
    
        if ($nextInLine->salesperson_id != $salespersonId) {
            return response()->json(['error' => '⏳ Please wait. It is not your turn yet.'], 403);
        }
        
        // ✅ Mark turn
        $nextInLine->update([
            'last_assigned_at' => now()
        ]);
        
        // ✅ Mark that this salesperson has taken their turn
        // $nextInLine->has_taken_customer = true;
        // $nextInLine->last_assigned_at = now(); // update turn time
        // $nextInLine->save();
        // $nextInLine->update([
        //     'last_assigned_at' => now(),
        // ]);
        
        return response()->json(['message' => '✅ It’s your turn! You may now take a customer.']);
    }
    
private function getFirstInLine()
{
    return SalesCheckin::whereDate('created_at', today())
        ->whereNull('check_out_time')
        ->where('has_taken_customer', false)
        ->orderBy('check_in_time')
        ->first();
}


    public function currentTurn()
    {
        $currentSalespersonId = session('sales_id'); // getting session ID
    
        $currentTurn = SalesCheckin::whereDate('check_in_time', Carbon::today())
            ->whereNotNull('check_in_time')
            ->whereNull('check_out_time')
            ->where('has_taken_customer', false)
            ->orderBy('check_in_time', 'asc')
            ->first();
    
        // Get the ID of the person whose turn it currently is
        $currentTurnId = $currentTurn?->salesperson_id;
    
        if (!$currentTurnId || $currentSalespersonId !== $currentTurnId) {
            return response()->json([
                'error' => 'It is not your turn yet. Please wait.',
                'current_turn' => $currentTurn?->salesperson->name ?? 'Unknown'
            ], 403);
        }
    
        return response()->json(['salesperson_id' => $currentTurnId]);
    }
    
    public function getSalespersons()
    {
        return SalesProfile::where('role', 'Sales Person')->get();
    }
    
    public function transferCustomer(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'new_salesperson_id' => 'required|exists:sales_profiles,id',
        ]);
    
        $customer = Customer::find($request->customer_id);
        $newSalesperson = SalesProfile::find($request->new_salesperson_id);
    
        if ($customer && $newSalesperson) {
            $customer->salesperson_id = $newSalesperson->id;
            $customer->assigned_to = $newSalesperson->id;
            $customer->transferred = 1;
            $customer->transferred_to = $newSalesperson->id;
            $customer->save();
    
            event(new CustomerTransferred($customer)); // 🔥 Send realtime event
    
            return response()->json([
                'success' => true,
                'salesperson_name' => $newSalesperson->name
            ]);
        }
    
        return response()->json(['error' => 'Transfer failed.'], 500);
    }
    

    private function formatDuration($seconds)
    {
        $h = floor($seconds / 3600);
        $m = floor(($seconds % 3600) / 60);
        $s = $seconds % 60;
    
        $text = '';
        if ($h > 0) $text .= "{$h}h ";
        if ($m > 0) $text .= "{$m}m ";
        $text .= "{$s}s";
    
        return trim($text);
    }
    
    
} 