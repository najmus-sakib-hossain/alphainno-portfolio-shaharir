@extends('layouts.app')@extends('layouts.app')



@section('title', 'Edit Publication Summary')@section('title', 'Edit Publication Summary')



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

    cursor: pointer;    padding: 2.5rem;

}    text-align: center;

    background: var(--bg-primary);

.image-upload-container.dragover {    transition: all 0.3s ease;

    border-color: var(--color-accent-green);    cursor: pointer;

    background: #1a1a1a;}

}

.image-upload-container.dragover {

.image-preview {    border-color: var(--primary-gradient-start);

    max-width: 100%;    background: rgba(102, 126, 234, 0.05);

    max-height: 250px;}

    object-fit: contain;

    margin-top: 1rem;.upload-text {

    border-radius: 10px;    color: var(--text-secondary);

    border: 1px solid var(--color-border);    font-size: 1rem;

    display: block;    font-weight: 500;

}    margin-bottom: 0.75rem;

}

.alert-danger {

    background: var(--color-accent-red);.upload-icon {

    color: #ffffff;    font-size: 3rem;

    border-radius: 10px;    color: var(--primary-gradient-start);

    padding: 1rem;    opacity: 0.6;

    margin-bottom: 1.5rem;    margin-bottom: 1rem;

}}



textarea.form-control-dark {.image-preview {

    resize: vertical;    max-width: 100%;

    min-height: 120px;    max-height: 300px;

}    object-fit: contain;

</style>    margin-top: 1.5rem;

@endpush    border-radius: 12px;

    border: 2px solid var(--border-color);

@section('content')}

<div class="content-area">

    <div class="card card-dark">.alert-danger {

        <div class="card-header-dark">    background: #fee2e2;

            <h3 class="card-title-modern"><i class="bi bi-journal-text me-2"></i>Edit Publication Summary</h3>    border: 1px solid #fecaca;

        </div>    color: #991b1b;

        <div class="card-body">    border-radius: 12px;

            @if ($errors->any())    padding: 1rem 1.25rem;

                <div class="alert-danger">    margin-bottom: 1.5rem;

                    <ul>}

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>.alert-danger ul {

                        @endforeach    margin: 0;

                    </ul>    padding-left: 1.5rem;

                </div>}

            @endif

textarea.form-control-modern {

            <form action="{{ route('publication-summery.update', $publicationSummery->id) }}" method="POST" enctype="multipart/form-data">    resize: vertical;

                @csrf    min-height: 150px;

                @method('PUT')}

</style>

                <!-- Content -->@endpush

                <div class="form-group">

                    <label for="content" class="form-label-dark">Content <span class="text-danger">*</span></label>@section('content')

                    <textarea <div class="content-area">

                        name="content"     <div class="card-modern">

                        id="content"         <div class="card-header-gradient">

                        class="form-control-dark @error('content') is-invalid @enderror"             <h1 class="card-title-modern">

                        rows="6"                 <i class="bi bi-pencil-square"></i>

                        placeholder="Write publication summary...">{{ old('content', $publicationSummery->content) }}</textarea>                <span>Edit Publication Summary</span>

                    @error('content')            </h1>

                        <small class="text-danger">{{ $message }}</small>        </div>

                    @enderror        <div class="card-body" style="padding: 2.5rem;">

                </div>            @if ($errors->any())

                <div class="alert-danger">

                <!-- Image Upload -->                    <strong><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</strong>

                <div class="form-group">                    <ul>

                    <label for="image" class="form-label-dark">Upload Image</label>                        @foreach ($errors->all() as $error)

                    <div class="image-upload-container" id="imageUploadContainer">                            <li>{{ $error }}</li>

                        <p class="upload-text">Click or drag to upload/change image</p>                        @endforeach

                        <input                     </ul>

                            type="file"                 </div>

                            name="image"             @endif

                            id="image" 

                            accept="image/*"            <form action="{{ route('publication-summery.update', $publicationSummery->id) }}" method="POST" enctype="multipart/form-data">

                            class="d-none @error('image') is-invalid @enderror">                @csrf

                @method('PUT')

                        @if($publicationSummery->hasMedia('publication_images'))

                            <img id="preview" src="{{ $publicationSummery->getFirstMediaUrl('publication_images') }}" alt="Preview" class="image-preview">                <!-- Content -->

                        @else                <div class="form-group mb-4">

                            <img id="preview" src="https://via.placeholder.com/250x150?text=Preview" alt="Preview" class="image-preview">                    <label for="content" class="form-label-modern">

                        @endif                        Content <span style="color: var(--danger-color);">*</span>

                    </label>

                        @error('image')                    <textarea 

                            <small class="text-danger d-block">{{ $message }}</small>                        name="content" 

                        @enderror                        id="content" 

                    </div>                        class="form-control-modern @error('content') is-invalid @enderror" 

                </div>                        rows="6" 

                        placeholder="Write your publication summary here..." 

                <!-- Buttons -->                        required>{{ old('content', $publicationSummery->content) }}</textarea>

                <div class="d-flex justify-content-center gap-3 mt-4">                    @error('content')

                    <a href="{{ route('publication-summery.index') }}" class="btn-modern-red">                        <small style="color: var(--danger-color); font-size: 0.875rem;">{{ $message }}</small>

                        <i class="bi bi-arrow-left me-1"></i> Back                    @enderror

                    </a>                </div>

                    <button type="submit" class="btn-modern-green">

                        <i class="bi bi-save me-1"></i> Update Summary                <!-- Image Upload -->

                    </button>                <div class="form-group mb-4">

                </div>                    <label for="image" class="form-label-modern">Upload Image (Optional)</label>

            </form>                    <div class="image-upload-container" id="imageUploadContainer">

        </div>                        <div class="upload-icon">

    </div>                            <i class="bi bi-cloud-upload"></i>

</div>                        </div>

@endsection                        <p class="upload-text">Click or drag to upload/change image</p>

                        <p style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 0.5rem;">

@push('scripts')                            Supported formats: JPG, PNG, WEBP (Max: 4MB)

<script>                        </p>

document.addEventListener('DOMContentLoaded', () => {                        <input 

    const container = document.getElementById('imageUploadContainer');                            type="file" 

    const input = document.getElementById('image');                            name="image" 

    const preview = document.getElementById('preview');                            id="image" 

                            accept="image/*"

    container.addEventListener('click', () => input.click());                            class="d-none @error('image') is-invalid @enderror">



    container.addEventListener('dragover', (e) => {                        @if($publicationSummery->hasMedia('publication_images'))

        e.preventDefault();                            <img id="preview" src="{{ $publicationSummery->getFirstMediaUrl('publication_images') }}" alt="Preview" class="image-preview">

        container.classList.add('dragover');                        @else

    });                            <img id="preview" src="https://via.placeholder.com/400x300/667eea/ffffff?text=No+Image" alt="Preview" class="image-preview">

                        @endif

    container.addEventListener('dragleave', () => container.classList.remove('dragover'));

                        @error('image')

    container.addEventListener('drop', (e) => {                            <small style="color: var(--danger-color); font-size: 0.875rem; display: block; margin-top: 0.5rem;">{{ $message }}</small>

        e.preventDefault();                        @enderror

        container.classList.remove('dragover');                    </div>

        if(e.dataTransfer.files.length) handleFile(e.dataTransfer.files[0]);                </div>

    });

                <!-- Buttons -->

    input.addEventListener('change', () => {                <div class="d-flex justify-content-center gap-3 mt-4">

        if(input.files.length) handleFile(input.files[0]);                    <a href="{{ route('publication-summery.index') }}" class="btn-modern-secondary">

    });                        <i class="bi bi-arrow-left"></i>

                        <span>Cancel</span>

    function handleFile(file) {                    </a>

        if(!file.type.startsWith('image/')) return;                    <button type="submit" class="btn-modern-primary">

        preview.src = URL.createObjectURL(file);                        <i class="bi bi-save"></i>

    }                        <span>Update Publication</span>

});                    </button>

</script>                </div>

@endpush            </form>

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

    // Show preview on load if image exists
    if (preview.src && !preview.src.includes('placeholder')) {
        preview.style.display = 'block';
    }

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
        if(!file.type.startsWith('image/')) {
            alert('Please upload a valid image file');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush

