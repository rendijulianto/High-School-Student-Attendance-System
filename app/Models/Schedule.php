<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable =[
        'teach_id',
        'grade_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teach_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

}
