<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Innovation extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title', 'content'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('innovation_images');
    }
}
