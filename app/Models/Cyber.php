<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cyber extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'short_description',
        'long_description',
        'image',
        'frame_image',
        'is_active',
    ];
}
