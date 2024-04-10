<?php

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
        Permission::truncate();
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-management',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'item-manage',
            'vendor-manage',
            'stock-order-manage',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
