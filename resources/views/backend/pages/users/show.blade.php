@extends('backend.layouts.master')

@section('page_title')
    {{trans('users.show_user')}}
    {{ $user->name }}
@endsection


@section('content')


    <div class="col-sm-4">
        <a class="btn btn-secondary btn-sm mb-1" href="{{ route('users.index') }}">
            <i class="fas fa-chevron-circle-right"></i>
            {{trans('back.back')}}
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="box-head pb-4">
                    <strong>{{trans('users.name')}} : </strong>
                    {{ $user->name }}
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong> {{trans('users.email')}} :</strong>
                        {{ $user->email }}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{trans('users.Roles')}}  :</strong>
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge bg-secondary">{{ $v }}</label> 
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
@endsection
