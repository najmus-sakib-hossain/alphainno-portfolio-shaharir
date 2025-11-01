<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travel;

class TravelController extends Controller
{
    // List all active travels
    public function index()
    {
        $travel = Travel::latest()->first();

        if (!$travel) {
            return response()->json([
                'status' => 'error',
                'message' => 'No travel found.'
            ], 404);
        }

        $data = [
            'id' => $travel->id,
            'title' => $travel->title,
            'content' => $travel->content,
            'map_image' => $travel->getFirstMediaUrl('map_image') ?: null,
            'countries' => collect($travel->countries)->map(function ($name, $index) use ($travel) {
                $flag = $travel->getMedia('country_flags')[$index] ?? null;
                return [
                    'name' => $name,
                    'flag' => $flag ? $flag->getUrl() : null,
                ];
            })->toArray(),
            'created_at' => $travel->created_at->toDateTimeString(),
            'updated_at' => $travel->updated_at->toDateTimeString(),
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    // Show single travel country
    public function show(Travel $travel)
    {
        if(!$travel->is_active) {
            return response()->json(['status'=>'error','message'=>'Travel not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $travel->id,
                'country_name' => $travel->country_name,
                'country_flag' => $travel->country_flag_path ? asset('storage/'.$travel->country_flag_path) : null,
                'map_image' => $travel->map_image_path ? asset('storage/'.$travel->map_image_path) : null,
                'order_no' => $travel->order_no,
            ]
        ]);
    }
}
