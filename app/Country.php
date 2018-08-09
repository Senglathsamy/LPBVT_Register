<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $province
 */
class Province extends Model
{
    protected $table = 'countries';
    protected $fillable = ['country_name'];
    protected $primaryKey = 'country_code';

    public function province()
    {
        return $this->hasMany(Province::class);
    }

}
