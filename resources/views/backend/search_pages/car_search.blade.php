@extends('backend.layouts.master')

@section('pageTitle')
{{trans('dashboard.car_search')}}
@endsection

@section('page_title')
{{trans('dashboard.car_search')}}
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

                    @if(! $cars->count() == 0)
                        <div class="table-responsive">
                            <table  class="table text-center  table-striped  table-bordered table-sm ">
                                <thead>
                                <tr style="background-color: rgb(232,245,252)">
                                    <th>#</th>
                                    <th>{{trans('cars.Customer_name')}}</th>
                                    <th>{{trans('cars.Customer_phone')}}</th>
                                    <th>{{trans('cars.brands_car')}}</th>
                                    <th>{{trans('cars.car_no')}}</th>
                                    <th>{{trans('cars.model')}}</th>
                                    <th>{{trans('cars.car_color')}}</th>
                                    <th>{{trans('cars.country_manufacture')}}</th>
                                    <th>{{trans('cars.registration_no')}}</th>
                                    <th>{{trans('cars.cylinders_no')}}</th>

                                    <th width="120">{{trans('cars.Action')}}</th>
                                    <th>{{trans('cars.number_invoices')}}</th>
                                    <th>{{trans('cars.Total_amount')}}</th>
                                    <th>{{trans('cars.Paid')}}</th>
                                    <th>{{trans('cars.rest_amount')}}</th>
                                    <th>{{trans('cars.Created_at')}}</th>
                                    <th width="120">{{trans('cars.Action')}}</th>
                                    <th>{{trans('cars.User')}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($cars as $index => $car)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{ $car->Customer->name ?? "" }}</td>
                                        <td>
                                            <a href="https://wa.me/{{ $car->Customer->phone ?? "" }}" target="_blank"> {{ $car->Customer->phone ?? "" }}</a>
                                        </td>
                                        <td>
                                            @if(app()->getLocale() == 'ar')
                                                {{ $car->brands_car->name_ar ?? "" }}
                                            @else
                                                {{ $car->brands_car->name_en ?? "" }}
                                            @endif
                                        </td>
                                        <td>{{ $car->car_no }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ $car->car_color }}</td>
                                        <td>{{ $car->country_manufacture }}</td>
                                        <td>{{ $car->registration_no }}</td>
                                        <td>{{ $car->cylinders_no }}</td>
                                        <td>
                                            @can('new_invoice')
                                                <a class="btn btn-secondary btn-xs mb-1 btn-block" href="{{route('create_invoice', $car->id)}}">
                                                    {{trans('cars.new_invoice')}}
                                                </a>
                                            @endcan
                                            @can('new_quotation')
                                                <a class="btn btn-secondary btn-xs mb-1 btn-block" href="{{route('create_quotation', $car->id)}}">
                                                    {{trans('cars.new_quotation')}}
                                                </a>
                                            @endcan

                                            @can('new_quotation')
                                                <a class="btn btn-secondary btn-xs mb-1 btn-block" href="{{route('create_jobCard', $car->id)}}">
                                                    {{trans('job_card.job_card')}}
                                                </a>
                                            @endcan
                                        </td>
                                        <td>{{ $car->invoices->count() }}</td>
                                        <td>{{ $car->invoices->sum('total_amount') }}</td>
                                        <td>{{ $car->payments->sum('payment_amount') }}</td>
                                        <td>{{ $car->invoices->sum('total_amount') - $car->payments->sum('payment_amount') }}</td>
                                        <td>{{ $car->created_at }}</td>

                                        <td>
                                            @can('Car_edit')
                                                <a class="btn btn-secondary btn-xs " href="" data-bs-toggle="modal" data-bs-target="#edit_car{{$car->id}}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @include('backend.pages.cars.edit')
                                            @endcan

                                            @can('Car_delete')
                                                <a href="" class="btn btn-secondary btn-xs " data-bs-toggle="modal" data-bs-target="#delete_car{{$car->id}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                @include('backend.pages.cars.delete')
                                            @endcan
                                        </td>
                                        <td>{{ $car->User->name ?? "" }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="col-md-12">
                            <h4 class="text-center">
                                {{trans('cars.No_Car_Found')}}
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
