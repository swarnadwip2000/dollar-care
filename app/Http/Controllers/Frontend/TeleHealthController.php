<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Specialization;
use App\Models\ClinicDetails;
use App\Models\User;
use App\Models\Symptoms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TeleHealthController extends Controller
{
    public function telehealth()
    {
        $blogs = Blog::orderBy('id', 'desc')->limit(4)->offset(1)->get();
        $blog = Blog::orderBy('id', 'desc')->first();
        $symptoms = Symptoms::orderBy('id', 'desc')->where('symptom_status', 1)->get();
        $speciliaztions = Specialization::orderBy('id', 'desc')->where('status', 1)->get();
        return view('frontend.telehealth')->with(compact('blogs', 'blog', 'symptoms', 'speciliaztions'));
    }

    public function  viewAllSpecializations()
    {
        $speciliaztions = Specialization::where('status', 1)->get();
        return view('frontend.all-specialist')->with(compact('speciliaztions'));
    }

    public function searchSpecialization(Request $request)
    {
        if ($request->ajax()) {
            if ($request->search == null) {
                $speciliaztions = Specialization::orderBy('id', 'desc')->where('status', 1)->get();
                return response()->json(['view' => (string)View::make('frontend.search-specilzation')->with(compact('speciliaztions'))]);
            } else {
                $speciliaztions = Specialization::orderBy('id', 'desc')->where('name', 'LIKE', '%' . $request->search . '%')->get();
                return response()->json(['view' => (string)View::make('frontend.search-specilzation')->with(compact('speciliaztions'))]);
            }
        }
    }

    public function doctors($type, $slug)
    {
        if ($type == 'symptoms') {
            $data = Symptoms::where('symptom_slug', $slug)->where('symptom_status', 1)->first();
            // get clinics within 10km radius
            $latitude = AutH::user()->locations->latitude;
            $longitude = Auth::user()->locations->longitude;
            $radius = 10;
            $clinics = ClinicDetails::select('id', 'user_id', 'clinic_name', 'clinic_address', 'clinic_phone', 'longitute', 'latitute', DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance'))->having('distance', '<', $radius)->with('users')->get()->groupBy('user_id');
            // dd($clinics);
            // get doctors from clinics
            $doctors_array = [];
            foreach ($clinics as $key => $clinic) {
                $doctors_array[] =  $key;
            }
            $doctors = User::whereIn('id', $doctors_array)->get();
            // @dd($doctors);
            $type = 'symptoms';
            return view('frontend.doctors')->with(compact('doctors', 'data', 'type'));
        } else {
            $data = Specialization::where('slug', $slug)->first();
            $doctors = $data->doctors()->where('status', 1)->get();
            $type = 'specialization';

            return view('frontend.doctors')->with(compact('doctors', 'data', 'type'));
        }
    }
}
