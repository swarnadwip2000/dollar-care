<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $bookingHistory = Appointment::where('doctor_id', Auth::user()->id)->orderBy('appointment_date', 'DESC')->get();
        return view('frontend.doctor.dashboard')->with(compact('bookingHistory'));
    }
}
