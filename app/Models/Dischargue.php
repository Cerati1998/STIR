<?php

namespace App\Models;

use App\Observers\DischargueObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[ObservedBy(DischargueObserver::class)]
class Dischargue extends Model
{
    protected $fillable = [
        'shipping_line_id',
        'vessel_id',
        'bl_number',
        'eta_date',
        'week',
        'started_at',
        'completed_at',
        'user_id',
        'branch_id',
    ];

    protected $casts = [
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Accessor para formatear la fecha
    protected function etaDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
        );
    }
}
