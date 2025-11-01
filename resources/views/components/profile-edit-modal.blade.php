<!-- Trigger Button -->
{{-- <button type="button" class="btn btn-info btn-flat flex-grow-1" onclick="openProfileModal(event)" style="border-radius: 50px;">
    <i class="bi bi-pencil-square me-1"></i> Edit Profile
</button> --}}

<!-- Custom Modal Overlay -->
<div id="profileModalOverlay" class="profile-modal-overlay" onclick="closeProfileModal()">
    <!-- Modal Container -->
    <div class="profile-modal-container" onclick="event.stopPropagation()">
        <!-- Modal Header -->
        {{-- <div class="profile-modal-header">
            <h3 class="profile-modal-title">
                <i class="bi bi-person-circle me-2"></i>Edit Profile
            </h3>
            <button type="button" class="profile-modal-close" onclick="closeProfileModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div> --}}

        <!-- Modal Body -->
        <div class="profile-modal-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileUpdateForm">
                @csrf
                @method('PATCH')

                <!-- Profile Image Section -->
                <div class="profile-image-section">
                    <div class="profile-image-wrapper">
                        <img id="profileImagePreview" 
                             src="{{ Auth::user() && Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/shahriar_khan_philosophy-B1MpPTGw.png') }}" 
                             alt="Profile Preview" 
                             class="profile-preview-image">
                        <div class="profile-image-badge">
                            <i class="bi bi-camera-fill"></i>
                        </div>
                    </div>
                    <div class="profile-upload-section">
                        <label for="profile_image" class="profile-upload-btn">
                            <i class="bi bi-upload me-2"></i>Choose New Photo
                        </label>
                        <input type="file" 
                               id="profile_image" 
                               name="profile_image" 
                               accept="image/*"
                               style="display: none;"
                               onchange="previewProfileImage(event)">
                        <p class="profile-upload-hint">PNG, JPG, GIF up to 2MB</p>
                        @error('profile_image')
                            <p class="profile-error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="profile-divider"></div>

                <!-- Name Input -->
                <div class="profile-form-group">
                    <label for="profile_name" class="profile-form-label">
                        <i class="bi bi-person-fill me-2"></i>Full Name
                    </label>
                    <input type="text" 
                           class="profile-form-input @error('name') profile-form-input-error @enderror" 
                           id="profile_name" 
                           name="name" 
                           value="{{ old('name', Auth::user()->name) }}"
                           placeholder="Enter your full name"
                           required>
                    @error('name')
                        <p class="profile-error-text">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="profile-form-group">
                    <label for="profile_email" class="profile-form-label">
                        <i class="bi bi-envelope-fill me-2"></i>Email Address
                    </label>
                    <input type="email" 
                           class="profile-form-input @error('email') profile-form-input-error @enderror" 
                           id="profile_email" 
                           name="email" 
                           value="{{ old('email', Auth::user()->email) }}"
                           placeholder="Enter your email"
                           required>
                    @error('email')
                        <p class="profile-error-text">{{ $message }}</p>
                    @enderror
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="profile-modal-footer">
            <button type="button" class="profile-btn profile-btn-cancel" onclick="closeProfileModal()">
                <i class="bi bi-x-circle me-2"></i>Cancel
            </button>
            <button type="submit" form="profileUpdateForm" class="profile-btn profile-btn-save">
                <i class="bi bi-check-circle me-2"></i>Save Changes
            </button>
        </div>
    </div>
</div>

<style>
    :root {
        --background: oklch(0.145 0 0);
        --foreground: oklch(0.985 0 0);
        --card: oklch(0.205 0 0);
        --card-foreground: oklch(0.985 0 0);
        --popover: oklch(0.269 0 0);
        --popover-foreground: oklch(0.985 0 0);
        --primary: oklch(0.922 0 0);
        --primary-foreground: oklch(0.205 0 0);
        --secondary: oklch(0.269 0 0);
        --secondary-foreground: oklch(0.985 0 0);
        --muted: oklch(0.269 0 0);
        --muted-foreground: oklch(0.708 0 0);
        --accent: oklch(0.371 0 0);
        --accent-foreground: oklch(0.985 0 0);
        --destructive: oklch(0.704 0.191 22.216);
        --border: oklch(1 0 0 / 10%);
        --input: oklch(1 0 0 / 15%);
        --ring: oklch(0.556 0 0);
        --chart-1: var(--color-blue-300);
        --chart-2: var(--color-blue-500);
        --chart-3: var(--color-blue-600);
        --chart-4: var(--color-blue-700);
        --chart-5: var(--color-blue-800);
        --sidebar: oklch(0.205 0 0);
        --sidebar-foreground: oklch(0.985 0 0);
        --sidebar-primary: oklch(0.488 0.243 264.376);
        --sidebar-primary-foreground: oklch(0.985 0 0);
        --sidebar-accent: oklch(0.269 0 0);
        --sidebar-accent-foreground: oklch(0.985 0 0);
        --sidebar-border: oklch(1 0 0 / 10%);
        --sidebar-ring: oklch(0.439 0 0);
        --surface: oklch(0.2 0 0);
        --surface-foreground: oklch(0.708 0 0);
        --code: var(--surface);
        --code-foreground: var(--surface-foreground);
        --code-highlight: oklch(0.27 0 0);
        --code-number: oklch(0.72 0 0);
        --selection: oklch(0.922 0 0);
        --selection-foreground: oklch(0.205 0 0);
    }

    .profile-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 10000;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.2s ease;
    }

    .profile-modal-overlay.active {
        display: flex !important;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { 
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        to { 
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .profile-modal-container {
        background: var(--background);
        border-radius: 1rem;
        width: 90%;
        max-width: 600px;
        max-height: 90vh;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.3s ease;
        color: var(--foreground);
    }

    .profile-modal-header {
        background: var(--accent);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .profile-modal-title {
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .profile-modal-close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .profile-modal-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .profile-modal-body {
        padding: 2rem;
        max-height: 60vh;
        overflow-y: auto;
    }

    .profile-image-section {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .profile-image-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .profile-preview-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--primary);
    }

    .profile-image-badge {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: var(--primary-foreground);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .profile-upload-section {
        margin-top: 1rem;
    }

    .profile-upload-btn {
        display: inline-block;
        background: var(--secondary);
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }

    .profile-upload-btn:hover {
        transform: translateY(-2px);
    }

    .profile-upload-hint {
        color: var(--muted-foreground);
        font-size: 0.875rem;
        margin-top: 0.5rem;
        margin-bottom: 0;
    }

    .profile-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--border), transparent);
        margin: 1.5rem 0;
    }

    .profile-form-group {
        margin-bottom: 1.5rem;
    }

    .profile-form-label {
        display: block;
        font-weight: 600;
        color: var(--foreground);
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }

    .profile-form-input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid var(--border);
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: all 0.2s;
        background: var(--background);
        color: var(--foreground);
    }

    .profile-form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .profile-form-input-error {
        border-color: #ef4444;
    }

    .profile-error-text {
        color: var(--destructive);
        font-size: 0.875rem;
        margin-top: 0.5rem;
        margin-bottom: 0;
    }

    .profile-modal-footer {
        padding: 1.5rem;
        background: var(--background);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        border-top: 2px solid var(--border);
        color: var(--foreground);
    }

    .profile-btn {
        padding: 0.75rem 1.75rem;
        border-radius: 50px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        font-size: 1rem;
    }

    .profile-btn-cancel {
        background: var(--secondary);
        color: var(--secondary-foreground);
    }

    .profile-btn-cancel:hover {
        background: #4b5563;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
    }

    .profile-btn-save {
        background: var(--accent);
        color: var(--accent-foreground);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .profile-btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
    }
</style>

<script>
    function openProfileModal(event) {
        // Prevent event bubbling
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        // Close any open dropdowns
        const dropdowns = document.querySelectorAll('.dropdown-menu.show');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('show');
        });
        
        // Open modal
        const overlay = document.getElementById('profileModalOverlay');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeProfileModal() {
        const overlay = document.getElementById('profileModalOverlay');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    function previewProfileImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImagePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeProfileModal();
        }
    });
</script>

<!-- Success Toast Notification -->
@if (session('status') === 'profile-updated')
<div id="successToast" class="success-toast">
    <i class="bi bi-check-circle-fill me-2"></i>
    Profile updated successfully!
</div>

<style>
    .success-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: var(--accent);
        color: var(--accent-foreground);
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
        z-index: 10001;
        animation: slideInRight 0.3s ease, fadeOut 0.3s ease 2.7s;
        font-weight: 600;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
</style>

<script>
    setTimeout(() => {
        const toast = document.getElementById('successToast');
        if (toast) {
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
</script>
@endif
