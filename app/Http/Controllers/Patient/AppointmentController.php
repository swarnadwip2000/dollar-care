<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function myAppointment()
    {
        // return date('h:i A');
        $date =  date('d-m-Y');
        $time = date('h:i A');
        $combinedDT = date('d-m-Y H:i A', strtotime("$date $time"));
        $upcominAppontments = Appointment::where('user_id', Auth::user()->id)->where(DB::raw("concat(appointment_date, ' ', appointment_time)"), '>=' , $combinedDT)->orderBy('id', 'DESC')->get();
        // dd($upcominAppontments);
        $pastAppontments = Appointment::where('user_id', Auth::user()->id)->where('appointment_date', '<', date('d-m-Y'))->orderBy('id', 'DESC')->get();
        $appointments = Appointment::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.patient.my-appointment')->with(compact('appointments','upcominAppontments','pastAppontments'));
    }
}
