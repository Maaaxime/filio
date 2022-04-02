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
            | Admin
            |--------------------------------------------------------------------------
            */

            'admin.routes',
            
            /*
            |--------------------------------------------------------------------------
            | Users
            |--------------------------------------------------------------------------
            */

            'user.create',
            'user.read',
            'user.update',
            'user.delete',
            'user.list',

            /*
            |--------------------------------------------------------------------------
            | Roles
            |--------------------------------------------------------------------------
            */

            'role.create',
            'role.read',
            'role.update',
            'role.delete',
            'role.list',

            /*
            |--------------------------------------------------------------------------
            | Children
            |--------------------------------------------------------------------------
            */

            'child.create',
            'child.read-general',
            'child.read-medical',
            'child.read-family',
            'child.read-contract',
            'child.update',
            'child.delete',
            'child.list-all',
            'child.list-my',

            /*
            |--------------------------------------------------------------------------
            | Attendances
            |--------------------------------------------------------------------------
            */

            'attendances-type.create',
            'attendances-type.read',
            'attendances-type.update',
            'attendances-type.delete',
            'attendances-type.list',

            'attendances-entry.create',
            'attendances-entry.read',
            'attendances-entry.update',
            'attendances-entry.delete',
            'attendances-entry.list-all',
            'attendances-entry.list-my',

            'attendances-schedule.create',
            'attendances-schedule.read',
            'attendances-schedule.update',
            'attendances-schedule.delete',
            'attendances-schedule.list',
        );

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
