<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class EntrepreneurshipBanner extends Model implements HasMedia
{
    use InteractsWithMedia; 

    protected $fillable = [
        'title',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('entrepreneurship_banner_image')
             ->singleFile();
    }
}
