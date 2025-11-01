<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TechnologyField extends Model
{
     use HasFactory;

    protected $fillable = [
        'title','subtitle','description','image','frame_image',
        'tools_title','tools_description','is_active'
    ];

    public function skills()
    {
        return $this->hasMany(TechnologyFieldSkill::class);
    }
}
