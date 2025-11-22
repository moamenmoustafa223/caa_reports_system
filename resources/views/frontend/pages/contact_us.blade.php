@extends('frontend.layouts.master')

@section('page_title') {{trans('front.contact_us')}} @endsection

@section('meta_keywords') {{$setting->meta_keywords}} @endsection

@section('meta_description') {{$setting->meta_description}} @endsection


@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area style-four "style=" background-image: url({{asset($contact_us->bg_image)}});">
        <div class="container">
            <div class="page-title-content text-start">
                <h3>{{trans('front.contact_us')}}</h3>
                <ul>
                    <li><a href="/">{{trans('front.home')}}</a></li>
                    <li>{{trans('front.contact_us')}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <div class="text-center container p-3">
        @include('flash-message')
    </div>



    <!-- Start Contact Area -->
    <div class="contact-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="single-contact-info-box style-two">
                        <div class="icon">
                            <i class='fas fa-map-marker-alt'></i>
                        </div>
                        <h3>{{trans('front.address')}}</h3>
                        <p><a href="#" target="_blank">{{$contact_us->address}}</a></p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="single-contact-info-box style-two">
                        <div class="icon">
                            <i class='fas fa-phone-volume'></i>
                        </div>
                        <h3>{{trans('front.phone')}}</h3>
                        <p><a href="tel:+44587154756">{{$contact_us->phone}}</a></p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="single-contact-info-box style-two">
                        <div class="icon">
                            <i class='far fa-envelope'></i>
                        </div>
                        <h3>{{trans('front.email')}}</h3>
                        <p><a href="mailto:noke@hello.com">{{$contact_us->email}}</a></p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="single-contact-info-box style-two">
                        <div class="icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h3>{{trans('front.whatsapp')}}</h3>
                        <p><a href="https://wa.me/{{$contact_us->whatsapp}}">{{$contact_us->whatsapp}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="maps">
        {!! $contact_us->map !!}
    </div>

    <div class="contact-area pt-100">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">{{trans('front.contact_us')}}</span>
                <h2>{{trans('front.We_are_pleased')}} </h2>
            </div>

            <div class="contact-form m-0">
                <form  action="{{route('messages.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" required placeholder="{{trans('front.name')}}">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email" required  placeholder="{{trans('front.email')}}">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="number" name="phone_number" class="form-control" id="phone_number" required  placeholder="{{trans('front.phone')}}">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" name="msg_subject" class="form-control" id="msg_subject" placeholder="{{trans('front.msg_subject')}}" required >
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <textarea name="message" id="message" class="form-control" cols="30" rows="6" required  placeholder="{{trans('front.message')}}"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <button type="submit" class="default-btn">{{trans('front.send_message')}} </button>
                        </div>



                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Contact Area -->


@endsection

@section('js')

@endsection
