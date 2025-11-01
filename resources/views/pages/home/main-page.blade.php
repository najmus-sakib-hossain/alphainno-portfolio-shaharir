@extends('layouts.app')

@section('title')
    Welcome Home
@endsection

@push('styles')
    <style>
        :root {
            --primary-color: #3b82f6; /* Bright blue for primary elements */
            --secondary-color: #6366f1; /* Purple for accents */
            --accent-color: #14b8a6; /* Teal for highlights */
            --success-color: #10b981; /* Green for success states */
            --background-color: #0a0a0a; /* Dark background */
            --card-background: #030712; /* Very dark card background */
            --section-background: #242424; /* Dark gray for sections */
            --text-primary: #9ca3af; /* Dim gray for primary text */
            --text-secondary: #9ca3af; /* Dim gray for secondary text */
            --header-text: #ffffff; /* White for headers */
            --shadow-sm: 0 4px 8px rgba(0, 0, 0, 0.3);
            --shadow-hover: 0 8px 16px rgba(59, 130, 246, 0.25);
        }

        .content-area {
            background: var(--background-color);
            padding: 2rem;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .container {
            max-width: 700px;
        }

        .card {
            background: var(--card-background);
            border-radius: 1rem;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }

        .card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-4px);
            border: none;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 0.75rem 0.75rem 0 0;
            padding: 1.5rem;
            display: flex; /* Center header content */
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .card-title {
            color: var(--header-text);
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 2rem;
            background: #1f2532;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: var(--header-text);
            font-weight: 400;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .form-label svg {
            width: 1rem;
            height: 1rem;
            color: var(--primary-color);
        }

        .form-control, select.form-control {
            border: 1px solid #374151;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            background: var(--card-background);
            color: #ffffff; /* Input text color changed to white */
        }

        .form-control:focus, select.form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            outline: none;
            background: var(--card-background);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
            opacity: 0.6;
        }

        .form-control.is-invalid {
            border-color: #dc2626;
        }

        .text-danger {
            font-size: 0.75rem;
            color: #dc2626;
            margin-top: 0.25rem;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .image-upload-container {
            border: 2px dashed #4b5563;
            border-radius: 0.75rem;
            padding: 1.5rem;
            text-align: center;
            background: var(--section-background);
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
            overflow: hidden;
        }

        .image-upload-container:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-hover);
            background: #2a2a2a;
        }

        .image-upload-container.dragover {
            border-color: var(--primary-color);
            background: #2a2a2a;
        }

        .image-upload-container.has-image {
            border-style: solid;
            border-color: var(--success-color);
        }

        .image-upload-container input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }

        .image-preview {
            max-width: 100%;
            max-height: 250px;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 5;
            transition: transform 0.3s ease;
            display: none;
            border-radius: 0.75rem;
        }

        .image-upload-container:hover .image-preview {
            transform: scale(1.05);
        }

        .upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            position: relative;
            z-index: 1;
        }

        .upload-icon {
            width: 2.5rem;
            height: 2.5rem;
            padding: 0.5rem;
            background: var(--primary-color);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .image-upload-container:hover .upload-icon {
            transform: translateY(-4px);
        }

        .upload-icon svg {
            width: 1.25rem;
            height: 1.25rem;
            color: #ffffff;
        }

        .upload-text {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
            margin: 0;
        }

        .upload-subtext {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .progress {
            height: 8px;
            margin-top: 1rem;
            border-radius: 0.5rem;
            background: #374151;
            display: none;
        }

        .progress-bar {
            background: var(--primary-color);
            border-radius: 0.5rem;
        }

        .btn-submit {
            background: var(--primary-color);
            border: none;
            color: #ffffff;
            padding: 0.75rem 2rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
        }

        .btn-submit:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-cancel {
            background: #dc2626;
            border: none;
            color: #ffffff;
            padding: 0.75rem 2rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
        }

        .btn-cancel:hover {
            background: #b91c1c;
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .btn-cancel::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-cancel:hover::before {
            left: 100%;
        }

        @media (max-width: 767.98px) {
            .content-area {
                padding: 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .card-title {
                font-size: 1.2rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }
        }
    </style>
@endpush

@section('content')
<div class="content-area">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Main Page Content</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('main.page.index') }}" enctype="multipart/form-data" id="mainForm">
                    @csrf

                    <div class="form-group">
                        <label for="banner_text" class="form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Banner Text <span class="text-danger">*</span>
                        </label>
                        <textarea 
                            class="form-control text-white @error('banner_text') is-invalid @enderror" 
                            name="banner_text" 
                            id="banner_text" 
                            rows="4"
                            placeholder="Enter banner text" 
                            required>{{ old('banner_text') }}</textarea>
                        @error('banner_text')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="moto" class="form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Moto <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="moto" 
                            class="form-control text-white @error('moto') is-invalid @enderror" 
                            id="moto" 
                            placeholder="Enter moto" 
                            value="{{ old('moto') }}" 
                            required>
                        @error('moto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="experience" class="form-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Experience
                                </label>
                                <input 
                                    type="number" 
                                    name="experience" 
                                    class="form-control text-white @error('experience') is-invalid @enderror" 
                                    id="experience" 
                                    placeholder="Enter years of experience"
                                    value="{{ old('experience') }}">
                                @error('experience')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="projects" class="form-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.5 3.5 0 001.948-.806 3.5 3.5 0 014.434 0 3.5 3.5 0 001.948.806 3.5 3.5 0 013.479 3.479A19.938 19.938 0 0112 20.677 19.938 19.938 0 013.5 8.176a3.5 3.5 0 013.479-3.479z"/>
                                    </svg>
                                    Projects
                                </label>
                                <input 
                                    type="number" 
                                    name="projects" 
                                    class="form-control text-white @error('projects') is-invalid @enderror" 
                                    id="projects" 
                                    placeholder="Total projects"
                                    value="{{ old('projects') }}">
                                @error('projects')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="certification" class="form-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 3c-2.616 0-5.13.815-7.147 2.32m0 0A11.955 11.955 0 013 12c0 2.616.815 5.13 2.32 7.147m0 0A11.955 11.955 0 0112 21c2.616 0 5.13-.815 7.147-2.32m0 0A11.955 11.955 0 0121 12c0-2.616-.815-5.13-2.32-7.147m-10.674 0h-.001a3 3 0 00-2.828 2.828v.001A3 3 0 009 12a3 3 0 002.828 2.828h.001A3 3 0 0015 12a3 3 0 00-2.828-2.828z"/>
                                    </svg>
                                    Certifications
                                </label>
                                <input 
                                    type="number" 
                                    name="certification" 
                                    class="form-control text-white @error('certification') is-invalid @enderror" 
                                    id="certification" 
                                    placeholder="Total certifications"
                                    value="{{ old('certification') }}">
                                @error('certification')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="books" class="form-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    Books
                                </label>
                                <input 
                                    type="number" 
                                    name="books" 
                                    class="form-control text-white @error('books') is-invalid @enderror" 
                                    id="books" 
                                    placeholder="Books published"
                                    value="{{ old('books') }}">
                                @error('books')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="mentoring" class="form-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v2h5m-2-6h6m-6 0H3a1 1 0 01-1-1v-3a1 1 0 011-1h18a1 1 0 011 1v3a1 1 0 01-1 1h-6m-6 0h6m2-8h2m-2 0h-6m6 0H9a1 1 0 01-1-1V5a1 1 0 011-1h6"/>
                                    </svg>
                                    Mentoring
                                </label>
                                <input 
                                    type="number" 
                                    name="mentoring" 
                                    class="form-control text-white @error('mentoring') is-invalid @enderror" 
                                    id="mentoring" 
                                    placeholder="Mentoring count"
                                    value="{{ old('mentoring') }}">
                                @error('mentoring')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="article" class="form-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                    Articles
                                </label>
                                <input 
                                    type="number" 
                                    name="article" 
                                    class="form-control text-white @error('article') is-invalid @enderror" 
                                    id="article" 
                                    placeholder="Total articles"
                                    value="{{ old('article') }}">
                                @error('article')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="banner_image" class="form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Banner Image
                        </label>
                        <div class="image-upload-container" id="imageUploadContainer">
                            <img id="imagePreview" class="image-preview" src="#" alt="Image Preview">
                            <div class="upload-label" id="uploadLabel">
                                <div class="upload-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="upload-text">
                                    <p class="upload-text">Click or drag image here</p>
                                    <p class="upload-subtext">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                            <input 
                                type="file" 
                                name="banner_image" 
                                id="banner_image" 
                                class="form-control text-white @error('banner_image') is-invalid @enderror" 
                                accept="image/*">
                            <div class="progress" id="uploadProgress">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @error('banner_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: inline-block; margin-right: 0.5rem; vertical-align: middle;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Submit
                        </button>
                        <a href="{{ route('main.page.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const imageUploadContainer = document.getElementById('imageUploadContainer');
            const imageInput = document.getElementById('banner_image');
            const imagePreview = document.getElementById('imagePreview');
            const uploadLabel = document.getElementById('uploadLabel');
            const progressBar = document.getElementById('uploadProgress').querySelector('.progress-bar');

            // Trigger file input click when clicking the container
            imageUploadContainer.addEventListener('click', () => {
                imageInput.click();
            });

            // Handle drag and drop
            imageUploadContainer.addEventListener('dragover', (e) => {
                e.preventDefault();
                imageUploadContainer.classList.add('dragover');
            });

            imageUploadContainer.addEventListener('dragleave', () => {
                imageUploadContainer.classList.remove('dragover');
            });

            imageUploadContainer.addEventListener('drop', (e) => {
                e.preventDefault();
                imageUploadContainer.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    imageInput.files = files;
                    handleImage(files[0]);
                }
            });

            // Handle file input change
            imageInput.addEventListener('change', () => {
                if (imageInput.files.length > 0) {
                    handleImage(imageInput.files[0]);
                }
            });

            function handleImage(file) {
                if (!file.type.startsWith('image/')) {
                    uploadLabel.querySelector('.upload-text').textContent = 'Please upload a valid image file';
                    uploadLabel.querySelector('.upload-text').style.color = '#dc2626';
                    return;
                }

                const reader = new FileReader();
                reader.onloadstart = () => {
                    progressBar.parentElement.style.display = 'block';
                    uploadLabel.querySelector('.upload-text').textContent = 'Uploading...';
                };
                reader.onprogress = (e) => {
                    if (e.lengthComputable) {
                        const percent = Math.round((e.loaded / e.total) * 100);
                        progressBar.style.width = `${percent}%`;
                        progressBar.setAttribute('aria-valuenow', percent);
                    }
                };
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    uploadLabel.classList.add('d-none');
                    progressBar.parentElement.style.display = 'none';
                    imageUploadContainer.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush