<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClinicDetails;
use App\Models\Specialization;
use App\Models\Symptoms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Location;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * @group Home Page Api's
 */

class HomeController extends Controller
{
    public $successStatus = 200;

    /**
     * Symptoms Api
     * @response 200{
     * "status": true,
     * "statusCode": 200,
     * "data": [
     *     {
     *         "id": 2,
     *         "specialization_id": 2,
     *         "symptom_name": "Oral Piercing Infection",
     *         "symptom_description": "<p>Visit your doctor for joint pain, sprains, arthritis, and other bone pains.</p>",
     *         "symptom_image": "symptoms/J1Qbab05PP4gVTbBJ3bJ5bW6up46R99VaXpp4uXi.png",
     *         "symptom_status": 1,
     *         "created_at": "2023-06-06T07:13:51.000000Z",
     *         "updated_at": "2023-06-06T07:13:51.000000Z"
     *     }
     *   ]
     * }
     *
     * @response 201{
     * "status": false,
     * "statusCode": 201,
     * "message": "No Symptoms Found"
     * }
     */

    public function symptoms(Request $request)
    {
        try {
            $limit = $request->limit ? $request->limit : 10;
            $offset = $request->offset ? $request->offset : 0;
            $count = Symptoms::where('symptom_status', 1)->count();
            if ($count > 0) {
                $symptoms = Symptoms::where('symptom_status', 1)->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();
                return response()->json(['status' => true, 'statusCode' => 200, 'data' => $symptoms]);
            } else {
                return response()->json(['status' => false, 'statusCode' => 201, 'message' => 'No Symptoms Found'], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 500, 'error' => $th->getMessage()]);
        }
    }

    /**
     * Specialization Api
     * @response 200{
     *  "status": true,
     *  "statusCode": 200,
     *  "data": [
     *      {
     *          "id": 3,
     *          "name": "Dermatologist",
     *          "slug": "dermatologist",
     *          "image": "specializations/V2TlHIoJvN7dL2bYdkUoh2GYhwitQotuohwGNqKe.png",
     *          "description": "Visit your doctor for joint pain, sprains, arthritis, and other bone pains.",
     *          "status": 1,
     *          "created_at": "2023-06-06T10:55:47.000000Z",
     *          "updated_at": "2023-06-06T10:55:47.000000Z"
     *      }
     *    ]
     * }
     *
     * @response 201{
     * "status": false,
     *  "statusCode": 201,
     *  "message": "No Specialization Found"
     * }
     */

    public function specializations(Request $request)
    {
        try {
            $count = Specialization::where('status', 1)->count();
            $limit = $request->limit ? $request->limit : 10;
            $offset = $request->offset ? $request->offset : 0;
            if ($count > 0) {
                $specializations = Specialization::where('status', 1)->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();
                return response()->json(['status' => true, 'statusCode' => 200, 'data' => $specializations]);
            } else {
                return response()->json(['status' => false, 'statusCode' => 201, 'message' => 'No Specialization Found'], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 500, 'error' => $th->getMessage()]);
        }
    }


    /**
     * Location Store Api
     * @bodyParam latitude string required The latitude of the location.
     * @bodyParam longitude string required The longitude of the location.
     * @response 200{
     *  "status": true,
     *  "statusCode": 200,
     *  "data": [
     *      {
     *          "id": 23,
     *          "user_id": 14,
     *          "session_id": null,
     *          "ip_address": "127.0.0.1",
     *          "address": "J92M+P72, Kolkata Station Rd, Belgachia, Kolkata, West Bengal 700004, India",
     *          "latitude": "22.5764753",
     *          "longitude": "88.4306861",
     *          "created_at": "2023-06-06T10:55:47.000000Z",
     *          "updated_at": "2023-06-06T10:55:47.000000Z"
     *      }
     *    ]
     * }
     *
     *
     */

    public function storeLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first(), 'statusCode' => 201, 'status' => false], 201);
        }

        try {
            $location = new Location();
            $location->user_id = auth()->user()->id;
            $location->session_id = null;
            $location->ip_address = $request->ip();
            $location->address = $request->address;
            $location->latitude = $request->latitude;
            $location->longitude = $request->longitude;
            $location->save();

            return response()->json(['status' => true, 'statusCode' => 200, 'data' => $location], $this->successStatus);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 500, 'error' => $th->getMessage()], 500);
        }
    }


    /**
     * All doctors Api
     * @response 200{
     *  "status": true,
     *  "statusCode": 200,
     *  "data": [
     *      {
     *          "id": 13,
     *          "name": "Shreeja Sadhukhan",
     *          "email": "shreeja@yopmail.com",
     *          "phone": "7475850123",
     *          "email_verified_at": "null",
     *          "profile_picture": "doctor/Vd1tp4kQptLxMkCVW5M0q8F9hE2KpEEedIi9LxNz.jpg",
     *          "year_of_experience": "3",
     *          "license_number": "null",
     *          "location": "Purba Bardhaman",
     *          "gender": "Female",
     *          "age": "22",
     *          "status": 1,
     *          "fcm_token": null,
     *          "created_at": "2023-06-06T10:55:47.000000Z",
     *          "updated_at": "2023-06-06T10:55:47.000000Z",
     *          "deleted_at": null
     *      }
     *    ]
     * }
     *
     * @response 201{
     * "status": false,
     *  "statusCode": 201,
     *  "message": "No Doctor Found in your area!"
     * }
     */

    public function allDoctorsByLocation(Request $request)
    {
        try {
            // get clinics within 10km radius
            $latitude = Auth::user()->locations->latitude;
            $longitude = Auth::user()->locations->longitude;
            $radius = 10;
            // $doctors = User::role('DOCTOR')->where('status', 1)->orderBy('id', 'desc')->get();
            $limit = $request->limit ? $request->limit : 10;
            $offset = $request->offset ? $request->offset : 0;

            $clinics = DB::table('clinic_details')
                ->join('users', 'clinic_details.user_id', '=', 'users.id')
                ->select(
                    'clinic_details.id',
                    'clinic_details.user_id',
                    'clinic_name',
                    'clinic_address',
                    'clinic_phone',
                    'longitute',
                    'latitute',
                    DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance')
                )
                ->having('distance', '<', $radius)
                ->get()
                ->groupBy('user_id');
            // get doctors from clinics
            $doctors_array = [];
            foreach ($clinics as $key => $clinic) {
                $doctors_array[] =  $key;
            }

            $allDotor = User::whereIn('id', $doctors_array)->where('status', 1)->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();
            if (count($allDotor) > 0) {
                $doctors = fractal($allDotor, new UserTransformer)->toArray()['data'];
                return response()->json(['status' => true, 'statusCode' => 200, 'data' => $doctors]);
            } else {
                return response()->json(['status' => false, 'statusCode' => 201, 'message' => 'No Doctor Found in your area!'], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 500, 'error' => $th->getMessage()]);
        }
    }



    /**
     * Doctors List as per symptoms/specializations Api
     * @bodyParam type string required The type of the search. example - symptoms, specializations, all
     * @bodyParam slug string required The slug of the search. example - dermatologist, oral-piercing-infection
     *
     * @response 200{
     *  "status": true,
     *  "statusCode": 200,
     *  "data": [
     *      {
     *          "id": 13,
     *          "name": "Shreeja Sadhukhan",
     *          "email": "shreeja@yopmail.com",
     *          "phone": "7475850123",
     *          "email_verified_at": "null",
     *          "profile_picture": "doctor/Vd1tp4kQptLxMkCVW5M0q8F9hE2KpEEedIi9LxNz.jpg",
     *          "year_of_experience": "3",
     *          "license_number": "null",
     *          "location": "Purba Bardhaman",
     *          "gender": "Female",
     *          "age": "22",
     *          "status": 1,
     *          "fcm_token": null,
     *          "created_at": "2023-06-06T10:55:47.000000Z",
     *          "updated_at": "2023-06-06T10:55:47.000000Z",
     *          "deleted_at": null
     *      }
     *    ]
     * }
     *
     * @response 201{
     * "status": false,
     *  "statusCode": 201,
     *  "message": "No Doctor Found"
     * }
     */


    public function doctorsList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'slug' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 201);
        }

        try {
            $type = $request->type;
            $slug = $request->slug;
            $limit = $request->limit ? $request->limit : 10;
            $offset = $request->offset ? $request->offset : 0;
            $latitude = Auth::user()->locations->latitude;
            $longitude = Auth::user()->locations->longitude;
            $radius = 10;

            if ($type == 'symptoms') {
                $data = Symptoms::where('symptom_slug', $slug)->where('symptom_status', 1)->first();
                $symptom_id = $data->id;

                $clinics = DB::table('clinic_details')
                    ->join('users', 'clinic_details.user_id', '=', 'users.id')
                    ->join('doctor_specializations', 'users.id', '=', 'doctor_specializations.doctor_id')
                    ->leftJoin('symptoms', 'symptoms.specialization_id', '=', 'doctor_specializations.specialization_id')
                    ->select(
                        'clinic_details.id',
                        'clinic_details.user_id',
                        'clinic_name',
                        'clinic_address',
                        'clinic_phone',
                        'longitute',
                        'latitute',
                        DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance')
                    )
                    ->where('symptoms.id', $symptom_id)
                    ->having('distance', '<', $radius)
                    ->get()
                    ->groupBy('user_id');
                // get doctors from clinics
                $doctors_array = [];
                foreach ($clinics as $key => $clinic) {

                    $doctors_array[] =  $key;
                }
                $result = [];
                $doctors = User::whereIn('id', $doctors_array)->where('status', 1)->orderBy('id', 'desc')->offset($offset)->limit($limit)->query();
                $result['status'] = 1;
                $result['type'] = 'symptoms';
            } else if ($type == 'specialization') {
                $data = Specialization::where('slug', $slug)->first();
                $specialization_id = $data->id;
                // get doctors within 10km radius

                $all_doctors = DB::table('users')
                    ->join('doctor_specializations', 'users.id', '=', 'doctor_specializations.doctor_id')
                    ->leftJoin('symptoms', 'symptoms.specialization_id', '=', 'doctor_specializations.specialization_id')
                    ->leftJoin('locations', 'locations.user_id', '=', 'users.id')
                    ->select(
                        'users.id as user_id',
                        'users.name',
                        'users.email',
                        'users.phone',
                        'users.year_of_experience',
                        'users.license_number',
                        'users.profile_picture',
                        'users.gender',
                        'users.fcm_token',
                        'locations.address as address',
                        'locations.latitude as latitude',
                        'locations.longitude as longitude',
                        DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitude ) ) ) ) AS distance')
                    )
                    ->where('doctor_specializations.specialization_id', $specialization_id)
                    ->having('distance', '<', $radius)
                    ->get()
                    ->groupBy('user_id');
                // get doctors from clinics
                $doctors_array = [];
                foreach ($all_doctors as $key => $clinic) {
                    $doctors_array[] =  $key;
                }
                $result = [];
                $doctors = User::whereIn('id', $doctors_array)->where('status', 1)->orderBy('id', 'desc')->offset($offset)->limit($limit)->query();
                $result['status'] = 1;
                $result['type'] = 'specialization';
            } else {
                $clinics = DB::table('clinic_details')
                    ->join('users', 'clinic_details.user_id', '=', 'users.id')
                    ->select(
                        'clinic_details.id',
                        'clinic_details.user_id',
                        'clinic_name',
                        'clinic_address',
                        'clinic_phone',
                        'longitute',
                        'latitute',
                        DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance')
                    )
                    ->having('distance', '<', $radius)
                    ->get()
                    ->groupBy('user_id');
                // get doctors from clinics
                $doctors_array = [];
                foreach ($clinics as $key => $clinic) {
                    $doctors_array[] =  $key;
                }
                $result = [];
                $doctors = User::whereIn('id', $doctors_array)->where('status', 1)->orderBy('id', 'desc')->offset($offset)->limit($limit)->query();
                $result['status'] = 1;
                $result['type'] = 'specialization';
            }

            if ($request->search) {
                $doctors->where('name', 'like', '%' . $request->search . '%');
            }
            $result['data'] = fractal($doctors->get(), new UserTransformer)->toArray()['data'];

            return response()->json(['status' => true, 'statusCode' => 200, 'data' => $result]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 500, 'error' => $th->getMessage()]);
        }
    }


    /**
     * Doctors/Clinics List as per search Api
     * @response 200{
     *  "status": true,
     *  "statusCode": 200,
     *  "data": [
     *      {
     *          "id": 13,
     *          "name": "Shreeja Sadhukhan",
     *          "email": "shreeja@yopmail.com",
     *          "phone": "7475850123",
     *          "email_verified_at": "null",
     *          "profile_picture": "doctor/Vd1tp4kQptLxMkCVW5M0q8F9hE2KpEEedIi9LxNz.jpg",
     *          "year_of_experience": "3",
     *          "license_number": "null",
     *          "location": "Purba Bardhaman",
     *          "gender": "Female",
     *          "age": "22",
     *          "status": 1,
     *          "fcm_token": null,
     *          "created_at": "2023-06-06T10:55:47.000000Z",
     *          "updated_at": "2023-06-06T10:55:47.000000Z",
     *          "deleted_at": null
     *      }
     *    ]
     * }
     *
     * @response 404{
     * "status": false,
     *  "statusCode": 404,
     *  "message": "No Doctor or Clinic Found"
     * }
     */


    public function searchDoctorOrClinic(Request $request)
    {

        // get clinics within 10km radius
        $latitude = Auth::user()->locations->latitude;
        $longitude = Auth::user()->locations->longitude;
        $radius = 10;
        $clinics = DB::table('clinic_details')
            ->join('users', 'clinic_details.user_id', '=', 'users.id')
            ->join('doctor_specializations', 'users.id', '=', 'doctor_specializations.doctor_id')
            ->select(
                'clinic_details.id',
                'clinic_details.user_id',
                'clinic_name',
                'clinic_address',
                'clinic_phone',
                'longitute',
                'latitute',
                DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance')
            )
            ->having('distance', '<', $radius)
            ->get()
            ->groupBy('user_id');

        // get doctors from clinics
        $doctors_array = [];
        $clinics_array = [];
        foreach ($clinics as $key => $clinic) {
            $doctors_array[] =  $key;
            $clinics_array[] = $clinic->id;
        }

        $doctors = User::whereIn('id', $doctors_array)->where('name', 'like', '%', $request->search)->get();
        $clinics = ClinicDetails::whereIn('id', $clinics_array)->where('clinic_name', 'like', '%', $request->search)->get();

        $results = $doctors->union($clinics)->get();

        return response()->json(['status' => true, 'statusCode' => 200, 'data' => $results]);
    }
}
