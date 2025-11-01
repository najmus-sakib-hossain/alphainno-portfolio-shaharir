@extends('layouts.app')
@push('styles')
    <style>
        /* Define the overall dark theme colors */
        :root {
            --color-bg-primary: #121212; /* Deep Black/Dark Gray */
            --color-bg-card: #1e1e1e;    /* Slightly lighter card background */
            --color-text-light: #e0e0e0; /* Light gray for main text */
            --color-text-accent: #f0f0f0; /* Near white for headings */
            --color-accent-red: #e94b3c;  /* Deep red */
            --color-accent-green: #2ecc71; /* Vibrant green */
            --color-border: #333333;
            --color-shadow: rgba(0, 0, 0, 0.5);
        }

        /* Modern Card Styling */
        .card-dark {
            background-color: var(--color-bg-card);
            border: 1px solid var(--color-border);
            border-radius: 12px;
            box-shadow: 0 10px 30px var(--color-shadow);
        }

        .card-header-dark {
            background-color: var(--color-bg-primary);
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 15px 20px; /* reduced padding */
            border-bottom: 1px solid var(--color-border);
        }

        /* Smaller Header (previously 1.5rem → now 1.25rem) */
        .card-title-modern {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--color-text-accent);
            letter-spacing: 0.3px;
        }

        /* Input Styling */
        .form-control-dark {
            background-color: #2c2c2c;
            color: var(--color-text-light);
            border: 1px solid var(--color-border);
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 0.95rem;
            font-weight: 300;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control-dark::placeholder {
            color: #777;
        }

        .form-control-dark:focus {
            background-color: #2c2c2c;
            color: var(--color-text-light);
            border-color: var(--color-accent-green);
            box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.3);
        }

        .form-label-dark {
            color: var(--color-text-light);
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        /* Smaller Buttons (from 0.95rem → 0.85rem) */
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
        }

        .btn-modern-red {
            background-color: var(--color-accent-red);
            border-color: var(--color-accent-red);
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
        }

        .btn-modern-green:hover {
            background-color: #27ae60;
            border-color: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);
        }

        /* Icon spacing */
        .btn-modern-red i,
        .btn-modern-green i {
            margin-right: 6px;
        }

        @media (max-width: 576px) {
            .btn-modern-red,
            .btn-modern-green {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="pt-2 px-2">
        <!-- Main Card Container -->
        <div class="card card-dark">
            <!-- Header Section -->
            <div class="card-header-dark text-center">
                <h1 class="card-title-modern">Add New Quote</h1>
            </div>

            <!-- Form Body -->
            <div class="card-body p-4 p-md-5">
                <form method="POST" action="/quotes">
                    {{-- @csrf --}}
                    <div class="mb-4">
                        <label for="quote-text" class="form-label form-label-dark">
                            Quote Text <span class="text-danger">*</span>
                        </label>
                        <textarea
                            class="form-control form-control-dark"
                            id="quote-text"
                            name="quote_text"
                            rows="7"
                            placeholder="Enter the full text of the quote here..."
                            required
                        ></textarea>
                    </div>

                    <!-- Button Group -->
                    <div class="d-flex justify-content-end flex-column flex-sm-row pt-3">
                        <button
                            type="button"
                            class="btn btn-modern-red me-sm-3"
                            onclick="window.history.back();"
                        >
                            <i class="fas fa-chevron-left"></i>
                            BACK
                        </button>

                        <button
                            type="submit"
                            class="btn btn-modern-green"
                        >
                            <i class="fas fa-plus-circle"></i>
                            ADD REPORT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
