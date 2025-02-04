<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients'; // টেবিলের নাম নির্ধারণ করা
    protected $primaryKey = 'id'; // প্রাইমারি কী নির্ধারণ করা
    public $timestamps = true; // timestamps ব্যবহৃত হচ্ছে কিনা

    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'phone_number',
        'date_of_birth',
        'nid_number',
        'nid_pic_font',
        'nid_pic_back',
        'occupation',
        'monthly_income',
        'present_district',
        'present_upazila',
        'present_village',
        'present_postcode',
        'permanent_district',
        'permanent_upazila',
        'permanent_postcode',
        'permanent_village',
        'email',
        'number',
        'emergency_contact_name',
        'pic',
        'loan_amount',
        'loan_type',
        'purpose',
        'guarantor_name',
        'guarantor_nid',
        'guarantor_nid_pic_font',
        'guarantor_nid_pic_back',
        'guarantor_address',
        'guarantor_occupation',
        'guarantor_monthly_income',
        'guarantor_phone_number',
        'guarantor_email',
        'guarantor_pic',
        'guarantor_relation',
        'has_previous_loan',
        'slug',
        'status',
        'creator',
        'editor',
    ];

    // **Creator সম্পর্কিত সম্পর্ক নির্ধারণ**
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    // **Editor সম্পর্কিত সম্পর্ক নির্ধারণ**
    public function editor()
    {
        return $this->belongsTo(User::class, 'editor');
    }

    // **Loan সম্পর্কিত সম্পর্ক নির্ধারণ**
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_amount');
    }
}
