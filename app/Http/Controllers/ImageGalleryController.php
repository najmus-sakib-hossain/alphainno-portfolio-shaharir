<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StandaloneMedia;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::where('collection_name', 'image_gallery')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('pages.image-gallery.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.image-gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Use a temporary model instance just for Spatie
        $tempModel = new StandaloneMedia();
        $tempModel->id = 1;
        $tempModel->exists = true;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $tempModel
                    ->addMedia($image)
                    ->toMediaCollection('image_gallery');
            }
        }

        return redirect()
            ->route('image-galleries.index')
            ->with('success', 'Images uploaded successfully!');
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
    public function destroyImage($id)
    {
        $media = Media::findOrFail($id);

        // delete physical file (optional)
        if (Storage::disk($media->disk)->exists($media->getPath())) {
            Storage::disk($media->disk)->delete($media->getPath());
        }

        // delete conversions
        foreach ($media->getGeneratedConversions()->keys() as $conversion) {
            $path = $media->getPath($conversion);
            if (Storage::disk($media->disk)->exists($path)) {
                Storage::disk($media->disk)->delete($path);
            }
        }

        // delete record
        $media->delete();

        return redirect()
            ->route('image-galleries.index')
            ->with('success', 'Image deleted successfully!');
    }

}
