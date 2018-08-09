<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Foundation\Auth\User;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class UserRole extends User
{
    protected $table = 'role_user';
    protected $fillable = [
        'user_id', 'role_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
