<?php

namespace App\Helpers;

use App\Models\Appointment;
use App\Models\ClinicOpeningDay;
use App\Models\DoctorSpecialization;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Helper
{

    public static function countExpireDays($date)
    {
        $now = time(); // or your date as well
        $your_date = strtotime($date);
        $datediff = $your_date - $now;
        return round($datediff / (60 * 60 * 24));
    }

    public static function dateWasExpireOrNot($date)
    {
        $now = time(); // or your date as well
        $your_date = strtotime($date);
        $datediff = $your_date - $now;
        if (round($datediff / (60 * 60 * 24)) < 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getClinicOpeninDay($clinic_id)
    {
        // implode clinic opening days by "-" and return
        $clinicOpeningDays = ClinicOpeningDay::with('day')->where('clinic_details_id', $clinic_id)->get();
        // dd($clinicOpeningDays->toArray());
        $days = array_map(function ($clinicOpeningDay) {
            return substr(ucfirst($clinicOpeningDay['day']['day']), 0, 3);
        }, $clinicOpeningDays->toArray());
        return implode('-', $days);
    }

    public static function getDoctorSpecializations($id)
    {
        $specializations = DoctorSpecialization::where('doctor_id', $id)->get();
        $data = [];
        foreach ($specializations as $specialization) {
            $data[] = $specialization->specialization->name;
        }
        return implode(', ', $data);
    }

    public static function getLeftTimeFromDate($date, $time)
    {
        // get time in day:hour:minute:second format
        $now = time(); // or your date as well
        $your_date = strtotime($date . ' ' . $time);
        $datediff = $your_date - $now;
        $days = floor($datediff / (60 * 60 * 24));
        $hours = floor(($datediff - $days * (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($datediff - $days * (60 * 60 * 24) - $hours * (60 * 60)) / 60);
        $seconds = floor(($datediff - $days * (60 * 60 * 24) - $hours * (60 * 60) - $minutes * 60));
        // ruturn only days if days is greater than 0
        if ($days > 0) {
            return $days . ' days';
        } else {
            //    return hours, minutes and seconds
            return $hours . ' hours ' . $minutes . ' minutes ' . $seconds . ' seconds';
        }
    }

    public static function slotAvailable($slot_id)
    {
        $slot = Slot::where('id', $slot_id)->first();
        $slot_start_time = $slot['slot_start_time'];
        $slot_end_time = $slot['slot_end_time'];
        $intervals = [];
        $currentTime = Carbon::parse($slot_start_time);
        $endTime = Carbon::parse($slot_end_time);

        while ($currentTime->lte($endTime)) {
            $intervals[] = $currentTime->format('h:i A');
            $currentTime->addMinutes(30);
        }
        $slotAvailable = 0;
        $slot_count = count($intervals);
        foreach ($intervals as $key => $value) {
           $appointment = Appointment::where(['clinic_id'=>$slot['clinic_detail_id'],'appointment_date'=>$slot['slot_date'],'appointment_time'=>$value, 'appointment_status' => 'Done' ])->first();
            if ($appointment) {
                $slotAvailable++;
            }
        }

      

        return $slot_count - $slotAvailable;
    }

    public static function slotSlice($slot_id)
    {
        $slot = Slot::where('id', $slot_id)->first();
        $slot_start_time = $slot['slot_start_time'];
        $slot_end_time = $slot['slot_end_time'];
        $intervals = [];
        $currentTime = Carbon::parse($slot_start_time);
        $endTime = Carbon::parse($slot_end_time);

        while ($currentTime->lte($endTime)) {
            $intervals[] = $currentTime->format('h:i A');
            $currentTime->addMinutes(30);
        }

        return $intervals;
    }

    public static function countSlotAvailability($clinic_id)
    {
        $count = Slot::whereBetween('slot_date', [date('Y-m-d'), date('Y-m-d', strtotime('+' . 7 . 'days'))])->where('clinic_detail_id',$clinic_id)->count();
        return $count;
    }

    public static function countSlotTimeAvailability($clinic_id, $time)
    {
        $count = Appointment::where(['clinic_id' => $clinic_id, 'appointment_time'=> $time, 'appointment_status' => 'Done'])->count();
        return $count;
    }
}
