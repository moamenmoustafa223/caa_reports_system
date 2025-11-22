<?php

namespace App\Notifications;

use App\Models\Report;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportSubmittedNotification extends Notification
{
    use Queueable;

    protected $report;

    /**
     * Create a new notification instance.
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // For User models, only store in database (no email)
        // For anonymous notifiable (settings email), only send email
        if ($notifiable instanceof User) {
            return ['database'];
        }

        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('back.new_report_submitted'))
            ->greeting(__('back.hello'))
            ->line(__('back.new_report_notification_message', [
                'report_number' => $this->report->report_number,
                'employee' => $this->report->employee?->name ?? '-',
            ]))
            ->line(__('back.location') . ': ' . ($this->report->location?->name ?? '-'))
            ->line(__('back.severity_level') . ': ' . ($this->report->severityLevel?->name ?? '-'))
            ->action(__('back.view_report'), route('reports.show', $this->report->id))
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
            'title' => __('back.new_report_submitted'),
            'message' => __('back.new_report_notification_message', [
                'report_number' => $this->report->report_number,
                'employee' => $this->report->employee?->name ?? '-',
            ]),
            'report_id' => $this->report->id,
            'report_number' => $this->report->report_number,
            'type' => 'report_submitted',
        ];
    }
}
