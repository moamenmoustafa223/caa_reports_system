<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportUpdatedNotification extends Notification
{
    use Queueable;

    protected $report;
    protected $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Report $report, ?string $comment = null)
    {
        $this->report = $report;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject(__('back.report_updated_notification'))
            ->greeting(__('back.hello') . ' ' . $notifiable->name)
            ->line(__('back.report_updated_message', [
                'report_number' => $this->report->report_number,
            ]))
            ->line(__('back.new_status') . ': ' . ($this->report->status?->name ?? '-'));

        if ($this->comment) {
            $message->line(__('back.comment') . ': ' . $this->comment);
        }
        
        return $message
            ->action(__('back.view_report'), route('employee.reports.show', $this->report->id))
            ->line(__('back.thank_you_for_using'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => __('back.report_updated_notification'),
            'message' => __('back.report_updated_message', [
                'report_number' => $this->report->report_number,
            ]),
            'report_id' => $this->report->id,
            'report_number' => $this->report->report_number,
            'type' => 'report_updated',
        ];
    }
}
