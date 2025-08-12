<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable = [
        'razonSocial',
        'numDoc',
        'tipoDoc',
        'direccion',
        'email',
        'phone',
        'observations',
        'branch_id',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
