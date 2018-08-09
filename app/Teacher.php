<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $department
 * @property mixed $subject
 * @property int $id
 * @property mixed $users
 * @property mixed $district
 */
class Teacher extends Model
{
    protected $table = 'teachers';
    protected $fillable = ['te_init', 
                        'te_firstname', 
                        'te_lastname', 
                        'te_gender', 
                        'te_bdate', 
                        'te_bvillage', 
                        'te_bdistrict', 
                        'te_nationality', 
                        'te_region', 
                        'te_phone', 
                        'te_education', 
                        'te_major', 
                        'te_degree', 
                        'startwork', 
                        'te_position', 
                        'te_party_position', 
                        'date_to_party1', 
                        'date_to_party2', 
                        'politic_level', 
                        'te_status', 
                        'te_photo', 
                        'dept_id'
                    ];
    protected $primaryKey = 'id';

    public function Status()
    {
        return $this->belongsTo(TeacherStatus::class, 'te_status');
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function subject()
    {
        return $this->belongsToMany(Subject::class, 'sub_teach', 'te_id', 'subb_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * TeachScore
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teach_score', 'te_id', 'subb_id')->withPivot("score_real", "score_upgrade");
    }

    public function register()
    {
        return $this->belongsToMany(Register::class, 'teach_score', 'te_id', 'reg_id')->withPivot("score_real", "score_upgrade");
    }

    public function upgrade()
    {
        return $this->belongsToMany(Upgrade::class, 'teach_score', 'te_id', 'upg_id')->withPivot("score_real", "score_upgrade");
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'te_bdistrict');
    }

}
