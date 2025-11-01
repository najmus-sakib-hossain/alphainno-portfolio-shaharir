<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Award;


class AwardController extends Controller
{
   /**
     * Display a listing of awards.
     */
    public function index()
    {
        $awards = Award::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => true,
            'message' => 'Awards fetched successfully.',
            'data' => $awards,
        ]);
    }

    /**
     * Store a newly created award.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|max:255',
            'time_period'  => 'required|string|max:100',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'is_active'    => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('awards', 'public');
        }

        $award = Award::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Award created successfully.',
            'data' => $award,
        ], 201);
    }

    /**
     * Display a specific award.
     */
    public function show($id)
    {
        $award = Award::find($id);

        if (!$award) {
            return response()->json([
                'status' => false,
                'message' => 'Award not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $award,
        ]);
    }

    /**
     * Update the specified award.
     */
    public function update(Request $request, $id)
    {
        $award = Award::find($id);

        if (!$award) {
            return response()->json([
                'status' => false,
                'message' => 'Award not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title'        => 'sometimes|required|string|max:255',
            'time_period'  => 'sometimes|required|string|max:100',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active'    => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Update image if new one uploaded
        if ($request->hasFile('image')) {
            if ($award->image_path && Storage::disk('public')->exists($award->image_path)) {
                Storage::disk('public')->delete($award->image_path);
            }

            $data['image_path'] = $request->file('image')->store('awards', 'public');
        }

        $award->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Award updated successfully.',
            'data' => $award,
        ]);
    }

    /**
     * Remove the specified award.
     */
    public function destroy($id)
    {
        // $award = Award::find($id);

        // if (!$award) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Award not found.',
        //     ], 404);
        // }

        // if ($award->image_path && Storage::disk('public')->exists($award->image_path)) {
        //     Storage::disk('public')->delete($award->image_path);
        // }

        // $award->delete();

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Award deleted successfully.',
        // ]);
    }
}
