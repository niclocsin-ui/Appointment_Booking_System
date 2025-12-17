<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Staff;

class AdminUserController extends Controller
{
    // 1. Show the User Management Page
    public function index() {
        // Security Check: Only Admins Allowed
        if (session('role') !== 'admin') {
            return redirect('/login');
        }

        $clients = Client::all();
        $staff = Staff::all();

        return view('admin.users', compact('clients', 'staff'));
    }

    // 2. Create a New User (Client or Staff)
    public function store(Request $request) {
        if (session('role') !== 'admin') return back();

        $request->validate([
            'user_type' => 'required', // 'client' or 'staff'
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:clients,Email|unique:staff,Email',
            'password' => 'required',
        ]);

        if ($request->user_type == 'staff') {
            Staff::create([
                'FirstName' => $request->first_name,
                'LastName'  => $request->last_name,
                'Email'     => $request->email,
                'Password'  => $request->password, // In real apps, use Hash::make()
                'Phone'     => $request->phone ?? '0000000000',
                'Role'      => $request->role // 'Provider' or 'Administrator'
            ]);
        } else {
            Client::create([
                'FirstName' => $request->first_name,
                'LastName'  => $request->last_name,
                'Email'     => $request->email,
                'Password'  => $request->password,
            ]);
        }

        return back()->with('success', 'New User Account Created!');
    }

    // 3. Delete a Staff Member
    public function destroyStaff($id) {
        if (session('role') !== 'admin') return back();
        
        // Prevent deleting yourself
        if ($id == session('user_id')) {
            return back()->withErrors(['msg' => 'You cannot delete your own account!']);
        }

        Staff::destroy($id);
        return back()->with('success', 'Staff member deleted.');
    }

    // 4. Delete a Client
    public function destroyClient($id) {
        if (session('role') !== 'admin') return back();
        Client::destroy($id);
        return back()->with('success', 'Client deleted.');
    }
}