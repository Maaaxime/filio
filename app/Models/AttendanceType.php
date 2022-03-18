<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
