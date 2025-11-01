<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Philosophy extends Model
{
    protected $fillable = [
        'logic_theory',
        'logics',
    ];

    protected $casts = [
        'logics' => 'array',
    ];
}
