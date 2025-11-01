@extends('layouts.app')

@section('title')
    Add Certificate
@endsection

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
    margin-bottom: 0.25rem;
}

.form-control-dark::placeholder {
    color: #777;
}

.form-control-dark:focus {
    background-color: #2c2c2c;
    color: var(--color-text-light);
    border-color: var(--color-accent-green);
    box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.3);
}

.form-label-dark {
    color: var(--color-text-light);
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
}

.error-message {
    display: block;
    color: var(--color-accent-red);
    font-size: 0.8rem;
    margin-top: 3px;
}

.btn-modern-red,
.btn-modern-green {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.25);
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
    box-shadow: 0 6px 15px rgba(233, 75, 60, 0.35);
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
    box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);
}

/* Drag & Drop Image Uploader */
.image-upload-container {
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    background: #2c2c2c;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    position: relative;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.3s ease;
}

.image-upload-container.dragover {
    border: 2px dashed var(--color-accent-green);
    box-shadow: 0 6px 25px rgba(46, 204, 113, 0.45);
    transform: translateY(-2px);
}

.image-upload-container.has-image {
    border: 2px solid var(--color-accent-green);
}

.image-upload-container input[type="file"] {
    position: absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    opacity:0;
    cursor:pointer;
    z-index:10;
}

.image-preview {
    max-width: 100%;
    max-height: 250px;
    object-fit: cover;
    border-radius: 12px;
    display: none;
    transition: transform 0.3s ease;
    margin-top: 1rem;
}

.upload-text {
    font-weight: 600;
    color: var(--color-text-light);
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.form-check-label {
    color: var(--color-text-light);
    font-weight: 600;
}

.form-group {
    margin-bottom: 2rem; /* increased from 1.5rem */
}

.form-check {
    margin-bottom: 0.1rem; /* spacing after checkbox */
}

.image-upload-container {
    margin-bottom: 0.1rem; /* spacing after image uploader */
}

</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-modern">Add Certificate</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data" id="certificateForm">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label-dark">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control-dark @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')
                        <small class="error-message">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label-dark">Description</label>
                    <textarea name="description" id="description" class="form-control-dark @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="error-message">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="form-label-dark">Image <span class="text-danger">*</span></label>
                    <div class="image-upload-container" id="imageUploadContainer">
                        <div class="upload-text">Drag & drop image here or click to upload</div>
                        <input type="file" name="image" id="image" accept="image/*" required>
                        <img id="preview" class="image-preview" src="#" alt="Image Preview">
                        @error('image')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('certificates.index') }}" class="btn-modern-red">Back</a>
                    <button type="submit" class="btn-modern-green">Save</button>
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
    const imagePreview = document.getElementById('preview');
    const uploadText = imageUploadContainer.querySelector('.upload-text');

    function handleImage(file){
        if(!file.type.startsWith('image/')){
            uploadText.textContent = 'Please upload a valid image file';
            uploadText.style.color = '#e94b3c';
            return;
        }
        const reader = new FileReader();
        reader.onload = e => {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            imageUploadContainer.classList.add('has-image');
            uploadText.textContent = 'Image ready! Click or drag to replace';
            uploadText.style.color = '#f0f0f0';
        };
        reader.readAsDataURL(file);
    }

    imageUploadContainer.addEventListener('click', () => imageInput.click());
    imageUploadContainer.addEventListener('dragover', e => { e.preventDefault(); imageUploadContainer.classList.add('dragover'); });
    imageUploadContainer.addEventListener('dragleave', () => imageUploadContainer.classList.remove('dragover'));
    imageUploadContainer.addEventListener('drop', e => {
        e.preventDefault();
        imageUploadContainer.classList.remove('dragover');
        if(e.dataTransfer.files.length > 0) imageInput.files = e.dataTransfer.files, handleImage(e.dataTransfer.files[0]);
    });
    imageInput.addEventListener('change', () => { if(imageInput.files.length > 0) handleImage(imageInput.files[0]); });
});
</script>
@endpush
