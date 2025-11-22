<!-- Start About Area -->
<div class="startup-about-area pt-70 pb-100" style="background-color: rgba(232,232,232,0.76)">
    <div class="container-fluid">

        <div class="row align-items-center">
            <div class="col-md-6 text-center">
                <div class="">
                    <img src="{{asset($about->image)}}" alt="image">
                </div>
            </div>

            <div class="col-md-6">
                <div class="startup-about-content">
                    <h3>{{$about->title}}</h3>
                    <p><strong>{!! $about->short_about !!}</strong></p>
                    <a href="{{$about->btn_url}}" target="_blank" class="default-btn">{{$about->btn}} </a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End About Area -->

