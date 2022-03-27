<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AttendanceScheduleEntry
 *
 * @property int $id
 * @property int $schedule_id
 * @property \Illuminate\Support\Carbon $schedule_date
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AttendanceSchedule|null $schedule
 * @method static \Database\Factories\AttendanceScheduleEntryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceScheduleEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceScheduleEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceScheduleEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceScheduleEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceScheduleEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceScheduleEntry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceScheduleEntry whereScheduleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceScheduleEntry whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceScheduleEntry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AttendanceScheduleEntry extends Model
{
    use HasFactory;

    protected $dates = [
        'schedule_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'schedule_id',
        'schedule_date',
        'name',
        'created_at',
        'updated_at',
    ];

    public function schedule()
    {
        return $this->belongsTo(AttendanceSchedule::class, 'schedule_id');
    }
}
