@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Cyber Security Section</h1>

    <form action="{{ route('cybers.update', $cyber->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $cyber->title }}" required>
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="{{ $cyber->subtitle }}">
        </div>

        <div class="mb-3">
            <label>Short Description</label>
            <textarea name="short_description" class="form-control" rows="2">{{ $cyber->short_description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Long Description</label>
            <textarea name="long_description" class="form-control" rows="5">{{ $cyber->long_description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Current Main Image</label><br>
            @if($cyber->image)
                <img src="{{ asset('storage/'.$cyber->image) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Current Frame Image</label><br>
            @if($cyber->frame_image)
                <img src="{{ asset('storage/'.$cyber->frame_image) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="frame_image" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $cyber->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('cybers.index') }}" class="btn btn-danger">Back</a>
    </form>
</div>
@endsection
