<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesProfile;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    // Show all appointments to Admin / Sales Manager
    public function showList()
    {
        $appointments = Appointment::with('salesperson')->latest()->get();
        return view('appointments.index', compact('appointments'));
    }

    // Show create appointment form
    public function index()
    {
        $salespersons = SalesProfile::all();
        return view('appointments.create', compact('salespersons'));
    }

    // Store new appointment
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
            'redirect' => route('admin.appointments.index') // redirect to admin index
        ]);
    }

    public function show($id)
{
    $appointment = Appointment::with('salesperson')->findOrFail($id); // <-- Fetch appointment first

    $allowedStatuses = ['completed', 'scheduled']; // Allow multiple statuses
    if (!in_array($appointment->status, $allowedStatuses)) {
        abort(403, 'This appointment is not accessible yet.');
    }
    
    return view('appointments.show', ['appointments' => [$appointment]]);
}


    // Show customer arrival form
    public function showArrivalForm($id)
    {
        $appointment = Appointment::with('salesperson')->findOrFail($id);
        return view('appointments.customer_arrived', compact('appointment'));
    }

    // Show appointment edit form
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $salespersons = SalesProfile::all();

        return view('appointments.edit', compact('appointment', 'salespersons'));
    }

    // Update appointment
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
            'redirect' => route('admin.appointments.index'),
        ]);
    }
}
