@extends('layouts.app')

@section('content')
@push('styles')
<style>
:root {
    --bg-dark: #121212;
    --card-bg: #1f1f1f;
    --text-light: #e0e0e0;
    --text-muted: #7f8c8d;
    --btn-success: #10b981;
    --btn-success-hover: #059669;
    --btn-danger: #dc2626;
    --btn-danger-hover: #b91c1c;
    --border-color: #333;
}

body {
    background-color: var(--bg-dark);
    font-family: 'Inter', sans-serif;
}

.content-area {
    padding: 2rem;
}

.card-dark {
    background-color: var(--card-bg);
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    border: 1px solid var(--border-color);
}

.card-header-dark {
    background: linear-gradient(90deg, #4b5563, #6b7280);
    color: #fff;
    padding: 1rem 1.5rem;
    font-weight: 600;
    text-align: center;
    border-radius: 12px 12px 0 0;
}

.form-label {
    color: var(--text-light);
}

.form-control, select.form-control, textarea.form-control {
    background-color: #2c2c2c;
    color: var(--text-light);
    border: 1px solid var(--border-color);
    border-radius: 8px;
}

.form-control:focus, select.form-control:focus, textarea.form-control:focus {
    border-color: var(--btn-success);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    outline: none;
}

.btn-success {
    background: var(--btn-success);
    border: none;
    border-radius: 8px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
    transition: 0.2s;
}

.btn-success:hover {
    background: var(--btn-success-hover);
    transform: translateY(-2px);
}

.btn-danger {
    background: var(--btn-danger);
    border: none;
    border-radius: 8px;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
    transition: 0.2s;
}

.btn-danger:hover {
    background: var(--btn-danger-hover);
    transform: translateY(-2px);
}

.image-upload-container {
    border: 2px dashed var(--border-color);
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    background: #2c2c2c;
    color: var(--text-muted);
    position: relative;
    cursor: default; /* remove click hint */
    transition: 0.3s;
}

.image-upload-container.dragover {
    border-color: var(--btn-success);
    background: #1f1f1f;
}

.image-preview {
    max-width: 100%;
    max-height: 250px;
    object-fit: contain;
    margin-top: 1rem;
    border-radius: 10px;
    border: 1px solid #444;
    display: none;
}

.progress {
    height: 10px;
    margin-top: 1rem;
    border-radius: 5px;
    display: none;
}

.upload-text {
    font-size: 0.9rem;
    font-weight: 500;
}
</style>
@endpush

<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            Add New Story
        </div>
        <div class="card-body">
            <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data" id="storyForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Story Image</label>
                    <div class="image-upload-container" id="imageUploadContainer">
                        <p class="upload-text">Drag & drop your image here</p>
                        <input type="file" name="image" id="image" class="d-none" accept="image/*">
                        <img id="preview" class="image-preview" src="#" alt="Image Preview">
                        <div class="progress" id="uploadProgress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%;"></div>
                        </div>
                    </div>
                    {{-- <label class="form-label">Story Image</label>
                    <div class="image-upload-container" id="imageUploadContainer">
                    <div class="upload-text">Click or Drag to Upload Event Image</div>
                    <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror" accept="image/*">
                    <img id="preview" class="image-preview" src="https://via.placeholder.com/400x250?text=Event+Preview" style="display:block;">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror  --}}
                </div>
                </div>

                

                <div class="mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order_no" class="form-control" value="{{ old('order_no', 1) }}">
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-success">Save Story</button>
                    <a href="{{ route('stories.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('imageUploadContainer');
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');
    const progress = document.getElementById('uploadProgress').querySelector('.progress-bar');
    const text = container.querySelector('.upload-text');

    container.addEventListener('dragover', e => {
        e.preventDefault();
        container.classList.add('dragover');
    });

    container.addEventListener('dragleave', () => {
        container.classList.remove('dragover');
    });

    container.addEventListener('drop', e => {
        e.preventDefault();
        container.classList.remove('dragover');
        if (e.dataTransfer.files.length) {
            input.files = e.dataTransfer.files;
            displayImage(e.dataTransfer.files[0]);
        }
    });

    function displayImage(file) {
        if (!file.type.startsWith('image/')) {
            text.textContent = 'Please upload a valid image file';
            text.style.color = '#dc2626';
            return;
        }
        const reader = new FileReader();
        reader.onloadstart = () => {
            progress.parentElement.style.display = 'block';
            text.textContent = 'Uploading...';
        };
        reader.onprogress = e => {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progress.style.width = percent + '%';
            }
        };
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            progress.parentElement.style.display = 'none';
            text.textContent = 'Image uploaded via drag & drop';
            text.style.color = '#6b7280';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
