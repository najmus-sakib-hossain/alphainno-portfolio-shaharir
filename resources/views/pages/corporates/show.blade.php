@extends('layouts.app')

@section('title')
    Corporate Step Details
@endsection

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-green: #2ecc71;
    --color-accent-red: #e94b3c;
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
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--color-text-accent);
    margin: 0;
}

.detail-row {
    margin-bottom: 1rem;
}

.detail-label {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--color-text-accent);
    margin-right: 0.5rem;
}

.detail-value {
    font-size: 0.95rem;
    color: var(--color-text-light);
}

.image-preview {
    max-width: 100%;
    border-radius: 12px;
    margin-bottom: 1rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

.badge-active {
    background-color: var(--color-accent-green);
    color: #fff;
    font-weight: 600;
    padding: 0.35rem 0.65rem;
    border-radius: 8px;
}

.badge-inactive {
    background-color: var(--color-accent-red);
    color: #fff;
    font-weight: 600;
    padding: 0.35rem 0.65rem;
    border-radius: 8px;
}

.btn-modern-red {
    background-color: var(--color-accent-red);
    color: #fff;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-modern-red:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(233, 75, 60, 0.35);
}
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-modern">{{ $corporate->title }}</h3>
        </div>
        <div class="card-body">

            <div class="detail-row">
                <span class="detail-label">Step Number:</span>
                <span class="detail-value">{{ $corporate->step_number }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Company Name:</span>
                <span class="detail-value">{{ $corporate->company_name }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Position / Years:</span>
                <span class="detail-value">{{ $corporate->position_years }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Status:</span>
                <span class="detail-value">
                    @if($corporate->is_active)
                        <span class="badge-active">Active</span>
                    @else
                        <span class="badge-inactive">Inactive</span>
                    @endif
                </span>
            </div>

            @if($corporate->image_path)
                <div class="detail-row">
                    <span class="detail-label">Image:</span><br>
                    <img src="{{ asset('storage/'.$corporate->image_path) }}" class="image-preview" alt="Corporate Image">
                </div>
            @endif

            <div class="detail-row">
                <span class="detail-label">Description:</span>
                <p class="detail-value">{{ $corporate->description }}</p>
            </div>

            <a href="{{ route('corporates.index') }}" class="btn-modern-red mt-3"><i class="fas fa-arrow-left me-1"></i> Back to List</a>
        </div>
    </div>
</div>
@endsection
