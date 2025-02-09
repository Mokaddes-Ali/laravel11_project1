<?php

namespace App\Notifications;


use App\Models\LoanApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class LoanApprovalNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $loanApplication;

    public function __construct(LoanApplication $loanApplication)
    {
        $this->loanApplication = $loanApplication;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Loan has been Approved!')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your loan application has been approved.')
            ->line('Loan Amount: ' . $this->loanApplication->loan->amount)
            ->line('Duration: ' . $this->loanApplication->loan->duration . ' months')
            ->action('View Loan Details', url('/loans/' . $this->loanApplication->id))
            ->line('Thank you for choosing our service!');
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => 'Your loan has been approved!',
            'loan_id' => $this->loanApplication->id,
            'amount' => $this->loanApplication->loan->amount,
            'due_dates' => $this->loanApplication->loan->duration . ' months',
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
