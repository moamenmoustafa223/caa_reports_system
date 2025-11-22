@extends('frontend.layouts.master')

@section('page_title') {{$category->name}} @endsection

@section('meta_keywords') {{$category->meta_keywords}} @endsection

@section('meta_description') {{$category->meta_description}} @endsection


@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area style-four " style=" background-image: url({{asset($category->bg_image)}});">
        <div class="container">
            <div class="page-title-content text-start">
                <h3>{{$category->name}}</h3>
                <ul>
                    <li><a href="/">{{trans('front.home')}}</a></li>
                    <li>{{$category->name}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->



    <!-- Start Blog Area -->
    <div class="blog-area ptb-100">
        <div class="container">

            <div class="row justify-content-center">


                @forelse($category->posts as $post)

                    <div class="col-md-4 text-center">
                        <div class="single-post-item startup-color">
                            <div class="post-image">
                                <a href="{{route('post', $post->slug)}}" class="d-block">
                                    <img src="{{asset($post->image)}}" alt="{{$post->title}}">
                                </a>
                            </div>
                            <div class="post-content">
                                <ul class="meta">
                                    <li><i class="far fa-calendar-alt"></i> {{$post->created_at->diffForHumans()}} </li>
                                </ul>
                                <h3><a href="{{route('post', $post->slug)}}">{{$post->title}}</a></h3>
                                <a href="{{route('post', $post->slug)}}" class="link-btn"> {{trans('front.reed_moor')}} </a>
                            </div>
                        </div>
                    </div>

                @empty
                    <h4 class="text-center">{{trans('front.no_items_found')}}  </h4>
                @endforelse

            </div>
        </div>
    </div>
    <!-- End Blog Area -->




@endsection

@section('js')

@endsection
