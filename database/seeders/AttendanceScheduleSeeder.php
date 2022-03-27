<?php

namespace Database\Seeders;

use App\Models\AttendanceSchedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttendanceSchedule::create([
            'name' => 'Défaut',
            'default_time_start' => Carbon::createFromFormat('H:i','08:00'),
            'default_time_end' => Carbon::createFromFormat('H:i','18:00'),
            'monday' => true,
            'tuesday' => true,
            'wednesday' => true,
            'thursday' => true,
            'friday' => true,
            'saturday' => false,
            'sunday' => false,
        ]);
    }
}
