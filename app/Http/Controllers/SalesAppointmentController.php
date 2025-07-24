<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SalesProfile;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;
class SalesAppointmentController extends Controller
{
    public function index()
    {
        $salespersons = SalesProfile::all(); // Optional if needed
        return view('salesperson.appointments.create', compact('salespersons'));
    }

    public function showList()
    {
        $salespersonId = session('salesperson_id'); // or Auth::user()->sales_profile_id
    
        $appointments = \App\Models\Appointment::with('salesperson')
            ->where('salesperson_id', $salespersonId)
            ->latest()
            ->get();
    
        return view('salesperson.appointments.index', compact('appointments'));
    }
    
    

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Only allow access to their own appointment
        if ($appointment->salesperson_id != session('salesperson_id')) {
            abort(403, 'Unauthorized access.');
        }

        // Only show if completed
        if ($appointment->status !== 'completed') {
            $appointments = [];
        } else {
            $appointments = [$appointment];
        }

        return view('salesperson.appointments.show', compact('appointments'));
    }

   
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'customer_name' => 'required|string|max:255',
                'phone'         => 'required|string|max:20',
                'date'          => 'required|date',
                'time'          => 'required',
                'notes'         => 'nullable|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
    
            $validated = $validator->validated();
            $validated['salesperson_id'] = session('salesperson_id') ?? 1; // fallback ID
    
            Appointment::create($validated);
    
            return response()->json([
                'message' => 'Appointment saved successfully!',
                'redirect' => route('salesperson.appointments.index'),
            ]);
        } catch (\Exception $e) {
            \Log::error('Appointment Store Error: ' . $e->getMessage());
    
            return response()->json([
                'error' => 'Internal Server Error: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function showArrivalForm($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->salesperson_id != session('salesperson_id')) {
            abort(403, 'Unauthorized');
        }

        return view('salesperson.appointments.customer_arrived', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->salesperson_id != session('salesperson_id')) {
            abort(403, 'Unauthorized');
        }

        return view('salesperson.appointments.edit', compact('appointment'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->salesperson_id != session('salesperson_id')) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|in:scheduled,completed,canceled',
        ]);

        $appointment->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment updated successfully!',
            'redirect' => route('salesperson.appointments.index'),
        ]);
    }
}
