<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReeferCondition extends Model
{
    protected $fillable = [
        'name',
        'description',
        'temperature_range',
        'ventilation',
        'humidity',
        'atmosphere',
        'usage',
    ];
}
