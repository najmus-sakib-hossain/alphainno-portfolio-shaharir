<?php

namespace App\Http\Controllers\Api\Donate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Donation;

class DonationController extends Controller
{
    /**
     * List all donations
     */
    public function index()
    {
        $donations = Donation::orderBy('order_no', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $donations,
        ]);
    }

    /**
     * Show single donation
     */
    public function show($id)
    {
        $donation = Donation::find($id);

        if (!$donation) {
            return response()->json([
                'success' => false,
                'message' => 'Donation not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $donation,
        ]);
    }

    /**
     * Store a new donation
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'order_no' => 'required|integer',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $donation = new Donation();
        $donation->title = $request->title;
        $donation->button_text = $request->button_text;
        $donation->order_no = $request->order_no;
        $donation->is_active = $request->is_active;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('donations', 'public');
            $donation->image = $path;
        }

        $donation->save();

        return response()->json([
            'success' => true,
            'message' => 'Donation created successfully',
            'data' => $donation,
        ]);
    }

    /**
     * Update an existing donation
     */
    public function update(Request $request, $id)
    {
        $donation = Donation::find($id);

        if (!$donation) {
            return response()->json([
                'success' => false,
                'message' => 'Donation not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'order_no' => 'sometimes|required|integer',
            'is_active' => 'sometimes|required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $donation->title = $request->title ?? $donation->title;
        $donation->button_text = $request->button_text ?? $donation->button_text;
        $donation->order_no = $request->order_no ?? $donation->order_no;
        $donation->is_active = $request->is_active ?? $donation->is_active;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($donation->image && Storage::disk('public')->exists($donation->image)) {
                Storage::disk('public')->delete($donation->image);
            }

            $path = $request->file('image')->store('donations', 'public');
            $donation->image = $path;
        }

        $donation->save();

        return response()->json([
            'success' => true,
            'message' => 'Donation updated successfully',
            'data' => $donation,
        ]);
    }

    /**
     * Delete a donation
     */
    public function destroy($id)
    {
        $donation = Donation::find($id);

        if (!$donation) {
            return response()->json([
                'success' => false,
                'message' => 'Donation not found'
            ], 404);
        }

        // Delete image if exists
        if ($donation->image && Storage::disk('public')->exists($donation->image)) {
            Storage::disk('public')->delete($donation->image);
        }

        $donation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Donation deleted successfully'
        ]);
    }
}
