@extends('layouts.app')

@section('title', 'Edit Travel')

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
    --color-border: #333;
    --color-shadow: rgba(0,0,0,0.5);
}

body {
    background-color: var(--color-bg-primary);
    font-family: 'Inter', sans-serif;
}

.card-dark {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    border: 1px solid var(--color-border);
    box-shadow: 0 10px 25px var(--color-shadow);
    transition: transform 0.2s ease;
    width: 100%;
}

.card-dark:hover {
    transform: translateY(-2px);
}

.card-header-dark {
    background-color: var(--color-bg-primary);
    color: var(--color-text-accent);
    text-align: center;
    padding: 15px 20px;
    border-bottom: 1px solid var(--color-border);
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.card-title-modern {
    font-size: 1.25rem;
    font-weight: 600;
}

.form-control-dark {
    width: 100%;
    background-color: #2c2c2c;
    color: var(--color-text-light);
    border: 1px solid var(--color-border);
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    margin-bottom: 1rem;
    box-sizing: border-box;
}

.form-control-dark::placeholder {
    color: #777;
}

.form-label-dark {
    color: var(--color-text-light);
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

.btn-modern-blue,
.btn-modern-red,
.btn-outline-modern {
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
    color: #fff;
    border: none;
}

.btn-modern-blue:hover {
    background-color: var(--color-accent-purple);
}

.btn-modern-red {
    background-color: var(--color-accent-red);
    color: #fff;
    border: none;
}

.btn-outline-modern {
    border: 1px solid var(--color-accent-blue);
    color: var(--color-accent-blue);
    background: transparent;
}

.btn-outline-modern:hover {
    background-color: var(--color-accent-blue);
    color: #fff;
}

.img-preview {
    display: block;
    margin-top: 8px;
    border-radius: 8px;
    max-height: 200px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    object-fit: cover;
    width: 100%;
}

.flag-preview {
    display: block;
    margin-top: 4px;
    border-radius: 6px;
    max-height: 60px;
    object-fit: cover;
}

.country-item .remove-country {
    font-weight: bold;
}
</style>
@endpush

@section('content')
<div class="content-area p-2 ">
    <div class="row justify-content-center">
        <div class="col-12">

            <div class="card card-dark">
                <div class="card-header-dark">
                    <h4 class="card-title-modern mb-0">Edit Travel</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('travels.update', $travel->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label for="title" class="form-label-dark">Title</label>
                            <input type="text" name="title" id="title" class="form-control-dark" value="{{ $travel->title }}" required>
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="form-label-dark">Content</label>
                            <textarea name="content" id="content" class="form-control-dark" rows="5" required>{{ $travel->content }}</textarea>
                        </div>

                        <!-- Map Image -->
                        <div>
                            <label for="map_image" class="form-label-dark">Map Image</label>
                            <input type="file" name="map_image" id="map_image" class="form-control-dark" accept="image/*">
                            <img id="map_preview" src="{{ $travel->getFirstMediaUrl('map_image') ?: '#' }}" class="img-preview" @if(!$travel->getFirstMediaUrl('map_image')) style="display:none;" @endif>
                        </div>

                        <!-- Countries -->
                        <div class="mb-4">
                            <label class="form-label-dark">Countries</label>
                            <div id="countries-wrapper">
                                @foreach($travel->countries as $index => $countryName)
                                <div class="row g-2 align-items-center country-item mb-2">
                                    <div class="col-md-5">
                                        <input type="text" name="countries[{{ $index }}][name]" class="form-control-dark" value="{{ $countryName }}" placeholder="Country Name" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="file" name="countries[{{ $index }}][flag]" class="form-control-dark country-flag" accept="image/*">
                                        @php $flag = $travel->getMedia('country_flags')[$index] ?? null; @endphp
                                        <img class="flag-preview" @if($flag) src="{{ $flag->getUrl() }}" @else style="display:none;" @endif>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn-outline-modern remove-country w-100">&times;</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-country" class="btn-outline-modern btn-sm mt-2">+ Add Country</button>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('travels.index') }}" class="btn-outline-modern btn-lg">Back</a>
                            <button type="submit" class="btn-modern-blue btn-lg">Update</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let countryIndex = document.querySelectorAll('.country-item').length;

    // Add Country
    document.getElementById('add-country').addEventListener('click', function() {
        const wrapper = document.getElementById('countries-wrapper');
        const countryItem = document.createElement('div');
        countryItem.classList.add('row', 'g-2', 'align-items-center', 'country-item', 'mb-2');
        countryItem.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="countries[${countryIndex}][name]" class="form-control-dark" placeholder="Country Name" required>
            </div>
            <div class="col-md-5">
                <input type="file" name="countries[${countryIndex}][flag]" class="form-control-dark country-flag" accept="image/*">
                <img class="flag-preview" style="display:none;">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn-outline-modern remove-country w-100">&times;</button>
            </div>
        `;
        wrapper.appendChild(countryItem);
        countryIndex++;
    });

    // Remove Country
    document.getElementById('countries-wrapper').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-country')) {
            e.target.closest('.country-item').remove();
        }
    });

    // Map Image Preview
    document.getElementById('map_image').addEventListener('change', function(e) {
        const preview = document.getElementById('map_preview');
        if (e.target.files && e.target.files[0]) {
            preview.src = URL.createObjectURL(e.target.files[0]);
            preview.style.display = 'block';
        }
    });

    // Country Flag Preview
    document.getElementById('countries-wrapper').addEventListener('change', function(e) {
        if (e.target.classList.contains('country-flag')) {
            const file = e.target.files[0];
            const img = e.target.closest('.col-md-5').querySelector('.flag-preview');
            if (file) {
                img.src = URL.createObjectURL(file);
                img.style.display = 'block';
            }
        }
    });
});
</script>
@endpush
