<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReeferTechnology extends Model
{
    use SoftDeletes;
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
