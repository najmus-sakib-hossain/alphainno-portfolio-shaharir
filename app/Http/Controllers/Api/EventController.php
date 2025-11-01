<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->query('limit');

        $query = Event::latest();

        if ($limit) {
            $query->take($limit);
        }

        $events = $query->get();

        $data = $events->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'content' => $item->content,
                'event_date' => $item->event_date,
                'event_place' => $item->event_place,
                'image_url' => $item->getFirstMediaUrl('event_image'),
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function lastActivity()
    {
        $lastActivity = Event::latest()->get();

        if ($lastActivity->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'data' => null,
            ], 404);
        }

        $data = $lastActivity->map(function ($item) {
            return [
                'id' => $item->id,
                'image_url' => $item->getFirstMediaUrl('event_image'),
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
