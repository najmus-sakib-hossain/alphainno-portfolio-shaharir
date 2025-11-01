<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Corporate;
use Illuminate\Support\Facades\Storage;

class CorporateController extends Controller
{
    /**
     * List all corporate steps.
     */
    public function index()
    {
        $corporates = Corporate::orderBy('order_no')->get();
        return response()->json($corporates);
    }

    /**
     * Show a single corporate step.
     */
    public function show($id)
    {
        $corporate = Corporate::find($id);

        if (!$corporate) {
            return response()->json(['message' => 'Corporate step not found'], 404);
        }

        return response()->json($corporate);
    }

    /**
     * Create a new corporate step.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'step_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'position_years' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:5048',
            'description' => 'nullable|string',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('corporates', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $corporate = Corporate::create($data);

        return response()->json($corporate, 201);
    }

    /**
     * Update an existing corporate step.
     */
    public function update(Request $request, $id)
    {
        $corporate = Corporate::find($id);
        if (!$corporate) {
            return response()->json(['message' => 'Corporate step not found'], 404);
        }

        $data = $request->validate([
            'step_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'position_years' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($corporate->image_path && Storage::disk('public')->exists($corporate->image_path)) {
                Storage::disk('public')->delete($corporate->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('corporates', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $corporate->update($data);

        return response()->json($corporate);
    }

    /**
     * Delete a corporate step.
     */
    public function destroy($id)
    {
        $corporate = Corporate::find($id);
        if (!$corporate) {
            return response()->json(['message' => 'Corporate step not found'], 404);
        }

        // Delete image if exists
        if ($corporate->image_path && Storage::disk('public')->exists($corporate->image_path)) {
            Storage::disk('public')->delete($corporate->image_path);
        }

        $corporate->delete();

        return response()->json(['message' => 'Corporate step deleted successfully']);
    }
}
