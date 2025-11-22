<div class="modal fade" id="deleteModal{{ $report->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">{{ __('back.delete_report') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('back.delete_confirmation') }}
                <br>
                <strong>{{ $report->report_number }}</strong>
                <br>
                <small class="text-danger">{{ __('back.all_attachments_will_be_deleted') }}</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('back.cancel') }}</button>
                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('back.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
