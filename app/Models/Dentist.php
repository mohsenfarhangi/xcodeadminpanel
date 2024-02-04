<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentist extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['formatted_times'];

    public function attendance_times()
    {
        return $this->hasMany(AttendanceTime::class);
    }

    public function getAttendanceTimeAttribute()
    {
        return $this->attendance_times;
    }

    public function getFormattedTimesAttribute()
    {
        return $this->formattedAttendanceTime();
    }

    public function formattedAttendanceTime()
    {
        $time_list = [];

        foreach ($this->attendance_times as $time) {
            $time_list[$time->day_in_week][$time->type] = [
                'start' => substr($time['start_time'],0,-3),
                'end'   => substr($time['end_time'],0,-3)
            ];
        }
        return $time_list;
    }
}
