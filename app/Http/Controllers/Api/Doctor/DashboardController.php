<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\ClinicDetails;
use App\Models\ClinicOpeningDay;
use App\Models\Day;
use App\Models\Slot;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function doctorProfile(Request $request)
    {
        try {
            if ($request->ajax()) {
                $doctor = auth()->user();
                return response()->json(['message' => 'Doctor Profile', 'status' => true, 'data' => $doctor]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function manageClinic()
    {
        $clinics = ClinicDetails::where('user_id', auth()->user()->id)->get();
        return response()->json(['message' => 'Clinic List', 'status' => true, 'data' => $clinics]);
    }

    public function addAddress()
    {
        $days = Day::all();
        return response()->json(['message' => 'Add Clinic Address', 'status' => true, 'data' => $days]);
    }

    public function addAddressSubmit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'clinic_name' => 'required',
            'clinic_address' => 'required',
            'clinic_phone' => 'required|numeric|digits_between:10,12',
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

        foreach ($request->slot_date as $key => $slot_date) {
            $slot = new Slot();
            $slot->clinic_detail_id = $clinicDetail->id;
            $slot->slot_date = $slot_date;
            $slot->slot_start_time = $request->slot_start_time[$key] . ':00 ' . $request->first_time_mode[$key];
            $slot->slot_end_time = $request->slot_end_time[$key] . ':00 ' . $request->second_time_mode[$key];
            $slot->save();
        }


        return response()->json(['message' => 'Clinic Address Added Successfully', 'status' => true, 'data' => $clinicDetail]);
    }

    public function delete($id)
    {
        $clinic = ClinicDetails::find($id);
        $clinic->delete();
        return response()->json(['message' => 'Clinic Address Deleted Successfully', 'status' => true, 'data' => $clinic]);
    }

    public function edit($id)
    {
        // delete previous slots
        Slot::where('slot_date', '<', date('Y-m-d'))->where('clinic_detail_id', $id)->delete();
        $slots = Slot::where('clinic_detail_id', $id)->orderBy('slot_date', 'desc')->get();
        // dd($slots);
        $clinic = ClinicDetails::find($id);
        $days = Day::all();
        return response()->json(['message' => 'Edit Clinic Address', 'status' => true, 'data' => ['clinic' => $clinic, 'days' => $days, 'slots' => $slots]]);
    }

    public function slotDelete($id)
    {
        $slot = Slot::find($id);
        $slot->delete();
        return response()->json(['message' => 'Slot Deleted Successfully', 'status' => true, 'data' => $slot]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'clinic_name' => 'required',
            'clinic_address' => 'required',
            'clinic_phone' => 'required|numeric|digits_between:10,12',
            'day_id' => 'required',
        ], [
            'day_id.required' => 'Please select at least one day',
        ]);
        // dd($request->all());
        $clinicDetail = ClinicDetails::find($request->id);
        $clinicDetail->user_id = auth()->user()->id;
        $clinicDetail->clinic_name = $request->clinic_name;
        $clinicDetail->clinic_address = $request->clinic_address;
        $clinicDetail->clinic_phone = $request->clinic_phone;
        $clinicDetail->longitute = $request->longitude;
        $clinicDetail->latitute = $request->latitude;
        $clinicDetail->save();

        ClinicOpeningDay::where('clinic_details_id', $request->id)->delete();
        foreach ($request->day_id as $day) {
            $clinic_opening_days = new ClinicOpeningDay();
            $clinic_opening_days->clinic_details_id = $clinicDetail->id;
            $clinic_opening_days->day_id = $day;
            $clinic_opening_days->save();
        }


        foreach ($request->slot_date as $key => $slot_date) {
            if ($slot_date != null) {
                $slot = new Slot();
                $slot->clinic_detail_id = $clinicDetail->id;
                $slot->slot_date = $slot_date;
                $slot->slot_start_time = $request->slot_start_time[$key] . ':00 ' . $request->first_time_mode[$key];
                $slot->slot_end_time = $request->slot_end_time[$key] . ':00 ' . $request->second_time_mode[$key];
                $slot->save();
            }
        }
        return response()->json(['message' => 'Clinic Address Updated Successfully', 'status' => true, 'data' => $clinicDetail]);
    }
}
