<?php

namespace App\Http\Controllers\Backend\Technology;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Cyber;

class CyberController extends Controller
{
    
    public function index()
    {
        $cybers = Cyber::latest()->get();
        return view('pages.cybers.index', compact('cybers'));
    }

    public function create()
    {
        return view('pages.cybers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg,image/svg+xml|max:5048',
            'frame_image' => 'nullable|mimes:jpg,jpeg,png,webp,svg,image/svg+xml|max:5048',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'title', 'subtitle', 'short_description', 'long_description', 'is_active'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cybers', 'public');
        }

        if ($request->hasFile('frame_image')) {
            $data['frame_image'] = $request->file('frame_image')->store('cybers', 'public');
        }

        Cyber::create($data);

        return redirect()->route('cybers.index')->with('success', 'Cyber Security section added successfully.');
    }


    public function edit(Cyber $cyber)
    {
        return view('pages.cybers.edit', compact('cyber'));
    }

    public function update(Request $request, Cyber $cyber)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:5048',
            'frame_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:5048',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'title', 'subtitle', 'short_description', 'long_description', 'is_active'
        ]);

        if ($request->hasFile('image')) {
            if ($cyber->image && Storage::disk('public')->exists($cyber->image)) {
                Storage::disk('public')->delete($cyber->image);
            }
            $data['image'] = $request->file('image')->store('cybers', 'public');
        }

        if ($request->hasFile('frame_image')) {
            if ($cyber->frame_image && Storage::disk('public')->exists($cyber->frame_image)) {
                Storage::disk('public')->delete($cyber->frame_image);
            }
            $data['frame_image'] = $request->file('frame_image')->store('cybers', 'public');
        }

        $cyber->update($data);

        return redirect()->route('cybers.index')->with('success', 'Cyber Security section updated successfully.');
    }

    public function destroy(Cyber $cyber)
    {
        if ($cyber->image && Storage::disk('public')->exists($cyber->image)) {
            Storage::disk('public')->delete($cyber->image);
        }
        if ($cyber->frame_image && Storage::disk('public')->exists($cyber->frame_image)) {
            Storage::disk('public')->delete($cyber->frame_image);
        }

        $cyber->delete();

        return redirect()->route('cybers.index')->with('success', 'Cyber Security section deleted successfully.');
    }
}