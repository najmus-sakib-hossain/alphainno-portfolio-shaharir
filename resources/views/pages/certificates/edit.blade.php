@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Certificate</h1>

    <form action="{{ route('certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $certificate->title }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $certificate->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="{{ asset('storage/' . $certificate->image) }}" width="100" height="80" class="mb-2">
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $certificate->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('certificates.index') }}" class="btn btn-danger">Back</a>
    </form>
</div>
@endsection
