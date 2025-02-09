<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_application_id',
        'amount_paid',
        'payment_method',
    ];

    public function loanApplication()
    {
        return $this->belongsTo(LoanApplication::class);
    }
}

