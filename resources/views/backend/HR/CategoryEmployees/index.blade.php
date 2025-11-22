@extends('backend.layouts.master')

@section('page_title')
{{trans('cat_employees.categories_employees')}}
@endsection

@section('content')

    <div class="row">
        @can('CategoryEmployees_add')
        <div class="col-md-9 mb-1">
            <a class="btn btn-primary btn-sm" href="" data-bs-toggle="modal" data-bs-target="#add_CategoryEmployees">
                <i class="mdi mdi-plus"></i>
                {{trans('cat_employees.add_new_category')}}
            </a>
            @include('backend.HR.CategoryEmployees.add')
        </div>
        @endcan

        <div class="col-md-3 mb-1">
            <form action="{{ route('CategoryEmployees.index') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="query" value="{{old('query', request()->input('query'))}}" placeholder="search..." id="query">
                    <button class="btn btn-primary btn-sm ml-1" type="submit" title="Search">
                        <span class="fas fa-search"></span>
                    </button>
                    <a href="{{ route('CategoryEmployees.index') }}" class="btn btn-success btn-sm ml-1 " type="button" title="Reload">
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
                            <th>#</th>
                            <th> {{trans('cat_employees.category_name')}}</th>
                            <th> {{trans('cat_employees.employees_under_this_category')}}</th>
                            <th> {{trans('cat_employees.Created_at')}}</th>
                            <th> {{trans('cat_employees.Action')}}</th>
                        </tr>
                        </thead>

                        @php $i=1 @endphp
                        <tbody>
                        @foreach($categoriesEmployees as $categoryEmployees)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    @if (app()->getLocale() == 'ar')
                                    {{ $categoryEmployees->name }}
                                    @else
                                        {{ $categoryEmployees->name_en }}
                                    @endif
                                </td>
                                <td>{{$categoryEmployees->Employees->count()}}</td>
                                <td>{{ $categoryEmployees->created_at }}</td>
                                <td class="text-center">

                                    {{-- Edit --}}
                                    @can('CategoryEmployees_edit')
                                        <a href="#" class="text-success mx-1" title="{{ trans('verbs.edit') }}"
                                           data-bs-toggle="modal" data-bs-target="#edit_CategoryEmployees{{ $categoryEmployees->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @include('backend.HR.CategoryEmployees.edit')
                                    @endcan
                                
                                    {{-- Delete --}}
                                    @can('CategoryEmployees_delete')
                                        <a href="#" class="text-danger mx-1" title="{{ trans('verbs.delete') }}"
                                           data-bs-toggle="modal" data-bs-target="#delete_CategoryEmployees{{ $categoryEmployees->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        @include('backend.HR.CategoryEmployees.delete')
                                    @endcan
                                
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

@endsection



@section('js')

    <script>

    </script>

@endsection


