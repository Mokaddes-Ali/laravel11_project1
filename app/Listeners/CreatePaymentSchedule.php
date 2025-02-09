<?php

namespace App\Listeners;

use App\Events\LoanApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\LoanPaymentSchedule;
use Carbon\Carbon;

class CreatePaymentSchedule
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
        $loan = $event->loanApplication->loan;
        $loanApplication = $event->loanApplication;

        $startDate = Carbon::now(); // Loan approval date
        $duration = $loan->duration; // Months
        $installmentAmount = $loan->monthly_pay_amount;

        for ($i = 1; $i <= $duration; $i++) {
            LoanPaymentSchedule::create([
                'loan_application_id' => $loanApplication->id,
                'due_date' => $startDate->copy()->addMonths($i),
                'amount' => $installmentAmount,
                'status' => 'pending',
            ]);
        }
    }
}
