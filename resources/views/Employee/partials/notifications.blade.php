@forelse($notifications as $notification)
    <div class="dropdown-item notification-item py-2 text-wrap {{ $notification->read_at ? '' : 'active' }}" data-notification-id="{{ $notification->id }}">
        <span class="d-flex align-items-center">
            <span class="me-3 position-relative flex-shrink-0">
                <i class="ri-message-3-line fs-20"></i>
            </span>
            @if($notification->data['report_id'] ?? null)
                <a href="{{ route('employee.reports.show', $notification->data['report_id']) }}" class="flex-grow-1 text-muted notification-link">
            @else
                <span class="flex-grow-1 text-muted">
            @endif
                <span class="fw-medium text-body">{{ $notification->data['title'] ?? trans('back.new_notification') }}</span>
                <br />
                <span class="fs-12">{{ $notification->data['message'] ?? '' }}</span>
                <br />
                <span class="fs-12">
                    <i class="far fa-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                </span>
            @if($notification->data['report_id'] ?? null)
                </a>
            @else
                </span>
            @endif
            <button class="btn btn-sm btn-link text-success mark-as-read-btn" data-notification-id="{{ $notification->id }}" title="{{ trans('back.mark_as_read') }}">
                <i class="fas fa-check"></i>
            </button>
        </span>
    </div>
@empty
    <p class="dropdown-item text-center text-primary notify-item notify-all">
        {{ trans('back.not_found_notification') }}
    </p>
@endforelse
