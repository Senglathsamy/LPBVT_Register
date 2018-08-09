<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $subject
 * @property mixed $register
 * @property mixed $upgrade
 * @property mixed $teacher
 * @property mixed $subjects
 * @property mixed $teachers
 */
class TeachScore extends Model
{

    protected $table = 'teach_score';
    protected $fillable = ['score_real', 'score_upgrade', 'reg_id', 'upg_id', 'te_id', 'subb_id'];
    protected $primaryKey = 'id';

    public function register()
    {
        return $this->belongsTo(Register::class, 'reg_id');
    }

    public function upgrade()
    {
        return $this->belongsTo(Upgrade::class, 'upg_id');
    }

    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'te_id');
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subb_id');
    }

}
