<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <title>{{ trans('auth.Administration_Login') }} | حارس السلامة الذكي</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="حارس السلامة الذكي - نحو بيئة عمل آمنة ومستدامة" name="description" />
    <meta content="CAA" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- PWA Meta Tags -->
    @include('pwa.meta')

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
            margin-bottom: 24px;
        }

        .logo-wrapper {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .logo-wrapper img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .app-name {
            font-size: 22px;
            font-weight: 800;
            color: white;
            margin-bottom: 4px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .app-slogan {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 400;
        }

        /* Language Switcher */
        .language-switcher {
            text-align: center;
            margin-bottom: 16px;
        }

        .lang-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 12px;
            font-family: 'Almarai', sans-serif;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .lang-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* Alert Messages */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .alert-danger {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.3);
            color: #fecaca;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #bbf7d0;
        }

        /* Login Card */
        .login-card {
            background: white;
            border-radius: 24px;
            padding: 28px 24px;
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 24px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Almarai', sans-serif;
            transition: all 0.2s;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #80873d;
            box-shadow: 0 0 0 3px rgba(128, 135, 61, 0.1);
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        /* Submit Button */
        .submit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #262761 0%, #3a3b8a 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Almarai', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(38, 39, 97, 0.3);
            margin-top: 8px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(38, 39, 97, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .submit-btn i {
            font-size: 18px;
        }

        /* Back Link */
        .back-link {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: #64748b;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #262761;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 11px;
        }

        .footer a {
            color: #80873d;
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover {
            color: #a0a84d;
        }

        /* PWA Install Button */
        .pwa-install-btn {
            display: none;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 14px 24px;
            background: rgba(128, 135, 61, 0.9);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Almarai', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 16px;
            box-shadow: 0 4px 12px rgba(128, 135, 61, 0.3);
        }

        .pwa-install-btn:hover {
            background: rgba(160, 168, 77, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(128, 135, 61, 0.4);
        }

        .pwa-install-btn:active {
            transform: translateY(0);
        }

        .pwa-install-btn i {
            font-size: 18px;
        }

        .pwa-install-btn.show {
            display: flex;
        }

        /* Input Icon */
        .input-wrapper {
            position: relative;
        }

        .input-wrapper .form-input {
            padding-right: {{ App::getLocale() == 'ar' ? '16px' : '44px' }};
            padding-left: {{ App::getLocale() == 'ar' ? '44px' : '16px' }};
        }

        .input-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }

        [dir="rtl"] .input-icon {
            left: 14px;
            right: auto;
        }

        [dir="ltr"] .input-icon {
            right: 14px;
            left: auto;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                max-width: 100%;
            }

            .logo-wrapper {
                width: 80px;
                height: 80px;
            }

            .logo-wrapper img {
                width: 56px;
                height: 56px;
            }

            .app-name {
                font-size: 20px;
            }

            .login-card {
                padding: 24px 20px;
            }
        }

        /* Spinner animation */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fa-spin {
            animation: spin 1s linear infinite;
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

        <!-- Language Switcher -->
        <div class="language-switcher">
            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                @if ($localeCode != App::getLocale())
                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="lang-btn">
                        <i class="fas fa-globe"></i>
                        {{ $properties['native'] }}
                    </a>
                @endif
            @endforeach
        </div>

        <!-- Flash Messages -->
        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div><i class="fas fa-exclamation-circle"></i> {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Login Card -->
        <div class="login-card">
            <h2 class="card-title">{{ trans('auth.Administration_Login') }}</h2>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">{{ trans('auth.email') }}</label>
                    <div class="input-wrapper">
                        <input type="email" class="form-input" name="email" id="email" required autofocus
                            placeholder="{{ trans('auth.email') }}" value="{{ old('email') }}">
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">{{ trans('auth.password2') }}</label>
                    <div class="input-wrapper">
                        <input type="password" class="form-input" name="password" id="password" required
                            autocomplete="current-password" placeholder="{{ trans('auth.password2') }}">
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-sign-in-alt"></i>
                    {{ trans('auth.sign_in') }}
                </button>

                <a href="{{ url('/') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> {{ trans('back.back') }}
                </a>
            </form>

            <!-- PWA Install Button -->
            <button id="pwaInstallBtn" class="pwa-install-btn">
                <i class="fas fa-download"></i>
                <span id="installText">{{ App::getLocale() == 'ar' ? 'تثبيت التطبيق' : 'Install App' }}</span>
            </button>
        </div>

        <!-- Footer -->
        <div class="footer">
          
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    '<i class="fas fa-spinner fa-spin"></i> {{ App::getLocale() == "ar" ? "جاري تسجيل الدخول..." : "Signing in..." }}';
            });
        });

        // PWA Install functionality
        let deferredPrompt;
        const installBtn = document.getElementById('pwaInstallBtn');
        const installText = document.getElementById('installText');
        const isArabic = {{ App::getLocale() == 'ar' ? 'true' : 'false' }};

        // Listen for the beforeinstallprompt event
        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent the mini-infobar from appearing on mobile
            e.preventDefault();
            // Stash the event so it can be triggered later
            deferredPrompt = e;
            // Show the install button
            installBtn.classList.add('show');
        });

        // Handle install button click
        installBtn.addEventListener('click', async () => {
            if (!deferredPrompt) {
                return;
            }

            // Show the install prompt
            deferredPrompt.prompt();

            // Wait for the user to respond to the prompt
            const { outcome } = await deferredPrompt.userChoice;

            if (outcome === 'accepted') {
                console.log('User accepted the install prompt');
                // Update button text
                installText.textContent = isArabic ? 'جاري التثبيت...' : 'Installing...';
            } else {
                console.log('User dismissed the install prompt');
            }

            // Clear the deferredPrompt
            deferredPrompt = null;
        });

        // Handle app installed event
        window.addEventListener('appinstalled', () => {
            console.log('PWA was installed');
            // Hide the install button
            installBtn.classList.remove('show');
            deferredPrompt = null;
        });

        // Check if app is already installed
        if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) {
            // App is already installed, hide install button
            installBtn.style.display = 'none';
        }
    </script>
</body>

</html>
