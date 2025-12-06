<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> تسجيل الدخول</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="برنامج متخصص في إدارة الفواتير والعملاء مع التقارير وطباعة الفواتير والسندات" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('logo.ico') }}">

    <!-- Bootstrap Css -->

    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app-rtl.min.css') }}" id="app-stylesheet" rel="stylesheet"
        type="text/css" />

    {{-- Google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400&display=swap" rel="stylesheet">

    <style>
        .btn-primary {
            background-color: #262761;
            border-color: #262761;
        }

        .btn:hover {
            background-color: #262761;
            border-color: #4e1f75;
        }
    </style>

</head>


<body class="authentication-bg20" style="background-color: #c3b6f3">

    <div class="account-pages mt-5 mb-5">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12">
                    <div class="text-center">
                        <a href="/" class="logo text-center">
                            <img src="{{ asset(App\Models\Setting::first()->logo) }}" width="80px"
                                alt="برنامج إدارة المدارس">
                        </a>
                        <h3 class=" mt-2 mb-4">برنامج إدارة المدارس</h3>
                    </div>

                    @include('flash-message')
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0"> تسجيل الدخول</h4>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="emailaddress"> البريد الإلكتروني</label>
                                    <input class="form-control" type="email" name="email" id="email" required
                                        autofocus placeholder="البريد الإلكتروني" value="{{ old('email') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">كلمة المرور</label>
                                    <input class="form-control" type="password" name="password" required
                                        autocomplete="current-password" id="password" placeholder="كلمة المرور">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-secondary btn-block" type="submit"> تسجيل الدخول</button>
                                </div>

                            </form>

                            <div class="text-center mt-2">
                            
                            </div>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <!-- Vendor js -->
    <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // البحث عن جميع الأزرار من نوع submit في الصفحة
            var submitButtons = document.querySelectorAll('form button[type="submit"]');

            // إضافة حدث onsubmit على كل فورم في الصفحة
            submitButtons.forEach(function(button) {
                button.closest('form').addEventListener('submit', function() {
                    // تعطيل الزر عند الضغط
                    button.disabled = true;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                });
            });
        });
    </script>

</body>

</html>
