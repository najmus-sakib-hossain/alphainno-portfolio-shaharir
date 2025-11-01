@extends('layouts.app')

@section('title')
    Add New Donation
@endsection

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-green: #2ecc71;
    --color-accent-red: #e94b3c;
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
    padding: 15px 20px;
    border-bottom: 1px solid var(--color-border);
    text-align: center;
}

.card-title-modern {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--color-text-accent);
    letter-spacing: 0.3px;
}

.form-control-dark,
.form-select-dark {
    width: 100%;
    background-color: #2c2c2c;
    color: var(--color-text-light);
    border: 1px solid var(--color-border);
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    font-weight: 300;
    transition: border-color 0.3s, box-shadow 0.3s;
    margin-bottom: 1.5rem;
}

.form-control-dark::placeholder {
    color: #777;
}

.form-control-dark:focus,
.form-select-dark:focus {
    background-color: #2c2c2c;
    color: var(--color-text-light);
    border-color: var(--color-accent-green);
    box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.3);
}

.form-label-dark {
    color: var(--color-text-light);
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

.text-danger {
    font-size: 0.85rem;
    color: var(--color-accent-red) !important;
}

.btn-modern-green,
.btn-modern-red {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.25);
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-modern-green {
    background-color: var(--color-accent-green);
    border: 1px solid var(--color-accent-green);
    color: #fff;
}

.btn-modern-green:hover {
    background-color: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);
}

.btn-modern-red {
    background-color: var(--color-accent-red);
    border: 1px solid var(--color-accent-red);
    color: #fff;
}

.btn-modern-red:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(233, 75, 60, 0.35);
}

/* Dark Theme Drag & Drop Image Uploader */
.image-upload-container {
    border: 2px dashed #444;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    background: #2c2c2c;
    transition: all 0.3s ease;
    position: relative;
    cursor: pointer;
}

.image-upload-container.dragover {
    border-color: var(--color-accent-green);
    box-shadow: 0 6px 25px rgba(46, 204, 113, 0.45);
    transform: translateY(-2px);
}

.upload-text {
    font-weight: 600;
    color: var(--color-text-light);
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.image-preview {
    max-width: 100%;
    max-height: 250px;
    object-fit: cover;
    border-radius: 10px;
    display: none;
    margin-top: 1rem;
    border: 1px solid var(--color-border);
}

.progress {
    height: 10px;
    margin-top: 1rem;
    border-radius: 5px;
    display: none;
    background: #1e1e1e;
}

.progress-bar {
    background-color: var(--color-accent-green);
}

.alert-danger {
    background-color: rgba(233, 75, 60, 0.15);
    border: 1px solid var(--color-accent-red);
    color: var(--color-text-accent);
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

.alert-danger ul {
    margin: 0;
    padding-left: 1.25rem;
}

.btn-modern-red {
    background-color: var(--color-accent-red);
    border-color: var(--color-accent-red);
    color: #ffffff;
    text-decoration: none; /* 🔹 removes underline */
}

</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-modern">Add New Donation</h3>
        </div>
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

            <form action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data" id="donationForm">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label-dark">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title"
                        class="form-control-dark @error('title') is-invalid @enderror"
                        value="{{ old('title') }}" required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="button_text" class="form-label-dark">Button Text</label>
                    <input type="text" name="button_text" id="button_text"
                        class="form-control-dark @error('button_text') is-invalid @enderror"
                        placeholder="e.g. Donate Now"
                        value="{{ old('button_text') }}">
                    @error('button_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="donation_link" class="form-label-dark">Donation Link</label>
                    <input type="url" name="donation_link" id="donation_link"
                        class="form-control-dark @error('donation_link') is-invalid @enderror"
                        placeholder="https://example.com/donate"
                        value="{{ old('donation_link') }}">
                    @error('donation_link')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label-dark">Description</label>
                    <textarea name="description" id="description"
                        class="form-control-dark @error('description') is-invalid @enderror"
                        rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="order_no" class="form-label-dark">Order No</label>
                    <input type="number" name="order_no" id="order_no"
                        class="form-control-dark @error('order_no') is-invalid @enderror"
                        value="{{ old('order_no', 0) }}">
                    @error('order_no')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="is_active" class="form-label-dark">Active Status</label>
                    <select name="is_active" id="is_active"
                        class="form-select-dark @error('is_active') is-invalid @enderror">
                        <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('is_active')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="form-label-dark">Image</label>
                    <div class="image-upload-container" id="imageUploadContainer">
                        <p class="upload-text">Drag & Drop Image Here or Click to Upload</p>
                        <input type="file" name="image" id="image"
                            class="@error('image') is-invalid @enderror d-none"
                            accept="image/*">
                        <img id="imagePreview" class="image-preview" src="#" alt="Image Preview">
                        <div class="progress" id="imageUploadProgress">
                            <div class="progress-bar" role="progressbar"
                                style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-3">
                    <a href="{{ route('donations.index') }}" class="btn-modern-red">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn-modern-green">
                        <i class="fas fa-save"></i> Save
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
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const progressBar = document.getElementById('imageUploadProgress').querySelector('.progress-bar');
    const uploadText = imageUploadContainer.querySelector('.upload-text');

    imageUploadContainer.addEventListener('click', () => imageInput.click());

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
        if (imageInput.files.length > 0) handleImage(imageInput.files[0]);
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
            uploadText.style.color = '#e0e0e0';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
