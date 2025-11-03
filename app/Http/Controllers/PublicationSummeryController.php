<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicationSummery;

class PublicationSummeryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicationSummaries = PublicationSummery::all();
        return view('pages.publication-summery.index', compact('publicationSummaries'));
    }

    /**
     * Display public publications page.
     */
    public function publicIndex()
    {
        $publications = PublicationSummery::latest()->get();
        return view('pages.publications.public', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.publication-summery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5096',
        ]);

        // ✅ Create summary record
        $summary = PublicationSummery::create([
            'content' => $validated['content'],
        ]);

        // ✅ Upload image if provided
        if ($request->hasFile('image')) {
            $summary->addMediaFromRequest('image')->toMediaCollection('publication_images');
        }

        return redirect()
            ->route('publication-summery.index')
            ->with('success', 'Publication summary added successfully!');
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
    public function edit(PublicationSummery $publicationSummery)
    {
        return view('pages.publication-summery.edit', compact('publicationSummery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $summary = PublicationSummery::findOrFail($id);

        // ✅ Validate
        $validated = $request->validate([
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // ✅ Update content
        $summary->update([
            'content' => $validated['content'],
        ]);

        // ✅ Replace image if new one uploaded
        if ($request->hasFile('image')) {
            $summary->clearMediaCollection('publication_images');
            $summary->addMediaFromRequest('image')->toMediaCollection('publication_images');
        }

        return redirect()
            ->route('publication-summery.index')
            ->with('success', 'Publication summary updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $summary = PublicationSummery::findOrFail($id);

        // Delete associated image
        $summary->clearMediaCollection('publication_images');

        // Delete record
        $summary->delete();

        return redirect()
            ->route('publication-summery.index')
            ->with('success', 'Publication summary deleted successfully!');
    }
}
