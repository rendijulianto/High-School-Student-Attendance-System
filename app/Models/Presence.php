<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'material',
    ];


    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function presenceDetails()
    {
        return $this->hasMany(PresenceDetail::class);
    }

}
