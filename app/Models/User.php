<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'village',
        'district',
        'state',
       // 'monthly_contribution',
        'group_id',
        'kyc_data',
        'is_kyc_completed',
        'user_id',
        'password',
    ];
    protected $primaryKey = 'user_id';
    public $incrementing = false; // Set to false if group_id is not auto-incrementing
    public $timestamps = false; // Set to true if you want to use timestamps
    protected $keyType = 'string'; // Set to 'string' if group_id is a string type
   
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'user_id_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
            public function getAuthIdentifierName()
        {
            return 'user_id';
        }
                public function getAuthIdentifier()
        {
            return $this->getAttribute($this->getAuthIdentifierName());
        }
        public function getAuthPassword()
        {
            return $this->password;
        }

    public function groups()
    {
        return $this->belongsToMany(GroupTable::class, 'group_user', 'user_id', 'group_id');
    }
}
