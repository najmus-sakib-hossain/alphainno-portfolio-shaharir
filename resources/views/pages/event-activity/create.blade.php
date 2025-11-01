@extends('layouts.app')

@section('title', 'Create Event Activity')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                    <h3 class="mb-0"><i class="bi bi-clipboard2-plus-fill me-2"></i>Create New Event Activity</h3>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('event-activities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Activity Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Activity Title</label>
                            <input type="text" name="title" id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Enter activity title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Write a short description (optional)">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Multi Image Upload -->
                        <div class="mb-4">
                            <label for="images" class="form-label fw-semibold">Upload Images</label>
                            <input type="file" name="images[]" id="images"
                                   class="form-control @error('images') is-invalid @enderror"
                                   accept="image/*" multiple>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- Multi Image Preview -->
                            <div id="preview-container" class="mt-3 row g-3">
                                <!-- Each selected image will appear here -->
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill">
                                <i class="bi bi-check-circle me-2"></i>Create Activity
                            </button>
                            <a href="{{ route('event-activities.index') }}" 
                               class="btn btn-outline-secondary px-4 py-2 rounded-pill ms-2">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Multi Image Preview Script -->
<script>
document.getElementById('images').addEventListener('change', function(event) {
    const container = document.getElementById('preview-container');
    container.innerHTML = ''; // Clear old previews

    const files = event.target.files;
    if (files.length > 0) {
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.classList.add('col-6', 'col-md-4', 'col-lg-3');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-fluid', 'rounded', 'shadow-sm');
                img.style.maxHeight = '150px';
                img.style.objectFit = 'cover';

                col.appendChild(img);
                container.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>
@endpush
