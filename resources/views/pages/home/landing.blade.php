@extends('layouts.app')

@section('title', 'Shahriar\'s Portfolio')

@push('styles')
    {{-- <style>
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
        }

        .upload-container {
            background: var(--card-background);
            border-radius: 1rem;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .upload-container:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-4px);
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 1.5rem;
            text-align: center;
            border-radius: 0.75rem 0.75rem 0 0;
            position: relative;
            overflow: hidden;
        }

        /* .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            opacity: 0.5;
        } */

        .header-title {
            color: var(--header-text);
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .header-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .form-content {
            padding: 2rem;
        }

        .url-section {
            background: var(--section-background);
            padding: 1.25rem;
            border-radius: 0.75rem;
            border: 1px solid #374151;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .url-section:focus-within {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-label {
            color: var(--header-text);
            font-weight: 600;
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

        .form-control {
            border: 1px solid #374151;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            background: var(--card-background);
            color: var(--text-primary);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            outline: none;
            background: var(--card-background);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
            opacity: 0.6;
        }

        .section-header {
            color: var(--header-text);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-header svg {
            width: 1.25rem;
            height: 1.25rem;
            color: var(--primary-color);
        }

        .file-input-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px dashed #4b5563;
            border-radius: 0.75rem;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.3s ease;
            background: var(--section-background);
        }

        .file-input-container:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-hover);
            background: #2a2a2a;
        }

        .file-input-container.has-image {
            border-style: solid;
            border-color: var(--success-color);
        }

        .file-input-container input[type="file"] {
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
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 5;
            transition: transform 0.3s ease;
        }

        .file-input-container:hover .image-preview {
            transform: scale(1.05);
        }

        .upload-label {
            padding: 1.5rem;
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

        .file-input-container:hover .upload-icon {
            transform: translateY(-4px);
        }

        .upload-icon svg {
            width: 1.25rem;
            height: 1.25rem;
            color: #ffffff;
        }

        .upload-text-main {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
            margin: 0;
        }

        .upload-text-sub {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .main-image-slot {
            height: 350px;
        }

        .side-image-slot {
            height: 100px;
        }

        .side-image-slot .upload-icon {
            width: 1.75rem;
            height: 1.75rem;
            padding: 0.375rem;
        }

        .side-image-slot .upload-icon svg {
            width: 0.875rem;
            height: 0.875rem;
        }

        .side-image-slot .upload-label {
            padding: 0.5rem;
            gap: 0.5rem;
        }

        .side-image-slot .upload-text-main {
            font-size: 0.75rem;
        }

        .side-image-slot .upload-text-sub {
            font-size: 0.625rem;
        }

        .slot-badge {
            position: absolute;
            top: 0.5rem;
            left: 0.5rem;
            background: rgba(59, 130, 246, 0.9);
            color: #ffffff;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.625rem;
            font-weight: 600;
            z-index: 20;
        }

        .submit-section {
            padding: 1.5rem;
            margin-top: 1.5rem;
            text-align: center;
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

        .image-grid {
            gap: 1rem;
        }

        .side-images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
        }

        @media (max-width: 991.98px) {
            .main-image-slot {
                height: 250px;
            }

            .side-image-slot {
                height: 80px;
            }
        }

        @media (max-width: 767.98px) {
            .content-area {
                padding: 1rem;
            }

            .form-content {
                padding: 1rem;
            }

            .header-title {
                font-size: 1.4rem;
            }

            .header-subtitle {
                font-size: 0.75rem;
            }

            .url-section {
                padding: 1rem;
            }

            .image-grid {
                gap: 0.75rem;
            }

            .side-images-grid {
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 0.75rem;
            }
        }
    </style> --}}

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
        }

        .upload-container {
            background: var(--card-background);
            border-radius: 1rem;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .upload-container:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-4px);
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 1.5rem;
            text-align: center;
            border-radius: 0.75rem 0.75rem 0 0;
            position: relative;
            overflow: hidden;
        }

        /* .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            opacity: 0.5;
        } */

        .header-title {
            color: var(--header-text);
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .header-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .form-content {
            padding: 2rem;
        }

        .url-section {
            background: var(--section-background);
            padding: 1.25rem;
            border-radius: 0.75rem;
            border: 1px solid #374151;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .url-section:focus-within {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-label {
            color: var(--header-text);
            font-weight: 600;
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

        .form-control {
            border: 1px solid #374151;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            background: var(--card-background);
            color: var(--text-primary);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            outline: none;
            background: var(--card-background);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
            opacity: 0.6;
        }

        .section-header {
            color: var(--header-text);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-header svg {
            width: 1.25rem;
            height: 1.25rem;
            color: var(--primary-color);
        }

        .file-input-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px dashed #4b5563;
            border-radius: 0.75rem;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.3s ease;
            background: var(--section-background);
        }

        .file-input-container:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-hover);
            background: #1f2532;
        }

        .file-input-container.has-image {
            border-style: solid;
            border-color: var(--success-color);
        }

        .file-input-container input[type="file"] {
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
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 5;
            transition: transform 0.3s ease;
        }

        .file-input-container:hover .image-preview {
            transform: scale(1.05);
        }

        .upload-label {
            padding: 1.5rem;
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

        .file-input-container:hover .upload-icon {
            transform: translateY(-4px);
        }

        .upload-icon svg {
            width: 1.25rem;
            height: 1.25rem;
            color: #ffffff;
        }

        .upload-text-main {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
            margin: 0;
        }

        .upload-text-sub {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .main-image-slot {
            height: 350px;
        }

        .side-image-slot {
            height: 100px;
        }

        .side-image-slot .upload-icon {
            width: 1.75rem;
            height: 1.75rem;
            padding: 0.375rem;
        }

        .side-image-slot .upload-icon svg {
            width: 0.875rem;
            height: 0.875rem;
        }

        .side-image-slot .upload-label {
            padding: 0.5rem;
            gap: 0.5rem;
        }

        .side-image-slot .upload-text-main {
            font-size: 0.75rem;
        }

        .side-image-slot .upload-text-sub {
            font-size: 0.625rem;
        }

        .slot-badge {
            position: absolute;
            top: 0.5rem;
            left: 0.5rem;
            background: rgba(59, 130, 246, 0.9);
            color: #ffffff;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.625rem;
            font-weight: 600;
            z-index: 20;
        }

        .submit-section {
            padding: 1.5rem;
            margin-top: 1.5rem;
            text-align: center;
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

        .image-grid {
            gap: 1rem;
        }

        .side-images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .side-images-grid {
                grid-template-columns: repeat(5, 1fr); /* 5 columns in a row for medium and large screens */
            }
        }

        @media (max-width: 991.98px) {
            .main-image-slot {
                height: 250px;
            }

            .side-image-slot {
                height: 80px;
            }
        }

        @media (max-width: 767.98px) {
            .content-area {
                padding: 1rem;
            }

            .form-content {
                padding: 1rem;
            }

            .header-title {
                font-size: 1.4rem;
            }

            .header-subtitle {
                font-size: 0.75rem;
            }

            .url-section {
                padding: 1rem;
            }

            .image-grid {
                gap: 0.75rem;
            }

            .side-images-grid {
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 0.75rem;
            }
        }
    </style>
@endpush

@section('content')
<div class="content-area">
    <div class="container">
        <div class="upload-container">
            <!-- Header Section -->
            <div class="header-section">
                <h1 class="header-title">Landing Page Image Upload</h1>
            </div>

            <!-- Form Content -->
            <div class="form-content" style="background-color: #1f2532">
                <form method="POST" enctype="multipart/form-data" action="{{ route('home.landing') }}">
                    @csrf

                    <!-- URL Input Section -->
                    <div class="url-section">
                        <label for="url_input" class="form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                            Redirect URL
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="url_input" name="url" placeholder="https://shahriar.com/home"
                               class="form-control" aria-describedby="urlHelp" required>
                    </div>

                    <!-- Main Image Section -->
                    <div class="mb-4">
                        <h2 class="section-header">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Featured Image
                        </h2>
                        <div class="file-input-container main-image-slot">
                            <img id="preview_main_image" class="image-preview d-none" src="" alt="Main Image Preview">
                            <div class="upload-label" id="label_main_image">
                                <div class="upload-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="upload-text">
                                    <p class="upload-text-main">Click or drag image here</p>
                                    <p class="upload-text-sub">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                            <input type="file" name="main_image" id="main_image" accept="image/*" onchange="previewImage(this, 'preview_main_image', 'label_main_image')">
                        </div>
                    </div>

                    <!-- Side Images Section -->
                    <div class="mb-4">
                        <h2 class="section-header">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                            </svg>
                            Left & Right Side Images
                        </h2>
                        <div class="side-images-grid" id="side-images">
                            <!-- Side image slots will be generated here by JavaScript -->
                        </div>
                    </div>

                    <!-- Submit Button Section -->
                    <div class="submit-section">
                        <button type="submit" class="btn btn-submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: inline-block; margin-right: 0.5rem; vertical-align: middle;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Upload & Save Images
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        const imageGroup = document.querySelector('#side-images');

        function createUploaderSlot(index) {
            const inputName = `image${index}`;
            const labelId = `label_${inputName}`;
            const previewId = `preview_${inputName}`;

            const html = `
                <div class="position-relative">
                    <div class="file-input-container side-image-slot">
                        <span class="slot-badge">Slot ${index}</span>
                        <img id="${previewId}" class="image-preview d-none" src="" alt="Image ${index} Preview">
                        <div class="upload-label" id="${labelId}">
                            <div class="upload-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="upload-text">
                                <p class="upload-text-main">Upload Image</p>
                                <p class="upload-text-sub">Click to browse</p>
                            </div>
                        </div>
                        <input type="file" name="${inputName}" id="${inputName}" accept="image/*" onchange="previewImage(this, '${previewId}', '${labelId}')">
                    </div>
                </div>
            `;
            return html;
        }

        for (let i = 1; i <= 10; i++) {
            const slot = createUploaderSlot(i);
            imageGroup.insertAdjacentHTML('beforeend', slot);
        }

        function previewImage(input, previewId, labelId) {
            const preview = document.getElementById(previewId);
            const label = document.getElementById(labelId);
            const container = input.closest('.file-input-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    label.classList.add('d-none');
                    container.classList.add('has-image');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "";
                preview.classList.add('d-none');
                label.classList.remove('d-none');
                container.classList.remove('has-image');
            }
        }
    </script>
@endpush