@extends('layouts.app')

@section('title', 'Add Recommended Books')

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-red: #e94b3c;
    --color-accent-green: #2ecc71;
    --color-border: #333333;
    --color-shadow: rgba(0, 0, 0, 0.5);
}

body {
    background-color: var(--color-bg-primary);
    font-family: 'Inter', sans-serif;
}

.content-area {
    padding: 2rem;
    min-height: 100vh;
}

.card-dark {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    box-shadow: 0 10px 30px var(--color-shadow);
    border: 1px solid var(--color-border);
}

.card-header-dark {
    background-color: var(--color-bg-primary);
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    border-bottom: 1px solid var(--color-border);
}

.card-title-dark {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--color-text-accent);
}

.form-control-dark {
    width: 100%;
    background-color: #2c2c2c;
    color: var(--color-text-light);
    border: 1px solid var(--color-border);
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    font-weight: 300;
    transition: border-color 0.3s, box-shadow 0.3s;
    margin-bottom: 1rem;
}

.form-control-dark::placeholder {
    color: #777;
}

.form-control-dark:focus {
    border-color: var(--color-accent-green);
    box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.3);
    outline: none;
}

.form-label-dark {
    color: var(--color-text-light);
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
}

.btn-modern-red, .btn-modern-green {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0,0,0,0.25);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.btn-modern-red {
    background-color: var(--color-accent-red);
    border-color: var(--color-accent-red);
    color: #ffffff;
}

.btn-modern-red:hover {
    background-color: #c0392b;
    border-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(233,75,60,0.35);
}

.btn-modern-green {
    background-color: var(--color-accent-green);
    border-color: var(--color-accent-green);
    color: #ffffff;
}

.btn-modern-green:hover {
    background-color: #27ae60;
    border-color: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(46,204,113,0.35);
}

.image-upload-container-dark {
    border: 2px dashed var(--color-border);
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    background: #2c2c2c;
    transition: border-color 0.3s ease, background 0.3s ease;
    position: relative;
}

.image-upload-container-dark.dragover {
    border-color: var(--color-accent-green);
    background: #1f1f1f;
}

.multi-image-preview img {
    max-width: 150px;
    max-height: 150px;
    object-fit: contain;
    border-radius: 10px;
    border: 1px solid var(--color-border);
}

.upload-text-dark {
    color: #9ca3af;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.alert-danger-dark {
    background: var(--color-accent-red);
    color: #ffffff;
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

/* Dark theme progress container */
#uploadProgress {
    height: 10px;
    margin-top: 1rem;
    border-radius: 5px;
    display: none;
    background-color: #2c2c2c; /* dark background */
}

#uploadProgress .progress-bar {
    background-color: var(--color-accent-green); /* accent color for progress */
}

</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-dark"><i class="bi bi-book-half me-2"></i>Add Recommended Books</h3>
        </div>
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger-dark">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('recommended-books.store') }}" method="POST" enctype="multipart/form-data" id="recommendedBooksForm">
                @csrf

                <div class="form-group">
                    <label for="images" class="form-label-dark">Upload Book Images <span class="text-danger">*</span></label>
                    <div class="image-upload-container-dark" id="imageUploadContainer">
                        <p class="upload-text-dark">Drag & drop book images here or click to upload (multiple)</p>
                        <input 
                            type="file" 
                            name="images[]" 
                            id="images" 
                            class="form-control-dark d-none @error('images.*') is-invalid @enderror"
                            accept="image/png,image/jpeg,image/webp" 
                            multiple 
                            required>
                        <div id="imagePreview" class="multi-image-preview"></div>
                        <div class="progress" id="uploadProgress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted d-block mt-2">You can upload multiple images at once.</small>
                        @error('images.*')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('recommended-books.index') }}" class="btn-modern-red">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                    <button type="submit" class="btn-modern-green">
                        <i class="bi bi-check2-circle me-2"></i>Save Books
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const imageUploadContainer = document.getElementById('imageUploadContainer');
    const imageInput = document.getElementById('images');
    const imagePreview = document.getElementById('imagePreview');
    const progressBar = document.getElementById('uploadProgress').querySelector('.progress-bar');
    const uploadText = imageUploadContainer.querySelector('.upload-text-dark');

    imageUploadContainer.addEventListener('click', () => imageInput.click());

    imageUploadContainer.addEventListener('dragover', e => {
        e.preventDefault();
        imageUploadContainer.classList.add('dragover');
    });

    imageUploadContainer.addEventListener('dragleave', () => imageUploadContainer.classList.remove('dragover'));

    imageUploadContainer.addEventListener('drop', e => {
        e.preventDefault();
        imageUploadContainer.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            handleImages(files);
        }
    });

    imageInput.addEventListener('change', () => {
        if (imageInput.files.length > 0) handleImages(imageInput.files);
    });

    function handleImages(files) {
        if ([...files].some(file => !file.type.startsWith('image/'))) {
            uploadText.textContent = 'Please upload valid image files';
            uploadText.style.color = '#dc2626';
            return;
        }

        imagePreview.innerHTML = '';
        let loadedImages = 0;
        const totalImages = files.length;

        progressBar.parentElement.style.display = 'block';
        uploadText.textContent = 'Uploading...';

        [...files].forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                imagePreview.appendChild(img);
                loadedImages++;
                const percent = Math.round((loadedImages / totalImages) * 100);
                progressBar.style.width = `${percent}%`;
                progressBar.setAttribute('aria-valuenow', percent);
                if (loadedImages === totalImages) {
                    progressBar.parentElement.style.display = 'none';
                    uploadText.textContent = 'Images uploaded! Click or drag to replace';
                    uploadText.style.color = '#9ca3af';
                }
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>
@endpush
