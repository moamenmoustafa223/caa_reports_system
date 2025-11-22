@extends('backend.layouts.master')

@section('page_title')
    {{ trans('dashboard.dashboard') }}
@endsection

@section('content')

    <style>
        .transition {
            transition: all 0.3s ease;
        }

        .card.transition:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .stat-card {
            border-radius: 12px;
            border: none;
            margin-bottom: 0px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-card .stat-value {
            font-size: 28px;
            font-weight: 700;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>

    <div class="row justify-content-center g-3">

        <!-- Logo -->
        <div class="col-md-12 text-center mb-2">
            <img src="{{ asset(App\Models\Setting::first()->logo) }}" alt="image" width="100">
        </div>

        
        <!-- Notifications Card -->
        @if($notifications->count() > 0)
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fa fa-bell me-2"></i>{{ __('back.notifications') }}
                        <span class="badge bg-danger ms-2">{{ $notifications->count() }}</span>
                    </h5>
                    <a href="{{ route('markAsRead_all') }}" class="btn btn-sm btn-outline-secondary">
                        {{ trans('dashboard.Clear_all') }}
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <tbody>
                                @foreach($notifications as $notification)
                                @php
                                    $severityColor = $notification->report?->severityLevel?->color ?? '#6c757d';
                                @endphp
                                <tr style="border-left: 4px solid {{ $severityColor }}">
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center">
                                            <div class="stat-icon me-3" style="background-color: {{ $severityColor }}20; color: {{ $severityColor }}; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium">{{ $notification->data['title'] ?? __('back.new_notification') }}</p>
                                                <small class="text-muted">
                                                    {{ $notification->data['message'] ?? '' }}
                                                </small>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="far fa-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                                    @if($notification->report?->severityLevel)
                                                        <span class="ms-2 badge" style="background-color: {{ $severityColor }}">
                                                            {{ $notification->report->severityLevel->name }}
                                                        </span>
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-3">
                                        @if($notification->data['report_id'] ?? null)
                                        @can('reports')
                                        <a href="{{ route('reports.show', $notification->data['report_id']) }}" class="btn btn-sm btn-primary me-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @endcan
                                        @endif
                                        <a href="{{ route('markAsRead', $notification->id) }}" class="btn btn-sm btn-success" title="{{ trans('back.mark_as_read') }}">
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Report Statistics Cards -->
        <div class="col-12">
            <div class="row g-3">
                <!-- Total Reports -->
                <div class="col-6 col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted mb-1">{{ __('back.total_reports') }}</p>
                                    <h3 class="stat-value mb-0">{{ $total_reports }}</h3>
                                </div>
                                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports Today -->
                <div class="col-6 col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted mb-1">{{ __('back.reports_today') }}</p>
                                    <h3 class="stat-value mb-0">{{ $reports_today }}</h3>
                                </div>
                                <div class="stat-icon bg-success bg-opacity-10 text-success">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports This Week -->
                <div class="col-6 col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted mb-1">{{ __('back.reports_this_week') }}</p>
                                    <h3 class="stat-value mb-0">{{ $reports_this_week }}</h3>
                                </div>
                                <div class="stat-icon bg-info bg-opacity-10 text-info">
                                    <i class="fas fa-calendar-week"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports This Month -->
                <div class="col-6 col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted mb-1">{{ __('back.reports_this_month') }}</p>
                                    <h3 class="stat-value mb-0">{{ $reports_this_month }}</h3>
                                </div>
                                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Severity Level Statistics Cards -->
        <div class="col-12">
            <h5 class="mb-2">{{ __('back.reports_by_severity') }}</h5>
            <div class="row g-3">
                @foreach($reportsBySeverity as $severity)
                <div class="col-6 col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted mb-1">{{ $severity->name }}</p>
                                    <h3 class="stat-value mb-0">{{ $severity->reports_count }}</h3>
                                </div>
                                <div class="stat-icon" style="background-color: {{ $severity->color }}20; color: {{ $severity->color }}">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <!-- Reports by Status -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h5 class="card-title mb-0">{{ __('back.reports_by_status') }}</h5>
                </div>
                <div class="card-body">
                    @foreach($reportsByStatus as $status)
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <span class="status-badge me-2" style="background-color: {{ $status->color }}20; color: {{ $status->color }}">
                                {{ $status->name }}
                            </span>
                        </div>
                        <span class="fw-bold">{{ $status->reports_count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ __('back.recent_reports') }}</h5>
                    @can('reports')
                    <a href="{{ route('reports.index') }}" class="btn btn-sm btn-primary">
                        {{ __('back.view_all') }}
                    </a>
                    @endcan
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>{{ __('back.report_number') }}</th>
                                    <th>{{ __('back.employee') }}</th>
                                    <th>{{ __('back.status') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse($recent_reports as $report)
                                <tr>
                                    <td>
                                        @can('reports')
                                        <a href="{{ route('reports.show', $report->id) }}">
                                            {{ $report->report_number }}
                                        </a>
                                        @else
                                        {{ $report->report_number }}
                                        @endcan
                                    </td>
                                    <td>{{ $report->employee?->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge" style="background-color: {{ $report->status->color }}">
                                            {{ $report->status->name }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">
                                        {{ __('back.no_reports_yet') }}
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Cards -->
        <div class="col-12 mt-4">
            <h5 class="mb-0">{{ __('back.quick_access') }}</h5>
        </div>

        @php
            $cards = [
                // Reports first
                [
                    'icon' => 'fa-file-alt',
                    'route' => 'reports.index',
                    'text' => 'back.reports',
                    'permission' => 'reports',
                ],
                [
                    'icon' => 'fa-map-marker-alt',
                    'route' => 'locations.index',
                    'text' => 'back.locations',
                    'permission' => 'locations',
                ],
                [
                    'icon' => 'fa-exclamation-triangle',
                    'route' => 'severity_levels.index',
                    'text' => 'back.severity_levels',
                    'permission' => 'severity_levels',
                ],
                [
                    'icon' => 'fa-tasks',
                    'route' => 'report_statuses.index',
                    'text' => 'back.report_statuses',
                    'permission' => 'report_statuses',
                ],
                // HR
                [
                    'icon' => 'fa-users-cog',
                    'route' => 'CategoryEmployees.index',
                    'text' => 'back.CategoryEmployees',
                    'permission' => 'CategoryEmployees',
                ],
                [
                    'icon' => 'fa-users',
                    'route' => 'Employees.index',
                    'text' => 'back.Employees',
                    'permission' => 'Employees',
                ],

                ['icon' => 'fa-cogs', 'route' => 'Setting.index', 'text' => 'back.settings', 'permission' => 'Setting'],
            ];
        @endphp

        @foreach ($cards as $card)
            @can($card['permission'])
                <div class="col-6 col-md-4 col-lg-3">
                    <div
                        class="card h-100 shadow-sm border-0 rounded-4 text-center position-relative bg-white bg-opacity-75 transition">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center py-3">
                            <i class="fas {{ $card['icon'] }} mb-2 text-primary" style="font-size: 32px;"></i>
                            <h6 class="fw-semibold mb-0">{{ trans($card['text']) }}</h6>
                            <a href="{{ route($card['route']) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @endcan
        @endforeach

    </div>

@endsection
