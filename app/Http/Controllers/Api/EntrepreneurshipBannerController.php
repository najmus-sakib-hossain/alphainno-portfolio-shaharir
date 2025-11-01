<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EntrepreneurshipBanner;

class EntrepreneurshipBannerController extends Controller
{
    public function index()
    {
        $banner = EntrepreneurshipBanner::latest()->first();

        $data = $banner ? [
            'id' => $banner->id,
            'title' => $banner->title,
            'image_url' => $banner->getFirstMediaUrl('entrepreneurship_banner_image'),
        ] : null;

        return response()->json([
            'success' => true,
            'data' => $data
        ]);

    }
}
