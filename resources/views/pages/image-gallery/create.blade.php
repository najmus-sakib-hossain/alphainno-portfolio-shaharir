@extends('layouts.app')

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-muted: #9ca3af;
    --color-accent: #667eea;
    --color-accent-hover: #764ba2;
    --color-danger: #ef4444;
    --color-danger-hover: #dc2626;
    --color-border: #333;
    --color-shadow: rgba(0, 0, 0, 0.5);
}

body {
    background-color: var(--color-bg-primary);
    font-family: 'Inter', sans-serif;
}

.upload-container {
    min-height: 100vh;
    padding: 60px 0;
}

.upload-card {
    background-color: var(--color-bg-card);
    border-radius: 20px;
    box-shadow: 0 10px 30px var(--color-shadow);
    overflow: hidden;
    animation: slideUp 0.5s ease-out;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(30px);}
    to { opacity: 1; transform: translateY(0);}
}

.card-header-custom {
    background: linear-gradient(135deg, var(--color-accent), var(--color-accent-hover));
    color: #fff;
    padding: 30px;
    border: none;
    text-align: center;
}

.card-header-custom h2 {
    margin: 0;
    font-weight: 600;
    font-size: 28px;
}

.card-header-custom p {
    margin-top: 8px;
    opacity: 0.95;
    font-size: 15px;
}

.upload-area {
    border: 2px dashed var(--color-border);
    border-radius: 15px;
    padding: 60px 20px;
    text-align: center;
    background-color: #242424;
    color: var(--color-text-light);
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
}

.upload-area.dragover {
    border-color: var(--color-accent);
    box-shadow: 0 6px 20px var(--color-shadow);
    transform: translateY(-2px);
}

.upload-icon i {
    font-size: 64px;
    color: var(--color-accent);
    margin-bottom: 20px;
}

.upload-area h4 {
    color: var(--color-text-light);
    font-weight: 600;
    margin-bottom: 10px;
}

.upload-area p {
    color: var(--color-text-muted);
    margin-bottom: 20px;
}

.btn-browse {
    background: var(--color-accent);
    color: #fff;
    border: none;
    padding: 12px 32px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-browse:hover {
    background: var(--color-accent-hover);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    color: #fff;
}

.preview-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.preview-item {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    background-color: #2c2c2c;
    box-shadow: 0 4px 12px var(--color-shadow);
    transition: all 0.3s ease;
    animation: fadeIn 0.4s ease-out;
}

@keyframes fadeIn {
    from {opacity:0; transform: scale(0.9);}
    to {opacity:1; transform: scale(1);}
}

.preview-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px var(--color-shadow);
}

.preview-item img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.preview-overlay {
    position: absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.preview-item:hover .preview-overlay {
    opacity: 1;
}

.btn-remove {
    background: var(--color-danger);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition: all 0.3s ease;
}

.btn-remove:hover {
    background: var(--color-danger-hover);
    transform: scale(1.1);
}

.file-name {
    position: absolute;
    bottom:0;
    left:0;
    right:0;
    background: rgba(0,0,0,0.8);
    color: #fff;
    padding: 8px;
    font-size: 12px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.form-control:focus {
    border-color: var(--color-accent);
    box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.25);
}

.btn-submit {
    background: var(--color-accent);
    color: #fff;
    border: none;
    padding: 14px 40px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-submit:hover {
    background: var(--color-accent-hover);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102,126,234,0.4);
}

.btn-cancel {
    background: #374151;
    color: #e0e0e0;
    border: none;
    padding: 14px 40px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    background: #4b5563;
    color: #fff;
}

.image-count {
    display: inline-block;
    background: #10b981;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 15px;
}

@media (max-width: 768px){
    .upload-card { padding: 20px; }
    .card-header-custom h2 { font-size: 22px; }
    .upload-area { padding: 40px 15px; }
    .preview-container { grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap:15px; }
    .preview-item img { height: 140px; }
}
</style>
@endpush

@section('content')
<div class="upload-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="upload-card">
                    <div class="card-header-custom">
                        <h2><i class="fas fa-images me-2"></i>Upload Image Gallery</h2>
                        <p>Select multiple images to create a beautiful gallery</p>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('image-galleries.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="fas fa-cloud-upload-alt me-2"></i>Upload Images</label>
                                <div class="upload-area" id="uploadArea">
                                    <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                    <h4>Drag & Drop Images Here</h4>
                                    <p class="text-muted">or</p>
                                    <button type="button" class="btn btn-browse" onclick="document.getElementById('fileInput').click()">
                                        <i class="fas fa-folder-open me-2"></i>Browse Files
                                    </button>
                                    <p class="text-muted mt-3 mb-0"><small>Supported formats: JPG, PNG, GIF, WebP (Max 5MB each)</small></p>
                                </div>
                                <input type="file" id="fileInput" name="images[]" multiple accept="image/*" style="display:none;">
                            </div>

                            <div id="previewSection" style="display:none;">
                                <div class="image-count"><i class="fas fa-image me-2"></i><span id="imageCount">0</span> image(s) selected</div>
                                <div class="preview-container" id="previewContainer"></div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                <a href="{{ route('image-galleries.index') }}" class="btn btn-cancel"><i class="fas fa-times me-2"></i>Cancel</a>
                                <button type="submit" class="btn btn-submit" id="submitBtn" disabled><i class="fas fa-check me-2"></i>Upload Gallery</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('fileInput');
const previewContainer = document.getElementById('previewContainer');
const previewSection = document.getElementById('previewSection');
const imageCount = document.getElementById('imageCount');
const submitBtn = document.getElementById('submitBtn');
let selectedFiles = [];

['dragenter','dragover','dragleave','drop'].forEach(e => uploadArea.addEventListener(e, preventDefaults, false));
document.body.addEventListener('dragenter', preventDefaults, false);
document.body.addEventListener('dragover', preventDefaults, false);
document.body.addEventListener('dragleave', preventDefaults, false);
document.body.addEventListener('drop', preventDefaults, false);

function preventDefaults(e){ e.preventDefault(); e.stopPropagation(); }

['dragenter','dragover'].forEach(e => uploadArea.addEventListener(e, ()=>uploadArea.classList.add('dragover')));
['dragleave','drop'].forEach(e => uploadArea.addEventListener(e, ()=>uploadArea.classList.remove('dragover')));

uploadArea.addEventListener('drop', e => handleFiles(e.dataTransfer.files));
fileInput.addEventListener('change', e => handleFiles(e.target.files));

function handleFiles(files){
    const newFiles = [...files].filter(f => f.type.startsWith('image/'));
    if(newFiles.length===0){ alert('Please select valid image files!'); return; }
    selectedFiles = [...selectedFiles, ...newFiles];
    updateFileInput(); displayPreviews();
}

function updateFileInput(){
    const dt = new DataTransfer();
    selectedFiles.forEach(f=>dt.items.add(f));
    fileInput.files = dt.files;
}

function displayPreviews(){
    previewContainer.innerHTML='';
    if(selectedFiles.length===0){ previewSection.style.display='none'; submitBtn.disabled=true; return; }
    previewSection.style.display='block'; submitBtn.disabled=false;
    imageCount.textContent=selectedFiles.length;
    selectedFiles.forEach((file,i)=>{
        const reader=new FileReader();
        reader.onload=e=>{
            const previewItem=document.createElement('div');
            previewItem.className='preview-item';
            previewItem.innerHTML=`
                <img src="${e.target.result}" alt="${file.name}">
                <div class="preview-overlay">
                    <button type="button" class="btn-remove" onclick="removeFile(${i})"><i class="fas fa-trash"></i></button>
                </div>
                <div class="file-name">${file.name}</div>
            `;
            previewContainer.appendChild(previewItem);
        };
        reader.readAsDataURL(file);
    });
}

function removeFile(i){
    selectedFiles.splice(i,1);
    updateFileInput();
    displayPreviews();
}

document.getElementById('uploadForm').addEventListener('submit', e=>{
    if(selectedFiles.length===0){ e.preventDefault(); alert('Please select at least one image!'); }
});
</script>
@endpush
