<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $subject
 * @property mixed $major
 * @property mixed $degree
 */
class SubMajor extends Model
{
    protected $table = 'sub_major';
    protected $fillable = ['year', 'term', 'ma_id', 'subb_id', 'de_id'];
    protected $primaryKey = 'id';

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subb_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'ma_id');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'de_id');
    }

}
