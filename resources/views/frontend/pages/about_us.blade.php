@extends('frontend.layouts.master')

@section('page_title') {{$about_us->title}} @endsection

@section('meta_keywords') {{$about_us->meta_keywords}} @endsection

@section('meta_description') {{$about_us->meta_description}} @endsection

@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area style-four " style=" background-image: url({{asset($about_us->bg_image)}});">
        <div class="container">
            <div class="page-title-content text-start">
                <h3>{{$about_us->title}}</h3>
                <ul>
                    <li><a href="/">{{trans('front.home')}}</a></li>
                    <li>{{$about_us->title}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->


    <!-- Start About Area -->
    <div class="marketing-about-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="marketing-about-image">
                        <img src="{{asset($about_us->image)}}" alt="{{$about_us->title}}" width="60%">
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="marketing-about-content">
                        <h3>{{$about_us->title}}</h3>
                        <p>{!! $about->about !!}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Area -->


@endsection

@section('js')

@endsection
