<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'teller']);
        Role::create(['name' => 'pengunjung']);
        
        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'teller']);
        Permission::create(['name' => 'pengunjung']);
    }
}
