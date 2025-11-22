<?php

namespace App\Http\Controllers;

use App\Models\ReportAttachment;

class ReportAttachmentController extends Controller
{
    /**
     * Download an attachment.
     */
    public function download(ReportAttachment $attachment)
    {
        $filePath = public_path($attachment->file_path);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath, $attachment->name);
    }

    /**
     * Delete an attachment.
     */
    public function destroy(ReportAttachment $attachment)
    {
        if (!auth()->user()->can('delete_report_attachment')) {
            abort(403);
        }

        // Delete file from local storage
        if (file_exists(public_path($attachment->file_path))) {
            unlink(public_path($attachment->file_path));
        }

        // Delete record
        $attachment->delete();

        // Update attachments count
        $report = $attachment->report;
        $report->update(['attachments_count' => $report->attachments()->count()]);

        toast(__('back.deleted_successfully'), 'success');
        return back();
    }
}
