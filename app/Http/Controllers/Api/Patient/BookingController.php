<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\ClinicDetails;
use App\Models\Slot;
use App\Models\Appointment;
use App\Mail\ThankYouMail;
use Carbon\Carbon;

/**
 * @group Patient Booking 
 * */ 

class BookingController extends Controller
{
    /**
     * Booking and Consultancy
     * @response 200{
     *       "message": "Booking And Consultancy",
     *       "status": true,
     *       "data": {
     *          "doctor": {
     *             "id": 4,
     *              "name": "James Bond",
     *             "email": "james@yopmail.com",
     *              "phone": "08596769586",
     *              "email_verified_at": null,
     *              "profile_picture": "doctor/5HiPk9oN9cQCNNKdzmBgvNLHSL8u7bbHncdrPE91.png",
     *             "year_of_experience": "4",
     *              "license_number": "UPS74856963",
     *              "location": "Kolkata",
     *              "gender": "Male",
     *              "age": "2001-01-30",
     *              "status": 1,
     *              "fcm_token": "fTcKacaIV3mJaU4VbJ_4Ib:APA91bHgCcot6OOpAlysNgDKq54K9PnU6PjDM3tHdiWFm5KpPXDnVVfcfTJV2C4Q6wKk056fIp6zgOLbEU1DhAvN5SQqZGg0ew7qjKN_FAXyd9ORER4vMhjf1qLc9pY32gI7ZGIJLAaI",
     *             "created_at": "2023-06-06T08:40:43.000000Z",
     *              "updated_at": "2023-07-25T08:53:27.000000Z",
     *              "deleted_at": null
     *         },
     *       "clinics": [
     *          {
     *             "id": 7,
     *             "user_id": 4,
     *             "clinic_name": "Life Medical",
     *             "clinic_address": "Park Street, Mullick Bazar, Beniapukur, Kolkata, West Bengal, India",
     *             "clinic_phone": "7894561230",
     *             "longitute": "88.3598025",
     *             "latitute": "22.5474164",
     *             "distance": 7.963637575826944
     *         },
     *      ]
     *      }
     *  }
     * 
     */
    public function bookingAndConsultancy(Request $request)
    {
        $id = $request->id;
        $data['doctor'] = User::find($id);
        // get clinics within 10km radius
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = 10;
        $data['clinics'] = ClinicDetails::where('user_id', $id)->select('id', 'user_id', 'clinic_name', 'clinic_address', 'clinic_phone', 'longitute', 'latitute', DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitute ) ) * cos( radians( longitute ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitute ) ) ) ) AS distance'))->having('distance', '<', $radius)->get();
        // dd($clinics); 
        
        return response()->json(['message' => 'Booking And Consultancy', 'status' => true, 'data' => $data], 200);
    }


    /**
     * Clinic Date and Time Slot
     * 
     * @response 200{
     *       "message": "Clinic Details!",
     *       "status": true,
     *       "data": {
     *          "id": 7,
     *         "user_id": 4,
     *          "clinic_name": "Life Medical",
     *          "clinic_address": "Park Street, Mullick Bazar, Beniapukur, Kolkata, West Bengal, India",
     *          "clinic_phone": "7894561230",
     *          "longitute": "88.3598025",
     *          "latitute": "22.5474164",
     *          "distance": 7.963637575826944,
     *         "clinic_slots": [
     *              {
     *                  "id": 1,
     *                  "clinic_detail_id": 7,
     *                  "slot_date": "2021-08-02",
     *                  "slot_start_time": "11:00 AM",
     *                  "slot_end_time": "12:00 PM",
     *                  "created_at": null,     
     *                  "updated_at": null
     *             },
     *         ]
     *      }
     *  }
     * 
     */
    public function visitDate(Request $request)
    {
        if ($request->status == true) {
            $clinic_details = ClinicDetails::with(array('clinic_slots' => function ($query) {
                $query->whereBetween('slot_date', [date('Y-m-d'), date('Y-m-d', strtotime('+' . 7 . 'days'))]);
            }))->where('id', $request->clinic_id)->first();

            return response()->json(['message' => 'Clinic Details', 'status' => true, 'data' => $clinic_details]);
        }
    }

    /**
     * Clinic Visit available Slot Time
     * 
     * @response 200{
     *      "message": "Clinic Details!",
     *     "status": true,
     *    "data": {
     *          "id": 1,
     *          "clinic_detail_id": 7,
     *          "slot_date": "2021-08-02",
     *          "slot_start_time": "11:00 AM",
     *          "slot_end_time": "12:00 PM",
     *          "created_at": null,
     *          "updated_at": null
     *     }
     * }
     */
    public function clinicVisitSlot(Request $request)
    {
        if ($request->status == true) {
            $slot_times = Slot::where('id', $request->slot_id)->first();

            return response()->json(['message' => 'Clinic Details', 'status' => true, 'data' => $slot_times]);
        }
    }

    /** 
     * Store Appointment
     * 
     * @response 200{
     *    "message": "Appointment booked successfully!",
     *   "status": true,
     *     "data": {
     *          "user_id": 1,
     *          "doctor_id": 4,
     *          "clinic_id": 7,
     *          "appointment_id": "000000",
     *          "appointment_date": "2021-08-02",
     *          "appointment_time": "11:00 AM",
     *           "appointment_status": "Done",
     *           "booking_time": "2021-08-02 12:00:00",
     *           "clinic_name": "Life Medical",
     *            "clinic_address": "Park Street, Mullick Bazar, Beniapukur, Kolkata, West Bengal, India",
     *          "clinic_phone": "7894561230",
     *          "updated_at": "2021-08-02T12:00:00.000000Z",
     *          "created_at": "2021-08-02T12:00:00.000000Z",
     *          "id": 1,
     *          "user": {
     *              "id": 1,
     *              "name": "Shilpi Chaki",
     *              "email": "shilpi@mailinator.com",  
     *              "email_verified_at": null,
     *              "profile_picture": "user/5HiPk9oN9cQCNNKdzmBgvNLHSL8u7bbHncdrPE91.png",
     *              "phone": "7894561230",
     *              "year_of_experience": "4",
     *              "license_number": "UPS74856963",
     *              "location": "Kolkata",
     *              "gender": "female",
     *              "age": "2001-01-30",
     *              "status": 1,
     *              "fcm_token": "fTcKacaIV3mJaU4VbJ_4Ib:APA91bHgCcot6OOpAlysNgDKq54K9PnU6PjDM3tHdiWFm5KpPXDnVVfcfTJV2C4Q6wKk056fIp6zgOLbEU1DhAvN5SQqZGg0ew7qjKN_FAXyd9ORER4vMhjf1qLc9pY32gI7ZGIJLAaI",
     *              "created_at": "2021-07-25T08:53:27.000000Z",
     *              "updated_at": "2021-07-25T08:53:27.000000Z",
     *              "deleted_at": null
     *          }
     *     }
     * }
     */
    public function storeAppointment(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'clinic_id' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            // Add other validation rules for your fields
        ], [
            'clinic_id.required' => 'Please Select Clinic for booking slot.',
            'appointment_date.required' => 'Please Select Appointment Date for booking slot.',
            'appointment_time.required' => 'Please Select Appointment Time for booking slot.',
        ]);

        if ($validator->fails()) {
            $errors['message'] = [];
            $data = explode(',', $validator->errors());

            for ($i = 0; $i < count($validator->errors()); $i++) {
                // return $data[$i];
                $dk = explode('["', $data[$i]);
                $ck = explode('"]', $dk[1]);
                $errors['message'][$i] = $ck[0];
            }
            return response()->json(['status' => false, 'statusCode' => 401,  'error' => $errors], 401);
        }

        try {
            $count = Appointment::where(['user_id' => Auth::user()->id, 'appointment_time' => $request->appointment_time, 'appointment_status' => 'Done'])->count();
            if ($count > 0) {
                return response()->json(['message' => 'You have already booked an appointment on this date and time!!', 'status' => false, 'statusCode' => 401], 401);
            }

            $clinic_details = ClinicDetails::where('id', $request->clinic_id)->first();

            $appointment = new Appointment();
            $appointment->user_id  = Auth::User()->id;
            $appointment->doctor_id  = $request->doctor_id;
            $appointment->clinic_id  = $request->clinic_id;
            $appointment->appointment_id = rand(000000, 999999);
            $appointment->appointment_date  = $request->appointment_date;
            $appointment->appointment_time  = $request->appointment_time;
            $appointment->appointment_status = 'Done';
            $appointment->booking_time  = Carbon::now();
            $appointment->clinic_name  = $clinic_details->clinic_name;
            $appointment->clinic_address = $clinic_details->clinic_address;
            $appointment->clinic_phone = $clinic_details->clinic_phone;
            $appointment->save();
            Session::put('remember', 1);
            $body = [
                'appointment' => $appointment
            ];
            $email = Auth::user()->email;
            Mail::to($email)->send(new ThankYouMail($body));

            return response()->json(['message' => 'Appointment booked successfully!', 'status' => true, 'data' => $appointment]);
        } catch(\Throwable $th) {
            return response()->json(['message' => 'Something went wrong!', 'status' => false, 'data' => $th->getMessage()]);
        }

        
    }
}
