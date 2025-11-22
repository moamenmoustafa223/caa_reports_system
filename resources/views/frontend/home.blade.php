@extends('frontend.layouts.master')

@section('page_title') {{\App\Models\Setting::first()->website_name}}@endsection


@section('content')

    <!-- Start Banner Area -->
    @include('frontend.include.slider')
    <!-- End Banner Area -->


@endsection

@section('js')

@endsection
