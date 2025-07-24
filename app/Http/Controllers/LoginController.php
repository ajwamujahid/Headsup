<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\SalesProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // 🔎 Search in sales_profiles
        $user = \App\Models\SalesProfile::where('email', $request->email)->first();
    
        if ($user && \Hash::check($request->password, $user->password)) {
            // Store session
            session([
                'sales_id' => $user->id,
                'sales_name' => $user->name,
                'sales_email' => $user->email,
                'role' => $user->role,
            ]);
    
            // 🧭 Redirect by role
            if ($user->role === 'Sales Manager') {
                return redirect()->route('manager.dashboard');
            } elseif ($user->role === 'Sales Person') {
                return redirect()->route('salesperson.dashboard');
            } else {
                return redirect('/login')->withErrors(['email' => 'Role not recognized.']);
            }
        }
    
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
    
    
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
