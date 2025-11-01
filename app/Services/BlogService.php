<?php

namespace App\Services;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogService
{
    public function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $readingTime = ceil($wordCount / 200);
        return $readingTime;
    }

    public function store($request)
    {
        $validatedData = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'reading_time' => 'nullable|integer',
            'author_id'    => 'required|exists:users,id',
            'published_at' => 'nullable|date',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        // 2. Prepare Data (e.g., automatically generate slug)
        // Note: 'published_at' is already correctly cast to Carbon because we defined it in $casts in the model.
        $postData = array_merge($validatedData, [
            'slug' => Str::slug($validatedData['title']),
            'reading_time' => $this->calculateReadingTime($validatedData['content']),
            'author_id' => Auth::user()->id
        ]);

        // We use a database transaction to ensure either the post is created AND the image is uploaded, 
        // or nothing happens if an error occurs.
        DB::beginTransaction();

        try {
            // 3. Create the Blog Model Record
            $blog = Blog::create($postData);

            // 4. Handle Spatie Media Library Upload
            if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
                
                // Add the media file named 'cover_image' from the request
                // and store it in the 'cover_image' collection we defined in the model.
                $blog->addMediaFromRequest('cover_image')
                     ->toMediaCollection('cover_image');
            }

            DB::commit();

            return redirect()->route('blogs.index')->with('success', 'Blog post created successfully with image!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            Log::error('Blog creation failed: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Could not create the blog post.']);
        }
    }
}
