<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImpactPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'impact_id',
        'point',
        'order_no',
        'is_active',
    ];

    public function impact()
    {
        return $this->belongsTo(Impact::class);
    }
}
