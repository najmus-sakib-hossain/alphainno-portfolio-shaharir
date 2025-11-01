@extends('layouts.app')

@section('title', $event->title)

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
    color: var(--color-text-light);
}

.card-dark {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    box-shadow: 0 10px 30px var(--color-shadow);
    border: 1px solid var(--color-border);
    overflow: hidden;
}

.card-dark img {
    display: block;
    width: 100%;
    object-fit: cover;
}

.card-title-dark {
    color: var(--color-text-accent);
}

.text-muted-dark {
    color: #a0a0a0;
}

.text-secondary-dark {
    color: #c0c0c0;
}

.btn-dark-outline {
    border-color: #555;
    color: #e0e0e0;
}

.btn-dark-outline:hover {
    background-color: #333;
    color: #fff;
}

p, li {
    line-height: 1.8;
}
</style>
@endpush

@section('content')
<div class="content-area py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card card-dark">
                <!-- Event Image -->
                @if ($event->hasMedia('event_image'))
                    <img src="{{ $event->getFirstMediaUrl('event_image') }}" 
                         alt="{{ $event->title }}" 
                         style="max-height: 400px;">
                @else
                    <img src="https://via.placeholder.com/800x400?text=No+Event+Image" 
                         style="max-height: 400px;">
                @endif

                <div class="card-body p-4">
                    <!-- Title -->
                    <h2 class="card-title-dark mb-3 fw-bold">
                        <i class="bi bi-calendar-event me-2"></i>{{ $event->title }}
                    </h2>

                    <!-- Event Details -->
                    <div class="mb-3 text-muted-dark">
                        <p class="mb-1">
                            <i class="bi bi-geo-alt-fill me-2 text-danger"></i>
                            <strong>Place:</strong> {{ $event->event_place }}
                        </p>
                        <p class="mb-1">
                            <i class="bi bi-clock-fill me-2 text-success"></i>
                            <strong>Date:</strong> 
                            {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}
                        </p>
                        <p class="mb-0">
                            <i class="bi bi-calendar-check-fill me-2 text-info"></i>
                            <strong>Created:</strong> {{ $event->created_at->format('M d, Y') }}
                        </p>
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <h5 class="fw-semibold mb-2 text-secondary-dark">Event Details</h5>
                        <p>{!! nl2br(e($event->content)) !!}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('events.index') }}" class="btn btn-dark-outline rounded-pill px-4 py-2">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>

                        <div class="d-flex gap-2">
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning rounded-pill px-4 py-2 text-white">
                                <i class="bi bi-pencil-square me-2"></i>Edit
                            </a>

                            <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-pill px-4 py-2">
                                    <i class="bi bi-trash3-fill me-2"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
