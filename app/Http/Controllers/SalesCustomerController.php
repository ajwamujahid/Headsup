<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;   
use App\Models\CustomerSale;
use Carbon\Carbon;

class SalesCustomerController extends Controller
{
    
    public function index(Request $request)
    {
        $query = CustomerSale::query();
    
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . trim($request->search) . '%');
        }
    
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $from = Carbon::parse($request->from_date)->startOfDay();
            $to = Carbon::parse($request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$from, $to]);
        }
    
        $customers = $query->latest()->paginate(10);
        if ($customers->isEmpty()) {
            // Flash message for SweetAlert
            session()->flash('no_data_found', 'No customer records found.');
        }    
        $allCustomers = CustomerSale::select('name')->distinct()->get();
    
        return view('salesperson.customer.index', compact('customers', 'allCustomers'));
    }
    
    public function create()
    {
        return view('salesperson.customer.add');
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

    CustomerSale::create($data);

    return response()->json([
        'status' => 'success',
        'message' => 'Customer saved successfully!',
        'redirect' => route('salesperson.customer.index'),
    ]);
}
}