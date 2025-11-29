@extends('Employee.layouts.master')

@section('page_title')
    {{ trans('back.report_details') }}
@endsection

@section('title_page')
    {{ trans('back.report_details') }}
@endsection

@section('css')
<style>
    /* Mobile-first responsive design */
    .mobile-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
    }

    .back-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        color: #0f172a;
        text-decoration: none;
        transition: all 0.2s;
    }

    .back-btn:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    .page-title {
        font-size: 18px;
        font-weight: 600;
        color: #0f172a;
        margin: 0;
    }

    /* Report Header Card */
    .report-header-card {
        background: linear-gradient(135deg, #262761 0%, #3a3b8a 100%);
        color: white;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 16px;
        box-shadow: 0 4px 12px rgba(38, 39, 97, 0.2);
    }

    .report-header-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .report-number-large {
        font-size: 20px;
        font-weight: 700;
    }

    .status-badge-large {
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }

    .report-date-large {
        font-size: 14px;
        opacity: 0.9;
    }

    /* Section Cards */
    .section-card {
        background: white;
        border-radius: 16px;
        padding: 16px;
        margin-bottom: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #e5e7eb;
    }

    .section-title {
        font-size: 13px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        font-weight: 500;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }

    .info-value {
        font-size: 14px;
        color: #0f172a;
        font-weight: 500;
        text-align: right;
    }

    .severity-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }

    .description-text {
        font-size: 14px;
        color: #334155;
        line-height: 1.6;
    }

    /* Map Button */
    .map-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        background: #262761;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .map-btn:hover {
        background: #80873d;
        color: white;
    }

    .coords-text {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 8px;
    }

    /* Attachments Grid */
    .attachments-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .attachment-item {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background: #f8fafc;
    }

    .attachment-image {
        width: 100%;
        height: 120px;
        object-fit: contain;
    }

    .attachment-audio {
        padding: 16px;
        text-align: center;
    }

    .attachment-audio i {
        font-size: 32px;
        color: #262761;
        margin-bottom: 8px;
        display: block;
    }

    .attachment-audio audio {
        width: 100%;
        height: 36px;
    }

    .attachment-name {
        padding: 8px;
        font-size: 11px;
        color: #64748b;
        text-align: center;
        background: white;
        border-top: 1px solid #e5e7eb;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Timeline */
    .timeline {
        position: relative;
        padding-left: 24px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 5px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 16px;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-badge {
        position: absolute;
        left: -24px;
        top: 0;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 0 0 2px #e5e7eb;
    }

    .timeline-content {
        background: #f8fafc;
        border-radius: 10px;
        padding: 12px;
    }

    .timeline-status {
        font-weight: 600;
        font-size: 13px;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .timeline-date {
        font-size: 11px;
        color: #64748b;
        margin-bottom: 8px;
    }

    .timeline-comment {
        font-size: 13px;
        color: #334155;
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .timeline-user {
        font-size: 11px;
        color: #64748b;
    }

    /* Empty State */
    .empty-timeline {
        text-align: center;
        padding: 20px;
        color: #64748b;
        font-size: 13px;
    }

    /* Action Button */
    .action-footer {
        margin-top: 8px;
    }

    .btn-back-full {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 14px 20px;
        background: #d3d3d3;
        color: #475569;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.2s;
    }

    .btn-back-full:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* Messages Styles */
    .messages-list {
        max-height: 300px;
        overflow-y: auto;
        padding: 4px 0;
    }

    .message-bubble {
        padding: 8px 10px;
        border-radius: 10px;
        margin-bottom: 6px;
        max-width: 85%;
    }

    .message-bubble.my-message {
        background: #e7f3ff;
        margin-left: auto;
        border-bottom-right-radius: 4px;
    }

    .message-bubble.admin-message {
        background: #f0f0f0;
        margin-right: auto;
        border-bottom-left-radius: 4px;
    }

    .message-sender {
        font-size: 11px;
        font-weight: 600;
        color: #262761;
        margin-bottom: 3px;
    }

    .message-text {
        font-size: 12px;
        color: #334155;
        line-height: 1.3;
        margin-bottom: 2px;
        word-wrap: break-word;
        word-break: break-word;
        white-space: pre-wrap;
        overflow-wrap: break-word;
    }

    .message-time {
        font-size: 10px;
        color: #64748b;
        text-align: right;
    }

    .empty-messages {
        text-align: center;
        padding: 20px;
        color: #64748b;
        font-size: 13px;
    }

    .empty-messages i {
        font-size: 28px;
        margin-bottom: 8px;
        display: block;
        opacity: 0.5;
    }

    .message-form {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-top: 8px;
    }

    .message-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 13px;
        font-family: 'Almarai', sans-serif;
        resize: vertical;
        transition: all 0.2s;
    }

    .message-input:focus {
        outline: none;
        border-color: #80873d;
        box-shadow: 0 0 0 2px rgba(128, 135, 61, 0.1);
    }

    .send-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 10px 16px;
        background: #262761;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .send-btn:hover {
        background: #80873d;
    }

    .send-btn:active {
        transform: scale(0.98);
    }

    /* Responsive */
    @media (min-width: 769px) {
        .mobile-container {
            max-width: 600px;
        }
    }

    @media (max-width: 480px) {
        .attachments-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="mobile-container">
    <!-- Back Header -->
    <div class="back-header">
        <a href="{{ route('employee.reports.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h5 class="page-title">{{ trans('back.report_details') }}</h5>
    </div>

    <!-- Report Header Card -->
    <div class="report-header-card">
        <div class="report-header-top">
            <div class="report-number-large">{{ $report->report_number }}</div>
            <span class="status-badge-large" style="background-color: {{ $report->status?->color }}">
                @if (app()->getLocale() == 'ar')
                    {{ $report->status?->name_ar ?? '-' }}
                @else
                    {{ $report->status?->name_en ?? '-' }}
                @endif
            </span>
        </div>
        <div class="report-date-large">
            <i class="fas fa-calendar-alt"></i> {{ $report->report_date->format('Y-m-d H:i') }}
        </div>
    </div>

    <!-- Location Info -->
    <div class="section-card">
        <div class="section-title">{{ trans('back.location_info') }}</div>

        <div class="info-row">
            <span class="info-label">{{ trans('back.location') }}</span>
            <span class="info-value">
                @if (app()->getLocale() == 'ar')
                    {{ $report->location?->name_ar ?? '-' }}
                @else
                    {{ $report->location?->name_en ?? '-' }}
                @endif
            </span>
        </div>

        <div class="info-row">
            <span class="info-label">{{ trans('back.department') }}</span>
            <span class="info-value">
                @if (app()->getLocale() == 'ar')
                    {{ $report->employee?->CategoryEmployees?->name ?? '-' }}
                @else
                    {{ $report->employee?->CategoryEmployees?->name_en ?? '-' }}
                @endif
            </span>
        </div>

        @if ($report->latitude && $report->longitude)
            <div class="info-row" style="flex-direction: column; align-items: flex-start; gap: 8px;">
                <span class="info-label">{{ trans('back.coordinates') }}</span>
                <div>
                    <div class="coords-text">📍 {{ $report->latitude }}, {{ $report->longitude }}</div>
                    <a href="https://www.google.com/maps?q={{ $report->latitude }},{{ $report->longitude }}"
                       target="_blank" class="map-btn">
                        <i class="fas fa-map-marker-alt"></i> {{ trans('back.view_on_map') }}
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Report Details -->
    <div class="section-card">
        <div class="section-title">{{ trans('back.report_details') }}</div>

        <div class="info-row">
            <span class="info-label">{{ trans('back.severity_level') }}</span>
            <span class="severity-badge" style="background-color: {{ $report->severityLevel?->color }}">
                @if (app()->getLocale() == 'ar')
                    {{ $report->severityLevel?->name_ar ?? '-' }}
                @else
                    {{ $report->severityLevel?->name_en ?? '-' }}
                @endif
            </span>
        </div>

        <div class="info-row">
            <span class="info-label">{{ trans('back.created_at') }}</span>
            <span class="info-value">{{ $report->created_at->format('Y-m-d H:i') }}</span>
        </div>
    </div>

    <!-- Description -->
    <div class="section-card">
        <div class="section-title">{{ trans('back.short_description') }}</div>
        <div class="description-text">
            {{ $report->short_description }}
        </div>
    </div>

    <!-- Attachments -->
    @if ($report->attachments && $report->attachments->count() > 0)
        <div class="section-card">
            <div class="section-title">{{ trans('back.attachments') }} ({{ $report->attachments->count() }})</div>
            <div class="attachments-grid">
                @foreach ($report->attachments as $attachment)
                    <div class="attachment-item">
                        @if ($attachment->isImage())
                            <img src="{{ $attachment->url }}"
                                 class="attachment-image"
                                 alt="{{ $attachment->name }}">
                        @elseif($attachment->isAudio())
                            <div class="attachment-audio">
                                <i class="fas fa-music"></i>
                                <audio controls>
                                    <source src="{{ $attachment->url }}"
                                            type="audio/mpeg">
                                </audio>
                            </div>
                        @endif
                        <div class="attachment-name">{{ $attachment->name }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Tracking History -->
    <div class="section-card">
        <div class="section-title">{{ trans('back.tracking_history') }}</div>

        @if ($report->trackings && $report->trackings->count() > 0)
            <div class="timeline">
                @foreach ($report->trackings as $tracking)
                    <div class="timeline-item">
                        <div class="timeline-badge" style="background-color: {{ $tracking->status?->color }}"></div>
                        <div class="timeline-content">
                            <div class="timeline-status">
                                @if (app()->getLocale() == 'ar')
                                    {{ $tracking->status?->name_ar ?? '-' }}
                                @else
                                    {{ $tracking->status?->name_en ?? '-' }}
                                @endif
                            </div>
                            <div class="timeline-date">
                                <i class="fas fa-clock"></i> {{ $tracking->created_at->format('Y-m-d H:i') }}
                            </div>
                            @if ($tracking->comment)
                                <div class="timeline-comment">{{ $tracking->comment }}</div>
                            @endif
                            @if ($tracking->user)
                                <div class="timeline-user">
                                    <i class="fas fa-user"></i> {{ trans('back.by') }}: {{ $tracking->user->name }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-timeline">
                <i class="fas fa-history"></i><br>
                {{ trans('back.no_tracking_history') }}
            </div>
        @endif
    </div>

    <!-- Messages Section -->
    <div class="section-card">
        <div class="section-title">💬 {{ trans('back.messages') }}</div>

        <!-- Messages List -->
        @if($report->messages && $report->messages->count() > 0)
            <div class="messages-list mb-2" id="messages-container">
                @foreach($report->messages as $message)
                    <div class="message-bubble {{ $message->isSentByEmployee() ? 'my-message' : 'admin-message' }}">
                        <div class="message-sender">
                            <strong>{{ $message->sender_name }}</strong>
                        </div>
                        <div class="message-text">
                            {{ $message->message }}
                        </div>
                        <div class="message-time">
                            {{ $message->created_at->diffForHumans() }}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-messages">
                <i class="fas fa-comments"></i><br>
                {{ trans('back.no_messages_yet') }}
            </div>
        @endif

        <!-- Send Message Form -->
        <form action="{{ route('employee.reports.send_message', $report->id) }}" method="POST">
            @csrf
            <div class="message-form">
                <textarea name="message"
                    class="message-input"
                    rows="3"
                    placeholder="{{ trans('back.type_your_message') }}"
                    required></textarea>
                <button type="submit" class="send-btn">
                    <i class="fas fa-paper-plane"></i> {{ trans('back.send') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Back Button -->
    <div class="action-footer mb-3">
        <a href="{{ route('employee.reports.index') }}" class="btn-back-full">
            <i class="fas fa-arrow-left"></i> {{ trans('back.back') }}
        </a>
    </div>
</div>
@endsection

@section('js')
<script>
    // Scroll to bottom of messages container on page load
    document.addEventListener('DOMContentLoaded', function() {
        const messagesContainer = document.getElementById('messages-container');
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    });
</script>
@endsection
