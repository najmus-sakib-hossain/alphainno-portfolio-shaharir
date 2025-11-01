<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\LandingPageImage;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LandingPageController extends Controller
{
    public function getImages()
    {
        $landingPage = LandingPageImage::firstOrFail();

        // Main image
        $mainImage = $landingPage->getFirstMedia('main_image');
        $mainData = $mainImage ? [
            'id' => $mainImage->id,
            'name' => $mainImage->name,
            'redirect_url' => $landingPage['url'],
            'original_url' => $mainImage->getUrl(),
            'thumb_url' => $mainImage->getUrl('thumb'),
            'slot' => $mainImage->custom_properties['slot'] ?? null,
        ] : null;

        // Side images (multi-file collection)
        $sideImages = $landingPage->getMedia('side_images')->map(function (Media $media) {
            return [
                'id' => $media->id,
                'name' => $media->name,
                'original_url' => $media->getUrl(),
                'thumb_url' => $media->getUrl('thumb'),
                'slot' => $media->custom_properties['slot'] ?? null,
            ];
        })->toArray();

        // Response structure
        return response()->json([
            'main_image' => $mainData,
            'side_images' => $sideImages,
        ]);
    }
}
