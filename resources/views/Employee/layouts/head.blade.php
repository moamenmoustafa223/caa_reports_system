<head>
    <meta charset="utf-8" />
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="description" />
    <meta name="author" content="Coderthemes" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- PWA Meta Tags -->
    @include('pwa.meta')

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset(App\Models\Setting::first()->logo) }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>

    <!-- Vendor CSS -->
    <link href="{{ asset('backend/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Google Font: Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet">

    @if (App::getLocale() == 'ar')
        <!-- RTL Styles -->
        <link href="{{ asset('backend/assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css"
            id="app-style" />
    @else
        <!-- LTR Styles -->
        <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    @endif

    <link href="{{ asset('backend/assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .logo-lg img {
            height: 56px !important;
        }
        .logo-sm img {
            height: 40px !important;
        }
    </style>
    @yield('css')
</head>
