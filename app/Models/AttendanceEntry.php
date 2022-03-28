<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AttendanceEntry
 *
 * @property int $id
 * @property int $child_id
 * @property int $type_id
 * @property \Illuminate\Support\Carbon $time_start
 * @property \Illuminate\Support\Carbon|null $time_end
 * @property string $system_time_start
 * @property string|null $system_time_end
 * @property string|null $comment
 * @property int $created_by_id
 * @property int $updated_by_id
 * @property int|null $deleted_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Child|null $child
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\User|null $deletedBy
 * @property-read mixed $name
 * @property-read mixed $time_end_date
 * @property-read mixed $time_end_time
 * @property-read mixed $time_start_date
 * @property-read mixed $time_start_time
 * @property-read mixed $total_time_hours
 * @property-read mixed $total_time_hours_string
 * @property-read mixed $total_time_minutes
 * @property-read mixed $total_time_seconds
 * @property-read \App\Models\AttendanceType|null $type
 * @property-read \App\Models\User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry newQuery()
 * @method static \Illuminate\Database\Query\Builder|AttendanceEntry onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereSystemTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereSystemTimeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereTimeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceEntry whereUpdatedById($value)
 * @method static \Illuminate\Database\Query\Builder|AttendanceEntry withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AttendanceEntry withoutTrashed()
 * @mixin \Eloquent
 */
class AttendanceEntry extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'attendance_entries';

    protected $dates = [
        'time_end',
        'time_start',
        'system_time_start',
        'system_time_end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'child_id',
        'type_id',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'time_end',
        'time_start',
        'system_time_start',
        'system_time_end',
        'comment',
        'created_at',
        'updated_at',
        'deleted_at',
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

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }

    public function type()
    {
        return $this->belongsTo(AttendanceType::class, 'type_id');
    }

    public static function defaultStartTime()
    {
        return Carbon::createFromTime(8, 0, 0, Config('app.timezone'));
    }

    public static function defaultEndTime()
    {
        return Carbon::createFromTime(18, 0, 0, Config('app.timezone'));
    }
    public function getNameAttribute()
    {
        $date = $this->time_start ? $this->time_start->format('d/m/Y') : '';
        $name = "{$this->child->full_name} · {$date} · {$this->time_start_time}";
        if ($this->time_end_time != '') {
            $name = $name . " · {$this->time_end_time}";
        }
        return $name;
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
