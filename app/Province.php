<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $country
 * @property mixed $district
 */
class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = ['province_name', 'province_name_lo', 'country_code'];
    protected $primaryKey = 'id';

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code');
    }

    public function district()
    {
        return $this->hasMany(District::class);
    }

}
