<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'id';
    public $timestamps = true;

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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
