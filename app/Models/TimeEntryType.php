<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntryType extends Model
{
    use HasFactory;

    public $table = 'time_entry_types';

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

    public function timeEntries()
    {
        return $this->belongsToMany(TimeEntry::class);
    }
}
