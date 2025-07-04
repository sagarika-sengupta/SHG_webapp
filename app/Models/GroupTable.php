<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class GroupTable extends Model
{
    
    use HasFactory;
    
    protected $table='groups';
    protected $primaryKey = 'group_id';
    public $incrementing = false; // Set to false if group_id is not auto-incrementing
    public $timestamps = true; // Set to true if you want to use timestamps
    protected $keyType = 'string'; // Set to 'string' if group_id is a string type
    protected $fillable = ['group_id','group_name','user_id','village','district','state','group_password'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id')
        ->withPivot('role','status')->withTimestamps();
    }
    public function leader()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id') //imp to have 'group_user' specified in belongsToMany and foreign keys
            ->withPivot(['status', 'role'])
            ->wherePivot('role', 'leader');
    }
    public function getUserCountAttribute()
    {
        return $this->users()
                ->wherePivot('status', 'active')
                ->count();
    }

}
