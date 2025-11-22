@extends('Employee.layouts.master')

@section('page_title')
{{ trans('back.dashboard') }}
@endsection

@section('title_page')
{{ trans('back.dashboard') }}
@endsection

@section('css')
<style>
    /* Mobile-first responsive design */
    .mobile-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
    }

    .profile-card {
        background: linear-gradient(135deg, #262761 0%, #3a3b8a 100%);
        color: white;
        padding: 24px;
        border-radius: 16px;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(38, 39, 97, 0.2);
    }

    .profile-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .profile-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: bold;
        color: #262761;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .profile-details h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .profile-details p {
        margin: 4px 0 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .section-title {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 12px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .action-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 24px;
    }

    .action-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .action-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        border-color: #80873d;
    }

    .action-icon {
        font-size: 36px;
        margin-bottom: 8px;
        display: block;
    }

    .action-title {
        font-weight: 600;
        font-size: 15px;
        color: #0f172a;
    }

    .sos-card {
        background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        color: white;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
    }

    .sos-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .sos-title {
        font-size: 18px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .beta-badge {
        background: rgba(255,255,255,0.3);
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
    }

    .sos-description {
        font-size: 14px;
        opacity: 0.95;
        margin-bottom: 12px;
    }

    .sos-button {
        background: white;
        color: #dc2626;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
        transition: all 0.2s;
    }

    .sos-button:hover {
        background: #fee2e2;
    }

    .awareness-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .awareness-title {
        font-size: 16px;
        font-weight: 600;
        color: #0f172a;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .info-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .info-card-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
        color: #0f172a;
    }

    .info-card-text {
        font-size: 13px;
        color: #64748b;
        line-height: 1.4;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .action-grid {
            gap: 10px;
        }

        .action-card {
            padding: 16px;
        }

        .profile-card {
            padding: 20px;
        }
    }

    @media (min-width: 769px) {
        .mobile-container {
            max-width: 600px;
        }
    }
</style>
@endsection

@section('content')
<div class="mobile-container">
    <!-- Profile Card -->
    <div class="profile-card">
        <div class="profile-info">
            <div class="profile-avatar">
                <img src="{{ asset(auth('employee')->user()->image) }}" class="rounded-circle img-thumbnail img-fluid" alt="profile-image">
                
            </div>
            <div class="profile-details">
                <h3>
                    @if (app()->getLocale() == 'ar')
                        {{ auth('employee')->user()->name_ar }}
                    @else
                        {{ auth('employee')->user()->name_en }}
                    @endif
                </h3>
                <p>
                    @if (app()->getLocale() == 'ar')
                        {{ auth('employee')->user()->CategoryEmployees->name ?? '-' }}
                    @else
                        {{ auth('employee')->user()->CategoryEmployees->name_en ?? '-' }}
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="section-title">{{ trans('back.quick_actions') }}</div>
    <div class="action-grid">
        <a href="{{ route('employee.reports.create') }}" class="action-card">
            <span class="action-icon">⚠️</span>
            <div class="action-title">{{ trans('back.add_report') }}</div>
        </a>

        <a href="{{ route('employee.reports.index') }}" class="action-card">
            <span class="action-icon">📋</span>
            <div class="action-title">{{ trans('back.my_reports') }}</div>
        </a>
    </div>

    <!-- Safety Awareness -->
    <div class="awareness-header">
        <div class="awareness-title">{{ trans('back.awareness') }}</div>
    </div>
    <div class="info-grid mb-3">
        @forelse($safetyTips as $tip)
        <div class="info-card">
            <div class="info-card-title">
                @if($tip->icon)
                    {{ $tip->icon }}
                @endif
                {{ $tip->title }}
            </div>
            <div class="info-card-text">
                {{ $tip->description }}
            </div>
        </div>
        @empty
        <div class="info-card">
            <div class="info-card-title">{{ trans('back.ppe') }}</div>
            <div class="info-card-text">
                @if (app()->getLocale() == 'ar')
                    خوذة • قفازات • سترة
                @else
                    Helmet • Gloves • Vest
                @endif
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
