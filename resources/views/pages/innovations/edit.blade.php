@extends('layouts.app')

@section('title', 'Edit Innovation')

@section('content')
<div class="pt-2">
    <div class="d-flex justify-content-center">
        <div class="card shadow-lg border-0 rounded-4" style="width: 80%;">

            <!-- Header -->
            <div class="card-header text-white text-center rounded-top-4"
                 style="background: linear-gradient(90deg, #6366f1, #8b5cf6);">
                <h4 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Edit Innovation</h4>
            </div>

            <!-- Body -->
            <div class="card-body p-4">
                <form action="{{ route('innovations.update', $innovation->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title"
                               class="form-control rounded-3 @error('title') is-invalid @enderror"
                               value="{{ old('title', $innovation->title) }}"
                               placeholder="Enter title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <label for="content" class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" rows="5"
                                  class="form-control rounded-3 @error('content') is-invalid @enderror"
                                  placeholder="Enter content..." required>{{ old('content', $innovation->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Images -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Current Images</label>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($innovation->getMedia('innovation_images') as $image)
                                <div class="position-relative">
                                    <img src="{{ $image->getFullUrl() }}" 
                                         class="img-thumbnail rounded-3 shadow-sm"
                                         style="height: 130px; width: 180px; object-fit: cover;">
                                    <button type="button" 
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle remove-existing-image" 
                                            data-id="{{ $image->id }}">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            @empty
                                <p class="text-muted fst-italic">No images uploaded yet</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Upload New Images -->
                    <div class="mb-4">
                        <label for="images" class="form-label fw-semibold">Upload New Images</label>
                        <div class="border border-2 border-dashed rounded-3 p-4 text-center bg-light"
                             style="cursor: pointer;" onclick="document.getElementById('images').click()">
                            <input type="file" name="images[]" id="images" 
                                   class="form-control d-none @error('images') is-invalid @enderror"
                                   multiple accept="image/*">
                            <img id="preview-placeholder" src="https://via.placeholder.com/300x180?text=Upload+Preview" 
                                 alt="Preview" class="img-fluid rounded-3 shadow-sm" style="max-height: 180px;">
                            <p class="text-muted mt-2 mb-0">Click or drag to upload new images</p>
                        </div>
                        @error('images')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Preview -->
                    <div id="preview-container" class="d-flex flex-wrap gap-2 mb-4"></div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill">
                            <i class="bi bi-save me-2"></i>Update Innovation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const imagesInput = document.getElementById('images');
    const previewContainer = document.getElementById('preview-container');

    // Preview uploaded images
    imagesInput.addEventListener('change', function() {
        previewContainer.innerHTML = '';
        Array.from(this.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'rounded-3', 'shadow-sm');
                img.style.height = '130px';
                img.style.width = '180px';
                img.style.objectFit = 'cover';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });

    // AJAX delete existing image
    document.querySelectorAll('.remove-existing-image').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            if (confirm('Remove this image?')) {
                fetch(`/innovations/remove-image/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.closest('div.position-relative').remove();
                    } else {
                        alert('Failed to delete image.');
                    }
                });
            }
        });
    });
</script>
@endpush
