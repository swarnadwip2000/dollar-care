<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClinicDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request, $id) 
    {
        // return date('Y-m-d', strtotime('+' . 7 . 'days'));
        $id = decrypt($id);
        $doctor = User::find($id);
        // get clinics within 10km radius
        $latitude = Auth::user()->locations->latitude;
        $longitude = Auth::user()->locations->longitude;
        $radius = 10;
        $clinics = ClinicDetails::where('user_id', $id)->select('id', 'user_id', 'clinic_name', 'clinic_address', 'clinic_phone', 'longitute', 'latitute', DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance'))->having('distance', '<', $radius)->get();
        // dd($clinics);   
        return response()->json(['message' => 'Booking and Consultancy', 'status' => true, 'data' => $clinics]);
    }

    public function visitSlotAjax(Request $request)
    {
        if ($request->ajax()) {
            $clinic_details = ClinicDetails::with(array('clinic_slots' => function ($query) {
                $query->whereBetween('slot_date', [date('Y-m-d'), date('Y-m-d', strtotime('+' . 7 . 'days'))]);
            }))->where('id', $request->clinic_id)->first();
            return response()->json(['message' => 'Clinic Details', 'status' => true, 'data' => $clinic_details]);
        }
    }
}
