<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function myAppointment()
    {
        return view('frontend.patient.my-appointment');
    }
}
