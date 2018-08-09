<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $id
 * @property mixed $subject
 * @property mixed $teacher
 */
class SubTeach extends Model
{
    protected $table = 'sub_teach';
    protected $fillable = ['te_id', 'subb_id'];
    protected $primaryKey = 'id';

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subb_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'te_id');
    }

}
