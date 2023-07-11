<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\ClinicDetails;
use App\Models\ClinicOpeningDay;
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

    public function addAddressSubmit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'clinic_name' => 'required',
            'clinic_address' => 'required',
            'clinic_phone' => 'required',
            'day_id' => 'required',
        ],[
            'day_id.required' => 'Please select at least one day',
        ]);

        $clinicDetail = new ClinicDetails();
        $clinicDetail->user_id = auth()->user()->id;
        $clinicDetail->clinic_name = $request->clinic_name;
        $clinicDetail->clinic_address = $request->clinic_address;
        $clinicDetail->clinic_phone = $request->clinic_phone;
        $clinicDetail->longitute = '88.431999';
        $clinicDetail->latitute = '22.577330'; 
        $clinicDetail->save();

        foreach ($request->day_id as $day) {
           $clinic_opening_days = new ClinicOpeningDay(
                
           );
        }
    }
}
