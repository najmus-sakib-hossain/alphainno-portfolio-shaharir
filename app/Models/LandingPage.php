<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LandingPage extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['image'];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('main-page-medium')
             ->width(800)
             ->height(600)
             ->sharpen(10);
    }
}