@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Edit Donation</h4>
    <form action="{{ route('donations.update', $donation->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ $donation->title }}" required>
        </div>

        <div class="mb-3">
            <label>Button Text</label>
            <input type="text" name="button_text" class="form-control" value="{{ $donation->button_text }}">
        </div>

        <div class="mb-3">
            <label>Donation Link</label>
            <input type="url" name="donation_link" class="form-control" value="{{ $donation->donation_link }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $donation->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Order No</label>
            <input type="number" name="order_no" class="form-control" value="{{ $donation->order_no }}">
        </div>

        <div class="mb-3">
            <label>Active Status</label>
            <select name="is_active" class="form-select">
                <option value="1" {{ $donation->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$donation->is_active ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control mb-2">
            @if($donation->image)
                <img src="{{ asset('storage/' . $donation->image) }}" width="120" class="rounded">
            @endif
        </div>

        <button class="btn btn-success mt-3">Update</button>
        <a href="{{ route('donations.index') }}" class="btn btn-danger mt-3">Cancel</a>
    </form>
</div>
@endsection
