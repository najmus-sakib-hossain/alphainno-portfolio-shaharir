@extends('layouts.app')

@section('title', 'All Event Activities')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-black fw-bold"><i class="bi bi-clipboard2-check-fill me-2"></i>Event Activities</h5>
        <a href="{{ route('event-activities.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
            <i class="bi bi-plus-circle me-2"></i>Create Activity
        </a>
    </div>

    <div class="row g-4">
        @forelse($activities as $activity)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    
                    <!-- First image preview -->
                    @if($activity->hasMedia('activity_images'))
                        <img src="{{ $activity->getMedia('activity_images')->first()->getUrl() }}"
                             class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $activity->title }}">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=No+Image"
                             class="card-img-top" style="height: 200px; object-fit: cover;" alt="No image">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary fw-bold">{{ $activity->title }}</h5>
                        <p class="card-text text-muted mb-3">
                            {{ Str::limit($activity->description ?? 'No description', 80) }}
                        </p>

                        <!-- Thumbnails of additional images -->
                        @if($activity->hasMedia('activity_images') && $activity->getMedia('activity_images')->count() > 1)
                            <div class="d-flex flex-wrap mb-3 gap-1">
                                @foreach($activity->getMedia('activity_images')->skip(1)->take(2) as $media)
                                    <img src="{{ $media->getUrl() }}"
                                         class="img-thumbnail rounded" style="width: 48px; height: 48px; object-fit: cover;">
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('event-activities.show', $activity->id) }}"
                               class="btn btn-outline-primary btn-sm rounded-pill">
                                <i class="bi bi-eye me-1"></i>View
                            </a>

                            <div>
                                <a href="{{ route('event-activities.edit', $activity->id) }}"
                                   class="btn btn-warning btn-sm rounded-pill text-white me-1">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </a>

                                <form action="{{ route('event-activities.destroy', $activity->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this activity?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill" data-delete-route="{{ route('event-activities.destroy', $activity->id) }}">
                                        <i class="bi bi-trash3-fill me-1"></i>Delete
                                    </button>
                                    {{-- <button class="action-btn delete-item-btn btn btn-sm text-danger" type="submit" data-delete-route="{{ route('event-activities.destroy', $activity->id) }}" title="Delete"><i class="bi bi-trash"></i></button> --}}
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>No event activities found.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
@include('components.delete-confirmation')
@endpush
