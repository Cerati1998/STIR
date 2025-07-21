<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingLine extends Model
{
    use SoftDeletes;
    protected $fillable = ['code', 'name'];

    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }
}
