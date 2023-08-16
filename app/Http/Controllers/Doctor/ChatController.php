<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Friends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $friends = Friends::where('user_id', Auth::user()->id)->where('status', 1)->orWhere('status', 0)->get();
        return view('frontend.doctor.chat.index')->with(compact('friends'));
    }
}
