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

    public function currentStatus(): Attribute
    {
        $status = [
            [
                'description' => 'Anulado',
                'code' => 'AN',
                'icon' => 'fas fa-ban',
                'styleBg' => 'bg-stone-500'
            ],
            [
                'description' => 'Anunciado',
                'code' => 'AC',
                'icon' => 'fas fa-bullhorn',
                'styleBg' => 'bg-yellow-500'
            ],
            [
                'description' => 'Recibido',
                'code' => 'RC',
                'icon' => 'fas fa-door-open',
                'styleBg' => 'bg-sky-500'
            ],
            [
                'description' => 'Damage',
                'code' => 'DM',
                'icon' => 'fas fa-screwdriver-wrench',
                'styleBg' => 'bg-red-500'
            ],
            [
                'description' => 'Operativo',
                'code' => 'AV',
                'icon' => 'fas fa-check-circle',
                'styleBg' => 'bg-green-500'
            ],
            [
                'description' => 'Despachado',
                'code' => 'DP',
                'icon' => 'fas fa-paper-plane',
                'styleBg' => 'bg-blue-500'
            ],
            [
                'description' => 'Devolución Interna',
                'code' => 'DI',
                'icon' => 'fas fa-undo',
                'styleBg' => 'bg-purple-500'
            ],
        ];
        return Attribute::make(
            get: fn() => $status[$this->status] ?? 'Desconocido'
        );
    }
}
