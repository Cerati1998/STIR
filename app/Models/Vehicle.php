<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'code',
        'brand',
        'model',
        'category',
        'type',
        'color',
        'transport_id',
    ];

    public function transport(){
        return $this->belongsTo(Transport::class);
    }
}
