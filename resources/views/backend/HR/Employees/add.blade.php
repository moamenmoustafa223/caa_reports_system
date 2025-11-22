@extends('backend.layouts.master')

@section('page_title')
   {{trans('employees.add_new_employee')}}
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

                    <h4 class="header-title mb-3"> {{trans('employees.add_new_employee')}}</h4>

                    <form action="{{route('Employees.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="" class="font-weight-bold">
                                    {{trans('employees.select_Category')}}
                                </label>
                                <b class="text-danger">*</b>
                                <select class="form-control select2" name="category_employees_id" required>
                                    <option selected disabled value=""> {{trans('employees.select_Category')}}</option>
                                    @foreach(App\Models\HR\CategoryEmployees::all() as $categoryEmployees)
                                        <option value="{{ $categoryEmployees->id }}" {{ old('category_employees_id') == $categoryEmployees->id ? 'selected' : null }} >
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
                                <b class="text-danger">*</b>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : null }}>{{trans('back.active')}}</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : null }}>{{trans('back.inactive')}}</option>
                                </select>
                            </div>

                            <hr class="col-md-12">

                            <div class="form-group col-md-3">
                                <label for="employee_no">{{trans('employees.employee_no')}}</label>
                                <b class="text-danger">*</b>
                                <input type="text" class="form-control" placeholder="{{trans('employees.employee_no')}}" name="employee_no" value="{{old('employee_no')}}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="Join_date">{{trans('employees.Join_date')}}</label>
                                
                                <input type="date" class="form-control" placeholder="{{trans('employees.Join_date')}}" name="Join_date" value="{{old('Join_date')}}" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="name_ar">{{trans('employees.employee_name_ar')}}</label>
                                <b class="text-danger">*</b>
                                <input type="text" class="form-control" placeholder="{{trans('employees.employee_name_ar')}}" name="name_ar" value="{{old('name_ar')}}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="name_en">{{trans('employees.employee_name_en')}}</label>
                                <b class="text-danger">*</b>
                                <input type="text" class="form-control" placeholder="{{trans('employees.employee_name_en')}}" name="name_en" value="{{old('name_en')}}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="email">{{trans('employees.email')}}</label>
                                <b class="text-danger">*</b>
                                <input type="email" class="form-control" placeholder="{{trans('employees.email')}} " name="email" value="{{old('email')}}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="phone">{{trans('employees.phone')}} (UserName)</label>
                                <b class="text-danger">*</b>
                                <input type="number" class="form-control" placeholder="{{trans('employees.phone')}} " name="phone" value="{{old('phone')}}" required>
                                <small id="emailHelp" class="form-text text-muted">{{trans('back.notes_username_employee')}}</small>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="password">{{trans('employees.password')}}</label>
                                <b class="text-danger">*</b>
                                <input type="password" class="form-control" placeholder="{{trans('employees.password')}}" name="password" value="{{old('password')}}" required>
                            </div>

                            <hr class="col-md-12">

                            <div class="form-group col-md-3">
                                <label for="Nationality">{{trans('employees.Nationality')}}</label>
                                <input type="text" class="form-control" placeholder="{{trans('employees.Nationality')}}" name="Nationality" value="{{old('Nationality')}}" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="id_number">{{trans('employees.id_number')}}</label>
                                <input type="text" class="form-control" placeholder="{{trans('employees.id_number')}} " name="id_number" value="{{old('id_number')}}" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="image">{{trans('employees.image')}}</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                        </div> <!-- end row -->

                        <hr class="col-md-12">
                        <div class=" col-md-12 text-center">
                            <button type="submit" class="btn btn-success"> {{trans('employees.Add')}} </button>
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


