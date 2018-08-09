<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Permission extends EntrustPermission
{
    protected $table = 'permissions';
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }
}
