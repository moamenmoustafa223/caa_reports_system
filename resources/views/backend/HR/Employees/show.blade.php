@extends('backend.layouts.master')

@section('page_title')
    {{ trans('employees.Page_of_employee') }} :
    {{ $employee->name }}
@endsection


@section('content')

    <div class="row">
        <div class="col-md-9 mb-1">
            <a class="btn btn-primary btn-sm" href="{{ route('Employees.index') }}">
                <i class="fas fa-arrow-right me-1"></i>
                {{ trans('back.Back') }}
            </a>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="bg-picture card-box">
                <div class="profile-info-name">
                    <img src="{{ asset($employee->image) }}" class="rounded-circle avatar-xl img-thumbnail float-left mr-3"
                        alt="profile-image">

                    <div class="profile-info-detail overflow-hidden">
                        <h4 class="mb-2">
                            <span class="text-primary">{{ trans('back.employee_name') }} :</span>
                            @if (app()->getLocale() == 'ar')
                                {{ $employee->name_ar }}
                            @else
                                {{ $employee->name_en }}
                            @endif
                        </h4>
                        <p class="font-16">
                            <span class="text-primary">{{ trans('back.employee_no') }} :</span>
                            {{ $employee->employee_no }}
                        </p>

                        <p class="font-16">
                            <span class="text-primary">{{ trans('back.Join_date') }} :</span>
                            {{ $employee->Join_date }}
                        </p>

                        <p class="font-16">
                            <b>{{ trans('back.Nationality') }} :</b>
                            {{ $employee->Nationality }}
                            -
                            <b> {{ trans('back.phone') }} :</b>
                            {{ $employee->phone }}
                            -
                            <b>{{ trans('back.email') }} :</b>
                            {{ $employee->email }}
                            -
                            <b> {{ trans('back.id_number') }} :</b>
                            {{ $employee->id_number }}
                        </p>

                        <p class="font-16">
                            <b>{{ trans('back.department') }} :</b>
                            @if (app()->getLocale() == 'ar')
                                {{ $employee->CategoryEmployees->name ?? '-' }}
                            @else
                                {{ $employee->CategoryEmployees->name_en ?? '-' }}
                            @endif
                        </p>

                        <p class="font-16">
                            <b>{{ trans('back.status') }} :</b>
                            @if($employee->status)
                                <span class="badge bg-success">{{ trans('back.active') }}</span>
                            @else
                                <span class="badge bg-danger">{{ trans('back.inactive') }}</span>
                            @endif
                        </p>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>

@endsection
