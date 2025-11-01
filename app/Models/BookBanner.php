<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class BookBanner extends Model implements HasMedia
{
    use InteractsWithMedia; 

    protected $fillable = [
        'title',
        'description',
        'price',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('book_banner_image')
             ->singleFile();
    }
}
