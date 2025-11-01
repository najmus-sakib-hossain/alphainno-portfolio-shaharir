<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Award;

class AwardController extends Controller
{
    /**
     * Display a listing of awards.
     */
    public function index()
    {
        $awards = Award::latest()->get();
        return view('pages.awards.index', compact('awards'));
    }

    /**
     * Show the form for creating a new award.
     */
    public function create()
    {
        return view('pages.awards.create');
    }

    /**
     * Store a newly created award in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'time_period' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('awards', 'public');
        }

        Award::create($validated);

        return redirect()->route('awards.index')->with('success', 'Award created successfully!');
    }

    /**
     * Display the specified award.
     */
    public function show(Award $award)
    {
        return view('pages.awards.show', compact('award'));
    }

    /**
     * Show the form for editing the specified award.
     */
    public function edit(Award $award)
    {
        return view('pages.awards.edit', compact('award'));
    }

    /**
     * Update the specified award.
     */
    public function update(Request $request, Award $award)
    {
        $validated = $request->validate([
            'time_period' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($award->image_path && Storage::disk('public')->exists($award->image_path)) {
                Storage::disk('public')->delete($award->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('awards', 'public');
        }

        $award->update($validated);

        return redirect()->route('awards.index')->with('success', 'Award updated successfully!');
    }

    /**
     * Remove the specified award from storage.
     */
    public function destroy(Award $award)
    {
        if ($award->image_path && Storage::disk('public')->exists($award->image_path)) {
            Storage::disk('public')->delete($award->image_path);
        }

        $award->delete();

        return redirect()->route('awards.index')->with('success', 'Award deleted successfully!');
    }
}
