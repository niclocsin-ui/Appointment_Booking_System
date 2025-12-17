<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Client;

class AuthController extends Controller
{
    // Show Login Page
    public function showLogin() {
        return view('auth.login');
    }

    // Process Login
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 1. Check STAFF Table (Admins & Providers)
        $staff = Staff::where('Email', $request->email)->first();
        if ($staff && $staff->Password == $request->password) {
            
            // CHECK ROLE: Is this person an Administrator or just a Provider?
            $role = ($staff->Role === 'Administrator') ? 'admin' : 'staff';

            session([
                'user_id' => $staff->StaffID, 
                'role' => $role, // Saves 'admin' or 'staff'
                'name' => $staff->FirstName
            ]);
            
            return redirect('/appointments');
        }

        // 2. Check CLIENT Table
        $client = Client::where('Email', $request->email)->first();
        if ($client && $client->Password == $request->password) {
            session([
                'user_id' => $client->ClientID, 
                'role' => 'client', 
                'name' => $client->FirstName
            ]);
            return redirect('/book');
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    // Logout
    public function logout() {
        session()->flush();
        return redirect('/login');
    }
}