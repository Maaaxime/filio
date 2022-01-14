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
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $role = Role::create(['name' => 'Employee']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $role = Role::create(['name' => 'Parent']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        // Admin User
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@fripouilles.local',
            'password' => bcrypt('123456'),
        ]);
        $adminUser->assignRole([$role->id]);

        // Employee User
        $employeeUser = User::create([
            'name' => 'Employee',
            'email' => 'employee@fripouilles.local',
            'password' => bcrypt('123456'),
        ]);
        $employeeUser->assignRole([$role->id]);

        // Parent User
        $parentUser = User::create([
            'name' => 'Parent',
            'email' => 'parent@fripouilles.local',
            'password' => bcrypt('123456'),
        ]);
        $parentUser->assignRole([$role->id]);
    }
}