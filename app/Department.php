<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $teacher
 * @property mixed $major
 */
class Department extends Model
{
    protected $table = 'department';
    protected $fillable = ['dept_name'];

    public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }

    public function major()
    {
        return $this->hasMany(Major::class);
    }


}
