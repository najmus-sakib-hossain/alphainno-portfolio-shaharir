@extends('layouts.app')

@section('content')
<div class="pt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6" style="width: 80%">

            <div class="card shadow-lg border-0 rounded-4 mx-auto">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">Edit Quote</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('quotes.update', $quote->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Quote Text -->
                        <div class="mb-3">
                            <label for="quote_text" class="form-label fw-semibold">Quote</label>
                            <textarea 
                                name="quote_text" 
                                id="quote_text" 
                                class="form-control @error('quote_text') is-invalid @enderror" 
                                rows="5" 
                                placeholder="Enter quote">{{ old('quote_text', $quote->quote_text) }}</textarea>
                            @error('quote_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-3">
                                <i class="bi bi-save me-1"></i> Update Quote
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
