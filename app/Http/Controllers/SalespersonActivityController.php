<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesCheckin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SalespersonActivityController extends Controller
{
   

public function index(Request $request)
{
    $salespersonId = session('sales_id'); // ✅ This will return the correct ID

    
    $query = SalesCheckin::where('salesperson_id', $salespersonId); // ✅ Filter by that ID only

    if ($request->filled('from') && $request->filled('to')) {
        $from = \Carbon\Carbon::parse($request->from)->startOfDay();
        $to = \Carbon\Carbon::parse($request->to)->endOfDay();
        $query->whereBetween('check_in_time', [$from, $to]);
    }

    $activities = $query->orderBy('check_in_time', 'desc')->get();

    $totalCheckIns = $activities->count();
    $totalCheckOuts = $activities->whereNotNull('check_out_time')->count();

    $totalDuration = $activities->reduce(function ($carry, $item) {
        if ($item->check_in_time && $item->check_out_time) {
            $carry += \Carbon\Carbon::parse($item->check_in_time)->diffInMinutes(\Carbon\Carbon::parse($item->check_out_time));
        }
        return $carry;
    }, 0);

    $hours = floor($totalDuration / 60);
    $minutes = $totalDuration % 60;

    

    return view('salesperson.customer.activity-report', compact(
        'activities', 'totalCheckIns', 'totalCheckOuts', 'hours', 'minutes'
    ));
}

}
