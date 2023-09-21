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
            'address'          => $user->address,
            'years_of_experience' => $user->years_of_experience,
            'specializations'  => $user->specializations()->select('specializations.id', 'specializations.name')->get(),
        ];
    }

}
