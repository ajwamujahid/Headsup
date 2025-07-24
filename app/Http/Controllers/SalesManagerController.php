<?php

namespace App\Http\Controllers;
use App\Models\SalesProfile;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Appointment;




class SalesManagerController extends Controller
{
    public function dashboard()
    {
        $totalSalespersons = SalesProfile::where('role', 'Sales Person')->count(); // Filter by role
        $totalCustomers = Customer::count();
        $totalAppointments = Appointment::count();
        // ✅ Aap yahan se data fetch karke view mein bhej sakte ho
        return view('manager.dashboard', compact(
            'totalSalespersons',
            'totalCustomers',
            'totalAppointments'
        )); 
    }
}
