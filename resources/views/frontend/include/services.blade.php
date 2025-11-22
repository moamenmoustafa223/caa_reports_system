<!-- Start Features Area -->
<div class="features-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h3>{{trans('front.services')}}</h3>
        </div>

        <div class="row justify-content-center">

            @forelse($services as $service)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-features-box">
{{--                        <i class="icon flaticon-chat"></i>--}}
                        {!! $service->icon !!}
                        <h3>{{$service->name}}</h3>
                        <p>{!! $service->description !!}</p>
                        <a href="{{route('service',$service->slug )}}" class="link-btn">
                            {{trans('front.reed_moor')}}
                        </a>
                    </div>
                </div>
            @empty

            @endforelse

        </div>
    </div>
</div>
<!-- End Features Area -->
