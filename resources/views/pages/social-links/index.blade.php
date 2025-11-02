@extends('layouts.app')

@section('title', 'Social Links')

@section('content')
<style>
    .social-link-form .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
        color: #495057;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .social-link-form .form-control {
        border-left: none;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .social-link-form .input-group:hover .input-group-text {
        background-color: #e9ecef;
        transform: scale(1.05);
    }

    .social-link-form .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }

    .social-link-form .btn-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
        border-radius: 50px;
        padding: 12px 24px;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4);
    }

    .social-link-form .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3 0%, #003d82 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.5);
    }

    .social-link-form .btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 2px 10px rgba(0, 123, 255, 0.3);
    }

    .social-link-form .header-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(90deg, #007bff, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        letter-spacing: 0.5px;
    }
</style>


<div class="row justify-content-center mt-4">
    <div class="col-md-10 col-lg-8 p-5 rounded shadow bg-[#222222]">
        <div class="social-link-form">
            <h3 class="mb-4 text-center header-title">Store Your Social Media Links</h3>
            <p class="text-center mb-5 text-blue-600">Provide the full URL for each of your profiles.</p>

            <form action="{{ route('social-links') }}" method="POST">
                @csrf

                @php
                    $socials = [
                        [
                            'name' => 'twitter',
                            'icon' => 'fa-x-twitter',
                            'color' => '#000000',
                            'placeholder' => 'https://x.com/your-username',
                        ],
                        [
                            'name' => 'facebook',
                            'icon' => 'fa-facebook',
                            'color' => '#1877F2',
                            'placeholder' => 'https://facebook.com/your-page',
                        ],
                        [
                            'name' => 'instagram',
                            'icon' => 'fa-instagram',
                            'color' => '#E4405F',
                            'placeholder' => 'https://instagram.com/your-username',
                        ],
                        [
                            'name' => 'pinterest',
                            'icon' => 'fa-pinterest',
                            'color' => '#E60023',
                            'placeholder' => 'https://pinterest.com/your-username',
                        ],
                        [
                            'name' => 'dribbble',
                            'icon' => 'fa-dribbble',
                            'color' => '#EA4C89',
                            'placeholder' => 'https://dribbble.com/your-username',
                        ],
                        [
                            'name' => 'behance',
                            'icon' => 'fa-behance',
                            'color' => '#1769FF',
                            'placeholder' => 'https://behance.net/your-username',
                        ],
                        [
                            'name' => 'linkedin',
                            'icon' => 'fa-linkedin-in',
                            'color' => '#0A66C2',
                            'placeholder' => 'https://linkedin.com/in/your-profile',
                        ],
                        [
                            'name' => 'youtube',
                            'icon' => 'fa-youtube',
                            'color' => '#FF0000',
                            'placeholder' => 'https://youtube.com/@yourchannel',
                        ],
                    ];
                @endphp

                @foreach($socials as $social)
                    <div class="mb-3">
                        <label for="{{ $social['name'] }}-url" class="form-label visually-hidden">{{ ucfirst($social['name']) }} URL</label>
                        <div class="input-group input-group-md">
                            <span class="input-group-text" id="{{ $social['name'] }}-addon">
                                <i class="fab {{ $social['icon'] }}" style="color: {{ $social['color'] }};"></i>
                            </span>
                            <input type="url" class="form-control" id="{{ $social['name'] }}-url" name="{{ $social['name'] }}-url" placeholder="{{ $social['placeholder'] }}" aria-label="{{ ucfirst($social['name']) }} URL" aria-describedby="{{ $social['name'] }}-addon">
                        </div>
                    </div>
                @endforeach

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Save Social Links
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection