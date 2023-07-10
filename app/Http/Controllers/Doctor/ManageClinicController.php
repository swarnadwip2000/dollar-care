<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Day;
use Illuminate\Http\Request;

class ManageClinicController extends Controller
{
    public function manageClinic()
    {
        return view('frontend.doctor.manage-clinic-address.list');
    }

    public function addAddress()
    {
        $days = Day::all();
        return view('frontend.doctor.manage-clinic-address.create')->with(compact('days'));
    }
}
