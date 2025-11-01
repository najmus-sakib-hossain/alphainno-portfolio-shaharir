<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class RecommendedBook extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections() : void 
    {
        $this->addMediaCollection('recommended_books');
    }
}
