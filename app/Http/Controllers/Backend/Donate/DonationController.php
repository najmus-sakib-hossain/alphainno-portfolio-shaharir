<?php

namespace App\Http\Controllers\Backend\Donate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Donation;

class DonationController extends Controller
{
    /**
     * Display a listing of the donations.
     */
    public function index()
    {
        $donations = Donation::orderBy('order_no', 'asc')->get();
        return view('pages.donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new donation.
     */
    public function create()
    {
        return view('pages.donations.create');
    }

    /**
     * Store a newly created donation in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'donation_link' => 'nullable|string|max:255',
            'order_no' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
        ]);

        $data = $request->only([
            'title',
            'button_text',
            'description',
            'donation_link',
            'order_no',
            'is_active',
        ]);

        $data['slug'] = Str::slug($request->title);

        // Upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/donations', 'public');
        }

        Donation::create($data);

        return redirect()->route('donations.index')->with('success', 'Donation created successfully.');
    }

    /**
     * Display the specified donation.
     */
    public function show($id)
    {
        $donation = Donation::findOrFail($id);
        return view('pages.donations.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified donation.
     */
    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        return view('pages.donations.edit', compact('donation'));
    }

    /**
     * Update the specified donation in storage.
     */
    public function update(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'donation_link' => 'nullable|string|max:255',
            'order_no' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
        ]);

        $data = $request->only([
            'title',
            'button_text',
            'description',
            'donation_link',
            'order_no',
            'is_active',
        ]);

        $data['slug'] = Str::slug($request->title);

        // Replace image if new one uploaded
        if ($request->hasFile('image')) {
            if ($donation->image && Storage::disk('public')->exists($donation->image)) {
                Storage::disk('public')->delete($donation->image);
            }

            $data['image'] = $request->file('image')->store('uploads/donations', 'public');
        }

        $donation->update($data);

        return redirect()->route('donations.index')->with('success', 'Donation updated successfully.');
    }

    /**
     * Remove the specified donation from storage.
     */
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);

        if ($donation->image && Storage::disk('public')->exists($donation->image)) {
            Storage::disk('public')->delete($donation->image);
        }

        $donation->delete();

        return redirect()->route('donations.index')->with('success', 'Donation deleted successfully.');
    }
}