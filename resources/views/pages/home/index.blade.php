@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex">
            <p class="card-title">Images For Landing Page</p>
            <button class="btn btn-primary btn-sm float-right">Upload Images</button>
        </div>
    </div>
    <div class="card-body">
        <div class="py-4">
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <tbody>
                        {{-- Main Image Row --}}
                        <tr>
                            <td class="align-top" style="width: 20%;">
                                <strong>Main Image</strong>
                            </td>
                            <td>
                                @php
                                    $mainImage = App\Models\LandingPageImage::first()->getFirstMedia('main_image');
                                @endphp
                                @if($mainImage)
                                    <div class="card mb-2" style="max-width: 200px;">
                                        <img src="{{ $mainImage->getUrl() }}" class="card-img-top" alt="Main Image Updated">
                                    </div>
                                @else
                                    <p>No main image uploaded.</p>
                                @endif
                            </td>
                        </tr>
        
                        {{-- Side Images Row --}}
                        <tr>
                            <td class="align-top">
                                <strong>Side Images</strong>
                            </td>
                            <td>
                                <div class="row g-2">
                                    @php
                                        $allSideImages = Spatie\MediaLibrary\MediaCollections\Models\Media::where('collection_name', 'side_images')->get();
                                    @endphp
        
                                    @if($allSideImages->count())
                                        @foreach($allSideImages as $media)
                                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                                <div class="card">
                                                    <img src="{{ $media->getUrl() }}" class="card-img-top" alt="{{ $media->name }}">
                                                    <div class="card-body p-2 text-center">
                                                        <small>{{ $media->name }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No side images uploaded.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection