<nav class="app-header navbar navbar-expand bg-body border-bottom border-4 " style=" background-color:#000000 !important">
    <div class="container-fluid">
        <ul class="navbar-nav" style="color:aliceblue !important;">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list" style="color:aliceblue !important"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link"
                    style="color:aliceblue !important">Home</a></li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen" style="color:aliceblue !important"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link" onclick="toggleUserDropdown(event)" id="userDropdownToggle">
                    <img src="{{ Auth::user() && Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/shahriar_khan_philosophy-B1MpPTGw.png') }}" 
                         class="user-image rounded-circle shadow me-2"
                         alt="User Image" 
                         style="width: 32px; height: 32px; object-fit: cover;" />
                    {{-- <span class="d-inline" style="color:aliceblue !important">{{ Auth::user() ? Auth::user()->name : 'Guest' }}</span> --}}
                </a>
                
                <!-- Custom Dropdown Menu -->
                <div id="userDropdownMenu" class="custom-dropdown-menu">
                    <div class="user-header-custom">
                        <img src="{{ Auth::user() && Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/shahriar_khan_philosophy-B1MpPTGw.png') }}" 
                             class="user-header-image" 
                             alt="User Image" />
                        <p class="user-header-name">
                            {{ Auth::user() ? Auth::user()->name : 'Guest' }}
                        </p>
                        <p class="user-header-email">
                            {{ Auth::user() ? Auth::user()->email : '' }}
                        </p>
                    </div>
                    <div class="user-footer-custom">
                        <button type="button" class="custom-dropdown-btn custom-dropdown-btn-edit" onclick="openProfileModalFromDropdown(event)">
                            <i class="bi bi-pencil-square me-2"></i>Edit
                        </button>
                        <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit()" 
                                class="custom-dropdown-btn custom-dropdown-btn-logout">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<style>
    .custom-dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        min-width: 280px;
        margin-top: 0.5rem;
        overflow: hidden;
        z-index: 1000;
        animation: dropdownSlideIn 0.2s ease;
    }

    .custom-dropdown-menu.show {
        display: block;
    }

    @keyframes dropdownSlideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .user-header-custom {
        background: #121212ff;
        padding: 1.5rem;
        text-align: center;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .user-header-image {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.3);
        margin-bottom: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .user-header-name {
        margin: 0.5rem 0 0.25rem 0;
        font-size: 1.1rem;
        font-weight: 700;
    }

    .user-header-email {
        margin: 0;
        font-size: 0.875rem;
        opacity: 0.9;
    }

    .user-footer-custom {
        padding: 1rem;
        background: #0a0a0aff;
        display: flex;
        gap: 0.75rem;
    }

    .custom-dropdown-btn {
        flex: 1;
        padding: 0.75rem 1rem;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
    }

    .custom-dropdown-btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    .custom-dropdown-btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .custom-dropdown-btn-logout {
        background: #dc3545;
        color: white;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }

    .custom-dropdown-btn-logout:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    }

    .user-menu {
        position: relative;
    }
</style>

<script>
    function toggleUserDropdown(event) {
        event.preventDefault();
        event.stopPropagation();
        const dropdown = document.getElementById('userDropdownMenu');
        dropdown.classList.toggle('show');
    }

    function openProfileModalFromDropdown(event) {
        event.preventDefault();
        event.stopPropagation();
        
        // Close dropdown
        const dropdown = document.getElementById('userDropdownMenu');
        dropdown.classList.remove('show');
        
        // Open modal immediately
        setTimeout(() => {
            openProfileModal(event);
        }, 100);
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdownMenu');
        const toggle = document.getElementById('userDropdownToggle');
        
        if (dropdown && !dropdown.contains(event.target) && !toggle.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });
</script>

<!-- Include Profile Edit Modal -->
@include('components.profile-edit-modal')
