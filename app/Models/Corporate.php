<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Corporate extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_number',
        'title',
        'company_name',
        'position_years',
        'image_path',
        'description',
        'order_no',
        'is_active',
    ];
}
