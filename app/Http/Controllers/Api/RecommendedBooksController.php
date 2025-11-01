<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RecommendedBooksController extends Controller
{
    public function index()
    {
        $data = Media::where('collection_name', 'recommended_images')
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'content' => $item->getCustomProperty('content'),
                    'image' => $item->getUrl(),
                ];
            })->toArray();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }



}
