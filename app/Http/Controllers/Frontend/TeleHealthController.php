<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\Specialization;
use App\Models\ClinicDetails;
use App\Models\User;
use App\Models\Symptoms;
use Carbon\Carbon;
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
            $symptom_id = $data->id;
            // get clinics within 10km radius
            $latitude = AutH::user()->locations->latitude;
            $longitude = Auth::user()->locations->longitude;
            $radius = 10;
            $clinics = DB::table('clinic_details')
                ->join('users', 'clinic_details.user_id', '=', 'users.id')
                ->join('doctor_specializations', 'users.id', '=', 'doctor_specializations.doctor_id')
                ->leftJoin('symptoms', 'symptoms.specialization_id', '=', 'doctor_specializations.specialization_id')
                ->select('clinic_details.id', 'clinic_details.user_id', 'clinic_name', 'clinic_address', 'clinic_phone', 'longitute', 'latitute',
                    DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance'))
                ->where('symptoms.id', $symptom_id)
                ->having('distance', '<', $radius)
                ->get()
                ->groupBy('user_id');
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
            $specialization_id = $data->id;
            // $doctors = $data->doctors()->where('status', 1)->get();
            // get clinics within 10km radius
            // dd(Auth::user());
            $latitude = Auth::user()->locations->latitude;
            $longitude = Auth::user()->locations->longitude;
            $radius = 10;
            $clinics = DB::table('clinic_details')
                ->join('users', 'clinic_details.user_id', '=', 'users.id')
                ->join('doctor_specializations', 'users.id', '=', 'doctor_specializations.doctor_id')
                ->leftJoin('symptoms', 'symptoms.specialization_id', '=', 'doctor_specializations.specialization_id')
                ->select('clinic_details.id', 'clinic_details.user_id', 'clinic_name', 'clinic_address', 'clinic_phone', 'longitute', 'latitute',
                    DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance'))
                ->where('symptoms.id', $specialization_id)
                ->having('distance', '<', $radius)
                ->get()
                ->groupBy('user_id');
            // dd($clinics);
            // get doctors from clinics
            $doctors_array = [];
            foreach ($clinics as $key => $clinic) {
                $doctors_array[] =  $key;
            }
            $doctors = User::whereIn('id', $doctors_array)->get();
            $type = 'specialization';

            return view('frontend.doctors')->with(compact('doctors', 'data', 'type'));
        }
    }

    public function doctorSearch(Request $request) 
    {
        $data_slug = $request->slug;
        $type = $request->type;
        if ($request->search) {
            if($type == 'symptoms') {
                $data = Symptoms::where('symptom_slug', $data_slug)->where('symptom_status', 1)->first();

                $symptom_id = $data->id;
                // get clinics within 10km radius
                $latitude = AutH::user()->locations->latitude;
                $longitude = Auth::user()->locations->longitude;
                $radius = 10;
                $clinics = DB::table('clinic_details')
                    ->join('users', 'clinic_details.user_id', '=', 'users.id')
                    ->join('doctor_specializations', 'users.id', '=', 'doctor_specializations.doctor_id')
                    ->leftJoin('symptoms', 'symptoms.specialization_id', '=', 'doctor_specializations.specialization_id')
                    ->select('clinic_details.id', 'clinic_details.user_id', 'clinic_name', 'clinic_address', 'clinic_phone', 'longitute', 'latitute',
                        DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance'))
                    ->where('symptoms.id', $symptom_id)
                    ->having('distance', '<', $radius)
                    ->get()
                    ->groupBy('user_id');
                // get doctors from clinics
                $doctors_array = [];
                foreach ($clinics as $key => $clinic) {
                    
                    $doctors_array[] =  $key;
                            
                }
                $doctors = User::whereIn('id', $doctors_array)->where('name', 'like', '%' . $request->search . '%')->get();
                $type = 'symptoms';
            } else {
                $data = Specialization::where('slug', $data_slug)->first();
                $specialization_id = $data->id;
                $latitude = Auth::user()->locations->latitude;
                $longitude = Auth::user()->locations->longitude;
                $radius = 10;
                $clinics = DB::table('clinic_details')
                    ->join('users', 'clinic_details.user_id', '=', 'users.id')
                    ->join('doctor_specializations', 'users.id', '=', 'doctor_specializations.doctor_id')
                    ->leftJoin('symptoms', 'symptoms.specialization_id', '=', 'doctor_specializations.specialization_id')
                    ->select('clinic_details.id', 'clinic_details.user_id', 'clinic_name', 'clinic_address', 'clinic_phone', 'longitute', 'latitute',
                        DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance'))
                    ->where('symptoms.id', $specialization_id)
                    ->having('distance', '<', $radius)
                    ->get()
                    ->groupBy('user_id');
                // get doctors from clinics
                $doctors_array = [];
                foreach ($clinics as $key => $clinic) {
                    $doctors_array[] =  $key;
                }
                $doctors = User::whereIn('id', $doctors_array)->where('name', 'like', '%' . $request->search . '%')->get();
                $type = 'specialization';

            }
        return view('frontend.doctors')->with(compact('doctors', 'data', 'type'));
        } 
        
    }

    public function alphabeticSearch(Request $request)
    {
        $data_slug = $request->slug;
        $type = $request->type;
        if($type == 'symptoms') {
            $data = Symptoms::where('symptom_slug', $data_slug)->where('symptom_status', 1)->first();
        } else {
            $data = Specialization::where('slug', $slug)->first();
        }

        if ($request->alphabeticsearch) {
            if($request->alphabeticSearch == '1') {
                $doctors = User::where('name', 'like', '%' . $request->alphabeticsearch . '%')->orderBy('name')->get();
            } else {
                $doctors = User::where('name', 'like', '%' . $request->alphabeticsearch . '%')->orderByDesc('name')->get();
            }
            

            return view('frontend.doctors')->with(compact('doctors', 'data', 'type'));
        } else {
            return $this->doctors($type,$data);
        }
    }

        public function alphabeticSearch1 (Request $request)
        {
        $data_slug = $request->slug;
        $type = $request->type;
        if($type == 'symptoms') {
            $data = Symptoms::where('symptom_slug', $data_slug)->where('symptom_status', 1)->first();
        } else {
            $data = Specialization::where('slug', $slug)->first();
        }

        if ($request->alphabeticsearch) {
            if($request->alphabeticSearch == '1') {
                $doctors = User::where('name', 'like', '%' . $request->alphabeticsearch . '%')->orderBy('name')->get();
            } else {
                $doctors = User::where('name', 'like', '%' . $request->alphabeticsearch . '%')->orderByDesc('name')->get();
            }
            

            return view('frontend.doctors')->with(compact('doctors', 'data', 'type'));
        } else {
            return $this->doctors($type,$data);
        }
    }


    
}
