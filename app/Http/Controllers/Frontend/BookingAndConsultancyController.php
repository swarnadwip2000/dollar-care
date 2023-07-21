<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ClinicDetails;
use App\Models\Slot;
use App\Models\User;
use App\Models\UserMembership;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BookingAndConsultancyController extends Controller
{
    public function bookingAndConsultancy($id)
    {
        // return date('Y-m-d', strtotime('+' . 7 . 'days'));
        $id = decrypt($id);
        $doctor = User::find($id);
        // get clinics within 10km radius
        $latitude = Auth::user()->locations->latitude;
        $longitude = Auth::user()->locations->longitude;
        $radius = 10;
        $clinics = ClinicDetails::with(array('slots' => function($query) {
            $query->whereBetween('slot_date',[date('Y-m-d'), date('Y-m-d', strtotime('+' . 7 . 'days'))]);
        }))->where('user_id', $id)->select('id', 'user_id', 'clinic_name', 'clinic_address', 'clinic_phone', 'longitute', 'latitute', DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance'))->having('distance', '<', $radius)->get();
        // dd($clinics);   
        return view('frontend.booking-and-consultancy')->with(compact('doctor','clinics'));
    }

    public function doctorChat(Request $request)
    {
        try {
            if ($request->ajax()) {
                if (Auth::check() && Auth::user()->membership_status == true) {
                    $userMembership = UserMembership::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->where('membership_expiry_date', '>=', date('Y-m-d'))->first();
                    if ($userMembership) {
                        return response()->json(['status' => true, 'view' => (string)View::make('frontend.chat')]);
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

    public function visitSlotAjax(Request $request)
    {
        if ($request->ajax()) {
            $clinic_details = ClinicDetails::with('slots')->where('id', $request->clinic_id)->first();
            return response()->json(['view' => (string)View::make('frontend.ajax-clinic-visit')->with(compact('clinic_details'))]);
        }
    }

    public function clinicVisitSlotAjax(Request $request)
    {
        if ($request->ajax()) {
            $slot_times = Slot::where('id', $request->slot_id)->first();
            return response()->json(['view' => (string)View::make('frontend.ajax-clinic-visit-slot-time')->with(compact('slot_times'))]);
        }
    }

    
}
