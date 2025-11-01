@extends('layouts.app')

@push('styles')
<style>
/* Root colors */
:root {
    --bg-dark: #121212;
    --card-bg: #1e1e1e;
    --text-light: #e0e0e0;
    --text-muted: #7f8c8d;
    --accent-blue: #3b82f6;
    --accent-green: #10b981;
    --accent-red: #ef4444;
    --border-color: #333;
    --shadow-color: rgba(0,0,0,0.5);
}

body {
    background: var(--bg-dark);
    color: var(--text-light);
    font-family: 'Inter', sans-serif;
}

/* Gallery Container */
.gallery-container {
    padding: 60px 0;
    min-height: 100vh;
    background: var(--bg-dark);
}

/* Header */
.gallery-header {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 10px 40px var(--shadow-color);
    animation: slideDown 0.5s ease-out;
}
.gallery-header h1 {
    margin: 0;
    font-weight: 700;
    font-size: 42px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.gallery-header p {
    margin-top: 10px;
    color: var(--text-muted);
}

/* Add New Button */
.btn-add-new {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff;
    border-radius: 25px;
    font-weight: 600;
    font-size: 16px;
    padding: 12px 28px;
    transition: all 0.3s ease;
}
.btn-add-new:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(102,126,234,0.4);
}

.btn-add-new,
.btn-action {
    text-decoration: none !important;
}

/* Filter/Search */
.filter-section {
    background: var(--card-bg);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px var(--shadow-color);
}
.search-box input {
    width: 100%;
    padding: 12px 45px 12px 20px;
    border: 2px solid #444;
    border-radius: 25px;
    background: #2c2c2c;
    color: var(--text-light);
    font-size: 15px;
    transition: all 0.3s ease;
}
.search-box input:focus {
    border-color: var(--accent-blue);
    box-shadow: 0 0 0 4px rgba(59,130,246,0.2);
    outline: none;
}
.search-box i {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
}

/* Gallery Grid */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
    animation: fadeIn 0.6s ease-out;
}

/* Gallery Item */
.gallery-item {
    background: var(--card-bg);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 20px var(--shadow-color);
    position: relative;
    transition: all 0.4s ease;
}
.gallery-item:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 15px 40px var(--shadow-color);
}

/* Image wrapper */
.gallery-image-wrapper {
    position: relative;
    width: 100%;
    padding-top: 75%;
    overflow: hidden;
}
.gallery-image {
    position: absolute;
    top:0; left:0;
    width:100%; height:100%;
    object-fit: cover;
    transition: transform 0.4s ease;
    cursor: pointer;
}
.gallery-item:hover .gallery-image {
    transform: scale(1.1);
}

/* Overlay Actions */
.gallery-overlay {
    position: absolute;
    top:0; left:0; right:0; bottom:0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent 60%);
    opacity:0;
    display:flex;
    align-items:flex-end;
    justify-content:center;
    padding:20px;
    transition: opacity 0.3s ease;
}
.gallery-item:hover .gallery-overlay {
    opacity:1;
}
.gallery-actions {
    display:flex;
    gap:10px;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}
.gallery-item:hover .gallery-actions {
    transform: translateY(0);
}
.btn-action {
    width:45px; height:45px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    cursor:pointer;
    transition: all 0.3s ease;
}
.btn-view { background: var(--accent-blue); color:#fff; }
.btn-view:hover { background:#2563eb; transform:scale(1.15); }
.btn-download { background: var(--accent-green); color:#fff; }
.btn-download:hover { background:#059669; transform:scale(1.15); }
.btn-delete { background: var(--accent-red); color:#fff; }
.btn-delete:hover { background:#dc2626; transform:scale(1.15); }

/* Info Section */
.gallery-info {
    padding:15px 20px;
}
.gallery-title { font-weight:600; font-size:16px; color: var(--text-light); margin-bottom:5px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.gallery-meta { display:flex; justify-content:space-between; align-items:center; color: var(--text-muted); font-size:12px; gap:10px; }
.gallery-size { background:#2c2c2c; padding:4px 10px; border-radius:10px; font-weight:600; font-size:11px; }

/* Media Badge */
.media-badge { position:absolute; top:15px; right:15px; background: rgba(0,0,0,0.6); color:#fff; padding:6px 12px; border-radius:20px; font-size:11px; font-weight:600; backdrop-filter:blur(8px); z-index:10; }

/* Empty State */
.empty-state {
    text-align:center;
    padding:80px 20px;
    background: var(--card-bg);
    border-radius:20px;
    box-shadow: 0 10px 40px var(--shadow-color);
}
.empty-state-icon { font-size:80px; color: #555; margin-bottom:20px; }
.empty-state h3, .empty-state p { color: var(--text-light); }

/* Lightbox */
.lightbox { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.95); z-index:9999; align-items:center; justify-content:center; }
.lightbox.active { display:flex; }
.lightbox-content { position:relative; max-width:90%; max-height:90%; }
.lightbox-content img { max-width:100%; max-height:90vh; border-radius:10px; box-shadow:0 20px 60px var(--shadow-color); }
.lightbox-close { position:absolute; top:-50px; right:0; background:white; color:#1f2937; width:45px; height:45px; border-radius:50%; font-size:24px; cursor:pointer; transition:all 0.3s ease; }
.lightbox-close:hover { background: var(--accent-red); color:#fff; transform:rotate(90deg); }

/* Animations */
@keyframes slideDown { from {opacity:0; transform:translateY(-30px);} to {opacity:1; transform:translateY(0);} }
@keyframes fadeIn { from {opacity:0;} to {opacity:1;} }

@media (max-width:768px){
    .gallery-header { padding:25px; }
    .gallery-header h1 { font-size:28px; }
    .gallery-grid { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap:20px; }
}
</style>
@endpush

@section('content')
<div class="gallery-container">
    <div class="container">
        <div class="gallery-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-images me-3"></i>Image Gallery</h1>
                    <p>Browse and manage your beautiful collection of images</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('image-galleries.create') }}" class="btn-add-new"><i class="fas fa-plus me-2"></i>Add New Images</a>
                </div>
            </div>
        </div>

        <div class="filter-section">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search images by filename...">
            </div>
        </div>

        @if($media->count() > 0)
        <div class="gallery-grid" id="galleryGrid">
            @foreach($media as $image)
                <div class="gallery-item" data-filename="{{ strtolower($image->file_name) }}">
                    <div class="gallery-image-wrapper">
                        <img src="{{ $image->getUrl() }}" 
                             alt="{{ $image->file_name }}" 
                             class="gallery-image"
                             onclick="viewImage('{{ $image->getUrl() }}', '{{ $image->file_name }}', '{{ $image->human_readable_size }}')">
                        <div class="gallery-overlay">
                            <div class="gallery-actions">
                                <button class="btn-action btn-view" 
                                        onclick="viewImage('{{ $image->getUrl() }}', '{{ $image->file_name }}', '{{ $image->human_readable_size }}')" 
                                        title="View Image">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="{{ $image->getUrl() }}" download="{{ $image->file_name }}" class="btn-action btn-download" title="Download Image">
                                    <i class="fas fa-download"></i>
                                </a>
                                <!-- <button class="btn-action btn-delete" onclick="confirmDelete({{ $image->id }})" title="Delete Image">
                                    <i class="fas fa-trash"></i>
                                </button> -->
                            </div>
                        </div>
                    </div>
                    <div class="gallery-info">
                        <h3 class="gallery-title" title="{{ $image->file_name }}">{{ $image->file_name }}</h3>
                        <div class="gallery-meta">
                            <span class="gallery-date"><i class="far fa-calendar-alt"></i> {{ $image->created_at->format('M d, Y') }}</span>
                            <span class="gallery-size">{{ $image->human_readable_size }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $media->links() }}
        </div>
        @else
        <div class="empty-state">
            <div class="empty-state-icon"><i class="far fa-images"></i></div>
            <h3>No Images Yet</h3>
            <p>Start building your gallery by uploading your first images</p>
            <a href="{{ route('image-galleries.create') }}" class="btn-add-new"><i class="fas fa-plus me-2"></i>Upload Images</a>
        </div>
        @endif
    </div>
</div>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <div class="lightbox-content">
        <button class="lightbox-close" onclick="closeLightbox()"><i class="fas fa-times"></i></button>
        <img src="" alt="Gallery Image" id="lightboxImage">
        <div class="lightbox-info">
            <div id="lightboxFilename"></div>
            <div id="lightboxSize"></div>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const galleryItems = document.querySelectorAll('.gallery-item');
    galleryItems.forEach(item => {
        const filename = item.getAttribute('data-filename');
        if(filename.includes(searchTerm)){
            item.style.display='block';
            setTimeout(()=>{item.style.opacity='1'; item.style.transform='scale(1)';},10);
        } else {
            item.style.opacity='0';
            item.style.transform='scale(0.9)';
            setTimeout(()=>{item.style.display='none';},300);
        }
    });
});

function viewImage(url, name, size){
    document.getElementById('lightboxImage').src = url;
    document.getElementById('lightboxFilename').textContent = name;
    document.getElementById('lightboxSize').textContent = 'Size: '+size;
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(){
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = 'auto';
}

document.getElementById('lightbox').addEventListener('click', function(e){
    if(e.target === this) closeLightbox();
});

document.addEventListener('keydown', function(e){
    if(e.key==='Escape') closeLightbox();
});

function confirmDelete(mediaId){
    if(confirm('Are you sure you want to delete this image?')){
        const form=document.getElementById('deleteForm');
        form.action="{{ route('image-galleries.media.destroy', ':id') }}".replace(':id', mediaId);
        form.submit();
    }
}
</script>
@endpush
