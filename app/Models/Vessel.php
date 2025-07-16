<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    protected $fillable = ['imo_number', 'name', 'type', 'shipping_line_id'];

}
