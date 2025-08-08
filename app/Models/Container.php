<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Container extends Model
{
    protected $fillable = [
        'code',
        'iso_code',
        'container_type_id',
        'port_id',
        'condition_status',
        'status',
        'reefer_technology_id',
        'reefer_machine_id',
        'manufacture_year',
        'tare',
        'payload',
        'origin_id',
        'origin_type',
        'gate_in_at',
        'gate_in_at',
        'gate_out_at',
        'last_machine_inspection_at',
        'is_operative',
    ];

    protected $casts = [
        'manufacture_year' => 'integer',
        'tare' => 'decimal:2',
        'payload' => 'decimal:2',
        'last_machine_inspection_at' => 'datetime',
        'is_operative' => 'boolean'
    ];

    public function origin(): MorphTo
    {
        return $this->morphTo();
    }

    public function container_type()
    {
        return $this->belongsTo(ContainerType::class);
    }

    public function port()
    {
        return $this->belongsTo(Port::class);
    }

    public function reefer_technology()
    {
        return $this->belongsTo(ReeferTechnology::class);
    }

    public function machine()
    {
        return $this->belongsTo(ReeferMachine::class);
    }
}
