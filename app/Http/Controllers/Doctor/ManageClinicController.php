<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\ClinicDetails;
use App\Models\ClinicOpeningDay;
use App\Models\Day;
use App\Models\Slot;
use Illuminate\Http\Request;

class ManageClinicController extends Controller
{
    public function manageClinic()
    {
        $clinics = ClinicDetails::where('user_id', auth()->user()->id)->get();
        return view('frontend.doctor.manage-clinic-address.list')->with(compact('clinics'));
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
        ], [
            'day_id.required' => 'Please select at least one day',
        ]);

        $clinicDetail = new ClinicDetails();
        $clinicDetail->user_id = auth()->user()->id;
        $clinicDetail->clinic_name = $request->clinic_name;
        $clinicDetail->clinic_address = $request->clinic_address;
        $clinicDetail->clinic_phone = $request->clinic_phone;
        $clinicDetail->longitute = $request->longitude;
        $clinicDetail->latitute = $request->latitude;
        $clinicDetail->save();

        foreach ($request->day_id as $day) {
            $clinic_opening_days = new ClinicOpeningDay();
            $clinic_opening_days->clinic_details_id = $clinicDetail->id;
            $clinic_opening_days->day_id = $day;
            $clinic_opening_days->save();
        }

        foreach($request->slot_date as $key => $slot_date){
            $slot = new Slot();
            $slot->clinic_detail_id = $clinicDetail->id;
            $slot->slot_date = $slot_date;
            $slot->slot_start_time = $request->slot_start_time[$key] . ':00 '. $request->first_time_mode[$key];
            $slot->slot_end_time = $request->slot_end_time[$key] . ':00 '. $request->second_time_mode[$key];
            $slot->save();
        }


        return redirect()->route('doctor.manage-clinic.index')->with('success', 'Clinic Address Added Successfully');
    }

    public function delete($id)
    {
        $clinic = ClinicDetails::find($id);
        $clinic->delete();
        return redirect()->route('doctor.manage-clinic.index')->with('error', 'Clinic Address Deleted Successfully');
    }
}
