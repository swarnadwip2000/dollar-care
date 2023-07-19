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
        $appointments = Appointment::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.patient.my-appointment')->with(compact('appointments'));
    }
}
