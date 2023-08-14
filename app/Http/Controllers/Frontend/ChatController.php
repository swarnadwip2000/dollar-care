<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function userChat(Request $request)
    {
        try {
            $chat = Chat::create([
                'sender_id' => $request->sender_id,
                'reciver_id' => $request->reciver_id,
                'message' => $request->message
            ]);

            return response()->json(['msg' => 'Message sent successfully', 'chat' => $chat, 'success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'success' => false]);
        }
    }
}
