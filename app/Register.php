<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property int $rg_id
 * @property mixed $student
 */
class Register extends Model
{
    protected $table = 'register';
    protected $fillable = [
                            'rg_date',
                            'class_id',
                            'rg_paiddate',
                            'rg_recieptno',
                            'rg_academicyear',
                            'rg_classno',
                            'st_id'];

    protected $primaryKey = 'rg_id';
    public $incrementing = true;


    public function student()
    {
        return $this->belongsTo(Student::class, 'st_id');
    }

    public function Class()
    {
        return $this->belongsTo(ClassRoom::class, 'rg_classno');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * TeachScore
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teach_score', 'reg_id', 'subb_id')->withPivot("score_real", "score_upgrade");
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teach_score', 'reg_id', 'te_id')->withPivot("score_real", "score_upgrade");
    }

}
