@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Donation Details</h4>

    <div class="card mt-3">
        <div class="card-body">
            @if($donation->image)
                <img src="{{ asset('storage/' . $donation->image) }}" width="300" class="rounded mb-4">
            @endif

            <h5><strong>Title:</strong> {{ $donation->title }}</h5>
            <p><strong>Button Text:</strong> {{ $donation->button_text ?? '—' }}</p>
            <p><strong>Donation Link:</strong> 
                @if($donation->donation_link)
                    <a href="{{ $donation->donation_link }}" target="_blank">{{ $donation->donation_link }}</a>
                @else
                    <span class="text-muted">No link</span>
                @endif
            </p>
            <p><strong>Description:</strong></p>
            <p>{{ $donation->description ?? 'No description available.' }}</p>
            <p><strong>Order No:</strong> {{ $donation->order_no }}</p>
            <p><strong>Status:</strong>
                @if($donation->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </p>
        </div>
    </div>

    <a href="{{ route('donations.index') }}" class="btn btn-primary mt-4">Back</a>
</div>
@endsection
