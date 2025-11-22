@extends('backend.layouts.master')

@section('page_title')
    {{ trans('back.reports') }}
@endsection


@section('content')


    <div class="row g-1 align-items-end mb-2">
        <div class="col-md-3">
            @can('add_report')
                <a href="{{ route('reports.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> {{ trans('back.add_report') }}
                </a>
            @endcan
            @can('export_report')
                <a href="{{ route('reports.export', request()->query()) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-file-export me-1"></i> {{ trans('back.export') }}
                </a>
            @endcan
        </div>
        <div class="col-md-12">
            <form action="{{ route('reports.index') }}" method="GET">
                <div class="row g-1">

                    {{-- Search --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small mb-1">{{ trans('back.Search') }}</label>
                        <input type="text" name="search" class="form-control form-control-sm"
                            placeholder="{{ trans('back.report_number') }}, {{ trans('back.description') }}"
                            value="{{ request('search') }}">
                    </div>
                    {{-- Employee Filter --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small mb-1">{{ trans('back.employee') }}</label>
                        <select name="employee_id" class="form-select form-select-sm select2">
                            <option value="">{{ trans('back.All') }}</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                    @if (app()->getLocale() == 'ar')
                                        {{ $employee->name_ar }} / {{ $employee->phone }}
                                    @else
                                        {{ $employee->name_en }} / {{ $employee->phone }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Location Filter --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">{{ trans('back.location') }}</label>
                        <select name="location_id" class="form-select form-select-sm select2">
                            <option value="">{{ trans('back.All') }}</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}"
                                    {{ request('location_id') == $location->id ? 'selected' : '' }}>
                                    @if (app()->getLocale() == 'ar')
                                        {{ $location->name_ar }}
                                    @else
                                        {{ $location->name_en }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Severity Filter --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">{{ trans('back.severity') }}</label>
                        <select name="severity_level_id" class="form-select form-select-sm select2">
                            <option value="">{{ trans('back.All') }}</option>
                            @foreach ($severityLevels as $level)
                                <option value="{{ $level->id }}"
                                    {{ request('severity_level_id') == $level->id ? 'selected' : '' }}>
                                    @if (app()->getLocale() == 'ar')
                                        {{ $level->name_ar }}
                                    @else
                                        {{ $level->name_en }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status Filter --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">{{ trans('back.status') }}</label>
                        <select name="status_id" class="form-select form-select-sm select2">
                            <option value="">{{ trans('back.All') }}</option>
                            @foreach ($reportStatuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ request('status_id') == $status->id ? 'selected' : '' }}>
                                    @if (app()->getLocale() == 'ar')
                                        {{ $status->name_ar }}
                                    @else
                                        {{ $status->name_en }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>



                    {{-- From Date --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">{{ trans('back.from_date') }}</label>
                        <input type="date" name="start_date" class="form-control form-control-sm"
                            value="{{ request('start_date') }}">
                    </div>

                    {{-- To Date --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">{{ trans('back.to_date') }}</label>
                        <input type="date" name="end_date" class="form-control form-control-sm"
                            value="{{ request('end_date') }}">
                    </div>

                    {{-- Action Buttons --}}
                    <div class="col-md-2 d-flex gap-1 align-items-end">
                        <button class="btn btn-primary" type="submit" title="{{ trans('back.Search') }}">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="{{ route('reports.index') }}" class="btn btn-success"
                            title="{{ trans('back.refresh') }}">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @if ($reports->count() > 0)
            <div class="col-12">
                <div class="card-box">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered text-center table-sm">
                            <thead>
                                <tr>
                                    <th width="30">#</th>
                                    <th width="120">{{ trans('back.report_number') }}</th>
                                    <th width="100">{{ trans('back.report_date') }}</th>
                                    <th width="150">{{ trans('back.employee') }}</th>
                                    <th width="120">{{ trans('back.department') }}</th>
                                    <th width="120">{{ trans('back.location') }}</th>
                                    <th width="100">{{ trans('back.severity') }}</th>
                                    <th width="150">{{ trans('back.status') }}</th>
                                    <th width="250">{{ trans('back.short_description') }}</th>
                                    <th width="200">{{ trans('back.actions') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($reports as $key => $report)
                                    <tr>
                                        <td>{{ $key + $reports->firstItem() }}</td>
                                        <td><strong>{{ $report->report_number }}</strong></td>
                                        <td>{{ $report->report_date->format('Y-m-d') }}</td>
                                        <td>
                                            @if (app()->getLocale() == 'ar')
                                                {{ $report->employee?->name_ar ?? '-' }}
                                            @else
                                                {{ $report->employee?->name_en ?? '-' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (app()->getLocale() == 'ar')
                                                {{ $report->employee?->CategoryEmployees?->name ?? '-' }}
                                            @else
                                                {{ $report->employee?->CategoryEmployees?->name_en ?? '-' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (app()->getLocale() == 'ar')
                                                {{ $report->location?->name_ar ?? '-' }}
                                            @else
                                                {{ $report->location?->name_en ?? '-' }}
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge"
                                                style="background-color: {{ $report->severityLevel?->color }}">
                                                @if (app()->getLocale() == 'ar')
                                                    {{ $report->severityLevel?->name_ar ?? '-' }}
                                                @else
                                                    {{ $report->severityLevel?->name_en ?? '-' }}
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            @can('change_report_status')
                                                <form action="{{ route('reports.change_status', $report->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <select name="status_id"
                                                        class="form-select form-select-sm text-white border-0"
                                                        style="background-color: {{ $report->status?->color }}; width: auto; display: inline-block;"
                                                        onchange="this.form.submit()">
                                                        @foreach ($reportStatuses as $status)
                                                            <option value="{{ $status->id }}"
                                                                {{ $report->status_id == $status->id ? 'selected' : '' }}>
                                                                @if (app()->getLocale() == 'ar')
                                                                    {{ $status->name_ar }}
                                                                @else
                                                                    {{ $status->name_en }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            @else
                                                <span class="badge" style="background-color: {{ $report->status?->color }}">
                                                    @if (app()->getLocale() == 'ar')
                                                        {{ $report->status?->name_ar ?? '-' }}
                                                    @else
                                                        {{ $report->status?->name_en ?? '-' }}
                                                    @endif
                                                </span>
                                            @endcan
                                        </td>
                                        <td class="text-start">

                                            {{ \Str::limit($report->short_description, 50) }}

                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                @can('show_report')
                                                    <a href="{{ route('reports.show', $report->id) }}"
                                                        class="btn btn-sm btn-info" title="{{ trans('back.show') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan

                                                @can('delete_report')
                                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $report->id }}"
                                                        title="{{ trans('back.delete') }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                @endcan

                                            </div>

                                            {{-- Include delete modal --}}
                                            @include('backend.pages.reports.delete')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $reports->appends(Request::all())->links() !!}
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="alert alert-danger text-center">
                    <h4>{{ trans('back.none') }}</h4>
                </div>
            </div>
        @endif

    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
        });
    </script>
@endsection
