<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TechnologyFieldSkill extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'technology_field_id','icon','name','order_no','is_active'
    ];

    public function field()
    {
        return $this->belongsTo(TechnologyField::class, 'technology_field_id');
    }
}
