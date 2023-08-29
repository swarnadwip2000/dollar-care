<?php

namespace App\Http\Controllers\Frontend;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Events\ChatRequestEvent;
use App\Models\Friends;

class ChatController extends Controller
{
    public function userChat(Request $request)
    {
        try {
            // count chat   
            $chat_count = Chat::where(function ($query) use ($request) {
                $query->where('sender_id', $request->sender_id)->where('reciver_id', $request->reciver_id);
            })->orWhere(function ($query) use ($request) {
                $query->where('sender_id', $request->reciver_id)->where('reciver_id', $request->sender_id);
            })->count();

            $chatData = Chat::create([
                'sender_id' => $request->sender_id,
                'reciver_id' => $request->reciver_id,
                'message' => $request->message
            ]);
            // get chat data with sender and reciver
            $chat = Chat::with('sender', 'reciver')->find($chatData->id);
            // profile picture url
            $sender_profile_picture = ($chat->sender->profile_picture) ? Storage::url($chat->sender->profile_picture) : asset('frontend_assets/images/profile.png');
            $reciver_profile_picture = ($chat->reciver->profile_picture) ? Storage::url($chat->reciver->profile_picture) : asset('frontend_assets/images/profile.png');


            event(new MessageEvent($chat, $sender_profile_picture, $reciver_profile_picture, $chat_count));
            return response()->json(['msg' => 'Message sent successfully', 'chat' => $chat, 'success' => true, 'sender_profile_picture' => $sender_profile_picture, 'reciver_profile_picture' => $reciver_profile_picture, 'chat_count' => $chat_count]);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'success' => false]);
        }
    }

    public function sendChatRequest(Request $request)
    {
        try {
            if ($request->ajax()) {
                // return $request->all();
                // check if chat request already sent
                $chatRequest = Friends::where('friend_id', $request->sender)->where('status', 0)->first();
                if ($chatRequest) {
                    return response()->json(['status' => false, 'message' => 'Chat request already sent.']);
                }
                $countFriends = Friends::where('user_id', $request->recipient)->where('friend_id', $request->sender)->count();
                if ($countFriends > 0) {
                    $chat = Friends::where('user_id', $request->recipient)->where('friend_id', $request->sender)->update(['status' => 0]);
                } else {
                    $chat = Friends::create([
                        'user_id' => $request->recipient, // recipient
                        'friend_id' => $request->sender, // sender
                        'status' => 0
                    ]);
                }


                $friendRequest = Friends::with('user', 'friend')->where('friend_id', $request->sender)->latest()->first();
                $friendProfilePicture = ($friendRequest->friend->profile_picture) ? Storage::url($friendRequest->friend->profile_picture) : asset('frontend_assets/images/profile.png');
                event(new ChatRequestEvent($friendRequest, $friendProfilePicture));
                return response()->json(['status' => true, 'message' => 'Chat request sent successfully.', 'chat' => $chat]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
}
