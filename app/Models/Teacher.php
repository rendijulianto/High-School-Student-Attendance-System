<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Authenticatable
{
    use HasFactory;

    protected $guard = 'teacher';

    protected $fillable = [
        'name',
        'email',
        'password',
        'nip',
        'gender',
    ];


    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teaches');
    }

    public function teaches()
    {
        return $this->hasMany(Teach::class);
    }

}
