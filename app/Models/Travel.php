<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Travel extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'travel_map';
    protected $fillable = [
        'title',
        'content',
        'countries',
    ];

    protected $casts = [
        'countries' => 'array',
    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('map_image')->singleFile();
        $this->addMediaCollection('country_flags');
    }
}
