<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
         // return date('h:i A');
         $date =  date('Y-m-d');
         $time = date('h:i A');
         $combinedDT = date('Y-m-d H:i A', strtotime("$date $time"));
         $upcominAppontment = Appointment::where('user_id', Auth::user()->id)->where(DB::raw("concat(appointment_date, ' ', appointment_time)"), '>=' , $combinedDT)->orderBy('id', 'DESC')->first();
        // dd($upcominAppontment);
        return view('frontend.patient.dashboard')->with(compact('upcominAppontment'));
    }
}
