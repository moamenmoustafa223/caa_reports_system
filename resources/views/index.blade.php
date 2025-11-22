<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <title>حارس السلامة الذكي | CAA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="حارس السلامة الذكي - نحو بيئة عمل آمنة ومستدامة" name="description" />
    <meta content="CAA" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('logo.svg') }}">

    {{-- Google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Almarai', sans-serif;
            min-height: 100vh;
            background: url('{{ asset("backend/caa.jpeg") }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(38, 39, 97, 0.75) 0%, rgba(58, 59, 138, 0.75) 100%);
            z-index: 0;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        /* Logo Section */
        .logo-section {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-wrapper {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .logo-wrapper img {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        .app-name {
            font-size: 28px;
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .app-slogan {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 400;
        }

        /* Login Card */
        .login-card {
            background: white;
            border-radius: 24px;
            padding: 32px 24px;
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 24px;
        }

        /* Login Button */
        .login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(135deg, #262761 0%, #3a3b8a 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Almarai', sans-serif;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(38, 39, 97, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(38, 39, 97, 0.4);
            color: white;
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn i {
            font-size: 20px;
        }

        /* Language Switcher */
        .language-switcher {
            text-align: center;
            margin-top: 20px;
        }

        .lang-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Almarai', sans-serif;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .lang-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 24px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
        }

        .footer a {
            color: #80873d;
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover {
            color: #a0a84d;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                max-width: 100%;
            }

            .logo-wrapper {
                width: 100px;
                height: 100px;
            }

            .logo-wrapper img {
                width: 70px;
                height: 70px;
            }

            .app-name {
                font-size: 24px;
            }

            .login-card {
                padding: 24px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <div class="logo-wrapper">
                <img src="{{ asset(App\Models\Setting::first()->logo) }}" alt="حارس السلامة الذكي">
            </div>
            <h1 class="app-name">حارس السلامة الذكي</h1>
            <p class="app-slogan">نحو بيئة عمل آمنة ومستدامة</p>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <h2 class="card-title">{{ trans('auth.Employee_Login') }}</h2>

            <a href="{{ route('login_employee') }}" class="login-btn">
                <i class="fas fa-user-shield"></i>
                {{ trans('auth.sign_in') }}
            </a>
        </div>

        <!-- Language Switcher -->
        <div class="language-switcher">
            @if (App::getLocale() == 'ar')
                <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="lang-btn">
                    <i class="fas fa-globe"></i>
                    English
                </a>
            @else
                <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" class="lang-btn">
                    <i class="fas fa-globe"></i>
                    العربية
                </a>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            {{ trans('auth.programming_development') }}
            <a href="https://mazoonsoft.com" target="_blank">{{ trans('auth.mazoonsoft') }}</a>
        </div>
    </div>
</body>

</html>
