@extends('frontend.layouts.master')

@section('page_title') {{trans('front.teams')}} @endsection

@section('meta_keywords') {{$setting->meta_keywords}} @endsection

@section('meta_description') {{$setting->meta_description}} @endsection


@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area style-four "style=" background-image: url({{asset($about_us->bg_image)}});">
        <div class="container">
            <div class="page-title-content text-start">
                <h3>{{trans('front.teams')}}</h3>
                <ul>
                    <li><a href="/">{{trans('front.home')}}</a></li>
                    <li>{{trans('front.teams')}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->


    <!-- Start Team Area -->
    <div class="team-area pt-70 pb-70">
        <div class="container">
            <div class="section-title">
                <h3>{{trans('front.teams')}}</h3>
                <p>لدينا فريق عمل متخصص وذو خبرة وكفاءة عالية مستعدون لخدمتكم دائماً </p>
            </div>

            <div class="row justify-content-center">

                @forelse($teams as $team)
                    <div class="col-md-3">
                        <div class="single-team-member">
                            <img src="{{asset($team->image)}}" alt="{{$team->name}}" width="80%">

                            <div class="content">
                                <h3>{{$team->name}}</h3>
                                <span>{{$team->jop}}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">{{trans('front.no_items_found')}}  </p>
                @endforelse

            </div>
        </div>
    </div>
    <!-- End Team Area -->


@endsection

@section('js')

@endsection
