<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\SalesProfile;
use App\Models\Appointment;
class AppointmentController extends Controller
{
    public function index()
    {
        $salespersons = SalesProfile::all(); // Assuming your salespeople are stored here
        return view('appointments.create', compact('salespersons'));
    }
    public function showList()
    {
        $appointments = Appointment::with('salesperson')->latest()->get();
        return view('appointments.index', compact('appointments'));
    }
    public function show($id)
    {
        $appointment = \App\Models\Appointment::findOrFail($id);
    
        // Check if appointment is completed
        if ($appointment->status !== 'completed') {
            $appointments = []; // show nothing if not completed
        } else {
            $appointments = [$appointment]; // wrap single appointment in array
        }
    
        return view('appointments.show', compact('appointments'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'salesperson_id' => 'nullable|exists:sales_profiles,id',
            'notes' => 'nullable|string',
        ]);
    
        $appointment = Appointment::create($validated);
    
        return response()->json([
            'message' => 'Appointment booked successfully!',
            'redirect' => route('appointments.create') // or wherever you want to go after
        ]);
    }
    // app/Http/Controllers/AppointmentController.php

// app/Http/Controllers/AppointmentController.php

public function showArrivalForm($id)
{
    $appointment = \App\Models\Appointment::findOrFail($id);

    return view('appointments.customer_arrived', compact('appointment'));
}
public function edit($id)
{
    $appointment = Appointment::findOrFail($id);
    $salespersons = SalesProfile::all(); // optional: only Sales Person role if needed

    return view('appointments.edit', compact('appointment', 'salespersons'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:20',
        'date' => 'required|date',
        'time' => 'required',
        'salesperson_id' => 'required|exists:sales_profiles,id',
        'status' => 'required|in:scheduled,completed,canceled',
    ]);

    $appointment = Appointment::findOrFail($id);
    $appointment->update($validated);

    return response()->json([
        'status' => 'success',
        'message' => 'Appointment updated successfully!',
        'redirect' => route('appointments.index'),
    ]);
}

}    