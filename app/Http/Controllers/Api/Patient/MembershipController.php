<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Mail\PurchaseMembership;
use App\Models\Plan;
use App\Models\UserMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Stripe;
/**
 * @group  Patient Membership
 */
class MembershipController extends Controller
{
    private $successStatus = 200;

    /**
     * Membership List
     * @authenticated
     * @response 200{
     * "status": true,
     * "data": [
     *     {
     *         "id": 1,
     *         "plan_name": "Basic",
     *         "plan_price": "100",
     *         "plan_type": "Basic",
     *         "plan_duration": "3",
     *         "specifications": [
     *             {
     *                 "id": 1,
     *                 "plan_id": 1,
     *                 "specification_name": "Domain Name                        "
     *             },
     *             {
     *                 "id": 2,
     *                 "plan_id": 1,
     *                 "specification_name": "Upto 8 Pages"
     *             }
     *         ]
     *     },
     * ]
     * }
     */

    public function membershipList(Request $request)
    {
        try {
            $plans = Plan::with(['specifications' => function ($query) {
                $query->select('id', 'plan_id', 'specification_name');
            }])->orderBy('plan_price', 'asc')->select('id', 'plan_name', 'plan_price', 'plan_type', 'plan_duration')->get();
            if ($plans->count() > 0) {
                return response()->json(['status' => true, 'data' => $plans], $this->successStatus);
            } else {
                return response()->json(['status' => false, 'message' => 'No membership found'], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     *  Membership Details by id
     * @authenticated
     * @bodyParam id int required The id of the membership.
     * @response 200{
     *   * "status": true,
     * "data": [
     *     {
     *         "id": 1,
     *         "plan_name": "Basic",
     *         "plan_price": "100",
     *         "plan_type": "Basic",
     *         "plan_duration": "3",
     *         "specifications": [
     *             {
     *                 "id": 1,
     *                 "plan_id": 1,
     *                 "specification_name": "Domain Name                        "
     *             },
     *             {
     *                 "id": 2,
     *                 "plan_id": 1,
     *                 "specification_name": "Upto 8 Pages"
     *             }
     *         ]
     *     },
     * ]
     * }
     * 
     * @response 201{
     *  "status": false,
     *  "message": "The selected id is invalid."
     * }
     */
    public function detailById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:plans,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 201);
        }

        try {
            $plan = Plan::with(['specifications' => function ($query) {
                $query->select('id', 'plan_id', 'specification_name');
            }])->where('id', $request->id)->select('id', 'plan_name', 'plan_price', 'plan_type', 'plan_duration')->first();
            if ($plan) {
                return response()->json(['status' => true, 'data' => $plan], $this->successStatus);
            } else {
                return response()->json(['status' => false, 'message' => 'No membership found'], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Payment api
     * @authenticated
     * @bodyParam plan_id int required The id of the membership.
     */

    public function membershipPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:plans,id',
            'name' => 'required',
            'stripeToken' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 201);
        }

        try {
            $count = UserMembership::where('user_id', Auth::user()->id)->count();
            if ($count > 0) {
                $userMembership = UserMembership::where('user_id', Auth::user()->id)->where('membership_expiry_date', '>=', date('Y-m-d'))->orderBy('id', 'desc')->first();
                if ($userMembership) {
                    return response()->json(['status' => false, 'message' => 'You already have a membership plan. Please wait until it expires.'], 201);
                } else {
                    UserMembership::where('user_id', Auth::user()->id)->where('membership_expiry_date', '<', date('Y-m-d'))->delete();
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                    $customer = Stripe\Customer::create(array(
                        "email" => Auth::user()->email,
                        "name" => $request->name,
                        "source" => $request->stripeToken
                    ));

                    $plan = Plan::find($request->plan_id);

                    $charge = Stripe\Charge::create([
                        "amount" => 100 * $plan->plan_price,
                        "currency" => "usd",
                        "customer" => $customer->id,
                        "description" => "Membership Plan Payment for " . $plan->plan_name . " Plan" . " by " . Auth::user()->name,
                    ]);

                    if ($charge->status == 'succeeded') {
                        $userMembership = new UserMembership();
                        $userMembership->user_id = Auth::user()->id;
                        $userMembership->plan_id = $request->plan_id;
                        $userMembership->payment_id = $charge->id;
                        $userMembership->currency = 'usd';
                        $userMembership->amount = $charge->amount / 100;
                        $userMembership->membership_expiry_date = date('Y-m-d', strtotime('+' . $plan->plan_duration . 'months'));
                        $userMembership->payment_response = json_encode($charge);
                        $userMembership->save();
                        $details = [
                            'name' => $request->name,
                            'plan_name' => $plan->plan_name,
                            'plan_price' => $userMembership->amount,
                        ];
                        Mail::to(Auth::user()->email)->send(new PurchaseMembership($details));
                        return response()->json(['status' => true, 'message' => 'Payment done successfully.'], $this->successStatus);
                    } else {
                        return response()->json(['status' => false, 'message' => 'Payment failed.'], 201);
                    }
                }
            } else {
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $customer = Stripe\Customer::create(array(
                    "email" => Auth::user()->email,
                    "name" => $request->name,
                    "source" => $request->stripeToken
                ));

                $plan = Plan::find($request->plan_id);

                $charge = Stripe\Charge::create([
                    "amount" => 100 * $plan->plan_price,
                    "currency" => "usd",
                    "customer" => $customer->id,
                    "description" => "Membership Plan Payment for " . $plan->plan_name . " Plan" . " by " . Auth::user()->name,
                ]);

                if ($charge->status == 'succeeded') {
                    $userMembership = new UserMembership();
                    $userMembership->user_id = Auth::user()->id;
                    $userMembership->plan_id = $request->plan_id;
                    $userMembership->payment_id = $charge->id;
                    $userMembership->currency = 'usd';
                    $userMembership->amount = $charge->amount / 100;
                    $userMembership->membership_expiry_date = date('Y-m-d', strtotime('+' . $plan->plan_duration . 'months'));
                    $userMembership->payment_response = json_encode($charge);
                    $userMembership->save();
                    $details = [
                        'name' => $request->name,
                        'plan_name' => $plan->plan_name,
                        'plan_price' => $userMembership->amount,
                    ];
                    Mail::to(Auth::user()->email)->send(new PurchaseMembership($details));
                    return response()->json(['status' => true, 'message' => 'Payment done successfully.'], $this->successStatus);
                } else {
                    return response()->json(['status' => false, 'message' => 'Payment failed.'], 201);
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
