<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class UserTransaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'transaction_id';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = ['transaction_id','user_id','group_id', 'amount','transaction_type','payment_id'];
//, 'transaction_type'
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function group()
    {
        return $this->belongsTo(GroupTable::class, 'group_id', 'group_id');
    }
    public function groups()
    {
        return $this->belongsToMany(GroupTable::class, 'group_user', 'user_id', 'group_id');
    }
}
