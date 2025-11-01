@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Edit Associate</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('associates.update', $associate->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $associate->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5">{{ $associate->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Background Image</label>
            <input type="file" name="background_image" class="form-control">
            @if($associate->background_image)
            <img src="{{ asset('storage/'.$associate->background_image) }}" width="100" class="mt-2 rounded">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Partner Images</label>
            <input type="file" name="partner_images[]" class="form-control" multiple>
            @if($associate->partner_images)
                <div class="mt-2">
                    @foreach($associate->partner_images as $img)
                        <img src="{{ asset('storage/'.$img) }}" width="60" class="me-2 mb-2 rounded">
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" {{ $associate->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <div class="mb-3">
            <label class="form-label">Order</label>
            <input type="number" name="order_no" class="form-control" value="{{ $associate->order_no }}">
        </div>

        <button type="submit" class="btn btn-success">Update Associate</button>
    </form>
</div>
@endsection
