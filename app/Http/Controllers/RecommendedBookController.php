<?php

namespace App\Http\Controllers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Http\Request;
use App\Models\RecommendedBook;

class RecommendedBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recommendedBooks = RecommendedBook::with('media')->get();
        return view('pages.recommended-book.index', compact('recommendedBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.recommended-book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate the request
        $validated = $request->validate([
            'images'   => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5096',
        ]);

        // ✅ Create an empty record (if you want to group uploads in a single entry)
        $book = RecommendedBook::create(); 

        // ✅ Upload multiple images using Spatie Media Library
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $book->addMedia($image)->toMediaCollection('recommended_images');
            }
        }

        return redirect()
            ->route('recommended-books.index')
            ->with('success', 'Recommended books uploaded successfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyImage($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        // Delete only this specific media file
        $media->delete();

        return redirect()
            ->route('recommended-books.index')
            ->with('success', 'Book image deleted successfully!');
    }
}
