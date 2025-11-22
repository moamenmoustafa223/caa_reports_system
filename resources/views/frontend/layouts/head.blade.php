<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('page_title') </title>

    <link rel="icon" type="image/png" href="{{asset(\App\Models\Setting::first()->logo)}}">

    <meta name="keywords" content="@yield('meta_keywords')" />
    <meta name="description" content="@yield('meta_description')" />


@if (App::getLocale() == 'ar')

    <!-- Links of CSS files -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/odometer.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/rangeSlider.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/showMoreItems-theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css_rtl/responsive.css')}}">

@else

        <!-- Links of CSS files -->
        <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/odometer.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/rangeSlider.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/showMoreItems-theme.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/flaticon.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/meanmenu.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">

@endif


    {{-- Google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400&display=swap" rel="stylesheet">

    <style>
        body, h1, h2, h3, h4, h5, h6, p{
            font-family: 'Almarai', sans-serif;
        }
    </style>
    {{-- Google font --}}



</head>
