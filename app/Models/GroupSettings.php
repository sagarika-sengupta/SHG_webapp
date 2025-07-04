<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupSettings extends Model
{
    use HasFactory;

    // Table name if it's non-standard
    protected $table = 'group_settings';
        // Primary key
    protected $primaryKey = 'group_id';

    // PK is not auto-incrementing (it's a string)
    public $incrementing = false;

    // PK type is string
    protected $keyType = 'string';

    // Fillable fields for mass assignment
    protected $fillable = [
        'group_id',
        'group_name',
        'monthly_contribution',
        'max_members',
        'user_count',
        'status',
    ];

    // Cast fields to proper types
    protected $casts = [
        'monthly_contribution' => 'float',
        'max_members' => 'integer',
        'user_count' => 'integer',
    ];

    /**
     * Relation to Group
     * Assuming group_id on group_settings matches group_id on groups
     */
    public function group()
    {
        return $this->belongsTo(GroupTable::class, 'group_id', 'group_id');
    }
}
