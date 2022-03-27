<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * App\Models\AttendanceSchedule
 *
 * @property int $id
 * @property string $name
 * @property int $monday
 * @property int $tuesday
 * @property int $wednesday
 * @property int $thursday
 * @property int $friday
 * @property int $saturday
 * @property int $sunday
 * @property string $default_time_start
 * @property string $default_time_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttendanceScheduleEntry[] $entries
 * @property-read int|null $entries_count
 * @property-read array $selected_working_days
 * @property-read string $time_slot
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereDefaultTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereDefaultTimeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereFriday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereMonday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereSaturday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereSunday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereThursday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereTuesday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceSchedule whereWednesday($value)
 * @mixin \Eloquent
 */
class AttendanceSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'default_time_start',
        'default_time_end',
        'created_at',
        'updated_at',
    ];

    public const workingDays = [
        0 => 'monday',
        1 => 'tuesday',
        2 => 'wednesday',
        3 => 'thursday',
        4 => 'friday',
        5 => 'saturday',
        6 => 'sunday'
    ];

    public function entries()
    {
        return $this->hasMany(AttendanceScheduleEntry::class, 'schedule_id');
    }

    protected static function boot() {
        parent::boot();
    
        static::deleting(function($attendanceSchedule) {
            //delete children, either hard or soft (use foreach loop on soft)
            $attendanceSchedule->entries()->delete();
        });
    }

    public function getSelectedWorkingDaysAttribute(): array
    {
        $workingDays = [];

        if ($this->monday) $workingDays[] = AttendanceSchedule::workingDays[0];
        if ($this->tuesday) $workingDays[] = AttendanceSchedule::workingDays[1];
        if ($this->wednesday) $workingDays[] = AttendanceSchedule::workingDays[2];
        if ($this->thursday) $workingDays[] = AttendanceSchedule::workingDays[3];
        if ($this->friday) $workingDays[] = AttendanceSchedule::workingDays[4];
        if ($this->saturday) $workingDays[] = AttendanceSchedule::workingDays[5];
        if ($this->sunday) $workingDays[] = AttendanceSchedule::workingDays[6];

        return $workingDays;
    }

    public function getTimeSlotAttribute(): string 
    {
        return Carbon::createFromFormat('H:i:s',$this->default_time_start)->format('H:i') . ' - ' . Carbon::createFromFormat('H:i:s',$this->default_time_end)->format('H:i');
    }
}
