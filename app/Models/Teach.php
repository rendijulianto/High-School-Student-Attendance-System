<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teach extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject_id',
    ];


    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // schedules
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

}
