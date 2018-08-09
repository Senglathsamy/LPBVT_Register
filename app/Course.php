<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $id
 * @property mixed $student
 * @property mixed $subject
 * @property mixed $major
 */
class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['name'];
    protected $primaryKey = 'id';

    public function degree()
    {
        return $this->hasMany(Degree::class);
    }

}
