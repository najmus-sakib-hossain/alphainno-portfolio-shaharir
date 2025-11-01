<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntrepreneurshipBanner;

class EntrepreneurshipBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = EntrepreneurshipBanner::latest()->get();
        return view('pages.entrepreneurship-banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.entrepreneurship-banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5096',
        ]);

        // ✅ Create the banner record
        $banner = EntrepreneurshipBanner::create([
            'title' => $request->title,
        ]);

        // ✅ Attach image using Spatie Media Library
        if ($request->hasFile('image')) {
            $banner->addMediaFromRequest('image')
                   ->toMediaCollection('entrepreneurship_banner_image');
        }

        // ✅ Redirect with success message
        return redirect()
            ->route('enterpreneurship-banners.index')
            ->with('success', 'Banner created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = EntrepreneurshipBanner::findOrFail($id);
        return view('pages.entrepreneurship-banner.edit', compact('banner'));
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ✅ Validate input
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $entrepreneurshipBanner = EntrepreneurshipBanner::findOrFail($id);

        // ✅ Update title
        $entrepreneurshipBanner->update([
            'title' => $request->title,
        ]);

        // ✅ If user uploads new image → replace the old one automatically
        if ($request->hasFile('image')) {
            $entrepreneurshipBanner
                ->clearMediaCollection('entrepreneurship_banner_image')
                ->addMediaFromRequest('image')
                ->toMediaCollection('entrepreneurship_banner_image');
        }

        return redirect()
            ->route('enterpreneurship-banners.index')
            ->with('success', 'Banner updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entrepreneurshipBanner = EntrepreneurshipBanner::findOrFail($id);  

        // Delete the attached image (Spatie Media Library)
        $entrepreneurshipBanner->clearMediaCollection('entrepreneurship_banner_image');

        // Delete the database record
        $entrepreneurshipBanner->delete();

        return redirect()
            ->route('enterpreneurship-banners.index')
            ->with('success', 'Banner deleted successfully!');

    }

}
