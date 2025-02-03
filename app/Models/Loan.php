<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $table = 'loans';

    // Specify which fields are mass assignable
    protected $fillable = [
        'loan_id',
        'amount',
        'duration',
        'interest_rate',
        'total_pay_amount',
        'monthly_pay_amount',
    ];
}
