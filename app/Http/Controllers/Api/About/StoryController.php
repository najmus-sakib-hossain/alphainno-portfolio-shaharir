<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StoryController extends Controller
{
    // GET /api/stories
    public function index()
    {
        $stories = Story::where('is_active', 1)->orderBy('order_no')->get();

        // Add full image URL
        $stories->transform(function($story) {
            $story->image_url = $story->image_path ? asset('storage/'.$story->image_path) : null;
            return $story;
        });

        return response()->json([
            'status' => true,
            'message' => 'Stories fetched successfully.',
            'data' => $stories
        ]);
    }

    // GET /api/stories/{id}
    public function show($id)
    {
        $story = Story::find($id);

        if (!$story) {
            return response()->json([
                'status' => false,
                'message' => 'Story not found.'
            ], 404);
        }

        $story->image_url = $story->image_path ? asset('storage/'.$story->image_path) : null;

        return response()->json([
            'status' => true,
            'data' => $story
        ]);
    }

    // POST /api/stories
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'order_no' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('stories', 'public');
        }

        $story = Story::create($data);
        $story->image_url = $story->image_path ? asset('storage/'.$story->image_path) : null;

        return response()->json([
            'status' => true,
            'message' => 'Story created successfully.',
            'data' => $story
        ], 201);
    }

    // PUT /api/stories/{id}
    public function update(Request $request, $id)
    {
        $story = Story::find($id);

        if (!$story) {
            return response()->json([
                'status' => false,
                'message' => 'Story not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'order_no' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            if ($story->image_path && Storage::disk('public')->exists($story->image_path)) {
                Storage::disk('public')->delete($story->image_path);
            }
            $data['image_path'] = $request->file('image')->store('stories', 'public');
        }

        $story->update($data);
        $story->image_url = $story->image_path ? asset('storage/'.$story->image_path) : null;

        return response()->json([
            'status' => true,
            'message' => 'Story updated successfully.',
            'data' => $story
        ]);
    }

    // DELETE /api/stories/{id}
    public function destroy($id)
    {
        $story = Story::find($id);

        if (!$story) {
            return response()->json([
                'status' => false,
                'message' => 'Story not found.'
            ], 404);
        }

        if ($story->image_path && Storage::disk('public')->exists($story->image_path)) {
            Storage::disk('public')->delete($story->image_path);
        }

        $story->delete();

        return response()->json([
            'status' => true,
            'message' => 'Story deleted successfully.'
        ]);
    }
}
