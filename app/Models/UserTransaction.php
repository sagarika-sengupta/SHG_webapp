<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class UserTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id','user_id', 'amount'];
//, 'transaction_type'
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
