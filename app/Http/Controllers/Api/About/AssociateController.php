<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Associate;

class AssociateController extends Controller
{
    // GET /api/associates
    public function index()
    {
        $associates = Associate::orderBy('order_no', 'asc')->get();
        return response()->json($associates);
    }

    // GET /api/associates/{id}
    public function show(Associate $associate)
    {
        return response()->json($associate);
    }

    // POST /api/associates
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'background_image' =>'nullable|file|mimes:jpg,jpeg,png,svg,webp',
            'partner_images.*' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp',
        ]);

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('associates', 'public');
        }

        if ($request->hasFile('partner_images')) {
            $partnerImages = [];
            foreach ($request->file('partner_images') as $image) {
                $partnerImages[] = $image->store('associates/partners', 'public');
            }
            $data['partner_images'] = $partnerImages;
        }

        $data['is_active'] = $request->has('is_active') ? true : false;

        $associate = Associate::create($data);

        return response()->json($associate, 201);
    }

    // PUT /api/associates/{id}
    public function update(Request $request, Associate $associate)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'background_image' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp',
            'partner_images.*' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp',
        ]);

        if ($request->hasFile('background_image')) {
            if ($associate->background_image) {
                Storage::disk('public')->delete($associate->background_image);
            }
            $data['background_image'] = $request->file('background_image')->store('associates', 'public');
        }

        if ($request->hasFile('partner_images')) {
            $partnerImages = $associate->partner_images ?? [];
            foreach ($request->file('partner_images') as $image) {
                $partnerImages[] = $image->store('associates/partners', 'public');
            }
            $data['partner_images'] = $partnerImages;
        }

        $data['is_active'] = $request->has('is_active') ? true : false;

        $associate->update($data);

        return response()->json($associate);
    }

    // DELETE /api/associates/{id}
    public function destroy(Associate $associate)
    {
        if ($associate->background_image) {
            Storage::disk('public')->delete($associate->background_image);
        }

        if ($associate->partner_images) {
            foreach ($associate->partner_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $associate->delete();

        return response()->json(['message' => 'Associate deleted successfully']);
    }
}
