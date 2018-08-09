<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Role extends EntrustRole
{
    protected $table = 'roles';
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'permission_id', 'role_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'role_user', 'user_id', 'role_id');
    }
}
