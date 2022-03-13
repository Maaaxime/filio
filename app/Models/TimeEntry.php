<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeEntry extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'time_entries';

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $dates = [
        'time_end',
        'time_start',
        'system_time_end',
        'system_time_start',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'time_end' => 'datetime',
        'time_start' => 'datetime',
        'system_time_end' => 'datetime',
        'system_time_start' => 'datetime',
    ];

    protected $fillable = [
        'children_id',
        'entry_type_id',
        'time_end',
        'time_start',
        'system_time_end',
        'system_time_start',
        'comment',
        'created_at',
        'created_by_id',
        'updated_at',
        'updated_by_id',
        'deleted_at',
        'deleted_by_id'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by_id');
    }

    public function children()
    {
        return $this->belongsTo(Children::class, 'children_id');
    }

    public function entry_type()
    {
        return $this->belongsTo(TimeEntryType::class, 'entry_type_id');
    }

    public static function defaultStartTime()
    {
        return Carbon::createFromTime(8, 0, 0, Config('app.timezone'));
    }

    public static function defaultEndTime()
    {
        return Carbon::createFromTime(18, 0, 0, Config('app.timezone'));
    }

    public function getTimeStartDateAttribute()
    {
        return $this->time_start ? $this->time_start->format('Y-m-d') : '';
    }
    public function getTimeStartTimeAttribute()
    {
        return $this->time_start ? $this->time_start->format('H:i') : '';
    }
    public function getTimeEndDateAttribute()
    {
        return $this->time_end ? $this->time_end->format('Y-m-d') : '';
    }
    public function getTimeEndTimeAttribute()
    {
        return $this->time_end ? $this->time_end->format('H:i') : '';
    }
    public function getTotalTimeSecondsAttribute()
    {
        return $this->time_end ? $this->time_end->diffInSeconds($this->time_start) : 0;
    }
    public function getTotalTimeMinutesAttribute()
    {
        return $this->total_time_seconds / 60;
    }
    public function getTotalTimeHoursAttribute()
    {
        return $this->total_time_minutes / 60;
    }
    public function getTotalTimeHoursStringAttribute()
    {
        return $this->total_time_hours == 0 ? '-' : number_format($this->total_time_hours, 2);
    }
}
