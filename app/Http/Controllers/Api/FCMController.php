<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FCMController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
         $input['fcm_token'];
        $fcm_token = $input['fcm_token'];
        $user = User::find($input['user_id']);
        $user->fcm_token = $fcm_token;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Token saved successfully.'    
        ]);
    }
}
