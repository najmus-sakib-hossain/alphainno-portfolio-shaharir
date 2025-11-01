@extends('layouts.app')

@section('title', 'Create New Event')

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
    display: block;
    margin-top: 10px;
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
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-modern"><i class="bi bi-calendar-event me-2"></i>Create New Event</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label-dark">Event Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control-dark @error('title') is-invalid @enderror" placeholder="Enter event title" value="{{ old('title') }}" required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content" class="form-label-dark">Description <span class="text-danger">*</span></label>
                    <textarea name="content" id="content" rows="5" class="form-control-dark @error('content') is-invalid @enderror" placeholder="Write event details here..." required>{{ old('content') }}</textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="event_date" class="form-label-dark">Event Date <span class="text-danger">*</span></label>
                    <input type="date" name="event_date" id="event_date" class="form-control-dark @error('event_date') is-invalid @enderror" value="{{ old('event_date') }}" required>
                    @error('event_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="event_place" class="form-label-dark">Event Place <span class="text-danger">*</span></label>
                    <input type="text" name="event_place" id="event_place" class="form-control-dark @error('event_place') is-invalid @enderror" placeholder="Enter event location" value="{{ old('event_place') }}" required>
                    @error('event_place')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="image-upload-container" id="imageUploadContainer">
                    <div class="upload-text">Click or Drag to Upload Event Image</div>
                    <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror" accept="image/*">
                    <img id="preview" class="image-preview" src="https://via.placeholder.com/400x250?text=Event+Preview" style="display:block;">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror 
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn-modern-green"><i class="bi bi-save me-1"></i>Create Event</button>
                    <a href="{{ route('events.index') }}" class="btn-modern-red"><i class="bi bi-arrow-left me-1"></i>Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(event) {
    const output = document.getElementById('preview');
    const file = event.target.files[0];
    if(file) {
        output.src = URL.createObjectURL(file);
        output.style.display = 'block';
    } else {
        output.style.display = 'none';
    }
}

const container = document.getElementById('imageUploadContainer');
const input = document.getElementById('image');

container.addEventListener('dragover', e => { e.preventDefault(); container.classList.add('dragover'); });
container.addEventListener('dragleave', () => container.classList.remove('dragover'));
container.addEventListener('drop', e => {
    e.preventDefault();
    container.classList.remove('dragover');
    if(e.dataTransfer.files.length === 0) return;
    input.files = e.dataTransfer.files;
    previewImage({ target: input });
});
</script>
@endpush
