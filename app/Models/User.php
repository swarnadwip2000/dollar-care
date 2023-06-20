<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function doctorSpecializations()
    {
        return $this->hasMany(DoctorSpecialization::class, 'doctor_id');
    }

    // specialization
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'doctor_specializations', 'doctor_id', 'specialization_id');
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

    public function getMembershipStatusAttribute()
    {
        $count = UserMembership::where('user_id', $this->id)->count();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
