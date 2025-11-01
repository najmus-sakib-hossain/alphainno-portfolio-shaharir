@extends('layouts.app')

@section('title', 'Philosophical Logics')

@push('styles')
<style>
    /* 1. Base Dark Theme Colors */
    body {
        /* Assuming 'layouts.app' wraps content. We set a deep charcoal background. */
        background-color: #1C1C21 !important; 
        color: #E0E0E0 !important; /* Off-White/Light Grey Text */
    }

    /* 2. Card Design (Surface color: slightly lighter than background) */
    .card {
        border: none;
        border-radius: 1rem;
        background-color: #24272C; /* Dark Grey surface */
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4); /* Deeper shadow for depth */
        transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .card:hover {
        transform: translateY(-5px) scale(1.01);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
    }
    
    .card-footer {
        border-top: 1px solid #3d3d5a; /* Subtle divider */
        background-color: transparent;
    }

    /* 3. Card Header (Vibrant Purple Gradient - unchanged) */
    .card-header {
        background: linear-gradient(135deg, #6C3483, #B565A7);
        color: #FFFFFF;
        font-weight: 700;
        font-size: 1.2rem;
        border-radius: 1rem 1rem 0 0;
        border-bottom: none;
    }

    /* 4. Action Colors / Accent */
    /* Primary Accent (Electric Blue for CTA and Main Heading) */
    .text-accent-primary {
        color: #00A3FF !important; /* Changed to Electric Blue */
        text-shadow: 0 0 5px rgba(0, 163, 255, 0.6); /* Adjusted shadow to blue */
    }
    
    /* Add New Button (Primary CTA) */
    .btn-primary-dark {
        background-color: #00A3FF; /* Changed to Electric Blue */
        border-color: #00A3FF; /* Changed to Electric Blue */
        color: #1C1C21; /* Dark text on bright button */
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-primary-dark:hover {
        background-color: #33B4FF; /* Lighter shade of blue for hover */
        border-color: #33B4FF; /* Lighter shade of blue for hover */
        box-shadow: 0 0 10px rgba(0, 163, 255, 0.8);
    }

    /* 5. Badges (Logics - unchanged) */
    .badge-logic-dark {
        background-color: #3D3D5A; /* Dark Indigo background */
        color: #C7CEEA; /* Light Lylac text */
        padding: 0.5em 0.7em;
        border-radius: 0.5rem;
        font-size: 0.85rem;
        display: inline-block;
        margin: 2px 4px 2px 0;
    }

    /* 6. Edit Button (Warm Gold/Orange - unchanged) */
    .btn-edit-dark {
        background-color: #FFB74D;
        color: #24272C;
        border: none;
        font-weight: 600;
    }

    .btn-edit-dark:hover {
        background-color: #FFA521;
        color: #1C1C21;
    }

    /* 7. Delete Button (Red - unchanged) */
    .btn-delete-dark {
        background-color: #EF5350;
        color: #FFFFFF;
        border: none;
    }

    .btn-delete-dark:hover {
        background-color: #D32F2F;
    }

    /* 8. Info Alert */
    .alert-info-dark {
        background-color: #24272C;
        border-color: #6C3483;
        color: #C7CEEA;
        border-left: 5px solid #00A3FF; /* Accent border changed to Electric Blue */
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Main Heading using the Electric Blue accent color -->
        <h3 class="fw-bold text-accent-primary mb-0">
            <i class="bi bi-lightbulb-fill me-2"></i>Philosophical Logics
        </h3>
        <!-- Add New Button using the custom dark theme primary style (Electric Blue) -->
        <a href="{{ route('philosophies.create') }}" class="btn btn-primary-dark px-4">
            <i class="bi bi-plus-circle me-1"></i> Add New
        </a>
    </div>

    <div class="row g-4">
        @forelse($philosophies as $philosophy)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        {{ $philosophy->logic_theory }}
                    </div>
                    <div class="card-body">
                        @if(!empty($philosophy->logics))
                            @foreach($philosophy->logics as $logic)
                                <!-- Badge using the custom dark theme style -->
                                <span class="badge badge-logic-dark">{{ $logic }}</span>
                            @endforeach
                        @else
                            <p class="text-muted">No logics added.</p>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <!-- Edit Button using the custom dark theme style -->
                        <a href="{{ route('philosophies.edit', $philosophy->id) }}" class="btn btn-edit-dark btn-sm">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>

                        <!-- Delete Button using the custom dark theme style -->
                        <button type="submit" data-delete-route="{{ route('philosophies.destroy', $philosophy->id) }}" class="delete-item-btn btn btn-sm btn-delete-dark" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info-dark text-center">
                    <i class="bi bi-info-circle me-2"></i>No Philosophical Logics found. Add a new one.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
@include('components.delete-confirmation')
@endpush
