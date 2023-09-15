<?php

namespace App\Http\Controllers\Api\Patient;

use App\Events\ChatRequestEvent;
use App\Http\Controllers\Controller;
use App\Models\Friends;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
/**
 * @group Patient Chat
 */
class ChatController extends Controller
{
    private $successStatus = 200;

    /**
     * Chat Request api
     * @authenticated
     * @bodyParam doctor_id integer required Doctor Id. Example: 1
     * @response 200{
     *  "status": true,
     *  "message": "Friend request sent successfully",
     *  "data": {
     *      "id": 25,
     *      "user_id": 4,
     *      "friend_id": 3,
     *      "status": 1,  // 0 = pending, 1 = accepted, 2 = rejected
     *      "created_at": "2023-08-28T11:02:45.000000Z",
     *      "updated_at": "2023-08-28T13:12:02.000000Z"
     *  }
     * }
     */

    public function chatRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'statusCode' => 201,'status'=>false], 401);
        }

        try {
            $user = User::find(auth()->user()->id);
            $data = $user->friendsRequest()->where('user_id', $request->doctor_id)->first();
            return response()->json(['status' => true, 'message' => 'Friend request sent successfully', 'data' => $data], $this->successStatus);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Send Chat Request api
     * @authenticated
     * @bodyParam doctor_id integer required Doctor Id. Example: 1
     */

    public function chatRequestSend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'statusCode' => 201,'status'=>false], 401);
        }

        try {
            $chatRequest = Friends::where('friend_id', Auth::user()->id)->where('status', 0)->first();

            if ($chatRequest) {
                return response()->json(['status' => false, 'message' => 'Chat request already sent.'], 201);
            }

            $countFriends = Friends::where('user_id', $request->doctor_id)->where('friend_id', Auth::user()->id)->count();

            if ($countFriends > 0) {
                $chat = Friends::where('user_id', $request->doctor_id)->where('friend_id', Auth::user()->id)->update(['status' => 0]);
            } else {
                $chat = Friends::create([
                    'user_id' => $request->doctor_id, // recipient
                    'friend_id' => Auth::user()->id, // sender
                    'status' => 0
                ]);
            }
            $friendRequest = Friends::with('user', 'friend')->where('friend_id', Auth::user()->id)->latest()->first();
            $friendProfilePicture = ($friendRequest->friend->profile_picture) ? Storage::url($friendRequest->friend->profile_picture) : asset('frontend_assets/images/profile.png');
            event(new ChatRequestEvent($friendRequest, $friendProfilePicture));
            return response()->json(['status' => true, 'message' => 'Friend request sent successfully', 'data' => $chat], $this->successStatus);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
