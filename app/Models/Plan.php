<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_name',
        'plan_price',
        'plan_type',
    ];

    public function Specification()
    {
        return $this->hasMany(PlanSpecfication::class);
    }
}
