<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\DoctorSpecialization;
use App\Models\Specialization;
use App\Models\User;
use App\Traits\ImageTrait;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @group Doctor Profile
 */
class ProfileController extends Controller
{
    use ImageTrait;
    public $sucessStatus = 200;
    /**
     * Get Doctor Profile
     * @authenticated
     * @response 200{
     *"status": true,
     * "statusCode": 200,
     * "message": "Profile fetched successfully",
     * "data": {
     *     "specializations": [
     *         {
     *             "id": 2,
     *             "name": "Dentist",
     *             "slug": "dentist",
     *             "image": "specialization/1dyavyARmT4SiXK9izxsvF1vjW0PYXI28mB94TuB.png",
     *             "description": "Visit your doctor for joint pain, sprains, arthritis, and other bone pains.",
     *             "status": 1,
     *             "created_at": "2023-06-06T12:40:19.000000Z",
     *             "updated_at": "2023-06-14T08:51:04.000000Z"
     *         },
     *     ],
     *     "user": {
     *         "data": {
     *             "id": 4,
     *             "name": "James Bond",
     *             "email": "james@yopmail.com",
     *             "phone": "08596769586",
     *             "gender": "Male",
     *             "age": "2001-01-30",
     *             "license_number": "UPS74856963",
     *             "profile_picture": "doctor/5HiPk9oN9cQCNNKdzmBgvNLHSL8u7bbHncdrPE91.png",
     *             "fcm_token": "eyo_Z9a_EQkcwF1y_TjA-U:APA91bFvEyoQw3XaMNheNcHlQMQISc-sB2b3RWySS515RaMauTX1RCKrinBcf5-4FhZeLtoB-BYV4K0khjO8pD1ZTi257s3A6_sH36SZGN4tBdS1AlUo3L2sBaXKpZoI0gwq-MWETDfN",
     *             "status": 1,
     *             "specializations": [
     *                 {
     *                     "id": 4,
     *                     "name": "ENT Specialist",
     *                     "pivot": {
     *                         "doctor_id": 4,
     *                         "specialization_id": 4
     *                     }
     *                 }
     *             ]
     *         }
     *     }
     * }
     * }
     */

    public function getProfile(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $data['specializations'] = Specialization::orderBy('name', 'asc')->get();
        $data['user'] = fractal($user, new UserTransformer())->toArray();
        return response()->json([
            'status' => true,
            'statusCode' => $this->sucessStatus,
            'message' => 'Profile fetched successfully',
            'data' => $data
        ]);
    }



    /**
     * Update Doctor Profile
     * @authenticated
     * @response 200{
     *"status": true,
     * "statusCode": 200,
     * "message": "Profile fetched successfully",
     * "data": {
     *     "specializations": [
     *         {
     *             "id": 2,
     *             "name": "Dentist",
     *             "slug": "dentist",
     *             "image": "specialization/1dyavyARmT4SiXK9izxsvF1vjW0PYXI28mB94TuB.png",
     *             "description": "Visit your doctor for joint pain, sprains, arthritis, and other bone pains.",
     *             "status": 1,
     *             "created_at": "2023-06-06T12:40:19.000000Z",
     *             "updated_at": "2023-06-14T08:51:04.000000Z"
     *         },
     *     ],
     *     "user": {
     *         "data": {
     *             "id": 4,
     *             "name": "James Bond",
     *             "email": "james@yopmail.com",
     *             "phone": "08596769586",
     *             "gender": "Male",
     *             "age": "2001-01-30",
     *             "license_number": "UPS74856963",
     *             "profile_picture": "doctor/5HiPk9oN9cQCNNKdzmBgvNLHSL8u7bbHncdrPE91.png",
     *             "fcm_token": "eyo_Z9a_EQkcwF1y_TjA-U:APA91bFvEyoQw3XaMNheNcHlQMQISc-sB2b3RWySS515RaMauTX1RCKrinBcf5-4FhZeLtoB-BYV4K0khjO8pD1ZTi257s3A6_sH36SZGN4tBdS1AlUo3L2sBaXKpZoI0gwq-MWETDfN",
     *             "status": 1,
     *             "specializations": [
     *                 {
     *                     "id": 4,
     *                     "name": "ENT Specialist",
     *                     "pivot": {
     *                         "doctor_id": 4,
     *                         "specialization_id": 4
     *                     }
     *                 }
     *             ]
     *         }
     *     }
     * }
     * }
     * @bodyParam name string required The name of the Doctor.
     * @bodyParam email string required The email of the Doctor.
     * @bodyPara  gender string reqired. Example: Male, Female, Other.
     * @bodyParam age date required The age of the Doctor.
     * @bodyParam phone numeric required The phone of the Doctor.
     * @bodyParam specialization_id array required The specialization_id of the Doctor.
     * @bodyParam license_number string required The license_number of the Doctor.
     * @response 201{
     * "error": "The email has already been taken."
     * }
     * @response 201{
     * "error": "The phone has already been taken."
     * }    
     */

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email,' . auth()->user()->id,
            'gender' => 'required',
            'age' => 'required',
            'phone' => 'required|numeric',
            //path is array or not and check if it is required or not
            'specialization_id' => 'array',
            'specialization_id.*' => 'required',
            'license_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 201);
        }

        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->age = $request->age;
            $user->phone = $request->phone;
            $user->license_number = $request->license_number;
            $user->save();
            if ($request->specialization_id) {
                DoctorSpecialization::where('doctor_id', Auth::user()->id)->delete();
                foreach ($request->specialization_id as $key => $value) {
                    $doctorSpecialization = DoctorSpecialization::create([
                        'doctor_id' => Auth::user()->id,
                        'specialization_id' => $value,
                    ]);
                }
            }

            $data =  fractal($user, new UserTransformer())->toArray();

            return response()->json([
                'status' => true,
                'statusCode' => $this->sucessStatus,
                'message' => 'Profile updated successfully',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     *  Upload profile image
     * @authenticated
     * @bodyParam profile_picture file required The profile_picture of the Doctor.
     * @response 200{
     *"status": true,
     * "statusCode": 200,
     * "message": "Profile updated successfully",
     * "data": {
     *     "specializations": [
     *         {
     *             "id": 2,
     *             "name": "Dentist",
     *             "slug": "dentist",
     *             "image": "specialization/1dyavyARmT4SiXK9izxsvF1vjW0PYXI28mB94TuB.png",
     *             "description": "Visit your doctor for joint pain, sprains, arthritis, and other bone pains.",
     *             "status": 1,
     *             "created_at": "2023-06-06T12:40:19.000000Z",
     *             "updated_at": "2023-06-14T08:51:04.000000Z"
     *         },
     *     ],
     *     "user": {
     *         "data": {
     *             "id": 4,
     *             "name": "James Bond",
     *             "email": "james@yopmail.com",
     *             "phone": "08596769586",
     *             "gender": "Male",
     *             "age": "2001-01-30",
     *             "license_number": "UPS74856963",
     *             "profile_picture": "doctor/5HiPk9oN9cQCNNKdzmBgvNLHSL8u7bbHncdrPE91.png",
     *             "fcm_token": "eyo_Z9a_EQkcwF1y_TjA-U:APA91bFvEyoQw3XaMNheNcHlQMQISc-sB2b3RWySS515RaMauTX1RCKrinBcf5-4FhZeLtoB-BYV4K0khjO8pD1ZTi257s3A6_sH36SZGN4tBdS1AlUo3L2sBaXKpZoI0gwq-MWETDfN",
     *             "status": 1,
     *             "specializations": [
     *                 {
     *                     "id": 4,
     *                     "name": "ENT Specialist",
     *                     "pivot": {
     *                         "doctor_id": 4,
     *                         "specialization_id": 4
     *                     }
     *                 }
     *             ]
     *         }
     *     }
     * }
     * }
     * @response 201{
     * "error": "The profile_picture filled is required."
     * }
     */

    public function updateProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 201);
        }

        try {
            $user = auth()->user();
            $user->profile_picture = $this->imageUpload($request->profile_picture, 'doctor');
            $user->save();
            $data =  fractal($user, new UserTransformer())->toArray();

            return response()->json([
                'status' => true,
                'statusCode' => $this->sucessStatus,
                'message' => 'Profile updated successfully',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Change Password
     * @authenticated
     * @bodyParam current_password string required The old_password of the Doctor.
     * @bodyParam new_password string required The password of the Doctor.
     * @bodyParam confirm_password string required The password_confirmation of the Doctor.
     * @response 200{
     *"status": true,
     * "statusCode": 200,
     * "message": "Password changed successfully",
     * "data": {
     *     "specializations": [
     *         {
     *             "id": 2,
     *             "name": "Dentist",
     *             "slug": "dentist",
     *             "image": "specialization/1dyavyARmT4SiXK9izxsvF1vjW0PYXI28mB94TuB.png",
     *             "description": "Visit your doctor for joint pain, sprains, arthritis, and other bone pains.",
     *             "status": 1,
     *             "created_at": "2023-06-06T12:40:19.000000Z",
     *             "updated_at": "2023-06-14T08:51:04.000000Z"
     *         },
     *     ],
     *     "user": {
     *         "data": {
     *             "id": 4,
     *             "name": "James Bond",
     *             "email": "james@yopmail.com",
     *             "phone": "08596769586",
     *             "gender": "Male",
     *             "age": "2001-01-30",
     *             "license_number": "UPS74856963",
     *             "profile_picture": "doctor/5HiPk9oN9cQCNNKdzmBgvNLHSL8u7bbHncdrPE91.png",
     *             "fcm_token": "eyo_Z9a_EQkcwF1y_TjA-U:APA91bFvEyoQw3XaMNheNcHlQMQISc-sB2b3RWySS515RaMauTX1RCKrinBcf5-4FhZeLtoB-BYV4K0khjO8pD1ZTi257s3A6_sH36SZGN4tBdS1AlUo3L2sBaXKpZoI0gwq-MWETDfN",
     *             "status": 1,
     *             "specializations": [
     *                 {
     *                     "id": 4,
     *                     "name": "ENT Specialist",
     *                     "pivot": {
     *                         "doctor_id": 4,
     *                         "specialization_id": 4
     *                     }
     *                 }
     *             ]
     *         }
     *     }
     * }
     * }
     * 
     * @response 201{
     * "error": "The old_password and password must be different."
     * }
     */

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|min:8|current_password|different:new_password|different:confirm_password',
            'new_password' => 'required|min:8|different:current_password|same:confirm_password',
            'confirm_password' => 'required|min:8|different:current_password|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 201);
        }

        try {
            $user = User::findOrFail(auth()->user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            $data =  fractal($user, new UserTransformer())->toArray();
            return response()->json([
                'status' => true,
                'statusCode' => $this->sucessStatus,
                'message' => 'Password changed successfully',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
