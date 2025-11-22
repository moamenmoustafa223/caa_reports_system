@extends('backend.layouts.master')

@section('page_title', __('back.report_details'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Report Details -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('back.report_details') }}</h4>
                        <span class="badge" style="background-color: {{ $report->status->color }}">
                            {{ $report->status->name }}
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="30%">{{ __('back.report_number') }}</th>
                                    <td><strong>{{ $report->report_number }}</strong></td>
                                </tr>
                                <tr>
                                    <th>{{ __('back.employee') }}</th>
                                    <td>{{ $report->employee?->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('back.department') }}</th>
                                    <td>
                                        @if (app()->getLocale() == 'ar')
                                            {{ $report->employee?->CategoryEmployees?->name ?? '-' }}
                                        @else
                                            {{ $report->employee?->CategoryEmployees?->name_en ?? '-' }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('back.report_date') }}</th>
                                    <td>{{ $report->report_date->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('back.location') }}</th>
                                    <td>{{ $report->location?->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('back.severity_level') }}</th>
                                    <td>
                                        <span class="badge"
                                            style="background-color: {{ $report->severityLevel?->color }}">
                                            {{ $report->severityLevel?->name ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('back.coordinates') }}</th>
                                    <td>
                                        @if ($report->latitude && $report->longitude)
                                            {{ $report->latitude }}, {{ $report->longitude }}
                                            <br>
                                            <a href="https://www.google.com/maps?q={{ $report->latitude }},{{ $report->longitude }}"
                                                target="_blank" class="btn btn-sm btn-primary mt-2">
                                                <i class="ti ti-map"></i> {{ __('back.view_on_map') }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('back.short_description') }}</th>
                                    <td>{{ $report->short_description }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('back.is_public') }}</th>
                                    <td>
                                        @if ($report->is_public)
                                            <span class="badge bg-success">{{ __('back.yes') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('back.no') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('back.created_at') }}</th>
                                    <td>{{ $report->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Attachments -->
                        @if ($report->attachments->count() > 0)
                            <h5 class="mt-4">{{ __('back.attachments') }} ({{ $report->attachments_count }})</h5>
                            <div class="row g-3">
                                @foreach ($report->attachments as $attachment)
                                    <div class="col-md-4">
                                        <div class="card">
                                            @if ($attachment->isImage())
                                                <img src="{{ $attachment->url }}" class="card-img-top"
                                                    style="height: 200px; object-fit: contain;"
                                                    alt="{{ $attachment->name }}">
                                            @elseif($attachment->isAudio())
                                                <div class="card-body text-center">
                                                    <i class="ti ti-music" style="font-size: 48px;"></i>
                                                    <audio controls class="w-100 mt-2">
                                                        <source src="{{ $attachment->url }}" type="audio/mpeg">
                                                    </audio>
                                                </div>
                                            @endif
                                            <div class="card-footer">
                                                <small>{{ $attachment->name }} ({{ $attachment->formatted_size }})</small>
                                                <div class="mt-2">
                                                    <a href="{{ route('attachments.download', $attachment->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti ti-download"></i> {{ __('back.download') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-1">
                            @can('edit_report')
                                <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-primary">
                                    <i class="ti ti-edit"></i> {{ __('back.edit') }}
                                </a>
                            @endcan
                            <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-back"></i> {{ __('back.back') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Change & Tracking History -->
            <div class="col-md-4">
                <!-- Change Status Form -->
                @can('change_report_status')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ __('back.change_status') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('reports.change_status', $report->id) }}" method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label for="status_id" class="form-label">{{ __('back.new_status') }}</label>
                                    <select class="form-select @error('status_id') is-invalid @enderror" id="status_id"
                                        name="status_id" required>
                                        @foreach ($reportStatuses as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $report->status_id == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-1">
                                    <label for="comment_" class="form-label">{{ __('back.comment') }}</label>
                                    <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="2"></textarea>
                                    @error('comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="ti ti-check"></i> {{ __('back.update_status') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endcan

                <!-- Tracking History -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('back.tracking_history') }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($report->trackings->count() > 0)
                            <div class="timeline">
                                @foreach ($report->trackings as $tracking)
                                    <div class="timeline-item mb-3">
                                        <div class="d-flex">
                                            <div class="timeline-badge"
                                                style="background-color: {{ $tracking->status->color }}"></div>
                                            <div class="timeline-content ms-3">
                                                <h6 class="mb-1">{{ $tracking->status->name }}</h6>
                                                <small class="text-muted">
                                                    {{ $tracking->created_at->format('Y-m-d H:i') }}
                                                </small>
                                                @if ($tracking->comment)
                                                    <p class="mb-1 mt-2">{{ $tracking->comment }}</p>
                                                @endif
                                                @if ($tracking->changed_by)
                                                    <small class="text-muted">
                                                        {{ __('back.by') }}: {{ $tracking->changed_by->name }}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">{{ __('back.no_tracking_history') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .timeline-badge {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-top: 5px;
        }
    </style>
@endpush
