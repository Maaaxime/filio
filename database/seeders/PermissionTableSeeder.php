<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $permissions = array(

            /*
            |--------------------------------------------------------------------------
            | Users
            |--------------------------------------------------------------------------
            */

            'user-create',
            'user-read',
            'user-update',
            'user-delete',

            // Only "My" User Account
            // 'user-create-my', // Non-sense
            'user-read-my',
            'user-update-my',
            'user-delete-my',

            /*
            |--------------------------------------------------------------------------
            | Roles
            |--------------------------------------------------------------------------
            */

            'role-create',
            'role-read',
            'role-update',
            'role-delete',

            /*
            |--------------------------------------------------------------------------
            | Childs
            |--------------------------------------------------------------------------
            */

            'children-create',
            'children-read-general',
            'children-read-medical',
            'children-read-family',
            'children-read-contract',
            'children-update',
            'children-update-general',
            'children-update-medical',
            'children-update-family',
            'children-update-contract',
            'children-delete',

            // Only "My" Children
            'children-create-my',
            'children-create-general-my',
            'children-create-medical-my',
            'children-create-family-my',
            'children-create-contract-my',
            'children-read-my',
            'children-read-general-my',
            'children-read-medical-my',
            'children-read-family-my',
            'children-read-contract-my',
            'children-update-my',
            'children-update-general-my',
            'children-update-medical-my',
            'children-update-family-my',
            'children-update-contract-my',
            'children-delete-my',

            /*
            |--------------------------------------------------------------------------
            | Attendances
            |--------------------------------------------------------------------------
            */

            'attendances.type-create',
            'attendances.type-read',
            'attendances.type-update',
            'attendances.type-delete',

            'attendances.entry-create',
            'attendances.entry-read',
            'attendances.entry-update',
            'attendances.entry-delete',

            // Only "My" Children
            'attendances.entry-create-my',
            'attendances.entry-read-my',
            'attendances.entry-update-my',
            'attendances.entry-delete-my',
        );

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
