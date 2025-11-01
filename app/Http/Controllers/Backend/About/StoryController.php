<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Story;

class StoryController extends Controller
{
     public function index()
    {
        $stories = Story::orderBy('order_no')->get();
        return view('pages.stories.index', compact('stories'));
    }

    public function create()
    {
        return view('pages.stories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $story = Story::create($request->except('image_path'));

        if ($request->hasFile('image_path')) {
            $story->addMediaFromRequest('image_path')->toMediaCollection('stories');
        }

        return redirect()->route('stories.index')->with('success', 'Story created successfully.');
    }

    public function show(Story $story)
    {
        return view('pages.stories.show', compact('story'));
    }

    public function edit(Story $story)
    {
        return view('pages.stories.edit', compact('story'));
    }

    public function update(Request $request, Story $story)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $story->update($request->except('image_path'));

        if ($request->hasFile('image_path')) {
            $story->clearMediaCollection('stories');
            $story->addMediaFromRequest('image_path')->toMediaCollection('stories');
        }

        return redirect()->route('stories.index')->with('success', 'Story updated successfully.');
    }

    public function destroy(Story $story)
    {
        $story->clearMediaCollection('stories');
        $story->delete();

        return redirect()->route('stories.index')->with('success', 'Story deleted successfully.');
    }
}
