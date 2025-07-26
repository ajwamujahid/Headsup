<?php
namespace App\Http\Controllers;
use App\Models\SalesProfile;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Appointment;
class AdminController extends Controller
{
    public function index()
{
    $totalSalespersons = SalesProfile::where('role', 'Sales Person')->count(); // Filter by role
    $totalCustomers = Customer::count();
    $totalAppointments = Appointment::count();

    return view('dashboard', compact(
        'totalSalespersons',
        'totalCustomers',
        'totalAppointments'
    ));
    }
}
