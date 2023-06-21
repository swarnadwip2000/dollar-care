<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\Symptoms;
use Illuminate\Http\Request;

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
     * @response 404{
     * "status": false,
     * "statusCode": 404,
     * "message": "No Symptoms Found"
     * }
     */

    public function symptoms(Request $request)
    {
        try {
            $count = Symptoms::where('symptom_status', 1)->count();
            if ($count > 0) {
                $symptoms = Symptoms::where('symptom_status', 1)->orderBy('id', 'desc')->get();
                return response()->json(['status' => true, 'statusCode' => 200, 'data' => $symptoms]);
            } else {
                return response()->json(['status' => false, 'statusCode' => 404, 'message' => 'No Symptoms Found']);
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
     * @response 404{
     * "status": false,
     *  "statusCode": 404,
     *  "message": "No Specialization Found"
     * }
     */

    public function specializations(Request $request)
    {
        try {
            $count = Specialization::where('status', 1)->count();
            if ($count > 0) {
                $specializations = Specialization::where('status', 1)->orderBy('id', 'desc')->get();
                return response()->json(['status' => true, 'statusCode' => 200, 'data' => $specializations]);
            } else {
                return response()->json(['status' => false, 'statusCode' => 404, 'message' => 'No Specialization Found']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 500, 'error' => $th->getMessage()]);
        }
    }

   
}
