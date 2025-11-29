<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Report;
use App\Models\ReportMessage;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $report;
    protected $message;
    protected $senderName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Report $report, ReportMessage $message, $senderName)
    {
        $this->report = $report;
        $this->message = $message;
        $this->senderName = $senderName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => trans('back.new_message_on_report') . ' ' . $this->report->report_number,
            'message' => $this->senderName . ': ' . \Str::limit($this->message->message, 50),
            'report_id' => $this->report->id,
            'message_id' => $this->message->id,
            'sender_name' => $this->senderName,
            'type' => 'message'
        ];
    }
}
