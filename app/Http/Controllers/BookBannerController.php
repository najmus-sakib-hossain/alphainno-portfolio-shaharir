<?php

namespace App\Http\Controllers;

use App\Models\BookBanner;
use Illuminate\Http\Request;

class BookBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookBanners = BookBanner::paginate(10);
        return view('pages.book-banner.index', compact('bookBanners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.book-banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $banner = BookBanner::create($validated);

        if ($request->hasFile('image')) {
            $banner->addMediaFromRequest('image')->toMediaCollection('book_banner_image');
        }

        return redirect()->route('book-banners.index')->with('success', 'Book banner created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(BookBanner $bookBanner)
    {
        return view('pages.book-banner.show', compact('bookBanner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookBanner $bookBanner)
    {
        return view('pages.book-banner.edit', compact('bookBanner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bookBanner = BookBanner::findOrFail($id);

        // ✅ Validate input
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'nullable|string|max:50',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5048',
        ]);

        // ✅ Update text fields
        $bookBanner->update([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'] ?? null,
        ]);

        // ✅ Replace old image if new one uploaded
        if ($request->hasFile('image')) {
            $bookBanner->clearMediaCollection('book_banner_image');
            $bookBanner->addMediaFromRequest('image')->toMediaCollection('book_banner_image');
        }

        return redirect()
            ->route('book-banners.index')
            ->with('success', 'Book Banner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bookBanner = BookBanner::findOrFail($id);

        try {
            // ✅ Delete associated image from storage
            $bookBanner->clearMediaCollection('banner_image');

            // ✅ Delete database record
            $bookBanner->delete();

            return redirect()
                ->route('book-banners.index')
                ->with('success', 'Book Banner deleted successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('book-banners.index')
                ->with('error', 'Failed to delete book banner: ' . $e->getMessage());
        }
    }
}
