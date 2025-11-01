<div class="sidebar-wrapper bg-white" style="background-color: #242424 !important;">
  <nav class="mt-2">
    <!--begin::Sidebar Menu-->
    <ul
      class="nav sidebar-menu flex-column"
      data-lte-toggle="treeview"
      role="navigation"
      aria-label="Main navigation"
      data-accordion="false"
      id="navigation"
    >
      <!--begin::Dashboard-->
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-palette"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <!--end::Dashboard-->

      <!--begin::Home-->
      <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-house"></i>
          <p>
            Home
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('main.page.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Home-->

      <!--begin::About Me-->
      <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-file-earmark-person"></i>
          <p>
            About Me
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('banners.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Banner </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('awards.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Awards </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('stories.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Story </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('impacts.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Impacts </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('reports.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Quotes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('travels.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Travel </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('corporates.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Corporate </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('philosophies.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Philosophy </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('associates.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Associate </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('image-galleries.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Image Gallery </p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::About Me-->


      <!--begin::Publications-->
      {{-- <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-feather"></i>
          <p>
            Publications
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li> --}}
      <!--end::Publications-->

      <!--begin::Books-->
      <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-book"></i>
          <p>
            Books
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('book-banners.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Books Banner</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('recommended-books.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Recommended Books</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('publication-summery.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Publication Summery</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Books-->

      <!--begin::Events-->
      <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-calendar-event"></i>
          <p>
            Events
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('events.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>All Events</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('events.create') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Create Event</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Events-->

      <!--begin::Blogs-->
      <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-substack"></i>
          <p>
            Blogs
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('blogs.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>All Blogs</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('blogs.create') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Create Blog</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Blogs-->

      <!--begin::Technology-->
      <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-cpu"></i>
          <p>
            Technology
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('technology.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Banner</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('certificates.index')}}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Certificate</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('cybers.index')}}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Cyber Security</p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="{{ route('technology.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Technology</p>
            </a>
          </li> --}}
        
        </ul>
      </li>
      <!--end::Technology-->


      <!--begin::Donation-->
      <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-archive"></i>
          <p>
            Donation
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('donation-banners.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Banner</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('donations.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Donation</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Donation-->

      <!--begin::entrepreneurship-->
      <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-archive"></i>
          <p>
            Entrepreneurship
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('enterpreneurship-banners.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Banner</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('innovations.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Innoovation</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('quotes.index') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Quote</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::entrepreneurship-->

      <!--begin::Videos-->
      {{-- <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-camera-reels"></i>
          <p>
            Videos
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li> --}}
      <!--end::Videos-->

      <!--begin::Life Events-->
      {{-- <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-calendar-event"></i>
          <p>
            Life Events
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li> --}}
      <!--end::Life Events-->

      <!--begin::Social Media-->
      <li class="nav-item">
        <a href="{{ route('social-links') }}" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-phone"></i>
          <p>Social Media</p>
        </a>
      </li>
      <!--end::Social Media-->

      <!--begin::Contacts-->
      {{-- <li class="nav-item">
        <a href="#" class="nav-link" style="color: #9ca3af !important;">
          <i class="nav-icon bi bi-person-lines-fill"></i>
          <p>
            Contacts
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" style="color: #9ca3af !important;">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li> --}}
      <!--end::Contacts-->
    </ul>
    <!--end::Sidebar Menu-->
  </nav>
</div>
