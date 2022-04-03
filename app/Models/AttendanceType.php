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
        'color',
        'need_proof',
        'need_permission',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'need_proof' => 'boolean',
        'need_permission' => 'boolean',
    ];

    public $colors = [
        ["name" => "primary-light", "background-color" => "#ebfffc", "font-color" => "#00d1b2"],
        ["name" => "link-light", "background-color" => "#eff1fa", "font-color" => "#485fc7"],
        ["name" => "info-light", "background-color" => "#eff5fb", "font-color" => "#3e8ed0"],
        ["name" => "success-light", "background-color" => "#effaf5", "font-color" => "#48c78e"],
        ["name" => "warning-light", "background-color" => "#fffaeb", "font-color" => "#ffe08a"],
        ["name" => "danger-light", "background-color" => "#feecf0", "font-color" => "#f14668"],
        ["name" => "primary-dark", "background-color" => "#00947e", "font-color" => "#fff"],
        ["name" => "link-dark", "background-color" => "#3850b7", "font-color" => "#fff"],
        ["name" => "info-dark", "background-color" => "#296fa8", "font-color" => "#fff"],
        ["name" => "success-dark", "background-color" => "#257953", "font-color" => "#fff"],
        ["name" => "warning-dark", "background-color" => "#946c00", "font-color" => "#fff"],
        ["name" => "danger-dark", "background-color" => "#cc0f35", "font-color" => "#fff"]
    ];

    public function attendanceEntries()
    {
        return $this->belongsToMany(AttendanceEntry::class);
    }

    public function getBackgroundColorAttribute()
    {
        if (empty($this->color))
            $this->color = 0;

        return $this->colors[$this->color]["background-color"];
    }

    public function getFontColorAttribute()
    {
        if (empty($this->color))
            $this->color = 0;

        return $this->colors[$this->color]["font-color"];
    }

    public function scopeAllowed($query)
    {
        $query->where(function ($query) {
            $query->where('need_permission', '=', 0);
        });
    }
}
