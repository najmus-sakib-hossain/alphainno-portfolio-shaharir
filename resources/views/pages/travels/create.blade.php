@extends('layouts.app')

@section('title', 'Add New Travel Country')

@push('styles')
<style>
:root {
    --bg-dark: #121212;
    --card-dark: #1f1f1f;
    --text-light: #e0e0e0;
    --accent-blue: #2563eb;
    --accent-green: #10b981;
    --accent-red: #dc2626;
    --border-dark: #333;
    --shadow-dark: rgba(0,0,0,0.5);
}

body {
    background-color: var(--bg-dark);
    font-family: 'Inter', sans-serif;
}

.card-dark {
    background-color: var(--card-dark);
    border-radius: 12px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 25px var(--shadow-dark);
    width: 100%;
}

.card-header-dark {
    background-color: var(--card-dark);
    color: var(--text-light);
    text-align: center;
    padding: 15px 20px;
    border-bottom: 1px solid var(--border-dark);
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.card-title-modern {
    font-size: 1.25rem;
    font-weight: 600;
}

.form-control-dark {
    width: 100%;
    background-color: #2c2c2c;
    color: var(--text-light);
    border: 1px solid var(--border-dark);
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    margin-bottom: 1rem;
}

.form-control-dark::placeholder {
    color: #777;
}

.form-label-dark {
    color: var(--text-light);
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

.btn-modern-green,
.btn-outline-modern {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.btn-modern-green {
    background-color: var(--accent-green);
    color: #fff;
    border: none;
}

.btn-outline-modern {
    border: 1px solid var(--accent-green);
    color: var(--accent-green);
    background: transparent;
}

.btn-outline-modern:hover {
    background-color: var(--accent-green);
    color: #fff;
}

.drag-drop-container {
    width: 100%;
    min-height: 150px;
    border: 2px dashed var(--border-dark);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
    color: #aaa;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    background-color: #2c2c2c;
}

.drag-drop-container.dragover {
    border-color: var(--accent-blue);
    background-color: #1a1a1a;
    color: var(--accent-blue);
}

.drag-drop-container input[type="file"] {
    display: none;
}

.drag-drop-container img {
    max-width: 100%;
    max-height: 250px;
    border-radius: 10px;
    margin-top: 10px;
    display: none;
    object-fit: contain;
}

.remove-preview {
    position: absolute;
    top: 10px;
    right: 10px;
    background: var(--accent-red);
    border: none;
    color: #fff;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    font-weight: bold;
    cursor: pointer;
    display: none;
    z-index: 10;
}
</style>
@endpush

@section('content')
<div class="content-area p-2">
    <div class="row justify-content-center">
        <div class="col-12">

            <div class="card card-dark">
                <div class="card-header-dark">
                    <h4 class="card-title-modern mb-0">Add New Travel Country</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('travels.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Country Name -->
                        <div>
                            <label for="country_name" class="form-label-dark">Country Name</label>
                            <input type="text" name="country_name" id="country_name" class="form-control-dark" placeholder="Enter country name" required>
                        </div>

                        <!-- Map Image Drag & Drop -->
                        <div class="mb-4">
                            <label for="map_image" class="form-label-dark">Map Image</label>
                            <div class="drag-drop-container" id="mapDrop">
                                <span>Drag & drop map here or click to upload</span>
                                <input type="file" name="map_image_path" id="map_image" accept="image/*">
                                <img id="mapPreview" alt="Map Preview">
                                <button type="button" class="remove-preview" id="removeMap">&times;</button>
                            </div>
                        </div>

                        <!-- Flag Image Drag & Drop -->
                        <div class="mb-4">
                            <label for="country_flag" class="form-label-dark">Country Flag</label>
                            <div class="drag-drop-container" id="flagDrop">
                                <span>Drag & drop flag here or click to upload</span>
                                <input type="file" name="country_flag_path" id="country_flag" accept="image/*">
                                <img id="flagPreview" alt="Flag Preview">
                                <button type="button" class="remove-preview" id="removeFlag">&times;</button>
                            </div>
                        </div>

                        <!-- Order No -->
                        <div class="mb-4">
                            <label for="order_no" class="form-label-dark">Order No</label>
                            <input type="number" name="order_no" id="order_no" class="form-control-dark" value="1">
                        </div>


                        <!-- Active Checkbox -->
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1" checked>
                            <label class="form-check-label form-label-dark" for="is_active">Active</label>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('travels.index') }}" class="btn-outline-modern btn-lg">Back</a>
                            <button type="submit" class="btn-modern-green btn-lg">Save Country</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    function setupDragDrop(dropContainer, inputFile, previewImage, removeBtn) {
        const container = dropContainer;

        // Click to open file selector
        container.addEventListener('click', () => inputFile.click());

        // Drag over
        container.addEventListener('dragover', e => {
            e.preventDefault();
            container.classList.add('dragover');
        });

        // Drag leave
        container.addEventListener('dragleave', () => container.classList.remove('dragover'));

        // Drop
        container.addEventListener('drop', e => {
            e.preventDefault();
            container.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if(files.length) {
                inputFile.files = files;
                showPreview(files[0]);
            }
        });

        // Change event
        inputFile.addEventListener('change', () => {
            if(inputFile.files.length) showPreview(inputFile.files[0]);
        });

        // Remove preview
        removeBtn.addEventListener('click', e => {
            e.stopPropagation();
            previewImage.src = '#';
            previewImage.style.display = 'none';
            removeBtn.style.display = 'none';
            inputFile.value = '';
        });

        function showPreview(file) {
            if(!file.type.startsWith('image/')) return;
            previewImage.src = URL.createObjectURL(file);
            previewImage.style.display = 'block';
            removeBtn.style.display = 'block';
        }
    }

    setupDragDrop(
        document.getElementById('mapDrop'),
        document.getElementById('map_image'),
        document.getElementById('mapPreview'),
        document.getElementById('removeMap')
    );

    setupDragDrop(
        document.getElementById('flagDrop'),
        document.getElementById('country_flag'),
        document.getElementById('flagPreview'),
        document.getElementById('removeFlag')
    );
});
</script>
@endpush
