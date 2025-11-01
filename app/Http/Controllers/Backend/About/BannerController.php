<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;

class BannerController extends Controller
{
    // Display all banners
    public function index()
    {
        $banners = Banner::all();
        return view('pages.banners.index', compact('banners'));
    }

    // Show create form
    public function create()
    {
        return view('pages.banners.create');
    }

    // Store new banner
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'video_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);
        // dd($request);

        $data = $request->except('image');

        // Upload image if exists
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('banners', 'public');
        }


        $banner = Banner::create($data);
            
        if ($request->hasFile('image')) {
            // dd($banner->addMediaFromRequest('image')->toMediaCollection('aboutbanner'));
            $banner->addMediaFromRequest('image')->toMediaCollection('aboutbanner');
        }

        return redirect()->route('banners.index')->with('success', 'Banner created successfully!');
    }
    public function show(Banner $banner)
    {
        return view('pages.banners.show', compact('banner'));
    }
    // Show edit form
    public function edit(Banner $banner)
    {
        return view('pages.banners.edit', compact('banner'));
    }

    // Update banner
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'video_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);


        $data = $request->except('image_path');

        if ($request->hasFile('image_path')) {
            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('donation_banners', 'public');
        }

        $banner->update($data);

        if ($request->hasFile('image_path')) {
            $banner->clearMediaCollection('aboutbanner');
            $banner->addMediaFromRequest('image_path')->toMediaCollection('aboutbanner');
        }

        // // Upload new image if exists
        // if ($request->hasFile('image_path')) {
        //     $data['image_path'] = $request->file('image_path')->store('banners', 'public');
        // }

        // $banner->update($data);

        return redirect()->route('banners.index')->with('success', 'Banner updated successfully!');
    }

    // Delete banner
    public function destroy(Banner $banner)
    {
        // $banner = DonationBanner::findOrFail($id);
        if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $banner->clearMediaCollection('donationbanners');
        $banner->delete();

        // $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully!');
    }
}
