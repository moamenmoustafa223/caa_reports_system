@extends('backend.layouts.master')

@section('page_title')
{{trans('employees.employees')}}
@endsection


@section('content')

    <div class="row">
        @can('Employees_add')
        <div class="col-md-9 mb-1">
            <a class="btn btn-primary btn-sm" href="{{route('Employees.create')}}">
                <i class="mdi mdi-plus"></i>
                {{trans('employees.add_new_employee')}}
            </a>
        </div>
        @endcan

        <div class="col-md-3 mb-1">
            <form action="{{ route('Employees.index') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="query" value="{{old('query', request()->input('query'))}}" placeholder="search..." id="query">
                    <button class="btn btn-primary btn-sm ml-1" type="submit" title="Search">
                        <span class="fas fa-search"></span>
                    </button>
                    <a href="{{ route('Employees.index') }}" class="btn btn-success btn-sm ml-1 " type="button" title="Reload">
                        <span class="fas fa-sync-alt"></span>
                    </a>
                </div>
            </form>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <div class="table-responsive">
                    <table  class="table text-center  table-bordered table-sm ">
                        <thead>
                        <tr style="background-color: rgb(232,245,252)">
                            <th width="25">#</th>
                            <th width="100">{{trans('employees.image')}}</th>
                            <th width="100">{{trans('employees.employee_no')}}</th>
                            <th width="150">{{trans('employees.employee_name')}}</th>
                            <th width="100">{{trans('employees.Category')}}</th>
                            <th width="100">{{trans('employees.phone')}}</th>
                            <th width="100">{{trans('employees.id_number')}}</th>
                            <th width="100">{{trans('employees.Nationality')}}</th>
                            <th width="100">{{trans('employees.Join_date')}}</th>
                            <th width="100">{{trans('back.Status')}}</th>
                            <th width="100">{{trans('back.reports')}}</th>
                            <th width="100">{{trans('employees.Created_at')}}</th>
                            <th width="250">{{trans('employees.Action')}}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($employees as $key=> $employee)
                            <tr
                            @if ($employee->status == 1)
                            style="background-color: #e3ffea"
                            @else
                            style="background-color: #ffe3e3"
                            @endif
                            >
                                <td>{{$key+ $employees->firstItem()}}</td>
                                <td>
                                    @if(isset($employee->image))
                                        <img src="{{asset($employee->image)}}" alt="{{$employee->name}}" width="40">
                                    @else
                                        <img src="{{asset('images/no_image.png')}}" alt="{{$employee->name}}" width="40">
                                    @endif
                                </td>
                                <td>
                                    {{$employee->employee_no}}
                                </td>
                                <td>
                                    @if (app()->getLocale() == 'ar')
                                        {{ $employee->name_ar }}
                                    @else
                                        {{ $employee->name_en }}
                                    @endif
                                </td>

                                <td>
                                    @if (app()->getLocale() == 'ar')
                                        {{ $employee->CategoryEmployees->name }}
                                    @else
                                        {{ $employee->CategoryEmployees->name_en }}
                                    @endif
                                </td>
                                <td> <a href="https://wa.me/{{ $employee->phone }}" target="_blank">{{ $employee->phone }}</a> </td>
                                <td>{{ $employee->id_number }}</td>
                                <td>{{ $employee->Nationality }}</td>
                                <td> {{ $employee->Join_date }}</td>
                                <td> {{ $employee->status() }}</td>
                                <td>{{ $employee->reports_count ?? 0 }}</td>
                                <td>{{ $employee->created_at }}</td>
                                <td class="text-center">

                                    {{-- View --}}
                                    @can('Employees_show')
                                        <a href="{{ route('Employees.show', $employee->id) }}" class="text-secondary mx-1" title="{{ trans('back.view') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                
                                    {{-- Edit --}}
                                    @can('Employees_edit')
                                        <a href="{{ route('Employees.edit', $employee->id) }}" class="text-success mx-1" title="{{ trans('back.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                
                                    {{-- Delete --}}
                                    @can('Employees_delete')
                                        <a href="#" class="text-danger mx-1" title="{{ trans('back.delete') }}"
                                           data-bs-toggle="modal" data-bs-target="#delete_Employees{{ $employee->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        @include('backend.HR.Employees.delete')
                                    @endcan
                                
                                    {{-- Images --}}
                                    @can('Employees_Images')
                                        <a href="#" class="text-info mx-1" title="{{ trans('back.images') }} ({{ $employee->employees_images->count() }})"
                                           data-bs-toggle="modal" data-bs-target="#EmployeesImages{{ $employee->id }}">
                                            <i class="fas fa-images"></i>
                                            ({{ $employee->employees_images->count() }})
                                        </a>
                                        @include('backend.HR.Employees.EmployeesImages')
                                    @endcan
                                
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $employees->appends(Request::all())->links() !!}

            </div>
        </div>
    </div>

@endsection

