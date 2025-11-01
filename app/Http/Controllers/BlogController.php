<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function __construct(private BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs = Blog::with('media')->latest()->paginate(10);
        return view('pages.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('pages.blog.create');
    }

    public function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $readingTime = ceil($wordCount / 200);
        return $readingTime;
    }

    public function store(Request $request)
    {
        // 1. Validation (Only validate fields coming directly from the form)
        $validatedData = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'published_at' => 'nullable|date',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);
        
        // 2. Prepare Data (Injecting auto-calculated and authenticated values)
        $postData = array_merge($validatedData, [
            'slug'         => Str::slug($validatedData['title']),
            'reading_time' => $this->calculateReadingTime($validatedData['content']),
            'author_id'    => Auth::user()->id, // Set authenticated user
        ]);
        
        // Remove file key from data array before mass assignment
        unset($postData['cover_image']);


        DB::beginTransaction();

        try {
            // 3. Create the Blog Model Record
            $blog = Blog::create($postData);

            // 4. Handle Spatie Media Library Upload:
            // This is the correct way to check and retrieve the uploaded file.
            if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
                $blog->addMediaFromRequest('cover_image')
                     ->toMediaCollection('blog_cover_image');
            }

            DB::commit();

            return redirect()->route('blogs.index')->with('success', 'Blog post created successfully with image!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Blog creation failed in Service: ' . $e->getMessage());

            throw $e;
        }
    }

    public function show(Blog $blog)
    {
        return view('pages.blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('pages.blog.edit', compact('blog'));
    }

    
    public function update(Request $request, Blog $blog)
    {
        // 1. Validation (Only validate fields coming directly from the form)
        $validatedData = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'published_at' => 'nullable|date',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);
        
        // 2. Prepare Data (Injecting auto-calculated and authenticated values)
        // Note: For update, we might not always regenerate slug or reading_time, but matching create logic.
        // Author_id remains unchanged.
        $postData = array_merge($validatedData, [
            'slug'         => Str::slug($validatedData['title']),
            'reading_time' => $this->calculateReadingTime($validatedData['content']),
            // 'author_id' not updated; assume it stays the same
        ]);
        
        // Remove file key from data array before mass assignment (though not in array, safety)
        unset($postData['cover_image']);

        DB::beginTransaction();

        try {
            // 3. Update the Blog Model Record
            $blog->update($postData);

            // 4. Handle Spatie Media Library Upload (Replacement):
            // If a new file is uploaded, clear old and add new.
            if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
                // Clear existing media in the collection to replace/delete old image
                $blog->clearMediaCollection('blog_cover_image');
                
                // Add the new media
                $blog->addMediaFromRequest('cover_image')
                     ->toMediaCollection('blog_cover_image');
            }
            // If no new image, old one remains untouched.

            DB::commit();

            return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Blog update failed: ' . $e->getMessage());

            // Optionally re-throw or handle differently
            return redirect()->back()->with('error', 'Failed to update blog post. Please try again.');
        }
    }

    public function destroy(Blog $blog)
    {
        DB::beginTransaction();

        try {
            // Explicitly clear media (files + DB entries). If using booted() above, this is redundant but safe.
            $blog->clearMediaCollection('blog_cover_image');

            // Delete the blog record
            $blog->delete();

            DB::commit();

            // Return JSON for AJAX (matches your JS expectations)
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Blog deletion failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete blog. Please try again.'
            ], 500);
        }
    }
}
