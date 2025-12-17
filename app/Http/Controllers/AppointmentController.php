<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;

class AppointmentController extends Controller
{
    // --- CLIENT FEATURES ---

    public function create() {
        // Only Clients can book
        if (session('role') !== 'client') {
            return redirect('/login');
        }
        $services = Service::all();
        return view('appointments.create', compact('services'));
    }

    public function store(Request $request) {
        $request->validate([
            'ServiceID' => 'required',
            'AppointmentDate' => 'required|date',
            'AppointmentTime' => 'required',
        ]);

        // Check Double Booking
        $exists = Appointment::where('AppointmentDate', $request->AppointmentDate)
                             ->where('AppointmentTime', $request->AppointmentTime)
                             ->exists();

        if ($exists) {
            return back()->withErrors(['msg' => 'Time slot taken!']);
        }

        Appointment::create([
            'ClientID' => session('user_id'),
            'StaffID' => $request->StaffID ? $request->StaffID : null, 
            'ServiceID' => $request->ServiceID,
            'AppointmentDate' => $request->AppointmentDate,
            'AppointmentTime' => $request->AppointmentTime,
            'Status' => 'Scheduled'
        ]);

        return redirect('/my-appointments')->with('success', 'Booked!');
    }

    public function clientDashboard() {
        // Business Rule: View History
        if (session('role') !== 'client') return redirect('/login');
        
        $appointments = Appointment::where('ClientID', session('user_id'))
                                   ->orderBy('AppointmentDate', 'desc')->get();
        return view('appointments.client_dashboard', compact('appointments'));
    }

    public function cancel($id) {
        // Business Rule: Client can cancel
        $apt = Appointment::where('AppointmentID', $id)->where('ClientID', session('user_id'))->first();
        if ($apt && $apt->Status == 'Scheduled') {
            $apt->Status = 'Canceled';
            $apt->save();
            return back()->with('success', 'Canceled.');
        }
        return back()->withErrors(['msg' => 'Cannot cancel.']);
    }

    // --- STAFF / ADMIN FEATURES ---

    public function index() {
        // Allow both 'staff' and 'admin'
        if (!in_array(session('role'), ['staff', 'admin'])) {
            return redirect('/login');
        }
        $appointments = Appointment::with(['client', 'service'])->get();
        return view('appointments.index', compact('appointments'));
    }

    public function updateStatus(Request $request, $id) {
        // Both can update status
        $apt = Appointment::find($id);
        if($apt) {
            $apt->Status = $request->status;
            $apt->save();
        }
        return back()->with('success', 'Status updated.');
    }

    public function saveNote(Request $request, $id) {
        // Both can add notes
        $apt = Appointment::find($id);
        if ($apt) {
            $apt->Notes = $request->notes;
            $apt->save();
        }
        return back()->with('success', 'Note saved.');
    }

    public function destroy($id) {
        // Business Rule: ONLY ADMIN CAN DELETE
        if (session('role') !== 'admin') {
            return back()->withErrors(['msg' => 'Access Denied: Only Admins can delete.']);
        }

        Appointment::destroy($id);
        return back()->with('success', 'Appointment deleted.');
    }
}