<?php

namespace App\Helpers;

use App\Models\ClinicOpeningDay;
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

}