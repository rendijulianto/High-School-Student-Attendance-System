<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'major',
        'class',
        'school_year',
    ];


    public function students()
    {
        return $this->hasMany(GradeStudent::class);
    }
}
