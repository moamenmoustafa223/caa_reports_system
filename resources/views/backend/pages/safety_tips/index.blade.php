@extends('backend.layouts.master')

@section('page_title')
{{trans('back.safety_tips')}}
@endsection

@section('content')

    <div class="row">
        @can('add_safety_tip')
        <div class="col-md-9 mb-1">
            <a class="btn btn-primary btn-sm" href="" data-bs-toggle="modal" data-bs-target="#add_SafetyTip">
                <i class="mdi mdi-plus"></i>
                {{trans('back.add_safety_tip')}}
            </a>
            @include('backend.pages.safety_tips.add')
        </div>
        @endcan

        <div class="col-md-3 mb-1">
            <form action="{{ route('safety_tips.index') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="query" value="{{old('query', request()->input('query'))}}" placeholder="search..." id="query">
                    <button class="btn btn-primary btn-sm ml-1" type="submit" title="Search">
                        <span class="fas fa-search"></span>
                    </button>
                    <a href="{{ route('safety_tips.index') }}" class="btn btn-success btn-sm ml-1 " type="button" title="Reload">
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
                            <th> {{trans('back.title_ar')}}</th>
                            <th> {{trans('back.title_en')}}</th>
                            <th> {{trans('back.icon')}}</th>
                            <th> {{trans('back.order')}}</th>
                            <th> {{trans('back.status')}}</th>
                            <th> {{trans('back.created_at')}}</th>
                            <th> {{trans('back.actions')}}</th>
                        </tr>
                        </thead>

                        @php $i=1 @endphp
                        <tbody>
                        @foreach($safetyTips as $safetyTip)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $safetyTip->title_ar }}</td>
                                <td>{{ $safetyTip->title_en }}</td>
                                <td>{{ $safetyTip->icon }}</td>
                                <td>{{ $safetyTip->order }}</td>
                                <td>
                                    @if($safetyTip->status == 1)
                                        <span class="badge bg-success">{{trans('back.active')}}</span>
                                    @else
                                        <span class="badge bg-danger">{{trans('back.inactive')}}</span>
                                    @endif
                                </td>
                                <td>{{ $safetyTip->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">

                                    {{-- Edit --}}
                                    @can('edit_safety_tip')
                                        <a href="#" class="text-success mx-1" title="{{ trans('back.edit') }}"
                                           data-bs-toggle="modal" data-bs-target="#edit_SafetyTip{{ $safetyTip->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @include('backend.pages.safety_tips.edit')
                                    @endcan

                                    {{-- Delete --}}
                                    @can('delete_safety_tip')
                                        <a href="#" class="text-danger mx-1" title="{{ trans('back.delete') }}"
                                           data-bs-toggle="modal" data-bs-target="#delete_SafetyTip{{ $safetyTip->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        @include('backend.pages.safety_tips.delete')
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
