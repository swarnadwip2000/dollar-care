<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BookingAndConsultancyController extends Controller
{
    public function bookingAndConsultancy($id)
    {
        $id = decrypt($id);
        $doctor = User::find($id);
        // dd($user);
        return view('frontend.booking-and-consultancy')->with(compact('doctor'));
    }
}
