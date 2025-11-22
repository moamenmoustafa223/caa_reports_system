<!-- Start Header Area -->
<div class="header-area p-absolute">

    <!-- Start Top Header Area -->
    <div class="top-header-area top-header-style-three consulting-color bg-f3f4f7">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="top-header-info">
                        <a href="mailto:hello@noke.com" class="email"><i class="far fa-envelope"></i> hello@noke.com</a>
                        <a href="tel:+44-45789-5789" class="number" data-bs-toggle="tooltip" data-bs-placement="top" title="Office Hours: 8AM - 8PM">
                            <i class="fas fa-phone-alt"></i>
                            (+44) - 45789 - 5789
                        </a>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="top-header-contact-info text-end">
                        <ul class="top-header-social-links d-inline-block">
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>


                        <div class="lang-switcher">
                            <label><i class="fas fa-globe"></i></label>
                            <a class=" dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (App::getLocale() == 'ar')
                                    <strong class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }} </strong>
                                @else
                                    <strong class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                @endif
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li >
                                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            @if($properties['native'] == "English")
                                            @elseif($properties['native'] == "العربية")
                                            @endif
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top Header Area -->

    <!-- Start Navbar Area -->
    <div class="navbar-area navbar-style-five consulting-color">
        <div class="noke-responsive-nav">
            <div class="container">
                <div class="noke-responsive-menu">
                    <div class="logo">
                        <a href="/"><img src="{{asset(\App\Models\Setting::first()->logo)}}" alt="logo" width="60px"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="noke-nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="/"><img src="{{asset(App\Models\Setting::first()->logo)}}" alt="logo" width="60px"></a>

                    <div class="collapse navbar-collapse mean-menu">
                        <ul class="navbar-nav">
                            <li class="nav-item megamenu">
                                <a href="/" class=" nav-link ">الرئيسية</a>
                            </li>


                            <li class="nav-item"><a href="#" class="dropdown-toggle nav-link">تواصل معنا </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="contact-1.html" class="nav-link">Contact 01</a></li>

                                    <li class="nav-item"><a href="contact-2.html" class="nav-link">Contact 02</a></li>

                                    <li class="nav-item"><a href="contact-3.html" class="nav-link">Contact 03</a></li>
                                </ul>
                            </li>
                        </ul>

                        <div class="others-option d-flex align-items-center">
                            <div class="option-item">
                                <div class="search-box">
                                    <input type="text" class="input-search" placeholder="Search">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="others-option-for-responsive">
            <div class="container">
                <div class="dot-menu">
                    <div class="inner">
                        <div class="circle circle-one"></div>
                        <div class="circle circle-two"></div>
                        <div class="circle circle-three"></div>
                    </div>
                </div>

                <div class="container">
                    <div class="option-inner">
                        <div class="others-option">
                            <div class="search-box">
                                <input type="text" class="input-search" placeholder="Search">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->

</div>
<!-- End Header Area -->
