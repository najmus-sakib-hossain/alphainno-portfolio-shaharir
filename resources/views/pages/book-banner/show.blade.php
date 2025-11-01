@extends('layouts.app')

@section('title', 'Book Banner Details')

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-red: #e94b3c;
    --color-accent-green: #2ecc71;
    --color-border: #333333;
    --color-shadow: rgba(0, 0, 0, 0.5);
}

body {
    background-color: var(--color-bg-primary);
    font-family: 'Inter', sans-serif;
}

.content-area {
    padding: 2rem;
    min-height: 100vh;
}

.card-dark {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    box-shadow: 0 10px 30px var(--color-shadow);
    border: 1px solid var(--color-border);
    overflow: hidden;
}

.card-header-dark {
    background-color: var(--color-bg-primary);
    padding: 0;
    margin: 0;
}

.card-body-dark {
    padding: 1.5rem 2rem;
    color: var(--color-text-light);
}

.card-footer-dark {
    background-color: var(--color-bg-primary);
    color: #9ca3af;
    text-align: center;
    padding: 1rem 0;
    border-top: 1px solid var(--color-border);
}

h2.title-dark {
    color: var(--color-text-accent);
    font-weight: 700;
    margin-bottom: 1rem;
    text-align: center;
}

p.text-dark {
    color: #cfd8dc;
}

p.text-muted-dark {
    color: #777;
    font-style: italic;
}

h5.text-success-dark {
    color: var(--color-accent-green);
    font-weight: 600;
}

.btn-dark, .btn-dark:hover {
    border-radius: 50px;
    padding: 8px 20px;
    font-weight: 600;
}

.btn-modern-red, .btn-modern-green, .btn-modern-red:hover, .btn-modern-green:hover {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0,0,0,0.25);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.btn-modern-red {
    background-color: var(--color-accent-red);
    border-color: var(--color-accent-red);
    color: #ffffff;
}

.btn-modern-red:hover {
    background-color: #c0392b;
    border-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(233, 75, 60, 0.35);
}

.btn-modern-green {
    background-color: var(--color-accent-green);
    border-color: var(--color-accent-green);
    color: #ffffff;
}

.btn-modern-green:hover {
    background-color: #27ae60;
    border-color: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);
}

.img-dark-preview {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-bottom: 1px solid var(--color-border);
}

.no-image-dark {
    background-color: #2c2c2c;
    color: #777;
    text-align: center;
    padding: 5rem 1rem;
}
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card card-dark">

                <!-- Banner Image -->
                @if($bookBanner->hasMedia('book_banner_image'))
                    <img src="{{ $bookBanner->getFirstMediaUrl('book_banner_image') }}"
                         alt="{{ $bookBanner->title }}"
                         class="img-dark-preview">
                @else
                    <div class="no-image-dark">
                        <i class="bi bi-image fs-1"></i>
                        <p class="mt-2 mb-0">No Image Uploaded</p>
                    </div>
                @endif

                <div class="card-body-dark">
                    <!-- Title -->
                    <h2 class="title-dark">{{ $bookBanner->title }}</h2>

                    <!-- Description -->
                    @if($bookBanner->description)
                        <p class="text-dark mb-4">{{ $bookBanner->description }}</p>
                    @else
                        <p class="text-muted-dark mb-4">No description available.</p>
                    @endif

                    <!-- Price -->
                    @if($bookBanner->price)
                        <h5 class="text-success-dark mb-4">
                            <i class="bi bi-cash-stack me-2"></i>Price: {{ $bookBanner->price }}
                        </h5>
                    @endif

                    <!-- Actions -->
                    <div class="d-flex justify-content-between flex-wrap gap-2 mt-4">
                        <a href="{{ route('book-banners.index') }}" class="btn-modern-red">
                            <i class="bi bi-arrow-left me-1"></i>Back
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('book-banners.edit', $bookBanner->id) }}" class="btn-modern-green">
                                <i class="bi bi-pencil-square me-1"></i>Edit
                            </a>
                            <form action="{{ route('book-banners.destroy', $bookBanner->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-modern-red"
                                        onclick="return confirm('Are you sure you want to delete this banner?');">
                                    <i class="bi bi-trash3 me-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-footer-dark">
                    <small>Created at: {{ $bookBanner->created_at->format('M d, Y') }} |
                    Last updated: {{ $bookBanner->updated_at->format('M d, Y') }}</small>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
