<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventActivity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EventActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = EventActivity::with('media')->get();
        return view('pages.event-activity.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.event-activity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate request
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
        ]);

        // ✅ Create the activity
        $eventActivity = EventActivity::create([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        // ✅ Handle multiple image uploads using Spatie Media Library
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $eventActivity->addMedia($image)->toMediaCollection('activity_images');
            }
        }

        // ✅ Redirect with success message
        return redirect()
            ->route('event-activities.index')
            ->with('success', 'Event activity created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventActivity $eventActivity)
    {
        return view('pages.event-activity.show', ['activity' => $eventActivity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventActivity $eventActivity)
    {
        return view('pages.event-activity.edit', compact('eventActivity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventActivity $eventActivity)
    {

        // ✅ Validate request
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // ✅ Update activity details
        $eventActivity->update([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        // ✅ Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $eventActivity->addMedia($image)->toMediaCollection('activity_images');
            }
        }

        // ✅ Redirect with success message
        return redirect()
            ->route('event-activities.index')
            ->with('success', 'Event activity updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $eventActivity = EventActivity::findOrFail($id);
            // This will automatically delete all media associated with the model
            $eventActivity->clearMediaCollection('activity_images');

            // Delete the activity itself
            $eventActivity->delete();

            return redirect()
                ->route('event-activities.index')
                ->with('success', 'Event activity and all associated images have been deleted successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('event-activities.index')
                ->with('error', 'Failed to delete activity: ' . $e->getMessage());
        }
    }


    public function removeImage(Media $media)
    {
        try {
            $media->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
