<div class="navbar-area">

    <div class="noke-responsive-nav">
        <div class="container">
            <div class="noke-responsive-menu">
                <div class="logo">
                    <a href="/"><img src="{{asset($setting->logo)}}" alt="logo" width="50px"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="noke-nav">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="/"><img src="{{asset($setting->logo)}}" alt="logo" width="70px"></a>

                <div class="collapse navbar-collapse mean-menu">
                    <ul class="navbar-nav">

                        <li class="nav-item ">
                            <a href="/" class=" nav-link ">{{trans('front.home')}}</a>
                        </li>


                        <li class="nav-item ">
                            <a href="{{route('about_us')}}" class=" nav-link  ">{{trans('front.about_us')}}  </a>
                        </li>


                        <li class="nav-item"><a href="#" class="dropdown-toggle nav-link">{{trans('front.services')}}</a>
                            <ul class="dropdown-menu">
                                @forelse($services as $service)
                                    <li class="nav-item">
                                        <a href="{{route('service',$service->slug )}}" class="nav-link">
                                            {{$service->name}}
                                        </a>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </li>

                        <li class="nav-item"><a href="#" class="dropdown-toggle nav-link">{{trans('front.blog')}}</a>
                            <ul class="dropdown-menu">
                                @forelse($categories as $category)
                                    <li class="nav-item">
                                        <a href="{{route('category',$category->slug )}}" class="nav-link">
                                            {{$category->name}}
                                        </a>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('team')}}" class=" nav-link ">{{trans('front.teams')}}</a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="dropdown-toggle nav-link">{{trans('front.gallery')}}</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{route('gallery_show' )}}" class="nav-link"> {{trans('front.gallery_photos')}} </a>
                                    <a href="{{route('video_show' )}}" class="nav-link"> {{trans('front.videos')}}  </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item ">
                            <a href="{{route('contact_us')}}" class=" nav-link ">{{trans('front.contact_us')}} </a>
                        </li>

                        {{-- كود تغيير اللغة  --}}
                        <li class="nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
                                @if (App::getLocale() == 'ar')
                                    <strong class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }} </strong>
                                @else
                                    <strong class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            @if($properties['native'] == "English")
                                            @elseif($properties['native'] == "العربية")
                                            @endif
                                            {{ $properties['native'] }}
                                        </a>
                                    @endforeach
                                </li>
                            </ul>
                        </li>
                        {{-- نهاية كود تغيير اللغة  --}}


                    </ul>

                    <div class="others-option d-flex align-items-center">
                        <div class="option-item">
                            <div class="search-icon">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>

                        <div class="option-item">
                            <div class="social-links">
                                <span><a href="{{$setting->facebook_url}}" target="_blank"><i class="fab fa-facebook-f"></i></a></span>
                                <span><a href="{{$setting->instagram_url}}" target="_blank"><i class="fab fa-instagram"></i></a></span>
                                <span><a href="{{$setting->twitter_url}}" target="_blank"><i class="fab fa-twitter"></i></a></span>
                                <span><a href="{{$setting->linkedin_url}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></span>
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
                        <div class="option-item">
                            <div class="search-icon">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>

                        <div class="option-item">
                            <div class="social-links">
                                <span><a href="{{$setting->facebook_url}}" target="_blank"><i class="fab fa-facebook-f"></i></a></span>
                                <span><a href="{{$setting->instagram_url}}" target="_blank"><i class="fab fa-instagram"></i></a></span>
                                <span><a href="{{$setting->twitter_url}}" target="_blank"><i class="fab fa-twitter"></i></a></span>
                                <span><a href="{{$setting->linkedin_url}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
