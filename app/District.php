<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $student
 * @property mixed $country
 */
class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['district_name', 'district_name_lo', 'prov_id'];
    protected $primaryKey = 'id';

    public function province()
    {
        return $this->belongsTo(Province::class, 'prov_id');
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

}
