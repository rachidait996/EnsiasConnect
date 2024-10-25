<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- CSS Files -->
    <link href="{{ asset('assets/niceadmin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/niceadmin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/niceadmin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/niceadmin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/niceadmin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/niceadmin/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/niceadmin/css/style.css') }}" rel="stylesheet">
    
    @stack('css')
     <!-- Include Bootstrap CSS -->
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

     <!-- Include jQuery -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 
     <!-- Include Bootstrap JS -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <!-- ======= Header ======= -->
    @include('partials.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('partials.sidebar-' . strtolower(Auth::user()->role))
    <!-- End Sidebar -->

    <main id="main" class="main">
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    <!-- End Footer -->

    <!-- JS Files -->
    <script src="{{ asset('assets/niceadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/niceadmin/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/niceadmin/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/niceadmin/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/niceadmin/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/niceadmin/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/niceadmin/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
