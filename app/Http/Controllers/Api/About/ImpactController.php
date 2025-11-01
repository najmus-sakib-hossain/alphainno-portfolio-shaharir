<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Impact;

class ImpactController extends Controller
{
    // List all impacts
    public function index()
    {
        $impacts = Impact::with(['points' => function($query) {
            $query->where('is_active', 1)->orderBy('order_no');
        }])->where('is_active', 1)->orderBy('order_no')->get();

        // Transform data
        $data = $impacts->map(function($impact) {
            return [
                'id' => $impact->id,
                'type' => $impact->type,
                'title' => $impact->title,
                'description' => $impact->description,
                'images' => [
                    $impact->image1_path ? asset('storage/'.$impact->image1_path) : null,
                    $impact->image2_path ? asset('storage/'.$impact->image2_path) : null,
                    $impact->image3_path ? asset('storage/'.$impact->image3_path) : null,
                    $impact->image4_path ? asset('storage/'.$impact->image4_path) : null,
                ],
                'points' => $impact->points->pluck('point'),
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // Show single impact
    public function show(Impact $impact)
    {
        if(!$impact->is_active) {
            return response()->json(['status'=>'error','message'=>'Impact not found'],404);
        }

        $impact->load(['points' => function($query) {
            $query->where('is_active', 1)->orderBy('order_no');
        }]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $impact->id,
                'type' => $impact->type,
                'title' => $impact->title,
                'description' => $impact->description,
                'images' => [
                    $impact->image1_path ? asset('storage/'.$impact->image1_path) : null,
                    $impact->image2_path ? asset('storage/'.$impact->image2_path) : null,
                    $impact->image3_path ? asset('storage/'.$impact->image3_path) : null,
                    $impact->image4_path ? asset('storage/'.$impact->image4_path) : null,
                ],
                'points' => $impact->points->pluck('point'),
            ]
        ]);
    }
}
