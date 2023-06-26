<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function notifications(Request $request): View
    {
        $notifications = Notification::where('send_to', 'Patient')->orWhere('send_to', 'All')->orderBy('id','desc')->paginate(5);
        if ($request->ajax()) {
            return view('frontend.patient.partials.message')->with(compact('notifications'));
        }
        return view('frontend.patient.notifications')->with(compact('notifications'));
    }
}
