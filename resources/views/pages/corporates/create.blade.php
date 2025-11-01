@extends('layouts.app')

@section('title')
    Add Corporate Step
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
    margin-bottom: 1.5rem;
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
    margin-bottom: 8px;
    display: block;
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

/* Modern Drag & Drop Image Uploader */
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
}

.image-upload-container:hover .image-preview {
    transform: scale(1.05);
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
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-modern">Add Corporate Step</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('corporates.store') }}" method="POST" enctype="multipart/form-data" id="corporateForm">
                @csrf

                <div class="form-group">
                    <label for="step_number" class="form-label-dark">Step Number <span class="text-danger">*</span></label>
                    <input 
                        type="number" 
                        name="step_number" 
                        id="step_number" 
                        class="form-control-dark @error('step_number') is-invalid @enderror" 
                        value="{{ old('step_number') }}" 
                        required>
                    @error('step_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title" class="form-label-dark">Title <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="form-control-dark @error('title') is-invalid @enderror" 
                        value="{{ old('title') }}" 
                        required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="company_name" class="form-label-dark">Company Name</label>
                    <input 
                        type="text" 
                        name="company_name" 
                        id="company_name" 
                        class="form-control-dark @error('company_name') is-invalid @enderror" 
                        value="{{ old('company_name') }}">
                    @error('company_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="position_years" class="form-label-dark">Position / Years</label>
                    <input 
                        type="text" 
                        name="position_years" 
                        id="position_years" 
                        class="form-control-dark @error('position_years') is-invalid @enderror" 
                        value="{{ old('position_years') }}">
                    @error('position_years')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image_path" class="form-label-dark">Step Image</label>
                    <div class="image-upload-container" id="imageUploadContainer">
                        <div class="upload-text">Drag & Drop Image Here or Click to Upload</div>
                        <input 
                            type="file" 
                            name="image_path" 
                            id="image_path" 
                            class="@error('image_path') is-invalid @enderror" 
                            accept="image/*">
                        <img id="preview" class="image-preview" src="#" alt="Image Preview">
                        @error('image_path')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label-dark">Description</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        class="form-control-dark @error('description') is-invalid @enderror" 
                        rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="is_active" 
                        id="is_active" 
                        value="1" 
                        {{ old('is_active', 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn-modern-green"><i class="fas fa-save"></i> Save Step</button>
                    <a href="{{ route('corporates.index') }}" class="btn-modern-red"><i class="fas fa-times"></i> Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('imageUploadContainer');
    const input = document.getElementById('image_path');
    const preview = document.getElementById('preview');
    const uploadText = container.querySelector('.upload-text');

    // Only trigger click if it's a simple click (no drag)
    container.addEventListener('click', (e) => {
        if (e.target === container || e.target === uploadText) {
            input.click();
        }
    });

    // Highlight container on drag over
    container.addEventListener('dragover', e => {
        e.preventDefault();
        container.classList.add('dragover');
    });

    container.addEventListener('dragleave', () => {
        container.classList.remove('dragover');
    });

    // Handle drop
    container.addEventListener('drop', e => {
        e.preventDefault();
        container.classList.remove('dragover');

        const files = e.dataTransfer.files;
        if (!files.length) return;

        input.files = files; // Assign files to input
        handleImage(files[0]);
    });

    // Handle file selection manually
    input.addEventListener('change', () => {
        if (input.files.length > 0) {
            handleImage(input.files[0]);
        }
    });

    function handleImage(file) {
        if (!file.type.startsWith('image/')) {
            uploadText.textContent = 'Please upload a valid image file';
            uploadText.style.color = '#e94b3c';
            return;
        }

        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            container.classList.add('has-image');
            uploadText.textContent = 'Image ready! Click or drag to replace';
            uploadText.style.color = '#f0f0f0';
        };
        reader.readAsDataURL(file);
    }
});

</script>
@endpush
