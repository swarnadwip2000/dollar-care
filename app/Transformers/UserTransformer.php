<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $user)
    {
        return [
            'id'               => $user->id,
            'name'             => $user->name,
            'email'            => $user->email,
            'phone'            => $user->phone,
            'gender'           => $user->gender,
            'age'              => $user->age,
            'license_number'   => $user->license_number,
            'profile_picture'  => $user->profile_picture,
            'fcm_token'        => $user->fcm_token,
            'status'           => $user->status,
            'specializations'  => $user->specializations()->select('specializations.id', 'specializations.name')->get(),    
        ];
    }

}