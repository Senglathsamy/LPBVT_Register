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
class Degree extends Model
{
    protected $table = 'degree';
    protected $fillable = ['degree', 'course_id', 'program'];
    protected $primaryKey = 'id';

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function subject()
    {
        return $this->belongsToMany(Subject::class, 'sub_major', 'de_id', 'subb_id')->withPivot("year", "term");
    }

    public function major()
    {
        return $this->belongsToMany(Major::class, 'sub_major', 'de_id', 'ma_id')->withPivot("year", "term");
    }

}
