<?php

namespace App\Http\Controllers\Api\Donate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\DonationBanner;

class DonationBannerController extends Controller
{/**
     * List all donation banners
     */
    public function index()
    {
        $banners = DonationBanner::orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $banners,
        ]);
    }

    /**
     * Show single donation banner
     */
    public function show($id)
    {
        $banner = DonationBanner::find($id);

        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Donation banner not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $banner,
        ]);
    }

    /**
     * Create new donation banner
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_title' => 'nullable|string|max:255',
            'main_quote' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['section_title', 'main_quote', 'button_text', 'button_link', 'is_active']);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('donation_banners', 'public');
        }

        $banner = DonationBanner::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Donation banner created successfully',
            'data' => $banner,
        ]);
    }

    /**
     * Update existing donation banner
     */
    public function update(Request $request, $id)
    {
        $banner = DonationBanner::find($id);

        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Donation banner not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'section_title' => 'nullable|string|max:255',
            'main_quote' => 'sometimes|required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['section_title', 'main_quote', 'button_text', 'button_link', 'is_active']);

        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }

            $data['image_path'] = $request->file('image_path')->store('donation_banners', 'public');
        }

        $banner->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Donation banner updated successfully',
            'data' => $banner,
        ]);
    }

    /**
     * Delete donation banner
     */
    public function destroy($id)
    {
        $banner = DonationBanner::find($id);

        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Donation banner not found'
            ], 404);
        }

        if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $banner->delete();

        return response()->json([
            'success' => true,
            'message' => 'Donation banner deleted successfully',
        ]);
    }
}