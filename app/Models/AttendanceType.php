<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AttendanceType
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $default
 * @property bool $need_proof
 * @property bool $need_permission
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttendanceEntry[] $attendanceEntries
 * @property-read int|null $attendance_entries_count
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType allowed()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType whereNeedPermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType whereNeedProof($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AttendanceType extends Model
{
    use HasFactory;

    public $table = 'attendance_types';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'description',
        'need_proof',
        'need_permission',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'need_proof' => 'boolean',
        'need_permission' => 'boolean',
    ];

    public function attendanceEntries()
    {
        return $this->belongsToMany(AttendanceEntry::class);
    }

    public function scopeAllowed($query)
    {
        $query->where(function ($query) {
            $query->where('need_permission', '=', 0);
        });
    }
}
