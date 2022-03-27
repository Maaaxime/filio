<?php

namespace Database\Seeders;

use App\Models\AttendanceScheduleEntry;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            AdminUserSeeder::class,
            AttendancesSeeder::class,
            AttendanceScheduleSeeder::class,
            AttendanceScheduleEntrySeeder::class,
            ChildrenSeeder::class,
        ]);
    }
}
