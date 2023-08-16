<?php

namespace App\Http\Controllers\Frontend;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function userChat(Request $request)
    {
        try {
            // count chat   
            $chat_count = Chat::where(function ($query) use ($request) {
                $query->where('sender_id', $request->sender_id)->where('reciver_id', $request->reciver_id);
            })->orWhere(function ($query) use ($request) {
                $query->where('sender_id', $request->doctor_id)->where('reciver_id', $request->sender_id);
            })->count();

            $chatData = Chat::create([
                'sender_id' => $request->sender_id,
                'reciver_id' => $request->reciver_id,
                'message' => $request->message
            ]);
            // get chat data with sender and reciver
            $chat = Chat::with('sender', 'reciver')->find($chatData->id);
            // profile picture url
            $sender_profile_picture = Storage::url($chat->sender->profile_picture) ?? asset('frontend_assets/images/profile.png');
            $reciver_profile_picture = Storage::url($chat->reciver->profile_picture) ?? asset('frontend_assets/images/profile.png');


            event(new MessageEvent($chat, $sender_profile_picture, $reciver_profile_picture, $chat_count));
            return response()->json(['msg' => 'Message sent successfully', 'chat' => $chat, 'success' => true, 'sender_profile_picture' => $sender_profile_picture, 'reciver_profile_picture' => $reciver_profile_picture, 'chat_count' => $chat_count]);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'success' => false]);
        }
    }

}
