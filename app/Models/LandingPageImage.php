<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media; 

class LandingPageImage extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')->singleFile();
        $this->addMediaCollection('side_images');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(400)
            ->performOnCollections('main_image', 'side_images');
    }

    /**
     * Helper to fetch a side image media by slot name (e.g. "image1").
     */
    public function getSideImageBySlot(string $slot)
    {
        return $this->getMedia('side_images')->firstWhere('custom_properties.slot', $slot);
    }
}
