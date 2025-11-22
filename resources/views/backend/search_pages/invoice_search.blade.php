@extends('backend.layouts.master')

@section('pageTitle')
{{trans('dashboard.Invoice_search')}}
@endsection

@section('page_title')
{{trans('dashboard.Invoice_search')}}
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


                    @if(! $invoices->count() == 0)
                        <div class="table-responsive">
                            <table  class="table text-center  table-striped  table-bordered table-sm ">
                                <thead>
                                <tr style="background-color: rgb(232,245,252)">
                                    <th>#</th>
                                    <th>{{trans('invoices.Invoice_Number')}}</th>
                                    <th>{{trans('invoices.job_card')}}</th>
                                    <th>{{trans('invoices.Customer_Name')}}</th>
                                    <th>{{trans('invoices.Car')}}</th>
                                    <th>{{trans('invoices.Total_All')}}</th>
                                    <th>{{trans('invoices.tax_value')}}</th>
                                    <th>{{trans('invoices.discount')}}</th>
                                    <th>{{trans('invoices.total_amount')}}</th>
                                    <th>{{trans('invoices.Paid')}}</th>
                                    <th>{{trans('invoices.rest_amount')}}</th>
                                    <th>{{trans('invoices.Invoice_Date')}}</th>
                                    <th>{{trans('invoices.Notes')}}</th>
                                    <th width="250">{{trans('invoices.Notes')}}</th>
                                    <th>{{trans('invoices.User')}}</th>
                                </tr>
                                </thead>

                                @php $i=1 @endphp

                                <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>$registrationType{{$invoice->invoice_number}}</td>
                                        <td>{{$invoice->job_card}}</td>
                                        <td>
                                            {{$invoice->Customer->name ?? ""}}
                                            <br>
                                            <a href="https://wa.me/{{ $invoice->Customer->phone ?? "" }}" target="_blank"> {{ $invoice->Customer->phone ?? "" }}</a>
                                        </td>

                                        <td>
                                            @if(app()->getLocale() == 'ar')
                                                {{$invoice->Car->brands_car->name_ar}}
                                            @else
                                                {{$invoice->Car->brands_car->name_en}}
                                            @endif
                                            <br>
                                            {{$invoice->Car->car_no ?? ""}}
                                        </td>
                                        <td>{{$invoice->sub_total_amount_all}}</td>
                                        <td>{{$invoice->tax_value}}</td>
                                        <td>{{$invoice->discount}}</td>
                                        <td>{{$invoice->total_amount}}</td>
                                        <td> {{ $invoice->payments->sum('payment_amount')}} </td>
                                        <td>{{$invoice->total_amount - $invoice->payments->sum('payment_amount')}}</td>
                                        <td>{{$invoice->invoice_date}}</td>
                                        <td width="100">{!! $invoice->notes !!}</td>
                                        <td>
                                            @can('Payment_add')
                                                <a class="btn btn-secondary btn-xs " href="" data-bs-toggle="modal" data-bs-target="#show_payments{{$invoice->id}}">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </a>
                                                @include('backend.pages.payments._show_payments')
                                            @endcan

                                            @can('Invoice_show')
                                                <a class="btn btn-secondary btn-xs " href="" data-bs-toggle="modal" data-bs-target="#invoice_details{{$invoice->id}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @include('backend.pages.invoices._invoice_details')
                                            @endcan

                                            @can('Invoice_edit')
                                                <a class="btn btn-secondary btn-xs " href="{{route('Invoices.edit', $invoice->id)}}" >
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('Invoice_print')
                                                <a class="btn btn-secondary btn-xs " href="{{route('invoice_number', $invoice->invoice_number)}}" target="_blank" >
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            @endcan

                                            @can('Invoice_delete')
                                                <a href="" class="btn btn-secondary btn-xs " data-bs-toggle="modal" data-bs-target="#delete_invoice{{$invoice->id}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                @include('backend.pages.invoices.delete')
                                            @endcan
                                        </td>
                                        <td>{{$invoice->User->name}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $invoices->appends(Request::all())->links() !!}.
                    @else
                        <div class="col-md-12">
                            <h4 class="text-center">
                                {{trans('invoices.No_invoices')}}
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
