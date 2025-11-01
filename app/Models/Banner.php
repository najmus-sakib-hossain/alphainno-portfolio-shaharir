<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'video_url',
        'is_active',
    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('donationbanners')
             ->singleFile();
    }
}
