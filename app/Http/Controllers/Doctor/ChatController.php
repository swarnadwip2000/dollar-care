<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Friends;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ChatController extends Controller
{
    public function index()
    {
        // get friend list from chat table orderby last conbversation
        $message = Chat::where('sender_id', Auth::user()->id)->orWhere('reciver_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $friends = [];
        foreach ($message as $key => $value) {
            if ($value->sender_id == Auth::user()->id) {
                $friends[] = $value->reciver_id;
            } else {
                $friends[] = $value->sender_id;
            }
        }
        $friends = array_unique($friends);
        // show the list of friends orderby $friends
        $friends = User::whereIn('id', $friends)->orderByRaw("FIELD(id, " . implode(',', $friends) . ")")->get(); // it's not working
        // dd($friends);


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
