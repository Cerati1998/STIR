<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ContainerOperationalTrace extends Model
{
    protected $fillable = [
        'gate_in_detail_id',
        'container_id',
        'status_box',
        'date_rep_box',
        'status_machine',
        'date_rep_machine',
        'date_final_status',
        'final_status_user',
        'status',
        'observation',
    ];

    protected $casts = [
        'date_rep_box' => 'datetime',
        'date_rep_machine' => 'datetime',
        'date_final_status' => 'datetime',
    ];

    public function gateInDetail()
    {
        return $this->belongsTo(GateInDetail::class);
    }

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function finalStatusUser()
    {
        return $this->belongsTo(User::class, 'final_status_user');
    }

    // Accessor para formatear la fecha
    protected function dateRepBox(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('d/m/Y H:i') : null,
        );
    }
    protected function dateRepMachine(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('d/m/Y H:i') : null,
        );
    }
    protected function dateFinalStatus(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('d/m/Y H:i') : null,
        );
    }
}
