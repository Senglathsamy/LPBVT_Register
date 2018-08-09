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
class ClassRoom extends Model
{
    protected $table = 'classroom';
    protected $fillable = ['cr_name', 'cr_year', 'cr_startdate', 'cr_enddate', 'cr_ma_id', 'cr_de_id'];
    protected $primaryKey = 'cr_id';

    public function register()
    {
        return $this->hasMany(Register::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'ma_id');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'de_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subjects', 'cr_id', 'subb_id');
    }

    public function subjectsTeacher()
    {
        return $this->belongsToMany(Teacher::class, 'class_subjects', 'cr_id', 'te_id');
    }

}
