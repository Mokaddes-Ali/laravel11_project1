<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients'; // Table name
    protected $primaryKey = 'id'; // Primary key
    public $timestamps = true; // Enable timestamps

    // Fields that can be mass-assigned
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
        'user_id',
    ];

    // Relationship with User (Creator)
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    // Relationship with User (Editor)
    public function editor()
    {
        return $this->belongsTo(User::class, 'editor');
    }
}
