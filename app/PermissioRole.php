<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class PermissionRole extends EntrustRole
{
    protected $table = 'permission_role';
    protected $fillable = [
        'permission_id', 'role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
