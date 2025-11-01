@extends('layouts.app')

@section('content')
<div class="container pt-4 pt-md-2 min-vh-100">

    <!-- Header and Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="title-header" style="font-size: 1,5rem; font-weight: 700; color: var(--primary-color); position: relative;">
            Associates
            <span class="title-underline"></span>
        </h4>
        <a href="{{ route('associates.create') }}" class="btn btn-primary add-btn rounded-pill px-4 py-2">
            <i class="bi bi-plus-circle me-1"></i> Add New Associate
        </a>
    </div>

    <!-- Associates Table Card -->
    <div class="card border-0 shadow-lg rounded-3" style="background: var(--card-background);">
        <div class="card-body p-0">
            <div class="table-responsive rounded rounded-lg">
                <table class="table align-middle table-dark table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: #ffffff;">
                        <tr>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">ID</th>
                            <th class="text-start py-3" style="font-size: 0.875rem; font-weight: 600;">Title</th>
                            <th class="text-start py-3" style="font-size: 0.875rem; font-weight: 600;">Description</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Background Image</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Status</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600; width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($associates as $associate)
                        <tr style="transition: background 0.2s ease;">
                            <td class="text-center" style="font-size: 0.875rem; color: var(--text-secondary);">{{ $associate->id }}</td>
                            <td class="fw-semibold text-start" style="font-size: 0.875rem; color: var(--text-primary);">{{ $associate->title }}</td>
                            <td class="text-start" style="font-size: 0.875rem; color: var(--text-secondary);">{{ Str::limit($associate->description, 50) }}</td>
                            <td class="text-center">
                                @if($associate->background_image)
                                    <div class="image-badge img-badge">
                                        <img src="{{ asset('storage/'.$associate->background_image) }}" 
                                             alt="Background Image" 
                                             width="48" 
                                             height="48" 
                                             class="rounded-circle" 
                                             style="object-fit: cover; border: 2px solid #60a5fa;">
                                    </div>
                                @else
                                    <div class="image-badge user-badge">No Img</div>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($associate->is_active)
                                    <span class="badge px-3 py-2" style="background-color: var(--success-color); color: #ffffff;">Active</span>
                                @else
                                    <span class="badge px-3 py-2" style="background-color: var(--danger-color); color: #ffffff;">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('associates.show', $associate->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background-color: var(--info-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('associates.edit', $associate->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background-color: var(--edit-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('associates.destroy', $associate->id) }}" 
                                          method="POST" 
                                          class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm action-btn" 
                                                style="background-color: var(--danger-color); color: #ffffff;" 
                                                data-bs-toggle="tooltip" 
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5" style="font-size: 0.875rem; color: var(--text-secondary);">
                                <i class="bi bi-info-circle me-1"></i> No associates found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        /* Dark Theme Palette */
        --primary-color: #8b5cf6;
        --secondary-color: #3b82f6;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --info-color: #3b82f6;
        --edit-color: #10b981;
        --body-background: #0f172a;
        --card-background: #1a1a1a;
        --text-primary: #ffffff;
        --text-secondary: #c9d6e7;
        --table-row-hover: #334155;
        --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.4);
        --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.5);
        --shadow-hover: 0 8px 16px rgba(139, 92, 246, 0.2);
    }

    body {
        background-color: var(--body-background) !important;
        color: var(--text-primary);
        font-family: 'Inter', sans-serif;
    }

    .title-header {
        color: var(--primary-color) !important;
    }
    .title-underline {
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color)) !important;
        height: 4px !important;
        border-radius: 4px !important;
    }

    .add-btn {
        background-color: var(--primary-color) !important;
        border: none;
        font-size: 0.95rem;
        font-weight: 600;
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
    .card-body.p-0 {
        overflow: hidden;
    }

    .table-dark {
        --bs-table-bg: var(--card-background);
        --bs-table-striped-bg: #2d3748;
        --bs-table-hover-bg: var(--table-row-hover);
        color: var(--text-primary);
        border: none;
    }
    .table-dark thead th, .table-dark td, .table-dark th {
        border-bottom: none;
    }
    .table-hover tbody tr:hover {
        background-color: var(--table-row-hover) !important;
    }

    .action-btn {
        width: 38px;
        height: 38px;
        border-radius: 50% !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .action-btn:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-hover);
    }

    .badge {
        min-width: 70px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
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
            font-size: 0.75rem;
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
