<?php

namespace App\Http\Controllers\Doctor;

use App\Events\ChatRequestAcceptedEvent;
use App\Events\RejectRequestEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Friends;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function index()
    {
        // get friend list from chat table orderby last conversation
        $message = Chat::where('sender_id', Auth::user()->id)->orWhere('reciver_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        // dd($message);
        $friends = [];
        foreach ($message as $key => $value) {
            if ($value->sender_id == Auth::user()->id) {
                $friends[] = $value->reciver_id;
            } else {
                $friends[] = $value->sender_id;
            }
        }
        $friends = array_unique($friends);
        // dd($friends);
        // show the list of friends orderby $friends
        if($friends) {
            $friends = User::whereIn('id', $friends)->orderByRaw("FIELD(id, " . implode(',', $friends) . ")")->get(); // it's not working
        } else {
            $friends = [];
        }
        //$friends = User::whereIn('id', $friends)->orderByRaw("FIELD(id, " . implode(',', $friends) . ")")->get(); // it's not working
        $requests = Friends::where('user_id', Auth::user()->id)->where('status', 0)->with('friend')->get();
        
        return view('frontend.doctor.chat.index')->with(compact('friends', 'requests'));
        
            
        
        


        
    }


    public function loadChat(Request $request)
    {
        try {
            $chat_call = 1;
            $chats = Chat::where(function ($query) use ($request) {
                $query->where('sender_id', $request->sender_id)->where('reciver_id', $request->reciver_id);
            })->orWhere(function ($query) use ($request) {
                $query->where('sender_id', $request->reciver_id)->where('reciver_id', $request->sender_id);
            })->get();
            $chat_count = count($chats);
            $reciver = User::find($request->reciver_id);
            return response()->json(['message'=>'Show Chat', 'status'=>true,'chat_count'=>$chat_count,'view' => (string)View::make('frontend.doctor.chat.chat-body')->with(compact('chats','chat_call','reciver'))]);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'status' => false]);
        }
    }

    

    public function chatRequestAccept(Request $request)
    {
        try {
            if ($request->ajax()) {
                // return $request->all();
                $friend = Friends::with('user','friend')->where('id', $request->friendId)->first();
                // return response()->json(['status' => true, 'message' => 'Chat request accepted successfully.', 'friend' => $friend]);
                $chat = Chat::create([
                    'sender_id' => $friend->user_id,
                    'reciver_id' => $friend->friend_id,
                    'message' =>  $friend->user->name . ' accepted your chat request.'
                ]);

                $friend->status = 1;
                $friend->save();

                // get chat data with sender and reciver
                $chat = Chat::with('sender', 'reciver')->find($chat->id);
                $acceptedByUser = User::find($friend->friend_id);
                $acceptedUser_profile_picture = ($acceptedByUser->profile_picture) ? Storage::url($acceptedByUser->profile_picture) : asset('frontend_assets/images/profile.png');
                $accepterUser_created_at = $acceptedByUser->created_at->format('d M Y');
                // profile picture url
                // $sender_profile_picture = Storage::url($chat->sender->profile_picture) ?? asset('frontend_assets/images/profile.png');
                // $reciver_profile_picture = Storage::url($chat->reciver->profile_picture) ?? asset('frontend_assets/images/profile.png');

                event(new ChatRequestAcceptedEvent($friend, $chat));
                return response()->json(['status' => true, 'message' => 'Chat request accepted successfully.', 'chat' => $chat, 'acceptedUser' => $acceptedByUser , 'acceptedUser_profile_picture' => $acceptedUser_profile_picture, 'accepterUser_created_at' => $accepterUser_created_at]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function deleteChatRequest(Request $request) {
        try {
            if ($request->ajax()) {
                // return $request->all();
                $chatRequest = Friends::findOrFail($request->friendId);
                $chatRequest->status = 2;
                $chatRequest->save();
                event(new RejectRequestEvent($chatRequest));
                return response()->json(['status' => true, 'msg' => 'Chat request deleted successfully.', 'chatRequest' => $chatRequest]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function chatGetUser(Request $request)
    {
        try {
            if ($request->ajax()) {
                $user = User::find($request->user_id);
                return response()->json(['status' => true, 'message' => 'chat accepted and get user', 'user' => $user]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
}
