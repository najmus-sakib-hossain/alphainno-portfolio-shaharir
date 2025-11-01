@extends('layouts.app')

@section('title', $activity->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Activity Card -->
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <h2 class="card-title text-primary fw-bold mb-3"><i class="bi bi-clipboard2-check-fill me-2"></i>{{ $activity->title }}</h2>
                    
                    @if($activity->description)
                        <p class="card-text text-muted mb-4">{{ $activity->description }}</p>
                    @else
                        <p class="card-text text-muted mb-4"><em>No description provided.</em></p>
                    @endif

                    <hr>

                    <!-- Images Gallery -->
                    <h5 class="text-secondary fw-semibold mb-3"><i class="bi bi-images me-2"></i>Images</h5>
                    @if($activity->hasMedia('activity_images'))
                        <div class="row g-3">
                            @foreach($activity->getMedia('activity_images') as $media)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                                        <img src="{{ $media->getUrl() }}" 
                                             class="card-img-top img-fluid" 
                                             style="height: 180px; object-fit: cover;" 
                                             alt="{{ $activity->title }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted"><em>No images uploaded for this activity.</em></p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('event-activities.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                        <a href="{{ route('event-activities.edit', $activity->id) }}" class="btn btn-warning rounded-pill px-4 py-2 text-white ms-2">
                            <i class="bi bi-pencil-square me-2"></i>Edit
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection