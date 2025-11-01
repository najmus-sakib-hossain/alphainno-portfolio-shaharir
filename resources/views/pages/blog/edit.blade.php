@extends('layouts.app')

@section('title', 'Edit Blog')

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
    --color-shadow: rgba(0,0,0,0.5);
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
    display: flex;
    align-items: center;
    gap: 0.5rem;
    justify-content: center;
}

.card-title-modern {
    font-size: 1.25rem;
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
    margin-bottom: 1.5rem;
}

.form-control-dark::placeholder { color: #777; }

.form-control-dark:focus {
    background-color: #2c2c2c;
    color: var(--color-text-light);
    border-color: var(--color-accent-green);
    box-shadow: 0 0 0 0.25rem rgba(46,204,113,0.3);
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

.image-upload-container {
    border: 2px dashed var(--color-border);
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    background-color: #2c2c2c;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    margin-bottom: 1.5rem;
}

.image-upload-container.dragover {
    border-color: var(--color-accent-green);
    box-shadow: 0 6px 25px rgba(46,204,113,0.45);
}

.image-preview {
    max-width: 100%;
    max-height: 150px;
    object-fit: cover;
    margin-top: 1rem;
    border-radius: 8px;
    display: block;
}

.current-image-box {
    border: 1px solid var(--color-border);
    border-radius: 8px;
    background-color: #2c2c2c;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.current-image-box img {
    border-radius: 6px;
    max-height: 100px;
    max-width: 150px;
    object-fit: cover;
}

.info-text {
    color: #a0a0a0;
    font-size: 0.9rem;
}
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card-dark mx-auto" style="max-width: 800px;">
        <div class="card-header-dark">
            <i class="bi bi-pencil-square fs-4"></i>
            <h3 class="card-title-modern mb-0">Edit Blog Post</h3>
        </div>
        <div class="card-body mx-3">
            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT')

                {{-- Title --}}
                <div class="form-group">
                    <label for="title" class="form-label-dark">Post Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="form-control-dark @error('title') is-invalid @enderror" 
                        placeholder="Enter a descriptive title" 
                        value="{{ old('title', $blog->title) }}" 
                        required
                    >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="form-group">
                    <label for="content" class="form-label-dark">Content</label>
                    <textarea 
                        name="content" 
                        id="content" 
                        class="form-control-dark @error('content') is-invalid @enderror" 
                        rows="10" 
                        placeholder="Write your full blog post here..." 
                        required
                    >{{ old('content', $blog->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Current Image --}}
                @if ($blog->getFirstMediaUrl('blog_cover_image'))
                    <div class="form-group">
                        <label class="form-label-dark">Current Featured Image</label>
                        <div class="current-image-box">
                            <img src="{{ $blog->getFirstMediaUrl('blog_cover_image') }}" alt="Current Cover Image">
                        </div>
                        <p class="info-text mt-2">Upload a new file below to replace the current image.</p>
                    </div>
                @endif

                {{-- New Image Upload --}}
                <div class="form-group">
                    <label for="cover_image" class="form-label-dark">Upload New Image</label>
                    <div class="image-upload-container" id="imageUploadContainer">
                        <p class="info-text">Drag & drop image here or click to upload</p>
                        <input type="file" name="cover_image" id="cover_image" class="d-none" accept="image/*">
                        <img id="preview" class="image-preview" style="display:none;">
                        @error('cover_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('blogs.index') }}" class="btn-modern-red"><i class="bi bi-arrow-left me-1"></i>Back</a>
                    <button type="submit" class="btn-modern-green"><i class="bi bi-arrow-repeat me-1"></i>Update Post</button>
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
    const input = document.getElementById('cover_image');
    const preview = document.getElementById('preview');
    const uploadText = container.querySelector('.info-text');

    container.addEventListener('click', () => input.click());

    container.addEventListener('dragover', e => {
        e.preventDefault();
        container.classList.add('dragover');
    });

    container.addEventListener('dragleave', () => container.classList.remove('dragover'));

    container.addEventListener('drop', e => {
        e.preventDefault();
        container.classList.remove('dragover');
        if (e.dataTransfer.files.length > 0) {
            input.files = e.dataTransfer.files;
            showPreview(e.dataTransfer.files[0]);
        }
    });

    input.addEventListener('change', () => {
        if (input.files.length > 0) showPreview(input.files[0]);
    });

    function showPreview(file) {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            uploadText.textContent = 'Image ready to upload';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
