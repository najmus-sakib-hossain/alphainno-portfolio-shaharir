@extends('layouts.app')

@section('title')
    {{ $blog->title ?? 'Blog Post' }}
@endsection

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-blue: #2e5aff;
    --color-border: #333;
    --color-shadow: rgba(0,0,0,0.5);
}

body {
    background-color: var(--color-bg-primary);
    color: var(--color-text-light);
    font-family: 'Inter', sans-serif;
}

.blog-card {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    box-shadow: 0 10px 30px var(--color-shadow);
    border: 1px solid var(--color-border);
    overflow: hidden;
}

.blog-cover {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

.blog-content {
    font-size: 1.125rem;
    line-height: 1.8;
    color: var(--color-text-light);
}

.blog-content p {
    margin-bottom: 1.5rem;
}

.blog-content h2, .blog-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: var(--color-text-accent);
}

.card-body-dark {
    padding: 3rem 2rem;
}

.badge-time {
    background-color: var(--color-accent-blue);
    color: #fff;
}

.bg-placeholder {
    background-color: #2c2c2c;
    color: #777;
    padding: 5rem 0;
    text-align: center;
    border-bottom: 1px solid var(--color-border);
}

.btn-dark-outline {
    color: var(--color-text-light);
    border-color: var(--color-border);
}

.btn-dark-outline:hover {
    background-color: var(--color-accent-blue);
    border-color: var(--color-accent-blue);
    color: #fff;
}

.btn-secondary-dark {
    background-color: #333;
    color: var(--color-text-light);
}

.btn-secondary-dark:hover {
    background-color: #444;
    color: #fff;
}

@media (max-width: 768px) {
    .display-5 {
        font-size: 2rem;
    }
    .card-body-dark {
        padding: 1.5rem !important;
    }
}
</style>
@endpush

@section('content')
<div class="content-area py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="blog-card">
                {{-- Cover Image --}}
                @if ($blog->getFirstMediaUrl('blog_cover_image'))
                    <div class="position-relative">
                        <img 
                            src="{{ $blog->getFirstMediaUrl('blog_cover_image') }}" 
                            alt="{{ $blog->title }} Cover Image" 
                            class="blog-cover w-100"
                            loading="lazy"
                        >
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge badge-time fs-6 px-3 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-clock me-1"></i> {{ $blog->reading_time }} min read
                            </span>
                        </div>
                    </div>
                @else
                    <div class="bg-placeholder">
                        <i class="bi bi-image display-1"></i>
                        <p class="mt-3">No cover image available</p>
                    </div>
                @endif

                {{-- Card Body --}}
                <div class="card-body-dark">
                    {{-- Title --}}
                    <h1 class="display-5 fw-bold mb-4 lh-base">{{ $blog->title }}</h1>

                    {{-- Meta --}}
                    <div class="d-flex flex-wrap align-items-center text-white mb-4 small">
                        <div class="me-4 mb-2">
                            <i class="bi bi-person-circle me-2"></i>
                            <span>By Admin</span>
                        </div>
                        <div class="me-4 mb-2">
                            <i class="bi bi-calendar-event me-2"></i>
                            <span>Published {{ $blog->published_at?->format('M d, Y') ?? $blog->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="blog-content lead lh-lg mb-5">
                        {!! nl2br(e($blog->content)) !!}
                    </div>

                    {{-- Tags --}}
                    @if ($blog->tags ?? false)
                        <div class="mb-4">
                            <hr class="my-4">
                            <h5 class="fw-semibold text-muted mb-3">Tags</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($blog->tags as $tag)
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="d-flex flex-wrap gap-3 mt-5 border-top pt-4">
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-dark-outline btn-md rounded-pill px-4">
                            <i class="bi bi-pencil-square me-2"></i> Edit Post
                        </a>
                        <button 
                            class="btn btn-dark-outline btn-md rounded-pill px-4 delete-item-btn" 
                            data-delete-route="{{ route('blogs.destroy', $blog->id) }}"
                        >
                            <i class="bi bi-trash me-2"></i> Delete Post
                        </button>
                        <a href="{{ route('blogs.index') }}" class="btn btn-secondary-dark btn-md rounded-pill px-4 ms-auto">
                            <i class="bi bi-arrow-left me-2"></i> Back to Blogs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('components.delete-confirmation')
@endpush
