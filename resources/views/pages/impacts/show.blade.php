@extends('layouts.app')

@section('title')
    View Impact
@endsection

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-red: #e94b3c;
    --color-accent-green: #2ecc71;
    --color-border: #333333;
    --color-shadow: rgba(0, 0, 0, 0.5);
}

body {
    background-color: var(--color-bg-primary);
    font-family: 'Inter', sans-serif;
}

.content-area {
    padding: 2rem;
    min-height: 100vh;
}

.card-dark {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    box-shadow: 0 10px 30px var(--color-shadow);
    border: 1px solid var(--color-border);
    padding: 2rem;
    margin-bottom: 2rem;
}

.card-header-dark {
    background-color: var(--color-bg-primary);
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 15px 20px;
    border-bottom: 1px solid var(--color-border);
    text-align: center;
}

.card-title-modern {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--color-text-accent);
    letter-spacing: 0.3px;
    margin-bottom: 1rem;
}

.text-light {
    color: var(--color-text-light);
}

.img-preview {
    max-width: 150px;
    max-height: 150px;
    object-fit: cover;
    border-radius: 12px;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    border: 1px solid var(--color-border);
}

.btn-modern-red,
.btn-modern-green {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.25);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.btn-modern-red {
    background-color: var(--color-accent-red);
    border-color: var(--color-accent-red);
    color: #ffffff;
}

.btn-modern-red:hover {
    background-color: #c0392b;
    border-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(233, 75, 60, 0.35);
}

.btn-modern-green {
    background-color: var(--color-accent-green);
    border-color: var(--color-accent-green);
    color: #ffffff;
}

.btn-modern-green:hover {
    background-color: #27ae60;
    border-color: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);
}

.ul-points {
    list-style: disc;
    padding-left: 1.5rem;
}

.ul-points li {
    margin-bottom: 0.5rem;
    color: var(--color-text-light);
}
</style>
@endpush

@section('content')
<div class="content-area">
    <div class="card card-dark">
        <div class="card-header-dark">
            <h3 class="card-title-modern">{{ $impact->title }}</h3>
        </div>
        <div class="card-body">
            <p class="text-light mb-2"><strong>Type:</strong> {{ ucfirst($impact->type) }}</p>
            @if($impact->description)
                <p class="text-light mb-4">{{ $impact->description }}</p>
            @endif

            <div class="mb-4 d-flex flex-wrap">
                @for($i=1; $i<=4; $i++)
                    @php $img = 'image'.$i.'_path'; @endphp
                    @if($impact->$img)
                        <img src="{{ asset('storage/'.$impact->$img) }}" class="img-preview">
                    @endif
                @endfor
            </div>

            @if($impact->points->count())
                <div class="mb-4">
                    <h5 class="text-light mb-2">Impact Points:</h5>
                    <ul class="ul-points">
                        @foreach($impact->points as $point)
                            <li>{{ $point->point }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-flex gap-2">
                <a href="{{ route('impacts.edit', $impact->id) }}" class="btn-modern-green"><i class="fas fa-pencil-alt me-1"></i> Edit</a>
                <a href="{{ route('impacts.index') }}" class="btn-modern-red"><i class="fas fa-arrow-left me-1"></i> Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
