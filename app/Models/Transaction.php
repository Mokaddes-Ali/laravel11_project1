<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['payment_id', 'transaction_amount', 'transaction_id'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
