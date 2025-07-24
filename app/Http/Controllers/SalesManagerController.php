<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesManagerController extends Controller
{
    public function dashboard()
    {
        // ✅ Aap yahan se data fetch karke view mein bhej sakte ho
        return view('manager.dashboard'); // 👈 view file banani padegi
    }
}
