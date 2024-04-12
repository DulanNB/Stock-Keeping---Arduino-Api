<?php

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::truncate();

        $permission = Permission::all();

        $permission_manager = ['item-manage'];

        $roleAdmin = Role::create(['name' => 'super_admin']);
        $roleManager = Role::create(['name' => 'inventory_admin']);


        $roleAdmin->syncPermissions($permission);
        $roleManager->syncPermissions($permission_manager);

    }
}
