<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\SalesCheckin;
use App\Models\Customer;
use App\Models\SalesProfile;
use App\Events\SalespersonCheckedIn;
use App\Events\SalespersonHighlighted;
use App\Events\TurnAssigned;

class QueueController extends Controller
{
    public function completeCustomer(Request $request)
    {
        $currentSalespersonId = $request->input('salesperson_id');

        // Mark current salesperson's turn off
        SalesCheckin::where('salesperson_id', $currentSalespersonId)
            ->update(['is_current_turn' => 0]);

        // Assign next turn (first from check-in queue who is not checked out)
        $next = SalesCheckin::whereNull('check_out_time')
                    ->where('is_current_turn', 0)
                    ->orderBy('check_in_time', 'asc')
                    ->first();

        if ($next) {
            $next->update(['is_current_turn' => 1]);
            event(new TurnAssigned($next->salesperson_id));  // Will auto fetch name inside Event
        }

        return response()->json(['success' => true]);
    }

    public function checkIn(Request $request)
{
    $salespersonId = $request->input('salesperson_id');
    $salesperson = SalesProfile::find($salespersonId);

    if (!$salesperson) {
        return response()->json(['status' => 'failed', 'message' => 'Salesperson not found'], 404);
    }

    // Check if anyone has current turn
    $hasCurrentTurn = SalesCheckin::where('is_current_turn', true)
                                  ->where('checked_out', false)
                                  ->exists();

    // Insert check-in
    $checkin = SalesCheckin::create([
        'salesperson_id' => $salespersonId,
        'check_in_time' => now(),
        'is_current_turn' => $hasCurrentTurn ? false : true,
    ]);

    // Broadcast Check-In Event
    event(new SalespersonCheckedIn($salesperson->name, $salesperson->id, $checkin->is_current_turn));

    // IMPORTANT: Fire TurnAssigned Event if this guy is first
    if (!$hasCurrentTurn) {
        event(new TurnAssigned($salesperson->id));  // FORCE Assign to him
    }

    return response()->json(['status' => 'success']);
}

public function index()
{
    $todayCheckins = SalesCheckin::with('salesperson')
        ->whereDate('created_at', now()->toDateString())
        ->latest()
        ->get();

    $checkedInSalespeople = $todayCheckins->unique('salesperson_id');

    $assignedIds = $checkedInSalespeople->pluck('salesperson_id');

    $customers = Customer::with('salesperson')
        ->where(function ($query) use ($assignedIds) {
            $query->whereIn('assigned_to', $assignedIds)
                  ->orWhereNull('assigned_to');
        })
        ->latest()
        ->get();

    // Get Current Turn Salesperson
    $currentTurn = SalesCheckin::with('salesperson')
    ->where('is_current_turn', true)
    ->whereNull('check_out_time')
    ->first();


    return view('queue-list', [
        'checkedInSalespeople' => $checkedInSalespeople,
        'customers' => $customers,
        'currentTurn' => $currentTurn,   // <-- Add this line
    ]);

}
public function rotateTurn($forceSalespersonId = null)
{
    // Clear current turn
    SalesCheckin::where('is_current_turn', true)->update(['is_current_turn' => false]);

    // Get next in line
    $target = SalesCheckin::where('checked_out', false)
                ->when($forceSalespersonId, fn($q) => $q->where('salesperson_id', $forceSalespersonId))
                ->orderBy('check_in_time', 'asc')
                ->first();

    if ($target) {
        $target->update(['is_current_turn' => true]);

        event(new TurnAssigned(
            $target->salesperson_id,
            optional($target->salesperson)->name ?? 'Unknown',
            optional($target->salesperson)->email ?? 'N/A'
        ));
    } else {
        // No available salesperson
        event(new TurnAssigned(null, 'No Salesperson', 'N/A'));
    }
}

    public function autoAssign(Request $request)
    {
        $firstSalespersonId = SalesCheckin::latest()->first()->salesperson_id ?? null;

        if ($firstSalespersonId && $request->customer_id) {
            Customer::where('id', $request->customer_id)
                ->update(['assigned_to' => $firstSalespersonId]);
        }

        return response()->json(['status' => 'assigned']);
    }

    public function highlightCustomer(Request $request)
    {
        $customerId = $request->customer_id;

        broadcast(new SalespersonHighlighted($customerId))->toOthers();

        return response()->json(['status' => 'Highlight Event Sent']);
    }

    public function takeover(Request $request)
    {
        $customer = Customer::find($request->id);

        if ($customer && $customer->assigned_to) {
            Session::put('highlight_salesperson_id', $customer->assigned_to);
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'failed']);
    }

    public function takeoverHighlight(Request $request)
    {
        $customer = Customer::find($request->customer_id);

        if ($customer && $customer->assigned_to) {
            session(['highlight_salesperson_id' => $customer->assigned_to]);
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'failed']);
    }
}
