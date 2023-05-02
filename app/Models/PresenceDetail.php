<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'presence_id',
        'student_id',
        'status',
        'date',
        'is_approved',
    ];

    public function presence()
    {
        return $this->belongsTo(Presence::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeUnapproved($query)
    {
        return $query->where('is_approved', false);
    }

    public function scopePresent($query)
    {
        return $query->where('status', 'H');
    }

    public function scopeSick($query)
    {
        return $query->where('status', 'S');
    }

    public function scopeAlpha($query)
    {
        return $query->where('status', 'A');
    }

    public function scopeIzin($query)
    {
        return $query->where('status', 'I');
    }

    public function scopeStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

}
