<?php

namespace App\Helpers;

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

}