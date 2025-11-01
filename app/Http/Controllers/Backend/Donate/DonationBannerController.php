<?php

namespace App\Http\Controllers\Backend\Donate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DonationBanner;

class DonationBannerController extends Controller
{// Show all banners
    public function index()
    {
        $banners = DonationBanner::orderBy('id', 'desc')->get();
        return view('pages.donation_banners.index', compact('banners'));
    }

    // Show form to create a new banner
    public function create()
    {
        return view('pages.donation_banners.create');
    }

    public function show($id)
{
    // Find the banner or fail with 404
    $banner = DonationBanner::findOrFail($id);

    // Return the show view with the banner data
    return view('pages.donation_banners.show', compact('banner'));
}

    // Store new banner
    public function store(Request $request)
    {
        $request->validate([
            'section_title' => 'nullable|string|max:255',
            'main_quote' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except('image_path');

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('donation_banners', 'public');
        }
        
        
        
        // DonationBanner::create($data);
        
        // $request->validate([
            //     'section_title' => 'nullable|string|max:255',
            //     'main_quote' => 'required|string',
            //     'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
            //     'button_text' => 'nullable|string|max:100',
            //     'button_link' => 'nullable|string|max:255',
            //     'is_active' => 'nullable|boolean',
            // ]);
            
            $banner = DonationBanner::create($data);
            
            if ($request->hasFile('image_path')) {
                // dd($banner->addMediaFromRequest('image_path')->toMediaCollection('donationbanners'));
                $banner->addMediaFromRequest('image_path')->toMediaCollection('donationbanners');
            }
            
            return redirect()->route('donation-banners.index')->with('success', 'Donation banner created successfully.');
        }
        
    // Show form to edit banner
    public function edit($id)
    {
        $banner = DonationBanner::findOrFail($id);
        return view('pages.donation_banners.edit', compact('banner'));
    }

    // Update banner
    public function update(Request $request, $id)
    {
        $banner = DonationBanner::findOrFail($id);

        $request->validate([
            'section_title' => 'nullable|string|max:255',
            'main_quote' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
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
            $banner->clearMediaCollection('stories');
            $banner->addMediaFromRequest('image_path')->toMediaCollection('stories');
        }

        return redirect()->route('donation-banners.index')->with('success', 'Donation banner updated successfully.');
    }

    // Delete banner
    public function destroy($id)
    {
        $banner = DonationBanner::findOrFail($id);
        if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
            Storage::disk('public')->delete($banner->image_path);
        }
        
        $banner->clearMediaCollection('stories');
        $banner->delete();


        // $banner->delete();

        return redirect()->route('donation-banners.index')->with('success', 'Donation banner deleted successfully.');
    }
}