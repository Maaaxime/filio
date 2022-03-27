<?php

namespace Database\Seeders;

use App\Models\AttendanceSchedule;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ChildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Child::create([
            'first_name' => 'Astrid',
            'last_name' => 'Grenier',
            'birthdate' => Carbon::parse('2019-06-13'),
            'gender' => 0,
            'legal_tutor1_name' => 'Honoré Grenier',
            'legal_tutor2_name' => 'Claudine Lefevre',
            'address' => '40 rue des six frères Ruellan',
            'address2' => '',
            'city' => 'Sarreguemines',
            'postCode' => '57200',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
        Child::create([
            'first_name' => 'Olivie',
            'last_name' => 'Bonnet',
            'birthdate' => Carbon::parse('2019-08-23'),
            'gender' => 0,
            'legal_tutor1_name' => 'Sébastien-Alphonse Bonnet',
            'legal_tutor2_name' => 'Anaïs-Maryse Lemaitre',
            'address' => '79 boulevard Albin Durand',
            'address2' => '',
            'city' => 'Cergy',
            'postCode' => '95800',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
        Child::create([
            'first_name' => 'Margaret',
            'last_name' => 'Perrin',
            'birthdate' => Carbon::parse('2019-08-13'),
            'gender' => 0,
            'legal_tutor1_name' => 'Denis Perrin',
            'legal_tutor2_name' => 'Marine Maillard',
            'address' => '73 Rue de la Pompe',
            'address2' => '',
            'city' => 'Manosque',
            'postCode' => '04100',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
        Child::create([
            'first_name' => 'Susan',
            'last_name' => 'Laroche Berger-Bonneau',
            'birthdate' => Carbon::parse('2020-11-14'),
            'gender' => 0,
            'legal_tutor1_name' => 'Roland Laroche',
            'legal_tutor2_name' => 'Alice Berger-Bonneau',
            'address' => '76 avenue du Marechal Juin',
            'address2' => '',
            'city' => 'Saint-louis',
            'postCode' => '68300',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
        Child::create([
            'first_name' => 'Rémy',
            'last_name' => 'Boulanger de la Morin',
            'birthdate' => Carbon::parse('2021-01-26'),
            'gender' => 1,
            'legal_tutor1_name' => 'Pierre Boulanger de la Morin',
            'legal_tutor2_name' => 'Jeanne Renaud',
            'address' => '51 rue du Paillle en queue',
            'address2' => '',
            'city' => 'Les Ulis',
            'postCode' => '91940',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
        Child::create([
            'first_name' => 'Margot',
            'last_name' => 'Jean',
            'birthdate' => Carbon::parse('2021-06-20'),
            'gender' => 0,
            'legal_tutor1_name' => 'Jules Jean',
            'legal_tutor2_name' => 'Paulette Adam',
            'address' => '76 place Maurice-Charretier',
            'address2' => '',
            'city' => 'Champs-sur-marne',
            'postCode' => '77420',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
        Child::create([
            'first_name' => 'Arthur',
            'last_name' => 'Gaillard',
            'birthdate' => Carbon::parse('2020-06-08'),
            'gender' => 0,
            'legal_tutor1_name' => 'Auguste Gaillard',
            'legal_tutor2_name' => 'Sophie Besnard',
            'address' => '6 Square de la Couronne',
            'address2' => '',
            'city' => 'Palaiseau',
            'postCode' => '91120',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
        Child::create([
            'first_name' => 'Julie',
            'last_name' => 'Briand',
            'birthdate' => Carbon::parse('2020-11-09'),
            'gender' => 0,
            'legal_tutor1_name' => 'René Briand',
            'legal_tutor2_name' => 'Michèle Deschamps',
            'address' => '72 rue Gontier-Patin',
            'address2' => 'Chez Mme Letellier',
            'city' => 'Agde',
            'postCode' => '34300',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
        Child::create([
            'first_name' => 'Henri',
            'last_name' => 'Chauveau',
            'birthdate' => Carbon::parse('2021-06-18'),
            'gender' => 1,
            'legal_tutor1_name' => 'Marcel Chauveau',
            'legal_tutor2_name' => 'Martine Neveu',
            'address' => '44 rue Sébastopol',
            'address2' => '',
            'city' => 'Sainte-marie',
            'postCode' => '97438',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
        Child::create([
            'first_name' => 'Martine',
            'last_name' => 'Dufour-Alves',
            'birthdate' => Carbon::parse('2021-10-06'),
            'gender' => 0,
            'legal_tutor1_name' => 'André Dufour-Alves',
            'legal_tutor2_name' => 'Alexandria Humbert-Gomez',
            'address' => '68 boulevard de la Liberation',
            'address2' => '',
            'city' => 'Marseille',
            'postCode' => '13014',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
        Child::create([
            'first_name' => 'Alix',
            'last_name' => 'Lebrun de la Barbe',
            'birthdate' => Carbon::parse('2021-10-06'),
            'gender' => 0,
            'legal_tutor1_name' => 'Gilbert Lebrun de la Barbe',
            'legal_tutor2_name' => '',
            'address' => '98 boulevard de Prague',
            'address2' => '',
            'city' => 'Nogent-sur-marne',
            'postCode' => '94130',
            'schedule_id' => AttendanceSchedule::first()->id,
        ]);
    }
}
