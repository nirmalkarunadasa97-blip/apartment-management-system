<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserRole extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_role_id';

    protected $fillable = [
        'title',
    ];

    /**
     * Get the users for this role.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_role_id');
    }
}
