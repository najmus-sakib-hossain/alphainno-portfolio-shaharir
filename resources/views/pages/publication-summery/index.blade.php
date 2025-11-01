@extends('layouts.app')

@section('title', 'Publication Summaries')

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-muted: #888888;
    --color-accent-green: #2ecc71;
    --color-accent-red: #e94b3c;
    --color-accent-yellow: #f59e0b;
    --color-border: #333333;
    --color-shadow: rgba(0, 0, 0, 0.5);
}

body {
    background-color: var(--color-bg-primary);
}

.container {
    max-width: 1200px;
    padding-top: 2rem;
    padding-bottom: 2rem;
}

h2.text-primary {
    color: var(--color-text-light) !important;
}

.card-dark {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    box-shadow: 0 6px 20px var(--color-shadow);
    border: 1px solid var(--color-border);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.card-dark img,
.card-dark .no-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.no-image {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #2c2c2c;
    color: var(--color-text-muted);
    flex-direction: column;
}

.card-body-dark {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    padding: 1rem;
    color: var(--color-text-light);
}

.card-text-dark {
    flex-grow: 1;
    color: var(--color-text-muted);
}

.btn-sm-dark {
    font-size: 0.8rem;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    text-decoration: none;
}

.btn-edit {
    background: #f59e0b;
    color: #ffffff;
    border: none;
}

.btn-edit:hover {
    background: #d97706;
}

.btn-delete {
    background: var(--color-accent-red);
    color: #ffffff;
    border: none;
}

.btn-delete:hover {
    background: #c0392b;
}

.card-footer-dark {
    background-color: #2c2c2c;
    color: var(--color-text-muted);
    font-size: 0.8rem;
    text-align: center;
    padding: 0.5rem;
}
</style>
@endpush

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0 text-white">
            <i class="bi bi-journal-text me-2"></i>Publication Summaries
        </h2>
        <a href="{{ route('publication-summery.create') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-lg me-2"></i>Add New
        </a>
    </div>

    @if($publicationSummaries->isEmpty())
        <div class="text-center text-muted py-5">
            <i class="bi bi-journal-bookmark fs-1"></i>
            <p class="mt-3 mb-0">No publication summaries found.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($publicationSummaries as $summary)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-dark">

                        @if($summary->hasMedia('publication_images'))
                            <img src="{{ $summary->getFirstMediaUrl('publication_images') }}" 
                                 alt="Publication Image">
                        @else
                            <div class="no-image">
                                <i class="bi bi-image fs-1"></i>
                                <span>No Image</span>
                            </div>
                        @endif

                        <div class="card-body-dark">
                            <p class="card-text-dark">{{ $summary->content }}</p>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('publication-summery.edit', $summary->id) }}" 
                                   class="btn btn-edit btn-sm btn-sm-dark">
                                    <i class="bi bi-pencil-square"></i>Edit
                                </a>

                                <form action="{{ route('publication-summery.destroy', $summary->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-sm btn-sm-dark"
                                            onclick="return confirm('Are you sure you want to delete this summary?');">
                                        <i class="bi bi-trash3"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-footer-dark">
                            Created at: {{ $summary->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
