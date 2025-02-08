<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ClientStatusNotification extends Notification
{
    use Queueable;

    public $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($status)
    {
        $this->status = $status;
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
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Client Status Updated')
                    ->line("Your application status has been updated to: {$this->status}.")
                    ->action('View Details', url('/dashboard'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Store notification in the database.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => "Your application has been {$this->status}.",
            'status' => $this->status,
            'time' => now()->diffForHumans(),
        ];
    }
}
