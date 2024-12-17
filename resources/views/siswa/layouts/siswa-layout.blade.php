<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Siswa')</title>

    <!-- Favicons -->
    <link href="{{ asset('images/logo.png') }}" rel="icon">
    <link href="{{ asset('images/logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('siswa/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('siswa/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('siswa/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('siswa/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('siswa/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('siswa/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('siswa/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

    <!-- Template Main CSS File -->
    <link href="{{ asset('siswa/assets/css/style.css') }}" rel="stylesheet">

    <style>
        /* Make sure the body takes full height */
        html, body {
            height: 100%;
            margin: 0;
        }

        /* Flexbox to push footer to the bottom */
        #wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        main {
            flex-grow: 1; /* Ensures main content takes up available space */
        }

        footer {
            margin-top: auto; /* Pushes footer to the bottom */
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('siswa.layouts.sidebar')

        <!-- Header -->
        @include('siswa.layouts.topbar')

        <!-- Main Content -->
        <main id="main" class="main">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('siswa.layouts.footer')

    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('siswa/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('siswa/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('siswa/assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('siswa/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('siswa/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('siswa/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('siswa/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('siswa/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('siswa/assets/js/main.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Datatables JS File -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

    <!-- Custom JS for Dropdown Profile -->
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').on('click', function(event) {
                event.preventDefault();
                var $this = $(this);
                $this.next('.dropdown-menu').toggle();
            });

            // Hide dropdown when clicking outside
            $(document).on('click', function(event) {
                if (!$(event.target).closest('.dropdown').length) {
                    $('.dropdown-menu').hide();
                }
            });
        });
    </script>
</body>

</html>
