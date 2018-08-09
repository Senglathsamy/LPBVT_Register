<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class TeacherStatus extends Model
{
    protected $table = 'teacher_status';
    protected $fillable = ['status'];
    protected $primaryKey = 'id';

    public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }

}
