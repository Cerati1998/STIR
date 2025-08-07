<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContainerType extends Model
{
    use SoftDeletes;
    protected $fillable = ['code','iso_code', 'description', 'length', 'width', 'height'];

    public function containers()
    {
        return $this->hasMany(Container::class);
    }
}
