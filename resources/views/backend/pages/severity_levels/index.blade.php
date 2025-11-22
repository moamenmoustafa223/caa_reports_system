@extends('backend.layouts.master')

@section('page_title')
{{trans('back.severity_levels')}}
@endsection

@section('content')

    <div class="row">
        @can('add_severity_level')
        <div class="col-md-9 mb-1">
            <a class="btn btn-primary btn-sm" href="" data-bs-toggle="modal" data-bs-target="#add_SeverityLevel">
                <i class="mdi mdi-plus"></i>
                {{trans('back.add_severity_level')}}
            </a>
            @include('backend.pages.severity_levels.add')
        </div>
        @endcan

        <div class="col-md-3 mb-1">
            <form action="{{ route('severity_levels.index') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="query" value="{{old('query', request()->input('query'))}}" placeholder="search..." id="query">
                    <button class="btn btn-primary btn-sm ml-1" type="submit" title="Search">
                        <span class="fas fa-search"></span>
                    </button>
                    <a href="{{ route('severity_levels.index') }}" class="btn btn-success btn-sm ml-1 " type="button" title="Reload">
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
                            <th> {{trans('back.level_key')}}</th>
                            <th> {{trans('back.name_ar')}}</th>
                            <th> {{trans('back.name_en')}}</th>
                            <th> {{trans('back.order')}}</th>
                            <th> {{trans('back.color')}}</th>
                            <th> {{trans('back.created_at')}}</th>
                            <th> {{trans('back.actions')}}</th>
                        </tr>
                        </thead>

                        @php $i=1 @endphp
                        <tbody>
                        @foreach($severityLevels as $level)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><code>{{ $level->level_key }}</code></td>
                                <td>{{ $level->name_ar }}</td>
                                <td>{{ $level->name_en }}</td>
                                <td><span class="badge bg-secondary">{{ $level->order }}</span></td>
                                <td>
                                    <span class="badge" style="background-color: {{ $level->color }}">
                                        {{ $level->color }}
                                    </span>
                                </td>
                                <td>{{ $level->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">

                                    {{-- Edit --}}
                                    @can('edit_severity_level')
                                        <a href="#" class="text-success mx-1" title="{{ trans('back.edit') }}"
                                           data-bs-toggle="modal" data-bs-target="#edit_SeverityLevel{{ $level->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @include('backend.pages.severity_levels.edit')
                                    @endcan

                                    {{-- Delete --}}
                                    @can('delete_severity_level')
                                        <a href="#" class="text-danger mx-1" title="{{ trans('back.delete') }}"
                                           data-bs-toggle="modal" data-bs-target="#delete_SeverityLevel{{ $level->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        @include('backend.pages.severity_levels.delete')
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


