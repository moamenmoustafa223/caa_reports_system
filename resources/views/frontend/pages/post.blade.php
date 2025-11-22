@extends('frontend.layouts.master')

@section('page_title') {{$post->title}} @endsection

@section('meta_keywords') {{$post->meta_keywords}} @endsection

@section('meta_description') {{$post->meta_description}} @endsection


@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area style-four " style=" background-image: url({{asset($post->bg_image)}});">
        <div class="container">
            <div class="page-title-content text-start">
                <h3>{{$post->title}}</h3>
                <ul>
                    <li><a href="/">{{trans('front.home')}}</a></li>
                    <li>{{$post->title}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->


    <!-- Start Blog Details Area -->
    <section class="blog-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-details-desc">
                        <div class="article-image">
                            <img src="{{asset($post->image)}}" alt="{{$post->title}}">
                        </div>

                        <div class="article-content">
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="fas fa-align-justify"></i> <a href="{{route('category', $post->category->slug)}}">{{$post->category->name}}</a></li>
                                    <li><i class="far fa-calendar-alt"></i> {{$post->created_at->diffForHumans()}} </li>
                                </ul>
                            </div>
                            <h3>{{$post->title}}</h3>
                            <p>{!! $post->description !!}</p>

                        </div>

                    </div>
                </div>


                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area extra-padding">
                        <div class="widget widget_search">
                            <form class="search-form">
                                <label>
                                    <input type="search" class="search-field" placeholder="Search...">
                                </label>
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>

                        <div class="widget widget_noke_posts_thumb">
                            <h3 class="widget-title">{{trans('front.other_posts')}}</h3>

                            @forelse($posts as $post)
                            <article class="item">
                                <a href="{{route('post', $post->slug)}}" class="thumb"><span class="fullimage cover bg1" role="img"></span></a>
                                <div class="info">
                                    <h4 class="title usmall"><a href="{{route('post', $post->slug)}}">{{$post->title}}r</a></h4>
                                    <span class="date"><i class="far fa-calendar-alt"></i> {{$post->created_at->diffForHumans()}}</span>
                                </div>
                            </article>
                            @empty
                                <p class="text-center">{{trans('front.no_items_found')}}  </p>
                            @endforelse

                        </div>

                        <div class="widget widget_categories">
                            <h3 class="widget-title">{{trans('front.blog')}}</h3>

                            <ul>
                                @forelse($categories as $category)
                                <li><a href="{{route('category', $category->slug)}}">{{$category->name}} <span class="post-count">{{$category->posts->count()}}</span></a></li>
                                @empty
                                    <p class="text-center">{{trans('front.no_items_found')}} </p>
                                @endforelse
                            </ul>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Details Area -->


@endsection

@section('js')

@endsection
