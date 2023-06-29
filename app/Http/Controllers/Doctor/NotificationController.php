<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function notifications(Request $request): View
    {
        $notifications = Notification::where('send_to', 'Doctor')->orWhere('send_to', 'All')->orderBy('id','desc')->paginate(5);
        if ($request->ajax()) {
            return view('frontend.doctor.partials.message')->with(compact('notifications'));
        }
        return view('frontend.doctor.notifications')->with(compact('notifications'));
    }
}
