@extends('layouts.app')

@section('content')
<div class="pt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8" style="max-width: 80%;">

            <div class="card shadow-lg border-0 rounded-4 mx-auto">
                <div class="card-header bg-warning text-white text-center rounded-top-4">
                    <h4 class="mb-0">Edit Entrepreneurship Banner</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('enterpreneurship-banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Title</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="form-control @error('title') is-invalid @enderror" 
                                value="{{ old('title', $banner->title) }}" 
                                placeholder="Enter banner title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Existing Image -->
                        <div class="mb-3 text-center">
                            @if($banner->getFirstMediaUrl('entrepreneurship_banner_image'))
                                <p class="fw-semibold">Current Image:</p>
                                <img src="{{ $banner->getFirstMediaUrl('entrepreneurship_banner_image') }}" 
                                     alt="Current Banner Image" 
                                     class="img-fluid rounded mb-3" 
                                     style="max-height: 200px;">
                            @else
                                <p class="text-muted fst-italic">No image uploaded yet.</p>
                            @endif
                        </div>

                        <!-- Upload New Image -->
                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Replace Image</label>
                            <input 
                                type="file" 
                                name="image" 
                                id="image" 
                                class="form-control @error('image') is-invalid @enderror" 
                                accept="image/*">
                            <small class="text-muted">Leave empty if you don't want to change the image.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Preview -->
                        <div class="mb-3 text-center">
                            <img id="preview-image" src="#" alt="Preview" class="img-fluid rounded d-none" style="max-height: 200px;">
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-3">
                                <i class="bi bi-save me-1"></i> Update Banner
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Live Image Preview Script --}}
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('preview-image');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endpush