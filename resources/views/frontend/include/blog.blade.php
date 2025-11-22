<!-- Start Blog Area -->
<div class="blog-area pt-70 pb-70" style="background-color: rgba(243,250,237,0.68)">
    <div class="container">
        <div class="section-title">
            <h3>{{trans('front.blog')}}</h3>
        </div>

        <div class="row justify-content-center">

            @forelse($posts as $post)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="single-blog-post">
                        <img src="{{asset($post->image)}}" alt="{{$post->title}}" >

                        <div class="content">
                            <ul class="meta">
                                <li><i class="far fa-calendar-alt"></i> {{$post->created_at->diffForHumans()}} </li>
                                <li><i class="fas fa-align-justify"></i> <a href="{{route('categories.show', $post->category->slug)}}">{{$post->category->name}}</a></li>
                            </ul>
                            <h3><a href="{{route('post', $post->slug)}}">{{$post->title}}</a></h3>
                            <a href="{{route('post', $post->slug)}}" class="link-btn">{{trans('front.reed_moor')}} </a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </div>
</div>
<!-- End Blog Area -->
