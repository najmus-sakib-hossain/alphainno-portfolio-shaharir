<?php

namespace App\Http\Controllers;

use App\Models\Innovation;
use Faker\Calculator\Inn;
use Illuminate\Http\Request;

class InnovationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $innovations = Innovation::latest()->paginate(10);
        return view('pages.innovations.index', compact('innovations'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.innovations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1️⃣ Validate input
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10096', // each file max 4MB
        ]);

        // 2️⃣ Create Innovation record
        $innovation = Innovation::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // 3️⃣ Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $innovation
                    ->addMedia($image)
                    ->toMediaCollection('innovation_images');
            }
        }

        // 4️⃣ Redirect back with success message
        return redirect()
            ->route('innovations.index')
            ->with('success', 'Innovation created successfully!');
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
    public function edit(Innovation $innovation)
    {
        return view('pages.innovations.edit', compact('innovation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Innovation $innovation)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $innovation->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $innovation->addMedia($image)->toMediaCollection('innovation_images');
            }
        }

        return redirect()->route('innovations.index')->with('success', 'Innovation updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Innovation $innovation)
    {
        // 1️⃣ Remove all associated media
        $innovation->clearMediaCollection('innovation_images');

        // 2️⃣ Delete the innovation record
        $innovation->delete();

        // 3️⃣ Redirect back with success message
        return redirect()
            ->route('innovations.index')
            ->with('success', 'Innovation deleted successfully!');
    }

    public function removeImage(\Spatie\MediaLibrary\MediaCollections\Models\Media $media)
    {
        $media->delete();
        return response()->json(['success' => true]);
    }

}
