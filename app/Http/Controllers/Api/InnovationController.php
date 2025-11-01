<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Innovation;
use Illuminate\Http\Request;

class InnovationController extends Controller
{
    public function index()
    {
        $innovation = Innovation::latest()->first();

        if (!$innovation) {
            return response()->json([
                'status' => 'success',
                'data' => null,
            ]);
        }
        $data = [
            'id' => $innovation->id,
            'title' => $innovation->title,
            'content' => $innovation->content,
            'images' => $innovation->getMedia('innovation_images')->map(function ($media) {
                return $media->getUrl();
            }),
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

}
