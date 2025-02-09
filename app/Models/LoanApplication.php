<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'loan_id',
        'application_id',
        'payable_amount',
        'paid_amount',
        'due_amount',
        'expend_amount',
        'loan_purpose',
        'loan_perporse',
        'collateral_details',
        'status',
        'creator',
        'editor',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'editor');
    }
}
