@extends('layouts.app')

@section('title')
    Edit Technology Field
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
    margin-bottom: 1.5rem;
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
    max-height: 200px;
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

.text-danger {
    font-size: 0.8rem;
    margin-top: 0.25rem;
    display: block;
}
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-modern">Edit Technology Field</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('technology.updateField', $field->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label-dark">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control-dark @error('title') is-invalid @enderror" value="{{ old('title', $field->title) }}" required>
                    @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label-dark">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control-dark @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', $field->subtitle) }}">
                    @error('subtitle')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label-dark">Description</label>
                    <textarea name="description" class="form-control-dark @error('description') is-invalid @enderror" rows="3">{{ old('description', $field->description) }}</textarea>
                    @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <!-- Main Image Upload -->
                <div class="form-group">
                    <label class="form-label-dark">Main Image</label>
                    <div class="image-upload-container" id="mainImageUploadContainer">
                        <div class="upload-text">Drag & Drop Main Image Here or Click to Upload</div>
                        <input type="file" name="image" id="image">
                        @if($field->image)
                            <img id="mainImagePreview" src="{{ asset('storage/'.$field->image) }}" class="image-preview" style="display:block;">
                        @else
                            <img id="mainImagePreview" class="image-preview">
                        @endif
                        @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <!-- Frame Image Upload -->
                <div class="form-group">
                    <label class="form-label-dark">Frame Image</label>
                    <div class="image-upload-container" id="frameImageUploadContainer">
                        <div class="upload-text">Drag & Drop Frame Image Here or Click to Upload</div>
                        <input type="file" name="frame_image" id="frame_image">
                        @if($field->frame_image)
                            <img id="frameImagePreview" src="{{ asset('storage/'.$field->frame_image) }}" class="image-preview" style="display:block;">
                        @else
                            <img id="frameImagePreview" class="image-preview">
                        @endif
                        @error('frame_image')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label-dark">Tools Title</label>
                    <input type="text" name="tools_title" class="form-control-dark @error('tools_title') is-invalid @enderror" value="{{ old('tools_title', $field->tools_title) }}">
                    @error('tools_title')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label-dark">Tools Description</label>
                    <textarea name="tools_description" class="form-control-dark @error('tools_description') is-invalid @enderror" rows="3">{{ old('tools_description', $field->tools_description) }}</textarea>
                    @error('tools_description')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" {{ $field->is_active ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn-modern-green"><i class="fas fa-save"></i> Update Field</button>
                    <a href="{{ route('technology.index') }}" class="btn-modern-red"><i class="fas fa-times"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Skills Table -->
    <div class="card card-dark mt-4 p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="card-title-modern">Skills</h3>
            <a href="{{ route('technology.createSkill', $field->id) }}" class="btn-modern-green">+ Add Skill</a>
        </div>

        <table class="table table-dark table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($field->skills as $key => $skill)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $skill->name }}</td>
                    <td>
                        <img src="{{ asset('storage/'.$skill->icon) }}" width="50">
                    </td>
                    <td>{{ $skill->order_no }}</td>
                    <td>
                        <form action="{{ route('technology.destroySkill', [$field->id,$skill->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-modern-red" onclick="return confirm('Delete skill?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const setupImageUpload = (containerId, inputId, previewId) => {
        const container = document.getElementById(containerId);
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const uploadText = container.querySelector('.upload-text');

        const handleImage = (file) => {
            if (!file.type.startsWith('image/')) {
                uploadText.textContent = 'Please upload a valid image file';
                uploadText.style.color = '#e94b3c';
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.style.display = 'block';
                container.classList.add('has-image');
                uploadText.textContent = 'Image ready! Click or drag to replace';
                uploadText.style.color = '#f0f0f0';
            };
            reader.readAsDataURL(file);
        };

        container.addEventListener('click', () => input.click());
        container.addEventListener('dragover', e => { e.preventDefault(); container.classList.add('dragover'); });
        container.addEventListener('dragleave', () => container.classList.remove('dragover'));
        container.addEventListener('drop', e => {
            e.preventDefault();
            container.classList.remove('dragover');
            if (e.dataTransfer.files.length > 0) handleImage(e.dataTransfer.files[0]);
            input.files = e.dataTransfer.files;
        });
        input.addEventListener('change', () => { if (input.files.length) handleImage(input.files[0]); });
    };

    setupImageUpload('mainImageUploadContainer', 'image', 'mainImagePreview');
    setupImageUpload('frameImageUploadContainer', 'frame_image', 'frameImagePreview');
});
</script>
@endpush
