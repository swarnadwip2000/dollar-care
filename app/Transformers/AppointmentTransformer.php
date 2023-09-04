<?php

namespace App\Transformers;

use App\Models\Appointment;
use League\Fractal\TransformerAbstract;

class AppointmentTransformer extends TransformerAbstract
{

    public function transform(Appointment $appointment)
    {
        return [
            'id'               => $appointment->id,
            'patient_name'             => $appointment->user->name,
            'patient_profile_picture'            => $appointment->user->profile_picture,
            'appointment_date'            => $appointment->appointment_date,        
            'appointment_time'            => $appointment->appointment_time,
            'clinic_name'            => $appointment->clinic_name,
            'clinic_address'            => $appointment->clinic_address,
            'duration'            => '30 min',
            'appointment_status'            => $appointment->appointment_status,
        ];
    }
}
