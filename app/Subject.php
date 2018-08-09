<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $teacher
 * @property int $id
 * @property mixed $major
 * @property mixed $degree
 * @property mixed $upgrades
 */
class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = ['sub_id', 'sub_name', 'sub_credit', 'sub_unit1', 'sub_unit2', 'sub_unit3'];
    protected $primaryKey = 'id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * SubTeach
     */
    public function teacher()
    {
        return $this->belongsToMany(Teacher::class, 'sub_teach', 'subb_id', 'te_id');
    }

    public function upgrades()
    {
        return $this->hasMany(Upgrade::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * SubMajor
     */
    public function major()
    {
        return $this->belongsToMany(Major::class, 'sub_major', 'subb_id', 'ma_id')->withPivot("year", "term");
    }

    public function degree()
    {
        return $this->belongsToMany(Degree::class, 'sub_major', 'subb_id', 'de_id')->withPivot("year", "term");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * TeachScore
     */
    public function register()
    {
        return $this->belongsToMany(Register::class, 'teach_score', 'subb_id', 'reg_id')->withPivot("score_real", "score_upgrade");
    }

    public function upgrade()
    {
        return $this->belongsToMany(Upgrade::class, 'teach_score', 'subb_id', 'upg_id')->withPivot("score_real", "score_upgrade");
    }

}
