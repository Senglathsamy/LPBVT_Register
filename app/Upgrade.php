<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property int $ug_id
 * @property mixed $student
 * @property mixed $subject
 */
class Upgrade extends Model
{
    protected $table = 'upgrade';
    protected $fillable = ['ug_paiddate', 'ug_recieptno', 'st_id'];

    protected $primaryKey = 'ug_id';
    public $incrementing = false;

    public function student()
    {
        return $this->belongsTo(Student::class, 'st_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subj_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * TeachScore
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teach_score', 'upg_id', 'subb_id')->withPivot("score_real", "score_upgrade");
    }

    public function register()
    {
        return $this->belongsToMany(Register::class, 'teach_score', 'upg_id', 'reg_id')->withPivot("score_real", "score_upgrade");
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teach_score', 'upg_id', 'te_id')->withPivot("score_real", "score_upgrade");
    }
}
