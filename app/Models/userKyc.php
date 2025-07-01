<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userKyc extends Model
{
    // Table name (optional if it's "kycs" plural)
    protected $table = 'users_kyc';

    // Primary key
    protected $primaryKey = 'user_id';

    // PK is not auto-incrementing (it's a string)
    public $incrementing = false;

    // PK type is string
    protected $keyType = 'int';

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'aadhar_card',
        'pan_card',
        'kyc_flag',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
