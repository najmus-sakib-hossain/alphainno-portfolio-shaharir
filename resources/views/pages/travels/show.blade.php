@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>{{ $travel->country_name }}</h2>

    <div class="mb-3">
        <strong>Status:</strong>
        @if($travel->is_active)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-secondary">Inactive</span>
        @endif
    </div>

    <div class="mb-4">
        <strong>Flag:</strong><br>
        @if($travel->country_flag_path)
            <img src="{{ asset('storage/'.$travel->country_flag_path) }}" width="100" class="rounded">
        @else
            <span class="text-muted">No Flag</span>
        @endif
    </div>

    <div class="mb-4">
        <strong>Map Image:</strong><br>
        @if($travel->map_image_path)
            <img src="{{ asset('storage/'.$travel->map_image_path) }}" width="200" class="rounded">
        @else
            <span class="text-muted">No Map</span>
        @endif
    </div>

    <div class="mb-4">
        <strong>Order No:</strong> {{ $travel->order_no }}
    </div>

    <a href="{{ route('travels.edit', $travel->id) }}" class="btn btn-success me-2"><i class="bi bi-pencil-square"></i> Edit</a>
    <a href="{{ route('travels.index') }}" class="btn btn-primary">Back</a>
</div>
@endsection
