<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'image',
        'status',
    ];

    public function symptoms()
    {
        return $this->hasMany(Symptoms::class);
    }

    public function doctorSpecializations()
    {
        return $this->hasMany(DoctorSpecialization::class, 'specialization_id');
    }
}
