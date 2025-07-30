<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;   
use App\Models\Customer;
use Carbon\Carbon;
use App\Events\TurnAssigned;
class SalesCustomerController extends Controller
{
    public function index(Request $request)
    {
    //     dd(session()->all());
   

        $salespersonId = session('sales_id'); // 👈 Logged in salesperson session
    
        $query = \App\Models\Customer::query()->where('salesperson_id', $salespersonId);
    
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . trim($request->search) . '%');
        }
    
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $from = \Carbon\Carbon::parse($request->from_date)->startOfDay();
            $to = \Carbon\Carbon::parse($request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$from, $to]);
        }
    
        $customers = $query->latest()->paginate(10);
    
        if ($customers->isEmpty()) {
            session()->flash('no_data_found', 'No customer records found.');
        }
    
        $allCustomers = \App\Models\Customer::select('name')->where('salesperson_id', $salespersonId)->distinct()->get();
    
        return view('salesperson.customer.index', compact('customers', 'allCustomers'));
    }
    
    public function add()
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
    
        // Fallback Logic: Session First, then Request Hidden Field
        // $data['salesperson_id'] = session('sales_id') ?: $request->salesperson_id;
         $data['salesperson_id'] = $request->salesperson_id ?? session('sales_id');

        \App\Models\Customer::create($data);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Customer saved successfully!',
            'redirect' => route('salesperson.customer.index'),
        ]);
    }
    
}