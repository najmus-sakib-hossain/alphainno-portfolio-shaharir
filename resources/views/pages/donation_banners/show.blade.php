@extends('layouts.app')

@section('content')
@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-green: #2ecc71;
    --color-accent-red: #e94b3c;
    --color-border: #333;
    --color-shadow: rgba(0,0,0,0.5);
}

body {
    background-color: var(--color-bg-primary);
    color: var(--color-text-light);
    font-family: 'Inter', sans-serif;
}

.card-dark {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    box-shadow: 0 10px 30px var(--color-shadow);
    border: 1px solid var(--color-border);
}

.card-header-dark {
    background: linear-gradient(90deg, #6b7280, #4b5563);
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 1rem 1.5rem;
    text-align: center;
}

.card-header-dark h4 {
    margin: 0;
    color: var(--color-text-accent);
    font-weight: 700;
}

.form-label-dark {
    font-weight: 600;
    margin-bottom: 0.25rem;
    display: block;
    color: var(--color-text-light);
}

.text-light-secondary {
    color: #a0aec0;
}

img.dark-preview {
    border-radius: 8px;
    object-fit: cover;
    max-width: 100%;
    border: 1px solid var(--color-border);
}

.btn-modern-green, .btn-modern-red {
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    color: #fff;
    border: none;
}

.btn-modern-green {
    background-color: var(--color-accent-green);
}

.btn-modern-green:hover {
    background-color: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);
}

.btn-modern-red {
    background-color: var(--color-accent-red);
}

.btn-modern-red:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(233,75,60,0.35);
}

.badge-dark {
    background-color: #374151;
    color: #fff;
}
</style>
@endpush

<div class="container-fluid py-4">
    <div class="card card-dark">
        <div class="card-header-dark d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Donation Banner Details</h4>
            <a href="{{ route('donation-banners.index') }}" class="btn btn-modern-green">
                <i class="bi bi-arrow-left-circle me-1"></i> Back to List
            </a>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 text-center">
                    <label class="form-label-dark">Image</label><br>
                    {{-- @if($banner->image_path)
                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner" class="dark-preview mb-2" width="250" height="150">
                    @else
                        <span class="text-light-secondary">No Image</span>
                    @endif --}}
                    @if($banner->hasMedia('donationbanners'))
                        <div class="image-badge img-badge">
                            <img src="{{ $banner->getFirstMediaUrl('donationbanners') }}" alt="Banner" class="dark-preview mb-2" width="250" height="150">
                        </div>
                    @else
                        <div class="image-badge user-badge">No Image</div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="mb-2">
                        <span class="form-label-dark">Section Title:</span>
                        <span>{{ $banner->section_title ?? '—' }}</span>
                    </div>

                    <div class="mb-2">
                        <span class="form-label-dark">Main Quote:</span>
                        <p class="mb-0">{{ $banner->main_quote }}</p>
                    </div>

                    <div class="mb-2">
                        <span class="form-label-dark">Button Text:</span>
                        <span>{{ $banner->button_text ?? '—' }}</span>
                    </div>

                    <div class="mb-2">
                        <span class="form-label-dark">Button Link:</span>
                        <span>{{ $banner->button_link ?? '—' }}</span>
                    </div>

                    <div class="mb-2">
                        <span class="form-label-dark">Status:</span>
                        @if($banner->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge badge-dark">Inactive</span>
                        @endif
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('donation-banners.edit', $banner->id) }}" class="btn btn-modern-green">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                        <form action="{{ route('donation-banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this banner?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-modern-red">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
