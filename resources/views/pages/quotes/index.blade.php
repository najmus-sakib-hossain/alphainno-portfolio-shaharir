@extends('layouts.app')

@section('content')
<div class="pt-2 mx-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-header" style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color); position: relative;">
            All Quotes
        </h2>
        <a href="{{ route('quotes.create') }}" class="btn btn-primary add-btn rounded-pill px-4 py-2">
            <i class="bi bi-plus-circle me-1"></i> Add New
        </a>
    </div>

    <div class="card border-0 shadow-lg rounded-3" style="background: var(--card-background);">
        <div class="card-body p-0">
            <div class="table-responsive rounded rounded-lg">
                <table class="table align-middle table-dark table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: #ffffff;">
                        <tr>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">ID</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Quote</th>
                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600; width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quotes as $quote)
                        <tr class="text-center" style="transition: background 0.2s ease;">
                            <td style="font-size: 0.875rem; color: var(--text-secondary);">{{ $loop->iteration }}</td>
                            <td class="fw-normal" style="font-size: 0.875rem; color: var(--text-primary);">
                                {{ Str::limit($quote->quote_text, 100) }}
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('quotes.edit', $quote->id) }}" 
                                       class="btn btn-sm action-btn" 
                                       style="background: var(--edit-color); color: #ffffff;" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('quotes.destroy', $quote->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this quote?')" 
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
                            <td colspan="3" class="text-center py-5" style="font-size: 0.875rem; color: var(--text-secondary);">
                                <i class="bi bi-info-circle me-1"></i> No quotes found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                {{ $quotes->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        --primary-color: #8b5cf6;
        --secondary-color: #3b82f6;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --edit-color: #10b981;

        --body-background: #0f172a;
        --card-background: #242424;
        --text-primary: #ffffff;
        --text-secondary: #5e7b88;
        --table-row-hover: #2d3748;

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
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        height: 4px;
        border-radius: 4px;
        display: block;
        margin-top: 0.25rem;
    }

    .add-btn {
        background-color: var(--primary-color) !important;
        border: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
    }

    .add-btn:hover {
        background-color: var(--secondary-color) !important;
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
    }

    .table-dark {
        --bs-table-bg: var(--card-background);
        --bs-table-hover-bg: var(--table-row-hover);
        color: var(--text-primary);
        border: none;
    }

    .table-dark th, .table-dark td {
        border: none;
        font-size: 0.875rem;
        font-weight: 400;
    }

    .table-hover tbody tr:hover {
        background-color: var(--table-row-hover) !important;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50% !important;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-hover);
    }

    .pagination .page-link {
        background: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
        border-radius: 8px;
        margin: 0 3px;
        font-weight: 500;
    }

    .pagination .active .page-link {
        background-color: var(--primary-color);
        color: #ffffff;
        border-color: var(--primary-color);
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
