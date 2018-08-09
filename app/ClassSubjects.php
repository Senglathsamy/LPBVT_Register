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
class ClassSubjects extends Model
{
    protected $table = 'class_subjects';
    protected $fillable = ['cr_id', 'subb_id', 'te_id'];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class, 'cr_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subb_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'te_id');
    }

}
