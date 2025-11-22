@extends('frontend.layouts.master')

@section('page_title') {{$service->name}} @endsection

@section('meta_keywords') {{$service->meta_keywords}} @endsection

@section('meta_description') {{$service->meta_description}} @endsection


@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area style-four " style=" background-image: url({{asset($service->bg_image)}});">
        <div class="container">
            <div class="page-title-content text-start">
                <h3>{{$service->name}}</h3>
                <ul>
                    <li><a href="/">{{trans('front.home')}}</a></li>
                    <li>{{$service->name}}</li>
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
                        <img src="{{asset($service->image)}}" alt="image">
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="marketing-about-content">
                        <h3>{{$service->name}}</h3>
                        <p>{!! $service->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Area -->


@endsection

@section('js')

@endsection
