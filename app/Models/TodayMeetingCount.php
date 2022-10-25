<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodayMeetingCount extends Model
{
    use HasFactory;

    protected $table = 'today_meeting_count';
    protected $guarded = [];
}
