<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $student
 * @property mixed $department
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $subject
 * @property mixed $degree
 */
class Major extends Model
{
    protected $table = 'majors';
    protected $fillable = ['ma_name', 'dept_id'];
    protected $primaryKey = 'id';

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function subject()
    {
        return $this->belongsToMany(Subject::class, 'sub_major', 'ma_id', 'subb_id')->withPivot("year", "term");
    }

    public function degree()
    {
        return $this->belongsToMany(Degree::class, 'sub_major', 'ma_id', 'de_id')->withPivot("year", "term");
    }

}
