<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'group_name','village','district','state','members'];

    //public function users()
    //{
      //  return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    //}
}
