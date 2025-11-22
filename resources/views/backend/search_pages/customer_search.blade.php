@extends('backend.layouts.master')

@section('pageTitle')
{{trans('dashboard.Customer_search')}}
@endsection

@section('page_title')
{{trans('dashboard.Customer_search')}}
@endsection

@section('content')


    <div class="row ">
        <div class="col-md-12">
            <div class="card-box">
                <div class=" row justify-content-center text-center">
                    <div class="col-md-4">
                        @can('Customer_add')
                            <a class="btn btn-secondary btn-block  m-1" href="" data-bs-toggle="modal" data-bs-target="#add_customer">
                                <i class="mdi mdi-plus"></i>
                                {{trans('customers.Add_New_Customer')}}
                                <i class="fas fa-user"></i>
                            </a>
                            @include('backend.pages.customers.add')
                        @endcan
                    </div>

                    <div class="col-md-4">
                        @can('Car_add')
                            <a class="btn btn-secondary btn-block  m-1" href="" data-bs-toggle="modal" data-bs-target="#add_car">
                                <i class="mdi mdi-plus"></i>
                                {{trans('cars.Add_New_Car')}}
                                <i class="fas fa-car"></i>
                            </a>
                            @include('backend.pages.cars.add')
                        @endcan
                    </div>

                    <div class="col-md-4">
                        @can('BrandsCars_add')
                            <a class="btn btn-secondary btn-block  m-1" href="" data-bs-toggle="modal" data-bs-target="#add_modelsCar">
                                <i class="mdi mdi-plus"></i>
                                {{trans('BrandsCars.Add_New_BrandsCar')}}
                                <i class="fas fa-car"></i>
                            </a>
                            @include('backend.pages.CarsBrands.add')
                        @endcan
                    </div>

                </div>
            </div>
        </div>
    </div>


    @can('search_dashboard')

        <div class="row ">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="row text-center justify-content-center">

                        <div class="col-md-4 ">
                            <form action="{{ route('customer_search') }}" method="GET" role="search">
                                <label for=""> {{trans('dashboard.Customer_search')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control " name="query"
                                           value="{{old('query', request()->input('query'))}}"
                                           placeholder="{{trans('dashboard.search_dashboard')}} "
                                           id="query" >
                                    <button class="btn btn-secondary" type="submit" title="Search">
                                        <span class="fas fa-search"></span>
                                    </button>
                                    <a href="{{ route('dashboard.index') }}" class="btn btn-secondary" type="button" title="Reload">
                                        <span class="fas fa-sync-alt"></span>
                                    </a>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4 ">
                            <form action="{{ route('car_search') }}" method="GET" role="search">
                                <label for=""> {{trans('dashboard.car_search')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control " name="query"
                                           value="{{old('query', request()->input('query'))}}"
                                           placeholder="{{trans('dashboard.search_dashboard')}} "
                                           id="query" >
                                    <button class="btn btn-secondary" type="submit" title="Search">
                                        <span class="fas fa-search"></span>
                                    </button>
                                    <a href="{{ route('dashboard.index') }}" class="btn btn-secondary" type="button" title="Reload">
                                        <span class="fas fa-sync-alt"></span>
                                    </a>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4 ">
                            <form action="{{ route('invoice_search') }}" method="GET" role="search">
                                <label for=""> {{trans('dashboard.Invoice_search')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control " name="query"
                                           value="{{old('query', request()->input('query'))}}"
                                           placeholder="{{trans('dashboard.search_dashboard')}} "
                                           id="query" >
                                    <button class="btn btn-secondary" type="submit" title="Search">
                                        <span class="fas fa-search"></span>
                                    </button>
                                    <a href="{{ route('dashboard.index') }}" class="btn btn-secondary" type="button" title="Reload">
                                        <span class="fas fa-sync-alt"></span>
                                    </a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-box">

                    @if(! $customers->count() == 0)

                        <div class="table-responsive">
                            <table  class="table text-center  table-striped  table-bordered table-sm ">
                                <thead>
                                <tr style="background-color: rgb(232,245,252)">
                                    <th>#</th>
                                    <th> {{trans('customers.Customer_Name')}}</th>
                                    <th> {{trans('customers.Customer_phone')}}</th>
                                    <th> {{trans('customers.Customer_email')}}</th>
                                    <th> {{trans('customers.Customer_address')}}</th>
                                    <th> {{trans('customers.Customer_nationality')}}</th>
                                    <th width="150"> {{trans('customers.number_cars')}}</th>
                                    <th> {{trans('customers.number_invoices')}}</th>
                                    <th> {{trans('customers.Total_amount')}}</th>
                                    <th> {{trans('customers.Paid')}}</th>
                                    <th> {{trans('customers.rest_amount')}}</th>
                                    <th> {{trans('customers.Created_at')}}</th>
                                    <th width="150">  {{trans('customers.Action')}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($customers as $key => $customer)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>
                                            <a href="https://wa.me/{{ $customer->phone }}" target="_blank"> {{ $customer->phone }}</a>
                                        </td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->nationality }}</td>
                                        <td>
                                            <a class="btn btn-secondary btn-xs " href="" data-bs-toggle="modal" data-bs-target="#show_cars_customer{{$customer->id}}">
                                                {{trans('customers.Customer_cars')}}
                                                ( {{ $customer->cars->count() ?? "" }} )
                                            </a>
                                            @include('backend.pages.customers.cars_customer')
                                        </td>
                                        <td>{{ $customer->invoices->count() }}</td>
                                        <td>{{ $customer->invoices->sum('total_amount') }}</td>
                                        <td>{{ $customer->payments->sum('payment_amount') }}</td>
                                        <td>{{ $customer->invoices->sum('total_amount') - $customer->payments->sum('payment_amount') }}</td>
                                        <td>{{ $customer->created_at }}</td>
                                        <td>
                                            @can('Customer_edit')
                                                <a class="btn btn-secondary btn-xs " href="" data-bs-toggle="modal" data-bs-target="#edit_customer{{$customer->id}}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @include('backend.pages.customers.edit')
                                            @endcan

                                            @can('Customer_delete')
                                                <a href="" class="btn btn-secondary btn-xs " data-bs-toggle="modal" data-bs-target="#delete_customer{{$customer->id}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                @include('backend.pages.customers.delete')
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    @else
                        <div class="col-md-12">
                            <h4 class="text-center">
                                {{trans('customers.No_Customer_Found')}}
                            </h4>
                        </div>
                    @endif


                </div>
            </div>
        </div>
     @endcan





@endsection


@section('js')


@endsection
