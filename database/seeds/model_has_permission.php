<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class model_has_permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            array(
                'role_id'=>1,
                'model_type'=>'App\User',
                'model_id'=>1,
            ),
            array(
                'role_id'=>2,
                'model_type'=>'App\User',
                'model_id'=>2,
            ),
            array(
                'role_id'=>3,
                'model_type'=>'App\User',
                'model_id'=>3,
            ),
        );
        DB::table('model_has_roles')->insert($data);
    }
}
