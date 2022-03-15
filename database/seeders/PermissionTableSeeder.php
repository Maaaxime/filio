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
            | Children
            |--------------------------------------------------------------------------
            */

            'child-create',
            'child-read-general',
            'child-read-medical',
            'child-read-family',
            'child-read-contract',
            'child-update',
            'child-update-general',
            'child-update-medical',
            'child-update-family',
            'child-update-contract',
            'child-delete',

            // Only "My" Children
            'child-create-my',
            'child-create-general-my',
            'child-create-medical-my',
            'child-create-family-my',
            'child-create-contract-my',
            'child-read-my',
            'child-read-general-my',
            'child-read-medical-my',
            'child-read-family-my',
            'child-read-contract-my',
            'child-update-my',
            'child-update-general-my',
            'child-update-medical-my',
            'child-update-family-my',
            'child-update-contract-my',
            'child-delete-my',

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
