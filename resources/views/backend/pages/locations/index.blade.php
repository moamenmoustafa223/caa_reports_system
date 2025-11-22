@extends('backend.layouts.master')

@section('page_title')
{{trans('back.locations')}}
@endsection

@section('content')

    <div class="row">
        @can('add_location')
        <div class="col-md-9 mb-1">
            <a class="btn btn-primary btn-sm" href="" data-bs-toggle="modal" data-bs-target="#add_Location">
                <i class="mdi mdi-plus"></i>
                {{trans('back.add_location')}}
            </a>
            @include('backend.pages.locations.add')
        </div>
        @endcan

        <div class="col-md-3 mb-1">
            <form action="{{ route('locations.index') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="query" value="{{old('query', request()->input('query'))}}" placeholder="search..." id="query">
                    <button class="btn btn-primary btn-sm ml-1" type="submit" title="Search">
                        <span class="fas fa-search"></span>
                    </button>
                    <a href="{{ route('locations.index') }}" class="btn btn-success btn-sm ml-1 " type="button" title="Reload">
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
                            <th> {{trans('back.name_ar')}}</th>
                            <th> {{trans('back.name_en')}}</th>
                            <th> {{trans('back.status')}}</th>
                            <th> {{trans('back.created_at')}}</th>
                            <th> {{trans('back.actions')}}</th>
                        </tr>
                        </thead>

                        @php $i=1 @endphp
                        <tbody>
                        @foreach($locations as $location)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $location->name_ar }}</td>
                                <td>{{ $location->name_en }}</td>
                                <td>
                                    @if($location->status == 1)
                                        <span class="badge bg-success">{{trans('back.active')}}</span>
                                    @else
                                        <span class="badge bg-danger">{{trans('back.inactive')}}</span>
                                    @endif
                                </td>
                                <td>{{ $location->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">

                                    {{-- Edit --}}
                                    @can('edit_location')
                                        <a href="#" class="text-success mx-1" title="{{ trans('back.edit') }}"
                                           data-bs-toggle="modal" data-bs-target="#edit_Location{{ $location->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @include('backend.pages.locations.edit')
                                    @endcan

                                    {{-- Delete --}}
                                    @can('delete_location')
                                        <a href="#" class="text-danger mx-1" title="{{ trans('back.delete') }}"
                                           data-bs-toggle="modal" data-bs-target="#delete_Location{{ $location->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        @include('backend.pages.locations.delete')
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


