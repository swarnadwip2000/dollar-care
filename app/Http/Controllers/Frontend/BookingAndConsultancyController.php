<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BookingAndConsultancyController extends Controller
{
    public function bookingAndConsultancy($id)
    {
        $id = decrypt($id);
        $doctor = User::find($id);
        // dd($user);
        return view('frontend.booking-and-consultancy')->with(compact('doctor'));
    }

    public function doctorChat(Request $request)
    {
        try {
            if ($request->ajax()) {
                if (Auth::check() && Auth::user()->membership_status == true) {
                    $userMembership = UserMembership::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->where('membership_expiry_date', '>=', date('Y-m-d'))->first();
                    if ($userMembership) {
                        return response()->json(['status' => true, 'view'=> (string)View::make('frontend.chat')]);
                    } else {
                        return response()->json(['status' => false, 'message' => 'Your membership has been expired.']);
                    }
                } else {
                    return response()->json(['status' => false, 'message' => 'You are not a member.']);
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
}
