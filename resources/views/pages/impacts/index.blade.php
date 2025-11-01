@extends('layouts.app')

@section('content')
<div class="pt-2 mx-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-header" style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color); position: relative;">
            Impacts
            <span class="title-underline"></span>
        </h2>
        <a href="{{ route('impacts.create') }}" class="btn btn-primary add-btn rounded-pill px-4 py-2">
            <i class="bi bi-plus-circle me-1"></i> Add New Impact
        </a>
    </div>

    <div class="card border-0 shadow-lg rounded-3" style="background: var(--card-background);">
        <div class="card-body p-0">
            <div class="table-responsive rounded rounded-lg">
                <table class="table align-middle table-dark table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: #ffffff;">
                        <tr>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">ID</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Type</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Title</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Images</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Status</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600; width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($impacts as $impact)
                        <tr style="transition: background 0.2s ease;">
                            <td class="text-center" style="font-size: 0.875rem; color: var(--text-secondary);">{{ $impact->id }}</td>
                            <td class="text-center" style="font-size: 0.875rem; color: var(--text-secondary);">{{ ucfirst($impact->type) }}</td>
                            <td class="fw-semibold text-center" style="font-size: 0.875rem; color: var(--text-primary);">{{ $impact->title }}</td>
                            <td class="text-center">
                                @for($i = 1; $i <= 4; $i++)
                                    @php $img = 'image' . $i . '_path'; @endphp
                                    @if($impact->$img)
                                        <img src="{{ asset('storage/'.$impact->$img) }}" 
                                             alt="Impact Image" 
                                             width="50" 
                                             class="img-thumbnail rounded shadow-sm me-1 mb-1" 
                                             style="border: none; transition: transform 0.2s ease;">
                                    @endif
                                @endfor
                            </td>
                            <td class="text-center">
                                @if($impact->is_active)
                                    <span class="badge px-3 py-2" style="background: var(--success-color); color: #ffffff;">Active</span>
                                @else
                                    <span class="badge px-3 py-2" style="background: var(--danger-color); color: #ffffff;">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('impacts.show', $impact->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background: var(--info-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('impacts.edit', $impact->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background: var(--edit-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('impacts.destroy', $impact->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Delete this impact?')" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm action-btn" 
                                                style="background: var(--danger-color); color: #ffffff;" 
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
                                <i class="bi bi-info-circle me-1"></i> No impacts found.
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
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color) !important;
        position: relative;
        padding-bottom: 0.5rem;
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
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
    }

    .table-dark td, .table-dark th {
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
        transition: all 0.3s ease;
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

    .img-thumbnail:hover {
        transform: scale(1.05);
    }

    @media (max-width: 767.98px) {
        .title-header {
            font-size: 1.5rem;
        }
        .add-btn {
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
        }
        .table th, .table td {
            font-size: 0.75rem;
            padding: 0.75rem;
        }
        .action-btn {
            width: 32px;
            height: 32px;
        }
        .img-thumbnail {
            width: 40px;
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
