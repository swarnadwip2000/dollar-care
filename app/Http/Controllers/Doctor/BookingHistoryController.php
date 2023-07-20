<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BookingHistoryController extends Controller
{
    public function bookingHistory()
    {
        $bookingHistory = Appointment::where('doctor_id', Auth::user()->id)->orderBy('appointment_date', 'DESC')->get();
        $clinics = Auth::user()->clinicDetails;
        return view('frontend.doctor.booking-history')->with(compact('bookingHistory', 'clinics'));
    }

    public function bookingHistoryAjax(Request $request)
    {
        // return $request->all();
       if ($request->ajax()) {
          $query = Appointment::where('doctor_id', Auth::user()->id)->orderBy('appointment_date', 'DESC');
            if ($request->date) {
                 $query->where('appointment_date',  date('d-m-Y', strtotime($request->date)));
            }
            if ($request->clinic_id) {
                 $query->whereIn('clinic_id', $request->clinic_id);
            }

            if ($request->status) {
                 $query->whereIn('appointment_status', $request->status);
            }
          
             $bookingHistory = $query->get();
            return response()->json(['view'=>(String)View::make('frontend.doctor.ajax-booking-history')->with(compact('bookingHistory'))]);
       }
    }
}
