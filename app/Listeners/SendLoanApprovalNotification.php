<?php

namespace App\Listeners;

use App\Events\LoanApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\LoanApprovalNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoanApprovedMail;

class SendLoanApprovalNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoanApproved $event): void
    {
        $loanApplication = $event->loanApplication;
        $client = $loanApplication->client;

        // Email পাঠানো
        Mail::to($client->email)->send(new LoanApprovedMail($loanApplication));

        // Notification পাঠানো
        $client->notify(new LoanApprovalNotification($loanApplication));
    }
}
