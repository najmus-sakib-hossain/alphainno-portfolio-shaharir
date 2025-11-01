@extends('layouts.app')

@section('title', 'Edit Event Activity')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-warning text-dark text-center py-3 rounded-top-4">
                    <h3 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Event Activity</h3>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('event-activities.update', $eventActivity->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Activity Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Event Activity Title</label>
                            <input type="text" name="title" id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $eventActivity->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Write a short description">{{ old('description', $eventActivity->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Existing Images -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Existing Images</label>
                            <div class="row g-2">
                                @forelse($eventActivity->getMedia('activity_images') as $media)
                                    <div class="col-6 col-md-4 col-lg-3 position-relative">
                                        <img src="{{ $media->getUrl() }}" class="img-fluid rounded shadow-sm" style="height: 120px; object-fit: cover;">
                                        
                                        <!-- Remove Image Button -->
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 remove-image-btn" data-id="{{ $media->id }}">
                                            <i class="bi bi-x-lg"></i>
                                        </button>                                        
                                    </div>
                                @empty
                                    <p class="text-muted">No images uploaded yet.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Upload Additional Images -->
                        <div class="mb-4">
                            <label for="images" class="form-label fw-semibold">Add More Images</label>
                            <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple>
                            
                            <!-- Preview container -->
                            <div id="preview-container" class="mt-3 row g-3"></div>
                        </div>

                        <!-- Submit -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-warning px-5 py-2 rounded-pill text-white">
                                <i class="bi bi-save2 me-2"></i>Update Activity
                            </button>
                            <a href="{{ route('event-activities.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill ms-2">
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

<!-- Optional: Remove existing image via AJAX -->
<script>
    document.querySelectorAll('.remove-image-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const mediaId = this.dataset.id;
            if(!confirm('Are you sure you want to remove this image?')) return;
    
            fetch(`/event-activities/remove-image/${mediaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    // Remove image thumbnail from DOM
                    this.closest('div').remove();
                } else {
                    alert('Failed to remove image: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(() => alert('Failed to remove image.'));
        });
    });
</script>
    
@endpush
