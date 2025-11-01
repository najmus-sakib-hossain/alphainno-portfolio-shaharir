<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DonationBanner extends Model implements HasMedia
{
     use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'section_title',
        'main_quote',
        'image_path',
        'button_text',
        'button_link',
        'is_active',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('donationbanners')
             ->singleFile();
    }
}
