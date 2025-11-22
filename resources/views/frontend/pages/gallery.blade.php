@extends('frontend.layouts.master')

@section('page_title'){{trans('front.gallery_photos')}} @endsection

@section('meta_keywords') {{$setting->meta_keywords}} @endsection

@section('meta_description') {{$setting->meta_description}} @endsection


@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area style-four "style=" background-image: url({{asset($about_us->bg_image)}});">
        <div class="container">
            <div class="page-title-content text-start">
                <h3>{{trans('front.gallery_photos')}}</h3>
                <ul>
                    <li><a href="/">{{trans('front.home')}}</a></li>
                    <li>{{trans('front.gallery_photos')}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->


    <!-- Start Gallery Area -->
    <div class="gallery-area pt-100 pb-70">
        <div class="container">

            <div class="shorting">
                <div class="row">
                    @forelse($galleries as $gallery)
                    <div class="col-lg-3 col-md-6 col-sm-6 mix branding">
                        <div class="single-gallery-item">
                            <img src="{{ asset('uploads/gallery') . '/' .$gallery->path }}" alt="{{$gallery->path}}">
                            <a href="{{ asset('uploads/gallery') . '/' .$gallery->path }}" class="popup-image"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    @empty
                        <h4 class="text-center" > {{trans('front.no_items_found')}} </h4>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
    <!-- End Gallery Area -->


@endsection

@section('js')

@endsection
