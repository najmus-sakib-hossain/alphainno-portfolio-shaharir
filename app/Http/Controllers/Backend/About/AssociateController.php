<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Associate;

class AssociateController extends Controller
{
     public function index()
    {
        $associates = Associate::orderBy('order_no', 'asc')->get();
        return view('pages.associates.index', compact('associates'));
    }

    public function create()
    {
        return view('pages.associates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image',
            'partner_images.*' => 'nullable|image',
            'order_no' => 'nullable|integer',
        ]);

        // Upload background image
        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('associates', 'public');
        }

        // Upload partner images
        if ($request->hasFile('partner_images')) {
            $partnerImages = [];
            foreach ($request->file('partner_images') as $image) {
                $partnerImages[] = $image->store('associates/partners', 'public');
            }
            $data['partner_images'] = $partnerImages;
        }

        $data['is_active'] = $request->has('is_active') ? true : false;

        Associate::create($data);

        return redirect()->route('associates.index')->with('success', 'Associate created successfully.');
    }

    public function show(Associate $associate)
    {
        return view('pages.associates.show', compact('associate'));
    }

    public function edit(Associate $associate)
    {
        return view('pages.associates.edit', compact('associate'));
    }

    public function update(Request $request, Associate $associate)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image',
            'partner_images.*' => 'nullable|image',
            'order_no' => 'nullable|integer',
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

        return redirect()->route('associates.index')->with('success', 'Associate updated successfully.');
    }

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
        return redirect()->route('associates.index')->with('success', 'Associate deleted successfully.');
    }
}
