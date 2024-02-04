<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceTime extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dentist()
    {
        return $this->belongsTo(AttendanceTime::class);
    }
}
