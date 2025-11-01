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
    cursor: pointer; /* Clickable */
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

.multi-image-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 1rem;
}

.multi-image-preview img {
    max-width: 150px;
    max-height: 150px;
    object-fit: contain;
    border-radius: 10px;
    border: 1px solid #444;
    transition: transform 0.3s;
}

.multi-image-preview img:hover {
    transform: scale(1.05);
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
            Add New Associate
        </div>
        <div class="card-body">
            <form action="{{ route('associates.store') }}" method="POST" enctype="multipart/form-data" id="associateForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                <!-- Background Image -->
                <div class="mb-3">
                    <label class="form-label">Background Image</label>
                    <div class="image-upload-container" id="backgroundUploadContainer">
                        <p class="upload-text">Drag & drop background image or click to upload</p>
                        <input type="file" name="background_image" id="background_image" class="d-none" accept="image/*">
                        <img id="backgroundPreview" class="image-preview" src="#" alt="Background Preview">
                        <div class="progress" id="backgroundUploadProgress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Partner Images -->
                <div class="mb-3">
                    <label class="form-label">Partner Images</label>
                    <div class="image-upload-container" id="partnerUploadContainer">
                        <p class="upload-text">Drag & drop partner images or click to upload (multiple)</p>
                        <input type="file" name="partner_images[]" id="partner_images" class="d-none" accept="image/*" multiple>
                        <div id="partnerPreview" class="multi-image-preview"></div>
                        <div class="progress" id="partnerUploadProgress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%;"></div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order_no" class="form-control" value="{{ old('order_no', 1) }}">
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-success">Save Associate</button>
                    <a href="{{ route('associates.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    function makeUploader(containerId, inputId, previewId, progressId, multi=false) {
        const container = document.getElementById(containerId);
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const progressBar = document.getElementById(progressId).querySelector('.progress-bar');
        const text = container.querySelector('.upload-text');

        container.addEventListener('click', () => input.click());
        container.addEventListener('dragover', e => { e.preventDefault(); container.classList.add('dragover'); });
        container.addEventListener('dragleave', () => container.classList.remove('dragover'));
        container.addEventListener('drop', e => {
            e.preventDefault();
            container.classList.remove('dragover');
            if (e.dataTransfer.files.length) {
                input.files = e.dataTransfer.files;
                multi ? displayMultiple(e.dataTransfer.files, preview, progressBar, text) : displaySingle(e.dataTransfer.files[0], preview, progressBar, text);
            }
        });

        input.addEventListener('change', () => {
            if (input.files.length) multi ? displayMultiple(input.files, preview, progressBar, text) : displaySingle(input.files[0], preview, progressBar, text);
        });

        function displaySingle(file, preview, progressBar, text) {
            if (!file.type.startsWith('image/')) { text.textContent='Please upload a valid image file'; text.style.color='#dc2626'; return; }
            const reader = new FileReader();
            reader.onloadstart = () => { progressBar.parentElement.style.display='block'; text.textContent='Uploading...'; };
            reader.onprogress = e => { if(e.lengthComputable) progressBar.style.width=Math.round((e.loaded/e.total)*100)+'%'; };
            reader.onload = e => { preview.src=e.target.result; preview.style.display='block'; progressBar.parentElement.style.display='none'; text.textContent='Image uploaded'; text.style.color='#6b7280'; };
            reader.readAsDataURL(file);
        }

        function displayMultiple(files, previewContainer, progressBar, text) {
            if ([...files].some(f => !f.type.startsWith('image/'))) { text.textContent='Please upload valid image files'; text.style.color='#dc2626'; return; }
            previewContainer.innerHTML='';
            let loaded=0;
            progressBar.parentElement.style.display='block'; text.textContent='Uploading...';
            [...files].forEach(file => {
                const reader=new FileReader();
                reader.onload=e=>{
                    const img=document.createElement('img'); img.src=e.target.result;
                    previewContainer.appendChild(img);
                    loaded++; progressBar.style.width=Math.round((loaded/files.length)*100)+'%';
                    if(loaded===files.length){ progressBar.parentElement.style.display='none'; text.textContent='Images uploaded'; text.style.color='#6b7280'; }
                };
                reader.readAsDataURL(file);
            });
        }
    }

    makeUploader('backgroundUploadContainer','background_image','backgroundPreview','backgroundUploadProgress',false);
    makeUploader('partnerUploadContainer','partner_images','partnerPreview','partnerUploadProgress',true);
});
</script>
@endpush
@endsection
