<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Friends;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ChatController extends Controller
{
    public function index()
    {
        $friends = Friends::where('user_id', Auth::user()->id)->where('status', 1)->orWhere('status', 0)->get();
        return view('frontend.doctor.chat.index')->with(compact('friends'));
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
            $reciver = User::find($request->reciver_id);
            return response()->json(['message'=>'Show Chat', 'status'=>true,'view' => (string)View::make('frontend.doctor.chat.chat-body')->with(compact('chats','chat_call','reciver'))]);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'status' => false]);
        }
    }
}
