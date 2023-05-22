<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count['patient'] = User::Role('PATIENT')->count();
        $count['doctor'] = User::Role('DOCTOR')->count();

        return view('admin.dashboard')->with(compact('count'));
    }

}
