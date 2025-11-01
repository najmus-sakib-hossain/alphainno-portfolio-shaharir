<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'content',
        'event_date',
        'event_place'
    ];

    protected $casts = [
        'event_date' => 'datetime'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('event_image')
             ->singleFile();
    }
}
