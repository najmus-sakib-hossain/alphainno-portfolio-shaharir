<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Associate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'background_image',
        'partner_images',
        'is_active',
        'order_no',
    ];

    protected $casts = [
        'is_active' => 'boolean',        
        'partner_images' => 'array',     
    ];
}
