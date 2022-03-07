<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $adminRole->syncPermissions($permissions);

        $employeeRole = Role::create(['name' => 'Employee']);
        $permissions = Permission::pluck('id','id')->all();
        $employeeRole->syncPermissions($permissions);

        $parentRole = Role::create(['name' => 'Parent']);
        $permissions = Permission::pluck('id','id')->all();
        $parentRole->syncPermissions($permissions);

        // Admin User
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@fripouilles.local',
            'password' => bcrypt('123456'),
        ]);
        $adminUser->assignRole([$adminRole->id]);

        // Employee User
        $employeeUser = User::create([
            'name' => 'Employee',
            'email' => 'employee@fripouilles.local',
            'password' => bcrypt('123456'),
        ]);
        $employeeUser->assignRole([$employeeRole->id]);

        // Parent User
        $parentUser = User::create([
            'name' => 'Parent',
            'email' => 'parent@fripouilles.local',
            'password' => bcrypt('123456'),
        ]);
        $parentUser->assignRole([$parentRole->id]);
    }
}