<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\SalesCheckin;
use App\Models\Customer;
use App\Models\SalesProfile;

class QueueController extends Controller
{
    public function index()
    {
        $checkedInSalespeople = SalesCheckin::with('salesperson')
            ->latest()
            ->get();
    
        $assignedIds = $checkedInSalespeople->pluck('salesperson_id');
    
        $customers = Customer::with('salesperson')
            ->where(function ($query) use ($assignedIds) {
                $query->whereIn('assigned_to', $assignedIds)
                      ->orWhereNull('assigned_to'); // show unassigned customers too
            })
            ->latest()
            ->get();
    
        return view('queue-list', [
            'checkedInSalespeople' => $checkedInSalespeople,
            'customers' => $customers,
        ]);
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
        session(['highlight_customer_id' => $request->customer_id]);
        return redirect('/queues');
    }
            

public function takeover(Request $request)
{
    // Save customer ID to session temporarily
    Session::put('highlight_customer_id', $request->id);

    // You can also save more if needed
    return response()->json(['status' => 'success']);
}



}
