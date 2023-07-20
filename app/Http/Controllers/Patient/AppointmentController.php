<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function myAppointment()
    {
        // return date('Y-m-d');
        $upcominAppontments = Appointment::where('user_id', Auth::user()->id)->where('appointment_date', '>=', date('d-m-Y'))->where('appointment_time', '>', date('h:i A'))->orderBy('id', 'DESC')->get();
        $pastAppontments = Appointment::where('user_id', Auth::user()->id)->where('appointment_date', '<', date('d-m-Y'))->orderBy('id', 'DESC')->get();
        $appointments = Appointment::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.patient.my-appointment')->with(compact('appointments','upcominAppontments','pastAppontments'));
    }
}
