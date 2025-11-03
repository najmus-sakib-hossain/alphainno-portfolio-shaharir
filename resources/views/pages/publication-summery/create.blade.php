@extends('layouts.app')@extends('layouts.app')



@section('title', 'Add Publication Summary')@section('title', 'Add Publication Summary')



@push('styles')@push('styles')

<style><style>

:root {:root {

    --color-bg-primary: #121212;    --primary-gradient-start: #667eea;

    --color-bg-card: #1e1e1e;    --primary-gradient-end: #764ba2;

    --color-text-light: #e0e0e0;    --success-color: #10b981;

    --color-text-accent: #f0f0f0;    --danger-color: #ef4444;

    --color-accent-green: #2ecc71;    --bg-primary: #f8fafc;

    --color-accent-red: #e94b3c;    --bg-card: #ffffff;

    --color-border: #333333;    --text-primary: #1e293b;

    --color-shadow: rgba(0, 0, 0, 0.5);    --text-secondary: #64748b;

}    --border-color: #e2e8f0;

    --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);

body {}

    background-color: var(--color-bg-primary);

    font-family: 'Inter', sans-serif;body {

}    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);

    min-height: 100vh;

.content-area {    font-family: 'Inter', sans-serif;

    padding: 2rem;}

    min-height: 100vh;

}.content-area {

    max-width: 900px;

.card-dark {    margin: 0 auto;

    background-color: var(--color-bg-card);    padding: 2.5rem 1.5rem;

    border-radius: 12px;    min-height: 100vh;

    box-shadow: 0 10px 30px var(--color-shadow);}

    border: 1px solid var(--color-border);

}.card-modern {

    background: var(--bg-card);

.card-header-dark {    border-radius: 16px;

    background-color: var(--color-bg-primary);    box-shadow: var(--shadow-lg);

    border-top-left-radius: 12px;    border: 1px solid var(--border-color);

    border-top-right-radius: 12px;    overflow: hidden;

    padding: 15px 20px;}

    border-bottom: 1px solid var(--color-border);

    text-align: center;.card-header-gradient {

}    background: linear-gradient(135deg, var(--primary-gradient-start), var(--primary-gradient-end));

    padding: 2rem;

.card-title-modern {    text-align: center;

    font-size: 1.25rem;}

    font-weight: 600;

    color: var(--color-text-accent);.card-title-modern {

    letter-spacing: 0.3px;    font-size: 1.75rem;

}    font-weight: 700;

    color: white;

.form-control-dark {    margin: 0;

    width: 100%;    display: flex;

    background-color: #2c2c2c;    align-items: center;

    color: var(--color-text-light);    justify-content: center;

    border: 1px solid var(--color-border);    gap: 0.75rem;

    border-radius: 8px;}

    padding: 10px 15px;

    font-size: 0.95rem;.form-control-modern {

    font-weight: 300;    width: 100%;

    transition: border-color 0.3s, box-shadow 0.3s;    background: var(--bg-primary);

    margin-bottom: 1.5rem;    color: var(--text-primary);

}    border: 2px solid var(--border-color);

    border-radius: 10px;

.form-control-dark::placeholder {    padding: 0.85rem 1.25rem;

    color: #777;    font-size: 0.95rem;

}    transition: all 0.3s ease;

}

.form-control-dark:focus {

    background-color: #2c2c2c;.form-control-modern::placeholder {

    color: var(--color-text-light);    color: var(--text-secondary);

    border-color: var(--color-accent-green);}

    box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.3);

}.form-control-modern:focus {

    background: white;

.form-label-dark {    border-color: var(--primary-gradient-start);

    color: var(--color-text-light);    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);

    font-size: 0.95rem;    outline: none;

    font-weight: 600;}

    margin-bottom: 8px;

    display: block;.form-label-modern {

}    color: var(--text-primary);

    font-size: 0.95rem;

.btn-modern-green,    font-weight: 600;

.btn-modern-red {    margin-bottom: 0.5rem;

    font-size: 0.85rem;    display: block;

    font-weight: 600;}

    padding: 7px 16px;

    border-radius: 6px;.btn-modern-primary,

    transition: all 0.3s ease;.btn-modern-secondary {

    display: inline-flex;    font-size: 0.95rem;

    align-items: center;    font-weight: 600;

    justify-content: center;    padding: 0.85rem 2rem;

    text-decoration: none;    border-radius: 50px;

}    border: none;

    cursor: pointer;

.btn-modern-green {    transition: all 0.3s ease;

    background-color: var(--color-accent-green);    display: inline-flex;

    border-color: var(--color-accent-green);    align-items: center;

    color: #ffffff;    justify-content: center;

}    gap: 0.5rem;

    text-decoration: none;

.btn-modern-green:hover {}

    background-color: #27ae60;

    border-color: #27ae60;.btn-modern-primary {

    transform: translateY(-2px);    background: linear-gradient(135deg, var(--primary-gradient-start), var(--primary-gradient-end));

    box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);    color: white;

}}



.btn-modern-red {.btn-modern-primary:hover {

    background-color: var(--color-accent-red);    transform: translateY(-2px);

    border-color: var(--color-accent-red);    box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);

    color: #ffffff;    color: white;

}}



.btn-modern-red:hover {.btn-modern-secondary {

    background-color: #c0392b;    background: var(--bg-primary);

    border-color: #c0392b;    color: var(--text-primary);

    transform: translateY(-2px);    border: 2px solid var(--border-color);

    box-shadow: 0 6px 15px rgba(233, 75, 60, 0.35);}

}

.btn-modern-secondary:hover {

.image-upload-container {    background: var(--border-color);

    border: 2px dashed var(--color-border);    transform: translateY(-2px);

    border-radius: 10px;    color: var(--text-primary);

    padding: 2rem;}

    text-align: center;

    background: #242424;.image-upload-container {

    transition: border-color 0.3s ease, background 0.3s ease;    border: 3px dashed var(--border-color);

    position: relative;    border-radius: 16px;

}    padding: 2.5rem;

    text-align: center;

.image-upload-container.dragover {    background: var(--bg-primary);

    border-color: var(--color-accent-green);    transition: all 0.3s ease;

    background: #1a1a1a;    cursor: pointer;

}}



.image-preview {.image-upload-container.dragover {

    max-width: 100%;    border-color: var(--primary-gradient-start);

    max-height: 250px;    background: rgba(102, 126, 234, 0.05);

    object-fit: contain;}

    margin-top: 1rem;

    border-radius: 10px;.image-preview {

    border: 1px solid var(--color-border);    max-width: 100%;

    display: none;    max-height: 300px;

}    object-fit: contain;

    margin-top: 1.5rem;

.progress {    border-radius: 12px;

    height: 10px;    border: 2px solid var(--border-color);

    margin-top: 1rem;    display: none;

    border-radius: 5px;}

    display: none;

    background-color: #2c2c2c;.progress {

}    height: 8px;

    margin-top: 1rem;

.progress-bar {    border-radius: 10px;

    background-color: var(--color-accent-green);    display: none;

}    background-color: var(--bg-primary);

}

.upload-text {

    color: #5e7b88;.progress-bar {

    font-size: 0.9rem;    background: linear-gradient(135deg, var(--primary-gradient-start), var(--primary-gradient-end));

    font-weight: 500;    border-radius: 10px;

    margin-bottom: 0.5rem;    transition: width 0.3s ease;

}}



.alert-danger {.upload-text {

    background: var(--color-accent-red);    color: var(--text-secondary);

    color: #ffffff;    font-size: 1rem;

    border-radius: 10px;    font-weight: 500;

    padding: 1rem;    margin-bottom: 0.75rem;

    margin-bottom: 1.5rem;}

}

.upload-icon {

textarea.form-control-dark {    font-size: 3rem;

    resize: vertical;    color: var(--primary-gradient-start);

    min-height: 100px;    opacity: 0.6;

}    margin-bottom: 1rem;

</style>}

@endpush

.alert-danger {

@section('content')    background: #fee2e2;

<div class="content-area">    border: 1px solid #fecaca;

    <div class="card card-dark">    color: #991b1b;

        <div class="card-header-dark">    border-radius: 12px;

            <h3 class="card-title-modern"><i class="bi bi-journal-text me-2"></i>Add Publication Summary</h3>    padding: 1rem 1.25rem;

        </div>    margin-bottom: 1.5rem;

        <div class="card-body">}

            @if ($errors->any())

                <div class="alert-danger">.alert-danger ul {

                    <ul>    margin: 0;

                        @foreach ($errors->all() as $error)    padding-left: 1.5rem;

                            <li>{{ $error }}</li>}

                        @endforeach

                    </ul>textarea.form-control-modern {

                </div>    resize: vertical;

            @endif    min-height: 150px;

}

            <form action="{{ route('publication-summery.store') }}" method="POST" enctype="multipart/form-data" id="publicationSummaryForm"></style>

                @csrf@endpush



                <div class="form-group">@section('content')

                    <label for="content" class="form-label-dark">Content <span class="text-danger">*</span></label><div class="content-area">

                    <textarea     <div class="card-modern">

                        name="content"         <div class="card-header-gradient">

                        id="content"             <h1 class="card-title-modern">

                        rows="6"                 <i class="bi bi-plus-circle"></i>

                        class="form-control-dark @error('content') is-invalid @enderror"                 <span>Add Publication Summary</span>

                        placeholder="Write publication summary..."             </h1>

                        required>{{ old('content') }}</textarea>        </div>

                    @error('content')        <div class="card-body" style="padding: 2.5rem;">

                        <small class="text-danger">{{ $message }}</small>            @if ($errors->any())

                    @enderror                <div class="alert-danger">

                </div>                    <strong><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</strong>

                    <ul>

                <div class="form-group">                        @foreach ($errors->all() as $error)

                    <label for="image" class="form-label-dark">Upload Image</label>                            <li>{{ $error }}</li>

                    <div class="image-upload-container" id="imageUploadContainer">                        @endforeach

                        <p class="upload-text">Drag & drop image here or click to upload</p>                    </ul>

                        <input                 </div>

                            type="file"             @endif

                            name="image" 

                            id="image"             <form action="{{ route('publication-summery.store') }}" method="POST" enctype="multipart/form-data" id="publicationSummaryForm">

                            class="form-control-dark @error('image') is-invalid @enderror d-none"                 @csrf

                            accept="image/*">

                        <img id="preview" class="image-preview" src="#" alt="Image Preview">                <div class="form-group mb-4">

                        <div class="progress" id="uploadProgress">                    <label for="content" class="form-label-modern">

                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>                        Content <span style="color: var(--danger-color);">*</span>

                        </div>                    </label>

                        @error('image')                    <textarea 

                            <small class="text-danger">{{ $message }}</small>                        name="content" 

                        @enderror                        id="content" 

                    </div>                        rows="6" 

                </div>                        class="form-control-modern @error('content') is-invalid @enderror" 

                        placeholder="Write your publication summary here..." 

                <div class="d-flex justify-content-center gap-3 mt-3">                        required>{{ old('content') }}</textarea>

                    <a href="{{ route('publication-summery.index') }}" class="btn-modern-red">                    @error('content')

                        <i class="bi bi-arrow-left me-2"></i>Back                        <small style="color: var(--danger-color); font-size: 0.875rem;">{{ $message }}</small>

                    </a>                    @enderror

                    <button type="submit" class="btn-modern-green">                </div>

                        <i class="bi bi-check2-circle me-2"></i>Save Summary

                    </button>                <div class="form-group mb-4">

                </div>                    <label for="image" class="form-label-modern">Upload Image (Optional)</label>

            </form>                    <div class="image-upload-container" id="imageUploadContainer">

        </div>                        <div class="upload-icon">

    </div>                            <i class="bi bi-cloud-upload"></i>

</div>                        </div>

@endsection                        <p class="upload-text">Drag & drop your image here or click to browse</p>

                        <p style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 0.5rem;">

@push('scripts')                            Supported formats: JPG, PNG, WEBP (Max: 5MB)

<script>                        </p>

document.addEventListener('DOMContentLoaded', () => {                        <input 

    const imageUploadContainer = document.getElementById('imageUploadContainer');                            type="file" 

    const imageInput = document.getElementById('image');                            name="image" 

    const imagePreview = document.getElementById('preview');                            id="image" 

    const progressBar = document.getElementById('uploadProgress').querySelector('.progress-bar');                            class="d-none @error('image') is-invalid @enderror" 

    const uploadText = imageUploadContainer.querySelector('.upload-text');                            accept="image/*">

                        <img id="preview" class="image-preview" src="#" alt="Image Preview">

    // Trigger file input click                        <div class="progress" id="uploadProgress">

    imageUploadContainer.addEventListener('click', () => imageInput.click());                            <div class="progress-bar" role="progressbar" style="width: 0%;"></div>

                        </div>

    // Drag & Drop                        @error('image')

    imageUploadContainer.addEventListener('dragover', (e) => {                            <small style="color: var(--danger-color); font-size: 0.875rem; display: block; margin-top: 0.5rem;">{{ $message }}</small>

        e.preventDefault();                        @enderror

        imageUploadContainer.classList.add('dragover');                    </div>

    });                </div>



    imageUploadContainer.addEventListener('dragleave', () => {                <div class="d-flex justify-content-center gap-3 mt-4">

        imageUploadContainer.classList.remove('dragover');                    <a href="{{ route('publication-summery.index') }}" class="btn-modern-secondary">

    });                        <i class="bi bi-arrow-left"></i>

                        <span>Cancel</span>

    imageUploadContainer.addEventListener('drop', (e) => {                    </a>

        e.preventDefault();                    <button type="submit" class="btn-modern-primary">

        imageUploadContainer.classList.remove('dragover');                        <i class="bi bi-check2-circle"></i>

        const files = e.dataTransfer.files;                        <span>Save Publication</span>

        if (files.length > 0) handleImage(files[0]);                    </button>

    });                </div>

            </form>

    // File input change        </div>

    imageInput.addEventListener('change', () => {    </div>

        if (imageInput.files.length > 0) handleImage(imageInput.files[0]);</div>

    });@endsection



    function handleImage(file) {@push('scripts')

        if (!file.type.startsWith('image/')) {<script>

            uploadText.textContent = 'Please upload a valid image file';document.addEventListener('DOMContentLoaded', () => {

            uploadText.style.color = '#e94b3c';    const imageUploadContainer = document.getElementById('imageUploadContainer');

            return;    const imageInput = document.getElementById('image');

        }    const imagePreview = document.getElementById('preview');

    const progressBar = document.getElementById('uploadProgress').querySelector('.progress-bar');

        const reader = new FileReader();    const uploadText = imageUploadContainer.querySelector('.upload-text');

        reader.onloadstart = () => {

            progressBar.parentElement.style.display = 'block';    // Trigger file input click

            uploadText.textContent = 'Uploading...';    imageUploadContainer.addEventListener('click', () => imageInput.click());

        };

        reader.onprogress = (e) => {    // Drag & Drop

            if (e.lengthComputable) {    imageUploadContainer.addEventListener('dragover', (e) => {

                const percent = Math.round((e.loaded / e.total) * 100);        e.preventDefault();

                progressBar.style.width = `${percent}%`;        imageUploadContainer.classList.add('dragover');

                progressBar.setAttribute('aria-valuenow', percent);    });

            }

        };    imageUploadContainer.addEventListener('dragleave', () => {

        reader.onload = (e) => {        imageUploadContainer.classList.remove('dragover');

            imagePreview.src = e.target.result;    });

            imagePreview.style.display = 'block';

            progressBar.parentElement.style.display = 'none';    imageUploadContainer.addEventListener('drop', (e) => {

            uploadText.textContent = 'Image uploaded! Click or drag to replace';        e.preventDefault();

            uploadText.style.color = '#5e7b88';        imageUploadContainer.classList.remove('dragover');

        };        const files = e.dataTransfer.files;

        reader.readAsDataURL(file);        if (files.length > 0) handleImage(files[0]);

    }    });

});

</script>    // File input change

@endpush    imageInput.addEventListener('change', () => {

        if (imageInput.files.length > 0) handleImage(imageInput.files[0]);
    });

    function handleImage(file) {
        if (!file.type.startsWith('image/')) {
            uploadText.textContent = 'Please upload a valid image file';
            uploadText.style.color = '#e94b3c';
            return;
        }

        const reader = new FileReader();
        reader.onloadstart = () => {
            progressBar.parentElement.style.display = 'block';
            uploadText.textContent = 'Uploading...';
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
            progressBar.parentElement.style.display = 'none';
            uploadText.textContent = 'Image uploaded! Click or drag to replace';
            uploadText.style.color = '#5e7b88';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
