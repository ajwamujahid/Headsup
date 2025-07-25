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

        // 🔐 First Try Admin Login
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'admin_id' => $admin->id,
                'admin_name' => $admin->name,
                'admin_email' => $admin->email,
                'role' => 'Admin',
            ]);

            return redirect()->route('admin.dashboard');  // 👈 Admin Dashboard Redirect
        }

        // 🔎 Search in sales_profiles (Sales Manager or Sales Person)
        $user = SalesProfile::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
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

    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Make sure this route exists
        } elseif ($user->role === 'sales_manager') {
            return redirect()->route('manager.dashboard');
        } elseif ($user->role === 'sales_person') {
            return redirect()->route('salesperson.dashboard');
        } else {
            return redirect('/home');
        }
    }
    
    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect('/login');
    // }
   
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
    
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    
        return back()->with('status', 'Profile updated successfully!');
    }
    
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password does not match.']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return back()->with('status', 'Password updated successfully!');
}

}
