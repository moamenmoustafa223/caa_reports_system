@extends('backend.layouts.master')

@section('page_title')
{{trans('dashboard.dashboard')}}
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
                    <div class="row">
                        @foreach($cars as $car)
                            <div class="col-md-6">
                                <div class="card border border-primary">

                                    <h5 class="card-header text-center" style="line-height: 27px">
                                         <span class=" ml-2">
                                             <i class="fas fa-user"></i>
                                            {{trans('cars.Customer_name')}} :
                                        </span>
                                        {{ $car->Customer->name ?? "" }}

                                        <span class=" ml-2">
                                            <i class="fas fa-phone-square"></i>
                                             {{trans('cars.Customer_phone')}} :
                                        </span>
                                        <a href="https://wa.me/{{ $car->Customer->phone ?? "" }}" target="_blank"> {{ $car->Customer->phone ?? "" }}</a>
                                    </h5>

                                    <div class="table-responsive">
                                        <table class="table table-striped  table-bordered table-sm text-center table-striped" style="margin-bottom: 10px">
                                            <tr>
                                                <th> {{trans('cars.brands_car')}}</th>
                                                <td>
                                                    @if(app()->getLocale() == 'ar')
                                                        {{ $car->brands_car->name_ar ?? "" }}
                                                    @else
                                                        {{ $car->brands_car->name_en ?? "" }}
                                                    @endif
                                                </td>

                                                <th>{{trans('cars.car_no')}}  </th>
                                                <td> {{ $car->car_no }}</td>
                                            </tr>

                                            <tr>
                                                <th>{{trans('cars.model')}} </th>
                                                <td> {{ $car->model }}</td>

                                                <th>{{trans('cars.car_color')}}</th>
                                                <td>{{ $car->car_color }} </td>
                                            </tr>

                                            <tr>
                                                <th>{{trans('cars.country_manufacture')}} </th>
                                                <td> {{ $car->country_manufacture }}</td>

                                                <th>{{trans('cars.registration_no')}}</th>
                                                <td>{{ $car->registration_no }} </td>
                                            </tr>

                                            <tr>
                                                <th>{{trans('cars.cylinders_no')}}</th>
                                                <td>{{ $car->cylinders_no }} </td>

                                                <th> {{trans('cars.number_invoices')}}</th>
                                                <td> {{ $car->invoices->count() }}</td>
                                            </tr>

                                            <tr>
                                                <th>{{trans('cars.Total_amount')}} </th>
                                                <td> {{ $car->invoices->sum('total_amount') }}</td>

                                                <th>{{trans('cars.Paid')}}</th>
                                                <td>{{ $car->payments->sum('payment_amount') }} </td>
                                            </tr>

                                            <tr>
                                                <th colspan="2">{{trans('cars.rest_amount')}} </th>
                                                <td colspan="2"> {{ $car->invoices->sum('total_amount') - $car->payments->sum('payment_amount') }}</td>
                                            </tr>

                                        </table>
                                    </div>

                                    <div class="card-footer text-center">
                                        @can('new_invoice')
                                            <a class="btn btn-secondary btn-sm" href="{{route('create_invoice', $car->id)}}">
                                                {{trans('cars.new_invoice')}}
                                            </a>
                                        @endcan
                                        @can('new_quotation')
                                            <a class="btn btn-secondary btn-sm" href="{{route('create_quotation', $car->id)}}">
                                                {{trans('cars.new_quotation')}}
                                            </a>
                                        @endcan
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
     @endcan





@endsection


@section('js')


@endsection
