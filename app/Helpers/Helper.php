<?php

namespace App\Helpers;

use App\Models\ClinicOpeningDay;
use App\Models\DoctorSpecialization;
use Illuminate\Support\Str;
class Helper {

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
        if(round($datediff / (60 * 60 * 24)) < 0){
            return true;
        }else{
            return false;
        }
    }

    public static function getClinicOpeninDay($clinic_id)
    {
        // implode clinic opening days by "-" and return
        $clinicOpeningDays = ClinicOpeningDay::with('day')->where('clinic_details_id', $clinic_id)->get();
        // dd($clinicOpeningDays->toArray());
        $days = array_map(function($clinicOpeningDay){
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
        $your_date = strtotime($date.' '.$time);
        $datediff = $your_date - $now;
        $days = floor($datediff / (60 * 60 * 24));
        $hours = floor(($datediff - $days * (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($datediff - $days * (60 * 60 * 24) - $hours * (60 * 60)) / 60);
        $seconds = floor(($datediff - $days * (60 * 60 * 24) - $hours * (60 * 60) - $minutes * 60));
        // ruturn only days if days is greater than 0
        if($days > 0){
            return $days.' days';
        }else{
        //    return hours, minutes and seconds
            return $hours.' hours '.$minutes.' minutes '.$seconds.' seconds';
        }   
    }

}