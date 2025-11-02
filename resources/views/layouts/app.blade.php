<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('/') }}css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css"
        integrity="sha512-UiKdzM5DL+I+2YFxK+7TDedVyVm7HMp/bN85NeWMJNYortoll+Nd6PU9ZDrZiaOsdarOyk9egQm6LOJZi36L2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.15.0/sweetalert2.min.css"
        integrity="sha512-Xxs33QtURTKyRJi+DQ7EKwWzxpDlLSqjC7VYwbdWW9zdhrewgsHoim8DclqjqMlsMeiqgAi51+zuamxdEP2v1Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet"href="{{ asset('/') }}css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- Tailwind CSS CDN for modal styling -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js for interactive components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Prevent sidebar flash on page load -->
    <script>
        // This runs immediately to prevent flash
        (function() {
            const isDesktop = window.innerWidth >= 992;
            const sidebarCollapsed = localStorage.getItem('sidebar-collapsed');
            
            if (isDesktop && sidebarCollapsed !== 'true') {
                // Desktop and sidebar should be open
                document.documentElement.classList.remove('sidebar-collapse');
            } else if (!isDesktop) {
                // Mobile - collapse by default
                document.documentElement.classList.add('sidebar-collapse');
            } else if (sidebarCollapsed === 'true') {
                // User preference to collapse
                document.documentElement.classList.add('sidebar-collapse');
            }
        })();
    </script>

    <!-- Custom Styles for Profile Modal and Dropdown -->
    <style>
        /* Ensure modal appears above everything */
        #profileEditModal {
            z-index: 1055 !important;
        }

        #profileEditModal .modal-dialog {
            z-index: 1060 !important;
        }

        .modal-backdrop {
            z-index: 1050 !important;
        }

        .modal.show {
            display: block !important;
        }

        /* Fix modal content visibility */
        .modal-content {
            position: relative;
            z-index: 1061 !important;
            background-color: #ffffff !important;
        }

        /* Smooth dropdown animation */
        .dropdown-menu {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Profile image hover effect */
        .user-image:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease;
        }

        /* Button hover effects */
        .btn-info:hover,
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
        }

        /* Ensure dropdown doesn't interfere with modal */
        .dropdown-menu {
            z-index: 1000 !important;
        }
    </style>

    @stack('styles')
    <!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
    <!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        @include('layouts.header')
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"
            style="background-color: #242424 !important;">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand" style="color: #475569">
                <!--begin::Brand Link-->
                <ahref="{{ asset('/') }}index.html" class="brand-link">
                <!--begin::Brand Image-->
                <img src="{{ Auth::user() && Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/shahriar_khan_philosophy-B1MpPTGw.png') }}"
                    class="rounded-circle pb-1" alt="User Image"
                    style="width: 32px; height: 32px; object-fit: cover;" />
                {{-- <img
                src="{{ asset('/') }}assets/alphainno.jpg "
                alt="AdminLTE Logo"
                class="brand-image rounded-circle opacity-75 shadow"
            /> --}}
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <span class="brand-text fw-light" style="color: #475569">Shahriar</span>
                <!--end::Brand Text-->
                </ahref=>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            @include('layouts.sidebar')
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main" style="background-color: #030712">
            <!--begin::App Content-->
            <div class="app-content" style="padding: 0px;">

                @yield('content')

            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        @include('layouts.footer')
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <!-- Initialize Bootstrap Modal Fix -->
    <script>
        // Ensure Bootstrap modal works correctly
        document.addEventListener('DOMContentLoaded', function() {
            // Fix for modal not showing
            const profileModal = document.getElementById('profileEditModal');
            if (profileModal) {
                profileModal.addEventListener('show.bs.modal', function(event) {
                    // Close dropdown when modal opens
                    const dropdowns = document.querySelectorAll('.dropdown-menu.show');
                    dropdowns.forEach(dropdown => {
                        const bsDropdown = bootstrap.Dropdown.getInstance(dropdown
                            .previousElementSibling);
                        if (bsDropdown) {
                            bsDropdown.hide();
                        }
                    });
                });
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.js"
        integrity="sha512-79j1YQOJuI8mLseq9icSQKT6bLlLtWknKwj1OpJZMdPt2pFBry3vQTt+NZuJw7NSd1pHhZlu0s12Ngqfa371EA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.15.0/sweetalert2.min.js"
        integrity="sha512-1x3+cFNog0WOdML2eUM5eF2kQ6yKixZ+QK6Xb42ogYC3LGSZs58Q0vtqO4fd7BN5b95bTTNHEnlDFZ5+ceb/GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('/') }}js/adminlte.js"></script>
    @stack('scripts')
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>
    <!-- sortablejs -->
    <script>
        new Sortable(document.querySelector('.connectedSortable'), {
            group: 'shared',
            handle: '.card-header',
        });

        const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = 'move';
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/fontawesome.min.js"
        integrity="sha512-obFNtQ1JKCrxPBPLmYDUevlriATl5EhvwU3CFtdW/HKOkeAe0bbsyZfHO44/f1QyndrZJ464TQvrRP9ZjyXSSA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script>
        @if (session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000, // Duration in milliseconds
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            }).showToast();
        @endif

        @if (session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
            }).showToast();
        @endif

        // Fix sidebar behavior - only toggle on hamburger click, not on link clicks
        document.addEventListener('DOMContentLoaded', function() {
            // Get the sidebar toggle button
            const sidebarToggle = document.querySelector('[data-lte-toggle="sidebar"]');
            
            const body = document.body;
            
            // Check if viewport is desktop size
            function isDesktop() {
                return window.innerWidth >= 992; // Bootstrap lg breakpoint
            }

            // Initialize sidebar state based on screen size and saved preference
            function initializeSidebar() {
                const sidebarCollapsed = localStorage.getItem('sidebar-collapsed');
                
                // Copy class from html to body if needed
                if (document.documentElement.classList.contains('sidebar-collapse')) {
                    body.classList.add('sidebar-collapse');
                }
                
                if (isDesktop()) {
                    // On desktop, check saved preference
                    if (sidebarCollapsed === 'true') {
                        body.classList.add('sidebar-collapse');
                    } else {
                        // Default to open on desktop
                        body.classList.remove('sidebar-collapse');
                    }
                } else {
                    // On mobile, always collapse by default
                    body.classList.add('sidebar-collapse');
                }
            }

            // Initialize immediately
            initializeSidebar();

            // Handle sidebar toggle button click
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    body.classList.toggle('sidebar-collapse');
                    
                    // Save preference to localStorage
                    if (body.classList.contains('sidebar-collapse')) {
                        localStorage.setItem('sidebar-collapsed', 'true');
                    } else {
                        localStorage.setItem('sidebar-collapsed', 'false');
                    }
                });
            }

            // Handle window resize
            window.addEventListener('resize', function() {
                if (isDesktop()) {
                    // On desktop, respect user's preference
                    const collapsed = localStorage.getItem('sidebar-collapsed');
                    if (collapsed !== 'true') {
                        body.classList.remove('sidebar-collapse');
                    }
                } else {
                    // On mobile, collapse by default
                    body.classList.add('sidebar-collapse');
                }
            });

            // Prevent sidebar from closing when clicking on nav links
            const sidebarLinks = document.querySelectorAll('.sidebar-menu .nav-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Check if this is a treeview toggle (has submenu)
                    const parentItem = this.closest('.nav-item');
                    const hasSubmenu = parentItem && parentItem.querySelector('.nav-treeview');
                    
                    // If it has a submenu, let AdminLTE handle it (don't prevent default)
                    if (hasSubmenu && this.getAttribute('href') === '#') {
                        // Don't prevent default, let treeview work
                        return;
                    }
                    
                    // For actual navigation links, only close sidebar on mobile
                    if (!isDesktop()) {
                        setTimeout(() => {
                            body.classList.add('sidebar-collapse');
                        }, 200);
                    }
                });
            });
        });
    </script>
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const sales_chart_options = {
            series: [{
                    name: 'Digital Goods',
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: 'Electronics',
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                type: 'datetime',
                categories: [
                    '2023-01-01',
                    '2023-02-01',
                    '2023-03-01',
                    '2023-04-01',
                    '2023-05-01',
                    '2023-06-01',
                    '2023-07-01',
                ],
            },
            tooltip: {
                x: {
                    format: 'MMMM yyyy',
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector('#revenue-chart'),
            sales_chart_options,
        );
        sales_chart.render();
    </script>
    <!-- jsvectormap -->
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
        integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
        integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>
    <!-- jsvectormap -->
    <script>
        // World map by jsVectorMap
        new jsVectorMap({
            selector: '#world-map',
            map: 'world',
        });

        // Sparkline charts
        const option_sparkline1 = {
            series: [{
                data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
        sparkline1.render();

        const option_sparkline2 = {
            series: [{
                data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
        sparkline2.render();

        const option_sparkline3 = {
            series: [{
                data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
        sparkline3.render();
    </script>
    <!--end::Script-->
    <style>
        /* Remove all margin-left from app-main */
        .app-main {
            margin-left: 0 !important;
            width: 100% !important;
        }

        /* Desktop sidebar behavior */
        @media (min-width: 992px) {
            /* Sidebar open by default on desktop */
            body:not(.sidebar-collapse) .app-sidebar {
                transform: translateX(0) !important;
            }
            
            /* Sidebar collapsed on desktop */
            body.sidebar-collapse .app-sidebar {
                transform: translateX(-250px) !important;
            }
        }

        /* Mobile sidebar behavior */
        @media (max-width: 991px) {
            /* Sidebar hidden by default on mobile */
            .app-sidebar {
                position: fixed !important;
                z-index: 1040 !important;
                transform: translateX(-250px);
                transition: transform 0.3s ease;
            }
            
            body:not(.sidebar-collapse) .app-sidebar {
                transform: translateX(0) !important;
            }
            
            body.sidebar-collapse .app-sidebar {
                transform: translateX(-250px) !important;
            }

            /* Overlay when sidebar is open on mobile */
            body:not(.sidebar-collapse)::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1039;
            }
        }

        /* Smooth transitions */
        .app-sidebar,
        .app-main {
            transition: all 0.3s ease;
        }
    </style>
</body>
<!--end::Body-->

</html>
