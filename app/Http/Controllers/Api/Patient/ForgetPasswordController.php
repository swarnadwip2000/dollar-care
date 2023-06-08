<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/**
 * @group Patient Forget Password
 */
class ForgetPasswordController extends Controller
{
    public $successStatus = 200;
    /**
     * Forget Password Api
     * @bodyparam email string required Email of the Patient. Example: john@yopmail.com
     * @response 200{
     *  "status": true,
     *  "statusCode": 200,
     *  "message": "OTP has been sent to your email"
     * }
     * 
     * @response 401{
     * "status": false,
     *  "statusCode": 401,
     * "error": {
     * "email": [
     * "The email field is required."
     * ]    
     *  }
     * }   
     */
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'error' => $validator->errors()
            ], 401);
        }

        try {
            $user = User::where('email', $request->email)->first();
            if ($user->hasRole('PATIENT')) {
                PasswordReset::where('email', $request->email)->delete();
                $otp = rand(100000, 999999);
                PasswordReset::create([
                    'email' => $request->email,
                    'token' => $otp,
                    'created_at' => Carbon::now(),
                ]);

                $details = [
                    'id' => base64_encode($user->id),
                    'otp' => $otp,
                ];
                Mail::to($request->email)->send(new SendOtpMail($details));
                return response()->json([
                    'status' => true,
                    'statusCode' => $this->successStatus,
                    'message' => 'OTP has been sent to your email'
                ], $this->successStatus);
            } else {
                return response()->json([
                    'status' => false,
                    'statusCode' => 401,
                    'error' => 'Admin & Doctor can not reset password from here'
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * OTP Verification Api
     * 
     */

    public function otpVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric|digits:6',
            'email' => 'required|email|exists:users,email'
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
            $user = User::where('email', $request->email)->first();
            $otp = PasswordReset::where('email', $user->email)->first();
            if ($otp->token == $request->otp) {
                $newtime = date('h:i A', strtotime($otp->created_at->addHour()));
                $currenttime = date('h:i A');
                if ($newtime < $currenttime) {
                    return response()->json([
                        'status' => false,
                        'statusCode' => 401,
                        'error' => 'OTP is expired'
                    ], 401);
                } else {
                    return response()->json([
                        'status' => true,
                        'statusCode' => $this->successStatus,
                        'message' => 'OTP verified successfully'
                    ], $this->successStatus);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'statusCode' => 401,
                    'error' => 'OTP is not valid'
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
