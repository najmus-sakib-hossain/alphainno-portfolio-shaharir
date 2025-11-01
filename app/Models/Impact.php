<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Impact extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'image1_path',
        'image2_path',
        'image3_path',
        'image4_path',
        'order_no',
        'is_active',
    ];
    public function points()
    {
        return $this->hasMany(ImpactPoint::class)->orderBy('order_no');
    }
}
