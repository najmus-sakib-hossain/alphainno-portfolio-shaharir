<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PublicationSummery;
use Illuminate\Http\Request;

class PublicationSummeryController extends Controller
{
    public function index()
    {
        $publicationSummaries = PublicationSummery::latest()->get();

        $data = $publicationSummaries->map(function ($item) {
            return [
                'id' => $item->id,
                'content' => $item->content,
                'image' => $item->getFirstMediaUrl('publication_images'),
            ];
        })->toArray();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}