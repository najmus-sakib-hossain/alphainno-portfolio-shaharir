@extends('layouts.app')

@section('content')
@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-green: #2ecc71;
    --color-accent-red: #e94b3c;
    --color-border: #333;
    --color-shadow: rgba(0,0,0,0.5);
}

body {
    background-color: var(--color-bg-primary);
    font-family: 'Inter', sans-serif;
    color: var(--color-text-light);
}

.container {
    max-width: 700px;
}

.card-dark {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    box-shadow: 0 10px 30px var(--color-shadow);
    border: 1px solid var(--color-border);
}

.card-header-dark {
    background-color: #1a1a1a;
    color: var(--color-text-accent);
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    font-weight: 600;
    font-size: 1.5rem;
}

.form-label-dark {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
    color: var(--color-text-light);
    font-size: 0.95rem;
}

.form-control-dark {
    width: 100%;
    background-color: #2c2c2c;
    color: var(--color-text-light);
    border: 1px solid var(--color-border);
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.form-control-dark:focus {
    background-color: #2c2c2c;
    color: var(--color-text-light);
    border-color: var(--color-accent-green);
    box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.3);
}

.text-danger {
    color: var(--color-accent-red);
    font-size: 0.85rem;
}

.btn-modern-green, .btn-modern-red {
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.6rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-modern-green {
    background-color: var(--color-accent-green);
    border: none;
    color: #fff;
}

.btn-modern-green:hover {
    background-color: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);
}

.btn-modern-red {
    background-color: var(--color-accent-red);
    border: none;
    color: #fff;
}

.btn-modern-red:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(233,75,60,0.35);
}

.image-upload-container-dark {
    border: 2px dashed var(--color-border);
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    background: #242424;
    transition: border-color 0.3s ease, background 0.3s ease;
    position: relative;
}

.image-upload-container-dark.dragover {
    border-color: var(--color-accent-green);
    background: #2c2c2c;
}

.image-preview-dark {
    max-width: 100%;
    max-height: 250px;
    object-fit: contain;
    margin-top: 1rem;
    border-radius: 8px;
    border: 1px solid var(--color-border);
    display: none;
}

.progress {
    height: 10px;
    margin-top: 1rem;
    border-radius: 5px;
    display: none;
}

.upload-text-dark {
    color: #777;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}
</style>
@endpush

<div class="pt-4">
    <div class="p-2">
        <div class="card card-dark">
            <div class="card-header-dark">Add Donation Banner</div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('donation-banners.store') }}" method="POST" enctype="multipart/form-data" id="donationBannerForm">
                    @csrf

                    <div class="form-group">
                        <label for="section_title" class="form-label-dark">Section Title</label>
                        <input 
                            type="text" 
                            name="section_title" 
                            id="section_title" 
                            class="form-control-dark @error('section_title') is-invalid @enderror" 
                            value="{{ old('section_title') }}">
                        @error('section_title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="main_quote" class="form-label-dark">Main Quote <span class="text-danger">*</span></label>
                        <textarea 
                            name="main_quote" 
                            id="main_quote" 
                            class="form-control-dark @error('main_quote') is-invalid @enderror" 
                            rows="3" 
                            required>{{ old('main_quote') }}</textarea>
                        @error('main_quote')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image_path" class="form-label-dark">Image</label>
                        <div class="image-upload-container-dark" id="imageUploadContainer">
                            <p class="upload-text-dark">Drag & drop image here or click to upload</p>
                            <input 
                                type="file" 
                                name="image_path" 
                                id="image_path" 
                                class="form-control d-none @error('image_path') is-invalid @enderror" 
                                accept="image/*">
                            <img id="imagePreview" class="image-preview-dark" src="#" alt="Image Preview">
                            <div class="progress" id="imageUploadProgress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @error('image_path')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="button_text" class="form-label-dark">Button Text</label>
                        <input 
                            type="text" 
                            name="button_text" 
                            id="button_text" 
                            class="form-control-dark @error('button_text') is-invalid @enderror" 
                            value="{{ old('button_text') }}">
                        @error('button_text')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button_link" class="form-label-dark">Button Link</label>
                        <input 
                            type="url" 
                            name="button_link" 
                            id="button_link" 
                            class="form-control-dark @error('button_link') is-invalid @enderror" 
                            value="{{ old('button_link') }}">
                        @error('button_link')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="is_active" 
                                id="is_active" 
                                value="1" 
                                {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label class="form-check-label form-label-dark" for="is_active">Active</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('donation-banners.index') }}" class="btn btn-modern-red">Cancel</a>
                        <button type="submit" class="btn btn-modern-green"><i class="bi bi-save me-1"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const imageUploadContainer = document.getElementById('imageUploadContainer');
    const imageInput = document.getElementById('image_path');
    const imagePreview = document.getElementById('imagePreview');
    const progressBar = document.getElementById('imageUploadProgress').querySelector('.progress-bar');
    const uploadText = imageUploadContainer.querySelector('.upload-text-dark');

    imageUploadContainer.addEventListener('click', () => {
        imageInput.click();
    });

    imageUploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageUploadContainer.classList.add('dragover');
    });

    imageUploadContainer.addEventListener('dragleave', () => {
        imageUploadContainer.classList.remove('dragover');
    });

    imageUploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        imageUploadContainer.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            handleImage(files[0]);
        }
    });

    imageInput.addEventListener('change', () => {
        if (imageInput.files.length > 0) {
            handleImage(imageInput.files[0]);
        }
    });

    function handleImage(file) {
        if (!file.type.startsWith('image/')) {
            uploadText.textContent = 'Please upload a valid image file';
            uploadText.style.color = '#e94b3c';
            return;
        }

        const reader = new FileReader();
        reader.onloadstart = () => {
            progressBar.parentElement.style.display = 'block';
            uploadText.textContent = 'Uploading...';
        };
        reader.onprogress = (e) => {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = `${percent}%`;
                progressBar.setAttribute('aria-valuenow', percent);
            }
        };
        reader.onload = (e) => {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            progressBar.parentElement.style.display = 'none';
            uploadText.textContent = 'Image uploaded! Click or drag to replace';
            uploadText.style.color = '#777';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
