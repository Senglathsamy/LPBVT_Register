<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $major
 * @property mixed $degree
 * @property string $st_id
 * @property mixed $register
 * @property mixed $upgrade
 * @property mixed $bdistrict
 * @property mixed $pdistrict
 */
class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['st_fname', 
                        'st_lname', 
                        'st_fname_eng', 
                        'st_lname_eng', 
                        'st_gender', 
                        'st_bdate', 
                        'st_bvillage', 
                        'st_bdistrict',
                        'st_nationality', 
                        'st_region',
                        'st_phone', 
                        'st_pvillage', 
                        'st_pdistrict', 
                        'gr_fname', 
                        'gr_lname',
                        'gr_phone', 
                        'gr_gender', 
                        'ma_id', 
                        'de_id', 
                        'st_registerdate', 
                        'st_status'
                    ];

    protected $primaryKey = 'st_id';
    public $incrementing = false;

    public function major()
    {
        return $this->belongsTo(Major::class, 'ma_id');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'de_id');
    }

    public function register()
    {
        return $this->hasMany(Register::class);
    }

    public function upgrade()
    {
        return $this->hasMany(Upgrade::class);
    }

    public function bdistrict()
    {
        return $this->belongsTo(District::class, 'st_bdistrict');
    }
    public function pdistrict()
    {
        return $this->belongsTo(District::class, 'st_pdistrict');
    }

}
