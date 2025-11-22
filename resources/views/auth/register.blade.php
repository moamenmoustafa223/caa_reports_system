<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>توصيل اكسبريس | تسجيل عضوية جديدة</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="برنامج متخصص في إدارة الفواتير والعملاء مع التقارير وطباعة الفواتير والسندات" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('logo.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ URL::asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-stylesheet" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ URL::asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ URL::asset('backend/assets/css/app-rtl.min.css') }}" id="app-stylesheet" rel="stylesheet"
        type="text/css" />

    {{-- Google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400&display=swap" rel="stylesheet">

    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            font-family: 'Almarai', sans-serif;
        }

        body.authentication-bg2 {
            background-image: url({{ asset('backend/assets/images/big/bg-light-img2.jpg') }});
            background-size: cover;
            background-position: center;
        }
    </style>

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


<body class="authentication-bg20">

    <div class="account-pages mt-4 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center">
                        <a href="/" class="logo text-center">
                            <img src="{{ URL::asset('logo.png') }}" width="80px" alt="برنامج إدارة المدارس">
                        </a>
                        <h3 class=" mt-2 mb-4">توصيل اكسبريس</h3>
                    </div>

                    @include('flash-message')
                    <div class="card">

                        <div class="card-body p-3">

                            <div class="text-center mb-2">
                                <h4 class="text-uppercase mt-0"> تسجيل عضوية جديدة</h4>
                            </div>

                            <form method="POST" action="{{ route('register_store') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="emailaddress"> الاسم</label>
                                    <input class="form-control" type="text" name="name" id="name" required
                                        autofocus placeholder="الاسم" value="{{ old('name') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="phone"> رقم الهاتف</label>
                                    <input class="form-control" type="number" name="phone" id="phone" required
                                        autofocus placeholder="رقم الهاتف" value="{{ old('phone') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="emailaddress"> البريد الإلكتروني</label>
                                    <input class="form-control" type="email" name="email" id="email" required
                                        autofocus placeholder="البريد الإلكتروني" value="{{ old('email') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">كلمة المرور</label>
                                    <input class="form-control" type="password" name="password" required id="password"
                                        placeholder="كلمة المرور">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">تأكيد كلمة المرور</label>
                                    <input class="form-control" type="password" name="password_confirmation" required
                                        id="password_confirmation" placeholder="تأكيد كلمة المرور">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-secondary btn-block" type="submit"> تسجيل </button>
                                </div>

                            </form>

                            <div class="text-center mt-2">
                                لدي حساب بالفعل
                                <a href="{{ route('login') }}"> تسجيل الدخول</a>
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
    <script src="{{ URL::asset('backend/assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('backend/assets/js/app.min.js') }}"></script>

</body>

</html>
