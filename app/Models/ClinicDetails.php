<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicDetails extends Model
{
    use HasFactory;

    public function clinicOpeningDays()
    {
        return $this->hasMany(ClinicOpeningDay::class, 'clinic_details_id', 'id');
    }
}
