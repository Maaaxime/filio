<?php

namespace Database\Seeders;

use App\Models\TimeEntryType;
use Illuminate\Database\Seeder;

class TimeEntriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TimeEntryType::create([
            'name' => 'Présent',
            'description' => 'L\'enfant est présent.',
            'need_proof' => false,
            'need_permission' => false,
            'default' => true
        ]);

        TimeEntryType::create([
            'name' => 'Maladie',
            'description' => 'L\'enfant est absent pour maladie.',
            'need_proof' => true,
            'need_permission' => false,
            'default' => false
        ]);

        TimeEntryType::create([
            'name' => 'Vacance',
            'description' => 'L\'enfant est absent pour vacances.',
            'need_proof' => false,
            'need_permission' => false,
            'default' => false
        ]);

        TimeEntryType::create([
            'name' => 'Fermeture',
            'description' => 'L\'établissement est fermé.',
            'need_proof' => false,
            'need_permission' => true,
            'default' => false
        ]);
    }
}
