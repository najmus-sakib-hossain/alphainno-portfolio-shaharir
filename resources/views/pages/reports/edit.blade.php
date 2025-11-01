@extends('layouts.app')

@section('title')
    Edit Report
@endsection

@section('content')
<div class="pt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6" style="width: 80%">

            <div class="card shadow-lg border-0 rounded-4 mx-auto">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">Edit Report</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('reports.update', $report->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- report Text -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">report</label>
                            <textarea 
                                name="title" 
                                id="title" 
                                class="form-control @error('title') is-invalid @enderror" 
                                rows="5" 
                                placeholder="Enter report">{{ old('title', $report->title) }}</textarea>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-3">
                                <i class="bi bi-save me-1"></i> Update report
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
