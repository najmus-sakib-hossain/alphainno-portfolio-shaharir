@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>{{ $associate->title }}</h2>

    <p>{{ $associate->description }}</p>

    @if($associate->background_image)
    <img src="{{ asset('storage/'.$associate->background_image) }}" width="300" class="rounded mb-3">
    @endif

    @if($associate->partner_images)
        <div class="d-flex flex-wrap mb-3">
            @foreach($associate->partner_images as $img)
                <img src="{{ asset('storage/'.$img) }}" width="80" class="me-2 mb-2 rounded">
            @endforeach
        </div>
    @endif

    <p>Status: 
        @if($associate->is_active)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-danger">Inactive</span>
        @endif
    </p>

    <a href="{{ route('associates.index') }}" class="btn btn-primary mt-3">Back to list</a>
</div>
@endsection
