@extends('layouts.app')

@section('title', 'Add New Book Banner')

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

.image-upload-container {
    border: 2px dashed var(--color-border);
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    background-color: #2c2c2c;
    color: #9ca3af;
    transition: border-color 0.3s, background 0.3s;
    cursor: pointer;
    position: relative;
}

.image-upload-container.dragover {
    border-color: var(--color-accent-green);
    background-color: #1f1f1f;
}

.image-preview {
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

.upload-text {
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.btn-remove {
    background-color: #2c2c2c;
    color: var(--color-accent-red);
    border: 1px solid #333;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-remove:hover {
    background-color: var(--color-accent-red);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(233,75,60,0.35);
}
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-modern"><i class="bi bi-bookmark-plus-fill me-2"></i>Add New Book Banner</h3>
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

            <form action="{{ route('book-banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label-dark">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control-dark" placeholder="Enter book title" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label-dark">Description</label>
                    <textarea name="description" id="description" class="form-control-dark" rows="4" placeholder="Write a short description...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label-dark">Price</label>
                    <input type="number" name="price" id="price" class="form-control-dark" placeholder="Enter price (optional)" value="{{ old('price') }}">
                </div>

                <div class="form-group">
                    <label for="image" class="form-label-dark">Banner Image</label>
                    <div class="image-upload-container" id="imageUploadContainer">
                        <p class="upload-text">Drag & drop image here or click to upload</p>
                        <input type="file" name="image" id="image" class="d-none" accept="image/*">
                        <img id="preview" class="image-preview" src="#" alt="Image Preview">
                        <div class="progress" id="uploadProgress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%;"></div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-3">
                    <button type="submit" class="btn-modern-green"><i class="fas fa-save me-1"></i> Save Book Banner</button>
                    <a href="{{ route('book-banners.index') }}" class="btn-modern-red"><i class="fas fa-times me-1"></i> Cancel</a>
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
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');
    const uploadText = container.querySelector('.upload-text');

    container.addEventListener('click', () => input.click());

    container.addEventListener('dragover', (e) => {
        e.preventDefault();
        container.classList.add('dragover');
    });

    container.addEventListener('dragleave', () => container.classList.remove('dragover'));

    container.addEventListener('drop', (e) => {
        e.preventDefault();
        container.classList.remove('dragover');
        if (e.dataTransfer.files.length > 0) {
            input.files = e.dataTransfer.files;
            handleImage(e.dataTransfer.files[0]);
        }
    });

    input.addEventListener('change', () => {
        if (input.files.length > 0) handleImage(input.files[0]);
    });

    function handleImage(file) {
        if (!file.type.startsWith('image/')) {
            uploadText.textContent = 'Please upload a valid image file';
            uploadText.style.color = '#e94b3c';
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            uploadText.textContent = 'Image ready! Click or drag to replace';
            uploadText.style.color = '#9ca3af';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
