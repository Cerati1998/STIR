<?php

namespace App\Models;

use App\Observers\DischargueObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[ObservedBy(DischargueObserver::class)]
class Dischargue extends Model
{
    protected $fillable = [
        'shipping_line_id',
        'vessel_id',
        'voyage',
        'bl_number',
        'eta_date',
        'week',
        'started_at',
        'completed_at',
        'user_id',
        'branch_id',
    ];

    protected $casts = [
        'eta_date' => 'date',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function containers(): MorphMany
    {
        return $this->morphMany(Container::class, 'origin');
    }

    public function shippingLine()
    {
        return $this->belongsTo(ShippingLine::class);
    }
    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }
}
