@extends('backend.layouts.master')

@section('page_title')
    {{ trans('back.report_statuses') }}
@endsection

@section('content')
    <div class="row">
        @can('add_report_status')
            <div class="col-md-9 mb-1">
                <a class="btn btn-primary btn-sm" href="" data-bs-toggle="modal" data-bs-target="#add_ReportStatus">
                    <i class="mdi mdi-plus"></i>
                    {{ trans('back.add_report_status') }}
                </a>
                @include('backend.pages.report_statuses.add')
            </div>
        @endcan

        <div class="col-md-3 mb-1">
            <form action="{{ route('report_statuses.index') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="query"
                        value="{{ old('query', request()->input('query')) }}" placeholder="search..." id="query">
                    <button class="btn btn-primary btn-sm ml-1" type="submit" title="Search">
                        <span class="fas fa-search"></span>
                    </button>
                    <a href="{{ route('report_statuses.index') }}" class="btn btn-success btn-sm ml-1 " type="button"
                        title="Reload">
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
                    <table class="table text-center  table-bordered table-sm ">
                        <thead>
                            <tr style="background-color: rgb(232,245,252)">
                                <th>#</th>
                                <th> {{ trans('back.name_ar') }}</th>
                                <th> {{ trans('back.name_en') }}</th>
                                <th> {{ trans('back.color') }}</th>
                                <th> {{ trans('back.description') }}</th>
                                <th> {{ trans('back.created_at') }}</th>
                                <th> {{ trans('back.actions') }}</th>
                            </tr>
                        </thead>

                        @php $i=1 @endphp
                        <tbody>
                            @foreach ($reportStatuses as $status)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $status->name_ar }}</td>
                                    <td>{{ $status->name_en }}</td>
                                    <td>
                                        <span class="badge" style="background-color: {{ $status->color }}">
                                            {{ $status->color }}
                                        </span>
                                    </td>
                                    <td>{{ \Str::limit($status->description, 50) }}</td>
                                    <td>{{ $status->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center">

                                        {{-- Edit --}}
                                        @can('edit_report_status')
                                            <a href="#" class="text-success mx-1" title="{{ trans('back.edit') }}"
                                                data-bs-toggle="modal" data-bs-target="#edit_ReportStatus{{ $status->id }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @include('backend.pages.report_statuses.edit')
                                        @endcan

                                        {{-- Delete --}}
                                        @can('delete_report_status')
                                            <a href="#" class="text-danger mx-1" title="{{ trans('back.delete') }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#delete_ReportStatus{{ $status->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @include('backend.pages.report_statuses.delete')
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
    <script></script>
@endsection
