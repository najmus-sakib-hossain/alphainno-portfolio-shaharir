@extends('layouts.app')

@push('styles')
    <style>
        /* Dark Mode Colors */
        :root {
            --dark-bg: #0A0A0A;
            --dark-card: #242424;
            --dark-surface: #1A1A1A;
            --card-border: #1f2937; /* border-gray-800 */
            --text-muted: #888; /* muted gray for labels */
        }

        body {
            background-color: var(--dark-bg);
            color: #ffffff;
        }

        .content-area {
            background-color: var(--dark-bg);
            padding: 2rem;
        }

        .card {
            background-color: var(--dark-card);
            border: 1px solid var(--card-border);
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.5);
            transition: all 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            font-size: 1.5rem;
            color: #ffffff;
            padding: 10px;
            border-radius: 8px;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        /* Chart container height */
        #visitorsChart {
            height: 350px !important;
        }

        @media (max-width: 767px) {
            .content-area {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')
<div class="content-area mt-2">
    <h2 class="mb-4 text-white">Analytics Overview</h2>
    {{-- <div class="row g-4">
        <!-- Total Blogs -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #4F46E5;"> <!-- Indigo -->
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $totalBlogs }}</div>
                        <div class="stat-label">Total Blogs</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Events -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #10B981;"> <!-- Green -->
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $totalEvents }}</div>
                        <div class="stat-label">Total Events</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Books -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #EF4444;"> <!-- Red -->
                        <i class="bi bi-book"></i>
                    </div>
                    <div>
                        <div class="stat-number">6</div>
                        <div class="stat-label">Total Books</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Donations -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #F59E0B;"> <!-- Yellow -->
                        <i class="bi bi-cash"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $totalDonations }}</div>
                        <div class="stat-label">Total Donations</div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row g-4">
        <!-- Total Blogs -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #4F46E5;">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $totalBlogs }}</div>
                        <div class="stat-label">Total Blogs</div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Total Events -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #10B981;">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $totalEvents }}</div>
                        <div class="stat-label">Total Events</div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Total Books -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #EF4444;">
                        <i class="bi bi-book"></i>
                    </div>
                    <div>
                        <div class="stat-number">6</div>
                        <div class="stat-label">Total Books</div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Total Donations -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="background-color: #F59E0B;">
                        <i class="bi bi-cash"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $totalDonations }}</div>
                        <div class="stat-label">Total Donations</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Visitors Graph -->
    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="card p-4">
                <h4 class="mb-4 text-white">Visitors Overview</h4>
                <canvas id="visitorsChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('visitorsChart').getContext('2d');
    const visitorsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Visitors',
                data: [120,190,300,500,200,300,450,600,550,700,800,900],
                backgroundColor: 'rgba(59,130,246,0.1)', // Tailwind blue-500
                borderColor: '#3B82F6',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#A0A0A0'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(30,30,30,0.9)',
                    titleColor: '#fff',
                    bodyColor: '#ddd',
                    borderColor: '#3B82F6',
                    borderWidth: 1,
                    cornerRadius: 6
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#2C2C2C'
                    },
                    ticks: {
                        color: '#888'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#888'
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
