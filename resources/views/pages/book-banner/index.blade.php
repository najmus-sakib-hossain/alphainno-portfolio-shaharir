@extends('layouts.app')

@section('title', 'Book Banners')

@section('content')
<div class="container pt-4 pt-md-2 min-vh-100">

    <!-- Header and Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="title-header" style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color); position: relative;">
            </i>Book Banners
            <span class="title-underline"></span>
        </h4>
        <a href="{{ route('book-banners.create') }}" class="btn btn-primary add-btn rounded-pill px-4 py-2">
            <i class="bi bi-plus-lg me-1"></i>Add New
        </a>
    </div>

    @if($bookBanners->count() > 0)
        <div class="table-responsive shadow-lg rounded-4">
            <table class="table align-middle table-dark table-hover mb-0">
                <thead style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: #ffffff;">
                    <tr>
                        <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">ID</th>
                        <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Image</th>
                        <th class="text-start py-3" style="font-size: 0.875rem; font-weight: 600;">Title</th>
                        <th class="text-start py-3" style="font-size: 0.875rem; font-weight: 600;">Description</th>
                        <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Price</th>
                        <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600; width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookBanners as $index => $banner)
                        <tr style="transition: background 0.2s ease;">
                            <td class="text-center" style="font-size: 0.875rem; font-weight: 400; color: var(--text-secondary);">{{ $index + 1 }}</td>

                            <td class="text-center">
                                @if($banner->hasMedia('book_banner_image'))
                                    <div class="image-badge img-badge">
                                        <img src="{{ $banner->getFirstMediaUrl('book_banner_image') }}" 
                                             alt="{{ $banner->title }}" 
                                             width="48" height="48" 
                                             class="rounded-circle" 
                                             style="object-fit: cover; border: 2px solid #60a5fa;">
                                    </div>
                                @else
                                    <div class="image-badge user-badge">No Img</div>
                                @endif
                            </td>

                            <td class="text-start" style="font-size: 0.875rem; font-weight: 400; color: var(--text-primary);">{{ $banner->title }}</td>

                            <td class="text-start text-truncate" style="max-width: 250px; font-size: 0.875rem; font-weight: 400; color: var(--text-secondary);">
                                {{ $banner->description ?? '—' }}
                            </td>

                            <td class="text-center" style="font-size: 0.875rem; font-weight: 400;">
                                @if($banner->price)
                                    <span class="badge px-3 py-2" style="background-color: var(--success-color); color: #ffffff;">
                                        <i class="bi bi-currency-dollar me-1"></i>{{ $banner->price }}
                                    </span>
                                @else
                                    <span class="text-muted" style="color: var(--text-secondary);">—</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('book-banners.show', $banner->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background-color: var(--info-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="View">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('book-banners.edit', $banner->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background-color: var(--edit-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('book-banners.destroy', $banner->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm action-btn" 
                                                style="background-color: var(--danger-color); color: #ffffff;" 
                                                data-bs-toggle="tooltip" 
                                                title="Delete">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $bookBanners->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076505.png" width="120" class="mb-3 opacity-75" alt="No Data">
            <h5 class="text-secondary">No Book Banners Found</h5>
        </div>
    @endif
</div>

@push('styles')
<style>
    :root {
        --primary-color: #8b5cf6;
        --secondary-color: #3b82f6;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --info-color: #3b82f6;
        --edit-color: #10b981;
        --card-background: #1a1a1a;
        --text-primary: #ffffff;
        --text-secondary: #c9d6e7;
        --table-row-hover: #334155;
        --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.4);
        --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.5);
        --shadow-hover: 0 8px 16px rgba(139, 92, 246, 0.2);
    }

    body {
        background-color: var(--body-background, #0f172a);
        color: var(--text-primary);
        font-family: 'Inter', sans-serif;
    }

    .title-header {
        color: var(--primary-color) !important;
        position: relative;
    }
    .title-underline {
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color)) !important;
        height: 4px !important;
        border-radius: 4px !important;
    }

    .add-btn {
        background-color: var(--primary-color) !important;
        border: none;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
    }
    .add-btn:hover {
        background-color: var(--secondary-color) !important;
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
    }

    .card.shadow-lg {
        box-shadow: var(--shadow-lg) !important;
    }

    .table-dark {
        --bs-table-bg: var(--card-background);
        --bs-table-striped-bg: #2d3748;
        --bs-table-hover-bg: var(--table-row-hover);
        color: var(--text-primary);
        border: none;
    }

    .table-dark thead th {
        border-bottom: none;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .table-dark td {
        border-bottom: none;
        font-size: 0.875rem;
        font-weight: 400;
    }

    .table-hover tbody tr:hover {
        background-color: var(--table-row-hover) !important;
    }

    .action-btn {
        width: 38px;
        height: 38px;
        border-radius: 50% !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        transition: transform 0.2s ease;
    }
    .action-btn:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-hover);
    }

    .badge {
        min-width: 70px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .image-badge {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
        color: #ffffff;
        text-transform: uppercase;
    }

    .img-badge {
        background-color: var(--info-color);
        border: 2px solid #60a5fa;
    }

    .user-badge {
        background-color: var(--danger-color);
        border: 2px solid #f87171;
    }

    @media (max-width: 767.98px) {
        .title-header {
            font-size: 1.5rem !important;
        }
        .add-btn {
            font-size: 0.8rem !important;
            padding: 0.5rem 1rem !important;
        }
        .table th, .table td {
            padding: 0.75rem;
            font-size: 0.875rem;
        }
        .action-btn {
            width: 32px;
            height: 32px;
        }
        .image-badge {
            width: 40px;
            height: 40px;
            font-size: 0.625rem;
        }
        .badge {
            font-size: 0.625rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
</script>
@endpush
@endsection
