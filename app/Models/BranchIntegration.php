<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchIntegration extends Model
{
    protected $fillable = [
        'branch_id',
        'integration_id',
        'api_token',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function integrations(){
        return $this->belongsTo(Integration::class);
    }
    public function branches(){
        return $this->belongsTo(Branch::class);
    }
}
