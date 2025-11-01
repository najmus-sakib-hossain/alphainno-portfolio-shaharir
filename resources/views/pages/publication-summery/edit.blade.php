@extends('layouts.app')

@section('title', 'Edit Publication Summary')

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

.btn-modern-green,
.btn-modern-red {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
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

.image-upload-container {
    border: 2px dashed var(--color-border);
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    background: #242424;
    transition: border-color 0.3s ease, background 0.3s ease;
    position: relative;
    cursor: pointer;
}

.image-upload-container.dragover {
    border-color: var(--color-accent-green);
    background: #1a1a1a;
}

.image-preview {
    max-width: 100%;
    max-height: 250px;
    object-fit: contain;
    margin-top: 1rem;
    border-radius: 10px;
    border: 1px solid var(--color-border);
    display: block;
}

.alert-danger {
    background: var(--color-accent-red);
    color: #ffffff;
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

textarea.form-control-dark {
    resize: vertical;
    min-height: 120px;
}
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-modern"><i class="bi bi-journal-text me-2"></i>Edit Publication Summary</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('publication-summery.update', $publicationSummery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Content -->
                <div class="form-group">
                    <label for="content" class="form-label-dark">Content <span class="text-danger">*</span></label>
                    <textarea 
                        name="content" 
                        id="content" 
                        class="form-control-dark @error('content') is-invalid @enderror" 
                        rows="6" 
                        placeholder="Write publication summary...">{{ old('content', $publicationSummery->content) }}</textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label for="image" class="form-label-dark">Upload Image</label>
                    <div class="image-upload-container" id="imageUploadContainer">
                        <p class="upload-text">Click or drag to upload/change image</p>
                        <input 
                            type="file" 
                            name="image" 
                            id="image" 
                            accept="image/*"
                            class="d-none @error('image') is-invalid @enderror">

                        @if($publicationSummery->hasMedia('publication_images'))
                            <img id="preview" src="{{ $publicationSummery->getFirstMediaUrl('publication_images') }}" alt="Preview" class="image-preview">
                        @else
                            <img id="preview" src="https://via.placeholder.com/250x150?text=Preview" alt="Preview" class="image-preview">
                        @endif

                        @error('image')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('publication-summery.index') }}" class="btn-modern-red">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                    <button type="submit" class="btn-modern-green">
                        <i class="bi bi-save me-1"></i> Update Summary
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
    const container = document.getElementById('imageUploadContainer');
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');

    container.addEventListener('click', () => input.click());

    container.addEventListener('dragover', (e) => {
        e.preventDefault();
        container.classList.add('dragover');
    });

    container.addEventListener('dragleave', () => container.classList.remove('dragover'));

    container.addEventListener('drop', (e) => {
        e.preventDefault();
        container.classList.remove('dragover');
        if(e.dataTransfer.files.length) handleFile(e.dataTransfer.files[0]);
    });

    input.addEventListener('change', () => {
        if(input.files.length) handleFile(input.files[0]);
    });

    function handleFile(file) {
        if(!file.type.startsWith('image/')) return;
        preview.src = URL.createObjectURL(file);
    }
});
</script>
@endpush
