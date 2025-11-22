@extends('backend.layouts.master')

@section('page_title')
    {{trans('employees.edit_employee')}}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-9 mb-1">
            <a class="btn btn-primary btn-sm" href="{{route('Employees.index')}}">
                <i class="fas fa-arrow-circle-right pr-1"></i>
                {{trans('employees.Back')}}
            </a>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title mb-3"> {{trans('employees.edit_employee')}}</h4>

                    <form action="{{route('Employees.update',$employee->id )}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="form-group col-md-3">
                                <label for="" class="font-weight-bold">
                                    {{trans('employees.select_Category')}}
                                </label>
                                <select class="form-control select2" name="category_employees_id" required>
                                    <option selected disabled value=""> {{trans('employees.select_Category')}}</option>
                                    @foreach(App\Models\HR\CategoryEmployees::all() as $categoryEmployees)
                                        <option value="{{ $categoryEmployees->id }}" {{ old('category_employees_id', $employee->category_employees_id) == $categoryEmployees->id ? 'selected' : null }} >
                                            @if (app()->getLocale() == 'ar')
                                                {{ $categoryEmployees->name }}
                                            @else
                                                {{ $categoryEmployees->name_en }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-3">
                                <label for="status">{{trans('back.Status')}}</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $employee->status) == 1 ? 'selected' : null }}>{{trans('back.active')}}</option>
                                    <option value="0" {{ old('status', $employee->status) == 0 ? 'selected' : null }}>{{trans('back.inactive')}}</option>
                                </select>
                            </div>


                            <hr class="col-md-12">


                            <div class="form-group col-md-3">
                                <label for="employee_no">{{trans('employees.employee_no')}}</label>
                                <input type="text" class="form-control" placeholder="{{trans('employees.employee_no')}}" name="employee_no" value="{{$employee->employee_no}}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="Join_date">{{trans('employees.Join_date')}}</label>
                                <input type="date" class="form-control" placeholder="{{trans('employees.Join_date')}}" name="Join_date" value="{{$employee->Join_date}}" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="name_ar">{{trans('employees.employee_name_ar')}}</label>
                                <input type="text" class="form-control" placeholder="{{trans('employees.employee_name_ar')}}" name="name_ar" value="{{$employee->name_ar}}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="name_en">{{trans('employees.employee_name_en')}}</label>
                                <input type="text" class="form-control" placeholder="{{trans('employees.employee_name_en')}}" name="name_en" value="{{$employee->name_en}}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="email">{{trans('employees.email')}}</label>
                                <b class="text-danger">*</b>
                                <input type="email" class="form-control" placeholder="{{trans('employees.email')}} " name="email" value="{{$employee->email}}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="phone">{{trans('employees.phone')}} (UserName)</label>
                                <input type="number" class="form-control" placeholder="{{trans('employees.phone')}} " name="phone" value="{{$employee->phone}}" required>
                                <small id="emailHelp" class="form-text text-muted">{{trans('back.notes_username_employee')}}</small>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="password">{{trans('employees.password')}}</label>
                                <input type="password" class="form-control" placeholder="{{trans('employees.password')}}" name="password">
                                <small class="form-text text-muted">{{trans('back.leave_empty_to_keep_current')}}</small>
                            </div>

                            <hr class="col-md-12">

                            <div class="form-group col-md-3">
                                <label for="Nationality">{{trans('employees.Nationality')}}</label>
                                <input type="text" class="form-control" placeholder="{{trans('employees.Nationality')}}" name="Nationality" value="{{$employee->Nationality}}" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="id_number">{{trans('employees.id_number')}} </label>
                                <input type="text" class="form-control" placeholder="{{trans('employees.id_number')}}" name="id_number" value="{{$employee->id_number}}" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="image">{{trans('employees.image')}}</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="image">{{trans('employees.image')}}</label>
                                <img src="{{asset($employee->image)}}" alt="{{$employee->name_ar}}" width="100">
                            </div>

                        </div>

                        <hr class="col-md-12">
                        <div class=" col-md-12 text-center">
                            <button type="submit" class="btn btn-success"> {{trans('employees.Save')}} </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- end row -->


@endsection


@section('js')
    <script>

    </script>
@endsection


