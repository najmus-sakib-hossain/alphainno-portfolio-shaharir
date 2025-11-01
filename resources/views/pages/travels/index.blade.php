@extends('layouts.app')

@section('title', 'Travel Map List')

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-blue: #2563eb;
    --color-accent-purple: #7c3aed;
    --color-accent-red: #dc2626;
    --color-accent-green: #059669;
    --color-border: #333;
    --color-shadow: rgba(0, 0, 0, 0.5);
}

body {
    background-color: var(--color-bg-primary);
    font-family: 'Inter', sans-serif;
}

.content-area {
    padding: 2rem;
}

.card-dark {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    box-shadow: 0 10px 25px var(--color-shadow);
    border: 1px solid var(--color-border);
    transition: transform 0.2s ease;
}

.card-dark:hover {
    transform: translateY(-2px);
}

.card-title-modern {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--color-text-accent);
    margin-bottom: 0.5rem;
}

.card-text {
    color: var(--color-text-light);
    font-size: 0.9rem;
}

.list-unstyled li {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
    color: var(--color-text-light);
}

.list-unstyled li img {
    height: 30px;
    width: auto;
    border-radius: 6px;
    margin-right: 0.5rem;
}

.btn-modern-red,
.btn-modern-blue {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.btn-modern-blue {
    background-color: var(--color-accent-blue);
    border-color: var(--color-accent-blue);
    color: #fff;
}

.btn-modern-blue:hover {
    background-color: var(--color-accent-purple);
    border-color: var(--color-accent-purple);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);
}

.btn-modern-red {
    background-color: var(--color-accent-red);
    border-color: var(--color-accent-red);
    color: #fff;
}

.btn-modern-red:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(233, 75, 60, 0.35);
}

.img-map {
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    margin-bottom: 1rem;
    object-fit: cover;
}

.card-footer {
    background: transparent;
    border-top: 1px solid var(--color-border);
}
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="card-title-modern">Travel Map List</h3>
        <a href="{{ route('travels.create') }}" class="btn btn-modern-blue"><i class="bi bi-plus-circle me-1"></i> Add New Travel</a>
    </div>

    <div class="row g-4">
        @forelse($travels as $travel)
        <div class="col-md-6">
            <div class="card card-dark h-100">
                <div class="card-body">
                    <h5 class="card-title-modern">{{ $travel->title }}</h5>
                    <p class="card-text">{{ $travel->content }}</p>

                    @if($travel->getFirstMediaUrl('map_image'))
                    <img src="{{ $travel->getFirstMediaUrl('map_image') }}" alt="Map Image" class="img-map">
                    @endif

                    @if($travel->countries && count($travel->countries) > 0)
                        <h6 class="text-light fw-bold">Countries:</h6>
                        <ul class="list-unstyled">
                            @foreach($travel->countries as $index => $country)
                                <li>
                                    @php $flag = $travel->getMedia('country_flags')[$index] ?? null; @endphp
                                    @if($flag)
                                        <img src="{{ $flag->getUrl() }}" alt="Flag">
                                    @endif
                                    {{ $country }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('travels.edit', $travel->id) }}" class="btn btn-modern-blue btn-sm me-1"><i class="bi bi-pencil-square"></i> Edit</a>
                    <button type="submit" data-delete-route="{{ route('travels.destroy', $travel->id) }}" class="delete-item-btn btn btn-modern-red btn-sm"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>
        @empty
        <p class="text-light">No travel maps found.</p>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
@include('components.delete-confirmation')
@endpush
