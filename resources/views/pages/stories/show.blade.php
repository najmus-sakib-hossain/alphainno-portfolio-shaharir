@extends('layouts.app')

@section('title')
    Story Details
@endsection

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-green: #2ecc71;
    --color-accent-blue: #3498db;
    --color-border: #333333;
    --color-shadow: rgba(0,0,0,0.5);
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
}

.card-header-dark {
    background-color: var(--color-bg-primary);
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 15px 20px;
    border-bottom: 1px solid var(--color-border);
    text-align: center;
}

.card-title-modern {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--color-text-accent);
    letter-spacing: 0.3px;
}

.text-light {
    color: var(--color-text-light);
}

.text-secondary-accent {
    color: #777777;
}

.btn-modern-green,
.btn-modern-blue {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.25);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    margin-right: 8px;
}

.btn-modern-green {
    background-color: var(--color-accent-green);
    border-color: var(--color-accent-green);
    color: #ffffff;
}

.btn-modern-green:hover {
    background-color: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);
}

.btn-modern-blue {
    background-color: var(--color-accent-blue);
    border-color: var(--color-accent-blue);
    color: #ffffff;
}

.btn-modern-blue:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(52, 152, 219, 0.35);
}

.img-fluid {
    max-width: 100%;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark p-4">
        <div class="card-header-dark mb-3">
            <h3 class="card-title-modern">Story Details</h3>
        </div>
        <div class="row">
            <div class="col-md-4 text-center">
                {{-- @if($story->image_path)
                    <img src="{{ asset('storage/'.$story->image_path) }}" alt="Story Image" class="img-fluid">
                @else
                    <div class="text-light fst-italic">No Image Available</div>
                @endif --}}
                {{-- {{dd($story->hasMedia('stories'))}} --}}
                @if($story->hasMedia('stories'))
                    <div class="image-badge img-badge">
                        <img src="{{ $story->getFirstMediaUrl('stories') }}" alt="Story Image" class="rounded-circle" width="48" height="48">
                    </div>
                @else
                    <div class="image-badge user-badge">No Image</div>
                @endif
            </div>

            <div class="col-md-8 text-light">
                <h4 class="fw-semibold">{{ $story->title }}</h4>
                @if($story->subtitle)
                    <p class="text-secondary-accent mb-2">{{ $story->subtitle }}</p>
                @endif
                <p>{{ $story->description }}</p>
                <p>
                    Status:
                    @if($story->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </p>
                <p>Order: {{ $story->order_no }}</p>

                <div class="mt-4">
                    <a href="{{ route('stories.edit', $story->id) }}" class="btn-modern-green">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <a href="{{ route('stories.index') }}" class="btn-modern-blue">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
