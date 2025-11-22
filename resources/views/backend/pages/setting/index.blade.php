@extends('backend.layouts.master')

@section('page_title')
    {{trans('setting.setting')}}
@endsection

@section('content')

    @can('Setting')
        <div class="row">
            <div class="col-12">
                <div class="card-box">

                    <form action=" {{ route('Setting.update', $setting->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="logo">{{trans('setting.logo')}} </label>
                                <input type="file" class="form-control-file mb-2" name="logo" id="logo">
                                <img src="{{ asset($setting->logo) }}"  alt="image" width="100px">
                            </div>


                            <hr class="col-md-12 mt-2 mb-2">

                            <div class="form-group col-md-6">
                                <label for="company_name_ar"> {{trans('setting.company_name_ar')}}   </label>
                                <input type="text" class="form-control"  name="company_name_ar" value="{{ $setting->company_name_ar }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="company_name_en"> {{trans('setting.company_name_en')}}   </label>
                                <input type="text" class="form-control"  name="company_name_en" value="{{ $setting->company_name_en }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email"> {{trans('setting.email')}}  </label>
                                <input type="email" class="form-control"   name="email" value="{{ $setting->email }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone"> {{trans('setting.phone')}}   </label>
                                <input type="tel" class="form-control" name="phone" value="{{ $setting->phone }}">
                            </div>

                            <div class="form-group col-md-12 text-center mt-2">
                                <button type="submit" class="btn btn-success"> {{trans('verbs.save')}}  </button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endcan

@endsection
