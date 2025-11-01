<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookBanner;
use Illuminate\Http\Request;

class BooksBannerController extends Controller
{
    public function index()
    {
        $banners = BookBanner::latest()->get();

        // Map each banner to include its single image URL
        $data = $banners->map(function ($banner) {
            return [
                'id' => $banner->id,
                'title' => $banner->title,
                'description' => $banner->description,
                'price' => $banner->price,
                'image' => $banner->getFirstMediaUrl('book_banner_image'), // single file
                'created_at' => $banner->created_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

}
