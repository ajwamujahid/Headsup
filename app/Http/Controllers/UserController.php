<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\SalesProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\SalesCheckin;
use App\Models\Customer;
class UserController extends Controller
{
    public function index()
{
    $salespeople = SalesProfile::withCount('customers')->get(); // 👈 Magic here
    return view('salesperson.index', compact('salespeople'));
}


    public function create()
    {
        return view('salesperson.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:sales_profiles,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:Sales Manager,Sales Person',
            'phone'    => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        SalesProfile::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'phone'    => $request->phone,
        ]);

        return response()->json(['message' => 'User created successfully!']);
    }


public function edit($id)
{
    $salesperson = SalesProfile::findOrFail($id);
    return view('salesperson.edit', compact('salesperson'));
}
public function update(Request $request, $id)
{
    $salesperson = SalesProfile::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:sales_profiles,email,' . $id,
        'password' => 'nullable|string|min:6|confirmed',
        'phone' => 'nullable|string|max:20',
        'role' => 'required|in:Sales Manager,Sales Person',
    ]);

    $salesperson->name = $validated['name'];
    $salesperson->email = $validated['email'];
    $salesperson->phone = $validated['phone'];
    $salesperson->role = $validated['role'];

    if (!empty($validated['password'])) {
        $salesperson->password = bcrypt($validated['password']);
    }

    $salesperson->save();

    // ✅ THIS MUST BE JSON
    return response()->json(['message' => 'Salesperson updated successfully.']);
}
public function destroy($id)
{
    $salesperson = SalesProfile::findOrFail($id);
    $salesperson->delete();

    return response()->json([
        'message' => 'Salesperson deleted successfully.'
    ]);
}


public function personCheckout($id)
{
    // Find active check-in (No checkout time yet)
    $checkin = SalesCheckin::where('salesperson_id', $id)
                ->whereNull('check_out_time')
                ->first();

    if (!$checkin) {
        return response()->json(['message' => 'This salesperson is already checked out!'], 400);
    }

    // Count active customers assigned
    $customerCount = Customer::where('salesperson_id', $id)
                            ->where('transferred', 0) // Optional: Filter if transferred is false
                            ->count();

    if ($customerCount > 0) {
        return response()->json(['message' => 'Cannot checkout! This salesperson still has active customers.'], 400);
    }

    // Proceed with Checkout
    $checkin->check_out_time = now();

    // Calculate Duration (in minutes)
    $checkin->duration = now()->diffInMinutes($checkin->check_in_time);
    $checkin->save();

    return response()->json(['message' => 'Salesperson checked out successfully!']);
}

}
