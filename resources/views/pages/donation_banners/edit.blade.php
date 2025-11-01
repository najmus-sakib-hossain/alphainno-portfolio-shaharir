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

.container-fluid {
    max-width: 700px;
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
    margin-bottom: 0.5rem;
    display: block;
    color: var(--color-text-light);
    font-size: 0.95rem;
}

.form-control-dark {
    width: 100%;
    background-color: #2c2c2c;
    color: var(--color-text-light);
    border: 1px solid var(--color-border);
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.form-control-dark:focus {
    border-color: var(--color-accent-green);
    box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.3);
    outline: none;
}

.text-danger {
    color: var(--color-accent-red);
    font-size: 0.85rem;
}

.image-preview-dark {
    border-radius: 8px;
    border: 1px solid var(--color-border);
    max-width: 120px;
    max-height: 80px;
    object-fit: cover;
    display: block;
    margin-bottom: 0.5rem;
}

.btn-modern-green, .btn-modern-red {
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.6rem 1.5rem;
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
</style>
@endpush

<div class="container-fluid py-4">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-dark">
        <!-- Card Header -->
        <div class="card-header-dark">
            <h4>Edit Donation Banner</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('donation-banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label-dark">Section Title</label>
                    <input type="text" name="section_title" class="form-control-dark" value="{{ old('section_title', $banner->section_title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label-dark">Main Quote <span class="text-danger">*</span></label>
                    <textarea name="main_quote" class="form-control-dark" rows="3" required>{{ old('main_quote', $banner->main_quote) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label-dark">Current Image</label><br>
                    @if($banner->image_path)
                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner" class="image-preview-dark">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label-dark">Change Image</label>
                    <input type="file" name="image_path" class="form-control-dark">
                </div>

                <div class="mb-3">
                    <label class="form-label-dark">Button Text</label>
                    <input type="text" name="button_text" class="form-control-dark" value="{{ old('button_text', $banner->button_text) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label-dark">Button Link</label>
                    <input type="text" name="button_link" class="form-control-dark" value="{{ old('button_link', $banner->button_link) }}">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $banner->is_active ? 'checked' : '' }}>
                    <label class="form-check-label form-label-dark">Active</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-modern-green"><i class="bi bi-save me-1"></i> Update</button>
                    <a href="{{ route('donation-banners.index') }}" class="btn btn-modern-red">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
