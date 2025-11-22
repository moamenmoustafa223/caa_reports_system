@extends('frontend.layouts.master')

@section('page_title') {{trans('front.videos')}} @endsection

@section('meta_keywords') {{$setting->meta_keywords}} @endsection

@section('meta_description') {{$setting->meta_description}} @endsection


@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area style-four "style=" background-image: url({{asset($about_us->bg_image)}});">
        <div class="container">
            <div class="page-title-content text-start">
                <h3>م{{trans('front.videos')}}</h3>
                <ul>
                    <li><a href="/">{{trans('front.home')}}</a></li>
                    <li>{{trans('front.videos')}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->


    <!-- Start Gallery Area -->
    <div class=" pt-70 pb-70">
        <div class="container">

            <div class="row">

                @forelse($videos as $video)

                    <div class="col-md-4 text-center">

                        <div class="card" >
                            <div class="ratio ratio-16x9">
                                {!! $video->url !!}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$video->title}}</h5>
                            </div>
                        </div>

                    </div>

                @empty
                    <h4 class="text-center"> {{trans('front.no_items_found')}} </h4>
                @endforelse

            </div>
        </div>
    </div>
    <!-- End Gallery Area -->






@endsection

@section('js')

@endsection
