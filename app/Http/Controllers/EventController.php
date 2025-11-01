<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('pages.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate incoming data
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'event_date'   => 'required|date',
            'event_place'  => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
        ]);

        // ✅ Create Event
        $event = Event::create([
            'title'       => $validated['title'],
            'content'     => $validated['content'],
            'event_date'  => $validated['event_date'],
            'event_place' => $validated['event_place'],
        ]);

        // ✅ Attach image using Spatie Media Library
        if ($request->hasFile('image')) {
            $event->addMediaFromRequest('image')->toMediaCollection('event_image');
        }

        // ✅ Redirect with success message
        return redirect()
            ->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('pages.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('pages.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'event_date'   => 'required|date',
            'event_place'  => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // ✅ Update the event details
        $event->update([
            'title'       => $validated['title'],
            'content'     => $validated['content'],
            'event_date'  => $validated['event_date'],
            'event_place' => $validated['event_place'],
        ]);

        // ✅ Handle image replacement (Spatie Media Library)
        if ($request->hasFile('image')) {
            // Remove old image if exists
            if ($event->hasMedia('event_image')) {
                $event->clearMediaCollection('event_image');
            }

            // Add new image
            $event->addMediaFromRequest('image')->toMediaCollection('event_image');
        }

        // ✅ Redirect with success message
        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }
}
