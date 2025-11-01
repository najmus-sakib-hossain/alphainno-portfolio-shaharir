@extends('layouts.app')

@section('title', 'Recommended Books')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">
            <i class="bi bi-book-half me-2"></i>Recommended Books
        </h2>
        <a href="{{ route('recommended-books.create') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-lg me-2"></i>Add New
        </a>
    </div>

    @if($recommendedBooks->isEmpty())
        <div class="text-center text-muted py-5">
            <i class="bi bi-images fs-1"></i>
            <p class="mt-3 mb-0">No recommended books uploaded yet.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($recommendedBooks as $book)
                @foreach($book->getMedia('recommended_images') as $image)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                            <div class="position-relative">
                                <img src="{{ $image->getUrl() }}" 
                                     alt="Recommended Book"
                                     class="img-fluid w-100"
                                     style="height: 230px; object-fit: cover;">

                                <!-- Delete Button -->
                                <form action="{{ route('recommended-books.image.destroy', $image->id) }}" method="POST" class="position-absolute top-0 end-0 m-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger rounded-circle"
                                            onclick="return confirm('Are you sure you want to delete this book image?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    @endif
</div>
@endsection
