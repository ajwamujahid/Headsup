<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;   
use App\Models\Customer;
use Carbon\Carbon;

class CustomerController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Customer::query();
    
        // 🔍 Search Filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . trim($request->search) . '%');
        }
    
        // 📅 Date Filter
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $from = Carbon::parse($request->from_date)->startOfDay();
            $to = Carbon::parse($request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$from, $to]);
        }
    
        // 👤 Salesperson Filter (Optional Dropdown Filter)
        if ($request->filled('salesperson_id')) {
            $query->where('assigned_to', $request->salesperson_id);
        }
    
        // 🟢 Logged-in Salesperson's Customers for Dropdown
        $loggedInSalespersonId = optional(auth()->user())->sales_profile_id;

        $allCustomers = Customer::where('assigned_to', $loggedInSalespersonId)->get();
    
        $customers = $query->latest()->paginate(10);
    
        $salespeople = \App\Models\SalesProfile::select('id', 'name')->get();
    
        return view('customer.index', compact('customers', 'salespeople', 'allCustomers'));
    }
    
    public function create()
    {
        return view('customer.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'interest' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'process' => 'nullable|array',
            'disposition' => 'nullable|string|max:255',
        ]);
    
        $data['process'] = $request->has('process') ? json_encode($request->process) : null;
    
        // Assign logged-in Salesperson ID to 'assigned_to'
        $loggedInUser = auth()->user();
    
        if ($loggedInUser) {
            $data['assigned_to'] = $loggedInUser->sales_profile_id;
        } else {
            // fallback for testing
            $data['assigned_to'] = 1; // Hardcode for now if needed
        }
    
        Customer::create($data);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Customer saved successfully!',
            'redirect' => route('customer.index'),
        ]);
    }
    
}