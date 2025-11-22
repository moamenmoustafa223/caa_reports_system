@extends('Employee.layouts.master')

@section('page_title')
{{trans('back.my_reports')}}
@endsection

@section('title_page')
{{trans('back.my_reports')}}
@endsection

@section('css')
<style>
    /* Mobile-first responsive design */
    .mobile-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .add-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 16px;
        background: linear-gradient(135deg, #262761 0%, #3a3b8a 100%);
        color: white;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
    }

    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(38, 39, 97, 0.3);
        color: white;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: 16px;
        padding: 16px;
        margin-bottom: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #e5e7eb;
    }

    .filter-row {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-field {
        flex: 1;
        min-width: 120px;
    }

    .filter-input,
    .filter-select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.2s;
    }

    .filter-input:focus,
    .filter-select:focus {
        outline: none;
        border-color: #80873d;
        box-shadow: 0 0 0 3px rgba(128, 135, 61, 0.1);
    }

    .filter-btn {
        padding: 10px 14px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .filter-btn.primary {
        background: #262761;
        color: white;
    }

    .filter-btn.secondary {
        background: #f1f5f9;
        color: #475569;
    }

    /* Report Cards */
    .reports-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .report-card {
        background: white;
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #e5e7eb;
        transition: all 0.2s;
    }

    .report-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-color: #80873d;
    }

    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .report-number {
        font-weight: 700;
        font-size: 15px;
        color: #0f172a;
    }

    .report-date {
        font-size: 12px;
        color: #64748b;
        margin-top: 2px;
    }

    .status-badge {
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        color: white;
    }

    .report-body {
        margin-bottom: 12px;
    }

    .report-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 8px;
    }

    .meta-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 11px;
        color: #475569;
    }

    .severity-badge {
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        color: white;
    }

    .report-description {
        font-size: 13px;
        color: #334155;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .report-footer {
        display: flex;
        justify-content: flex-end;
    }

    .view-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 8px 12px;
        background: #f1f5f9;
        color: #0f172a;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .view-btn:hover {
        background: #262761;
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
    }

    .empty-icon {
        font-size: 48px;
        margin-bottom: 12px;
    }

    .empty-title {
        font-weight: 600;
        font-size: 16px;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .empty-text {
        font-size: 14px;
        color: #64748b;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 16px;
        display: flex;
        justify-content: center;
    }

    /* Responsive */
    @media (min-width: 769px) {
        .mobile-container {
            max-width: 600px;
        }
    }

    @media (max-width: 480px) {
        .filter-field {
            min-width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="mobile-container">
    <!-- Header -->
    <div class="page-header">
        <h5 style="margin: 0; font-weight: 600;">{{trans('back.my_reports')}}</h5>
        <a href="{{ route('employee.reports.create') }}" class="add-btn">
            <i class="fas fa-plus"></i> {{ trans('back.add_report') }}
        </a>
    </div>

    <!-- Filters -->
    <div class="filter-section">
        <form action="{{ route('employee.reports.index') }}" method="GET">
            <div class="filter-row">
                <div class="filter-field" style="flex: 2;">
                    <input type="text" name="search" class="filter-input"
                        placeholder="{{ trans('back.Search') }}..."
                        value="{{ request('search') }}">
                </div>
                <div class="filter-field">
                    <select name="status_id" class="filter-select">
                        <option value="">{{ trans('back.status') }}</option>
                        @foreach($reportStatuses as $status)
                            <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>
                                @if (app()->getLocale() == 'ar')
                                    {{ $status->name_ar }}
                                @else
                                    {{ $status->name_en }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="filter-btn primary">
                    <i class="fas fa-search"></i>
                </button>
                <a href="{{ route('employee.reports.index') }}" class="filter-btn secondary">
                    <i class="fas fa-sync-alt"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Reports List -->
    @if($reports->count() > 0)
        <div class="reports-list">
            @foreach($reports as $report)
                <div class="report-card">
                    <div class="report-header">
                        <div>
                            <div class="report-number">{{ $report->report_number }}</div>
                            <div class="report-date">{{ $report->report_date->format('Y-m-d') }}</div>
                        </div>
                        <span class="status-badge" style="background-color: {{ $report->status?->color }}">
                            @if (app()->getLocale() == 'ar')
                                {{ $report->status?->name_ar ?? '-' }}
                            @else
                                {{ $report->status?->name_en ?? '-' }}
                            @endif
                        </span>
                    </div>

                    <div class="report-body">
                        <div class="report-meta">
                            <span class="meta-tag">
                                <i class="fas fa-building"></i>
                                @if (app()->getLocale() == 'ar')
                                    {{ $report->employee?->CategoryEmployees?->name ?? '-' }}
                                @else
                                    {{ $report->employee?->CategoryEmployees?->name_en ?? '-' }}
                                @endif
                            </span>
                            <span class="meta-tag">
                                <i class="fas fa-map-marker-alt"></i>
                                @if (app()->getLocale() == 'ar')
                                    {{ $report->location?->name_ar ?? '-' }}
                                @else
                                    {{ $report->location?->name_en ?? '-' }}
                                @endif
                            </span>
                            <span class="severity-badge" style="background-color: {{ $report->severityLevel?->color }}">
                                @if (app()->getLocale() == 'ar')
                                    {{ $report->severityLevel?->name_ar ?? '-' }}
                                @else
                                    {{ $report->severityLevel?->name_en ?? '-' }}
                                @endif
                            </span>
                        </div>
                        <div class="report-description">
                            {{ $report->short_description }}
                        </div>
                    </div>

                    <div class="report-footer">
                        <a href="{{ route('employee.reports.show', $report->id) }}" class="view-btn">
                            <i class="fas fa-eye"></i> {{ trans('back.show') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {!! $reports->appends(Request::all())->links() !!}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">📋</div>
            <div class="empty-title">{{ trans('back.none') }}</div>
            <div class="empty-text">
                @if (app()->getLocale() == 'ar')
                    لا توجد بلاغات حتى الآن
                @else
                    No reports yet
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
