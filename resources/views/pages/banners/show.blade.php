@extends('layouts.app')

@section('title')
    Banner Details
@endsection

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

.text-muted-dark {
    color: #5e7b88;
    font-weight: 500;
}

.btn-modern-red,
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

.btn-modern-blue {
    background-color: #3498db;
    border-color: #3498db;
    color: #ffffff;
}

.btn-modern-blue:hover {
    background-color: #2980b9;
    border-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(52, 152, 219, 0.35);
}

.img-dark {
    border-radius: 12px;
    max-width: 100%;
    max-height: 400px;
    object-fit: cover;
}

.badge-active {
    background-color: var(--color-accent-green);
    color: #fff;
    font-weight: 600;
}

.badge-inactive {
    background-color: var(--color-accent-red);
    color: #fff;
    font-weight: 600;
}

@media (max-width: 767.98px) {
    .content-area {
        padding: 1rem;
    }
    .card-title-modern {
        font-size: 1.2rem;
    }
}
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="mb-4">
        <a href="{{ route('banners.index') }}" class="btn-modern-blue"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-modern">{{ $banner->title }}</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h5 class="text-muted-dark">Subtitle:</h5>
                <p>{{ $banner->subtitle ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <h5 class="text-muted-dark">Image:</h5>
                @if($banner->image_path)
                    <img src="{{ asset('storage/'.$banner->image_path) }}" alt="Banner Image" class="img-dark">
                @else
                    <p class="text-muted-dark">No image available</p>
                @endif
            </div>

            <div class="mb-3">
                <h5 class="text-muted-dark">Video:</h5>
                @if($banner->video_url)
                    <div class="ratio ratio-16x9">
                        <iframe 
                            src="{{ $banner->video_url }}" 
                            title="Banner Video"
                            allowfullscreen
                            class="rounded">
                        </iframe>
                    </div>
                @else
                    <p class="text-muted-dark">No video available</p>
                @endif
            </div>

            <div class="mb-3">
                <h5 class="text-muted-dark">Status:</h5>
                @if($banner->is_active)
                    <span class="badge-active">Active</span>
                @else
                    <span class="badge-inactive">Inactive</span>
                @endif
            </div>

            <div class="mt-4">
                <a href="{{ route('banners.edit', $banner->id) }}" class="btn-modern-green"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure you want to delete this banner?')" class="btn-modern-red">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
