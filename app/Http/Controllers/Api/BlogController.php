<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(Request $request)
{
    $query = Blog::latest();

    $limit = $request->query('limit'); // Gets the value of ?limit=X

    if ($limit !== null && is_numeric($limit) && (int)$limit > 0) {
        $query->limit((int)$limit);
    }

    $blogs = $query->get();

    $data = $blogs->map(function ($blog) {
        return [
            'id' => $blog->id,
            'title' => $blog->title,
            'content' => $blog->content,
            'reading_time' => $blog->reading_time,
            'author' => $blog->author,
            'published_at' => $blog->created_at,
            'image_url' => $blog->getFirstMediaUrl('blog_cover_image'),
        ];
    });

    // 6. Return the JSON response
    return response()->json([
        'status' => 'success',
        'data' => $data,
    ]);
}

    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        $data = [
            'id' => $blog->id,
            'title' => $blog->title,
            'content' => $blog->content,
            'author' => $blog->author,
            'published_at' => $blog->published_at,
            'image_url' => $blog->getFirstMediaUrl('blog_cover_image'),
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('q');

        // Start with a base query
        $query = Blog::latest();

        // 2. Apply the search logic if a term is provided
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                // Sanitize the search term for LIKE
                $search = '%' . $searchTerm . '%';

                // Search in title OR content
                $q->where('title', 'LIKE', $search)
                ->orWhere('content', 'LIKE', $search);
            });
        }


        // 3. Execute the query
        $blogs = $query->get();

        // 4. Map the results
        $data = $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'content' => $blog->content,
                'reading_time' => $blog->reading_time,
                'author' => $blog->author,
                'published_at' => $blog->published_at,
                'image_url' => $blog->getFirstMediaUrl('blog_cover_image'),
            ];
        });

        // 5. Return the JSON response
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
