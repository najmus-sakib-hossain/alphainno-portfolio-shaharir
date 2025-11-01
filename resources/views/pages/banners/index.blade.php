@extends('layouts.app')



@section('content')

<!-- Main Content Area -->

<div class="container pt-4 pt-md-2 min-vh-100">

    <!-- Header and Add Button -->

    <div class="d-flex justify-content-between align-items-center mb-2">

        <h4 class="title-header" style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color); position: relative; padding-bottom: 0.5rem;">

            Banners

            <span class="title-underline"></span>

        </h4>

        <a href="{{ route('banners.create') }}" class="btn btn-primary add-btn rounded-pill px-4 py-2">

            <i class="bi bi-plus-circle me-1"></i> Add New Banner

        </a>

    </div>



    <!-- Banner Table Card -->

    <div class="card border-0 shadow-lg rounded-3" style="background: var(--card-background);">

        <div class="card-body p-0">

            <div class="table-responsive rounded rounded-lg">

                <table class="table align-middle table-dark table-hover mb-0">

                    <thead style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: #ffffff;">

                        <tr>

                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">ID</th>

                            <th class="text-start py-3" style="font-size: 0.875rem; font-weight: 600;">Title</th>

                            <th class="text-start py-3" style="font-size: 0.875rem; font-weight: 600;">Subtitle</th>

                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Image</th>

                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600;">Status</th>

                            <th class="text-center py-3" style="font-size: 0.875rem; font-weight: 600; width: 200px;">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($banners as $banner)

                        <!-- Data row - all content centered except Title and Subtitle -->

                        <tr style="transition: background 0.2s ease;">

                            <td class="text-center" style="font-size: 0.875rem; color: var(--text-secondary);">{{ $banner->id }}</td>

                            <td class="fw-semibold text-start" style="font-size: 0.875rem; color: var(--text-primary);">{{ $banner->title }}</td>

                            <td class="text-start" style="font-size: 0.875rem; color: var(--text-secondary);">{{ $banner->subtitle }}</td>

                            <td class="text-center">
                                @if($banner->hasMedia('aboutbanner'))
                                    <div class="image-badge img-badge">
                                        <img src="{{ $banner->getFirstMediaUrl('aboutbanner') }}" alt="Donation Banner" class="rounded-circle" width="48" height="48">
                                    </div>
                                @else
                                    <div class="image-badge user-badge">No Image</div>
                                @endif

                                {{-- @if($banner->image_path)
                                    <div class="image-badge img-badge">
                                        <img src="https://portfolio.alphainno.com/storage/{{ $banner->image_path }}" alt="" width="70px" height="60px">
                                    </div>
                                @else

                                    <!-- Placeholder 2: User (Red/Orange circle) -->

                                    <div class="image-badge user-badge">User</div>

                                @endif --}}

                            </td>

                            <td class="text-center">

                                @if($banner->is_active)

                                    <span class="badge px-3 py-2" style="background-color: var(--success-color); color: #ffffff;">Active</span>

                                @else

                                    <span class="badge px-3 py-2" style="background-color: var(--danger-color); color: #ffffff;">Inactive</span>

                                @endif

                            </td>

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('banners.show', $banner->id) }}" 

                                        class="btn btn-sm action-btn" 

                                        style="background-color: var(--info-color); color: #ffffff;">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a href="{{ route('banners.edit', $banner->id) }}" 

                                        class="btn btn-sm action-btn" 

                                        style="background-color: var(--edit-color); color: #ffffff;">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <!-- NOTE: Removed JS confirm, you need a custom modal implementation for production -->

                                    <form action="{{ route('banners.destroy', $banner->id) }}" 

                                        method="POST" 

                                        class="d-inline delete-form">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm action-btn" 

                                                style="background-color: var(--danger-color); color: #ffffff;">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center py-5" style="font-size: 0.875rem; color: var(--text-secondary);">

                                <i class="bi bi-info-circle me-1"></i> No banners found. Create one to get started.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>



<!-- Custom Styles for Dark Theme and Modern UI -->

@push('styles')

    <style>

        :root {

            /* Dark Theme Palette */

            --primary-color: #8b5cf6; /* Vibrant Violet */

            --secondary-color: #3b82f6; /* Bright Blue accent */

            --success-color: #10b981;

            --danger-color: #ef4444;

            --info-color: #3b82f6; /* Used for View (Eye) button */

            --edit-color: #10b981; /* Used for Edit (Pencil) button */



            --body-background: #0f172a; /* Very Dark Blue/Gray */

            --card-background: #1a1a1a; /* UPDATED: Dark Surface to #1a1a1a */

            --text-primary: #ffffff; /* UPDATED: Light Off-White to pure white */

            --text-secondary: #c9d6e7; /* Muted Light Gray, adjusted for contrast */

            --table-row-hover: #334155; /* Slightly lighter surface for hover */

            

            /* Shadows for depth on dark theme */

            --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.4);

            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.5);

            --shadow-hover: 0 8px 16px rgba(139, 92, 246, 0.2);

        }



        /* Essential Dark Theme Body and Container setup (Assumes Bootstrap 5 is linked) */

        body {

            background-color: var(--body-background) !important;

            color: var(--text-primary);

            font-family: 'Inter', sans-serif;

        }



        /* Title and Underline */

        .title-header {

            color: var(--primary-color) !important;

        }

        .title-underline {

            background: linear-gradient(to right, var(--primary-color), var(--secondary-color)) !important;

            height: 4px !important;

            border-radius: 4px !important;

        }



        /* Add Button */

        .add-btn {

            background-color: var(--primary-color) !important;

            border: none;

            font-size: 0.95rem;

            font-weight: 600;

            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);

            box-shadow: var(--shadow-sm);

        }

        .add-btn:hover {

            background-color: var(--secondary-color) !important;

            transform: translateY(-3px);

            box-shadow: var(--shadow-hover);

        }

        .add-btn::before {

            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);

        }



        /* Table Styling */

        .card.shadow-lg {

            box-shadow: var(--shadow-lg) !important;

        }

        

        /* Ensure table corners are rounded by hiding overflow of the container */

        .card-body.p-0 {

            overflow: hidden;

        }



        .table-dark {

            --bs-table-bg: var(--card-background); /* Now #1a1a1a */

            --bs-table-striped-bg: #2d3748;

            --bs-table-hover-bg: var(--table-row-hover);

            color: var(--text-primary); /* Now white */

            border: none; /* Removing border as requested, relying on container rounding */

        }

        

        .table-dark thead th {

             border-bottom: none;

        }

        

        /* REMOVED BOTTOM BORDER FROM TABLE CELLS */

        .table-dark td, .table-dark th {

            border-bottom: none;

        }



        .table-hover tbody tr:hover {

            background-color: var(--table-row-hover) !important;

        }



        /* Action Buttons and Badges */

        .action-btn {

            width: 38px;

            height: 38px;

            border-radius: 50% !important; /* Make buttons round */

            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);

        }



        .action-btn:hover {

            transform: scale(1.05);

            box-shadow: var(--shadow-hover);

        }



        .badge {

            min-width: 70px; /* Ensure consistent width */

            text-transform: uppercase;

            letter-spacing: 0.05em;

        }

        

        /* New Image Badge Styling */

        .image-badge {

            width: 48px;

            height: 48px;

            border-radius: 50%;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            color: #ffffff;

            font-weight: 600;

            font-size: 0.75rem;

            text-transform: uppercase;

            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);

        }



        .img-badge {

            background-color: var(--info-color); /* Blue for IMG */

            border: 2px solid #60a5fa;

        }



        .user-badge {

            background-color: var(--danger-color); /* Red/Orange for User */

            border: 2px solid #f87171;

        }



        /* Responsive adjustments */

        @media (max-width: 767.98px) {

            .title-header {

                font-size: 1.5rem !important;

            }

            .add-btn {

                font-size: 0.8rem !important;

                padding: 0.5rem 1rem !important;

            }

        }

    </style>

@endpush

@endsection