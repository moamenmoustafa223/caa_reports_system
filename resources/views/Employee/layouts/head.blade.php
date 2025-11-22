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

        /* PWA Floating Install Button */
        .pwa-float-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #80873d 0%, #a0a84d 100%);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(128, 135, 61, 0.4);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .pwa-float-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 30px rgba(128, 135, 61, 0.6);
        }

        .pwa-float-btn:active {
            transform: translateY(-1px) scale(1.02);
        }

        .pwa-float-btn.show {
            display: flex;
        }

        .pwa-float-btn i {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        /* RTL Support */
        [dir="rtl"] .pwa-float-btn {
            right: auto;
            left: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pwa-float-btn {
                bottom: 20px;
                right: 20px;
                width: 56px;
                height: 56px;
                font-size: 22px;
            }

            [dir="rtl"] .pwa-float-btn {
                right: auto;
                left: 20px;
            }
        }
    </style>
    @yield('css')
</head>
