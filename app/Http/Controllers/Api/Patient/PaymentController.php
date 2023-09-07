<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Models\UserMembership;
use App\Transformers\UserMembershipTransformer;
use Illuminate\Http\Request;

/**
 * @group  Patient Payment History
 */
class PaymentController extends Controller
{
    private $successStatus = 200;

    /**
     * Payment history
     * @authenticated
     * @response 200{
     * "status": true,
     * "membership": {
     *         "id": 6,
     *         "amount": "200",
     *         "membership_expiry_date": "2024-01-11",
     *         "currency": "usd",
     *         "plan_name": "Standard",
     *         "plan_duration": "6"
     *     }
     * }
     */

    public function paymentHistory(Request $request)
    {
        try {
            $membership = UserMembership::where('user_id', auth()->user()->id)->where('membership_expiry_date', '>=', date('Y-m-d'))->orderBy('id', 'desc')->first();
            if ($membership) {
                $data = fractal($membership, new UserMembershipTransformer())->toArray()['data'];
                return response()->json(['status' => true, 'membership' => $data], $this->successStatus);
            } else {
                return response()->json(['status' => false, 'message' => 'No payment history'], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
