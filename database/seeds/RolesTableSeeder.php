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

        $permission_manager = ['customer-manage','customer-edit','customer-remove','customer-add'];
        $permission_cashier = ['item-manage','item-edit','item-remove','item-add'];

        $roleAdmin = Role::create(['name' => 'owner']);
        $roleManager = Role::create(['name' => 'manager']);
        $roleCashier = Role::create(['name' => 'cashier']);

        $roleAdmin->syncPermissions($permission);
        $roleCashier->syncPermissions($permission_cashier);
        $roleManager->syncPermissions($permission_manager);
    }
}
