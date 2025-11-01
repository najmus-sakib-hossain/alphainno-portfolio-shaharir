<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'button_text',
        'description',
        'donation_link',
        'order_no',
        'is_active',
    ];

    // Automatically generate slug from title
    protected static function booted()
    {
        static::creating(function ($donation) {
            if (empty($donation->slug)) {
                $donation->slug = Str::slug($donation->title);
            }
        });
    }
}
