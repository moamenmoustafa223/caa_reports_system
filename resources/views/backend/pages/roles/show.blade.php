@extends('backend.layouts.master')

@section('page_title')
{{trans('roles.show_role')}}
    {{ $role->name }}
@endsection


@section('content')


    <div class="col-sm-4">
        <a class="btn btn-secondary btn-sm mb-1" href="{{ route('roles.index') }}">
            <i class="fas fa-chevron-circle-right"></i>
            {{trans('roles.Back')}}
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="box-head pb-4">
                    <strong>{{trans('roles.role_name')}} : </strong>
                    {{ $role->name }}
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{trans('roles.permissions')}}:</strong>
                        <br>
                        <br>
                        @if(!empty($rolePermissions))
                            <div class="row">
                                @foreach($rolePermissions as $v)
                                    <div class="col-md-2">
                                        {{ trans('back.'.$v->name)  }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end row -->


@endsection
