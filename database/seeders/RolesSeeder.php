<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin =   Role::create(['name' => 'adminstrator']);
        Role::create(['name' => 'agent']);
        Role::create(['name' => 'user']);

        Permission::create(['name' => 'manage-dashboard']);
        $admin->givePermissionTo($admin);
    }
}
