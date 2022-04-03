<?php

namespace Database\Seeders;

use App\Models\AttendanceType;
use Illuminate\Database\Seeder;

class AttendancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttendanceType::create([
            'name' => 'Présent',
            'description' => 'L\'enfant est présent.',
            'color' => "0",
            'need_proof' => false,
            'need_permission' => false,
            'default' => true
        ]);

        AttendanceType::create([
            'name' => 'Maladie',
            'description' => 'L\'enfant est absent pour maladie.',
            'color' => 5,
            'need_proof' => true,
            'need_permission' => false,
            'default' => false
        ]);

        AttendanceType::create([
            'name' => 'Vacances',
            'description' => 'L\'enfant est absent pour vacances.',
            'color' => 3,
            'need_proof' => false,
            'need_permission' => false,
            'default' => false
        ]);

        AttendanceType::create([
            'name' => 'Fermeture',
            'description' => 'L\'établissement est fermé.',
            'color' => 4,
            'need_proof' => false,
            'need_permission' => true,
            'default' => false
        ]);
    }
}
