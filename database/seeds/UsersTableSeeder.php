<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::insert([
        	[
        		'name'		=> 'super',
                'last_name'=>'admin',
        		'email'		=> 'superadmin@admin.com',
        		'password'	=> bcrypt('password'),
			'created_at'=> Carbon::now(),
        		'updated_at'=> Carbon::now()
        	],
            [
                'name'		=> 'admin',
                'last_name'=>'admin',
                'email'		=> 'inventoryadmin@admin.com',
                'password'	=> bcrypt('password'),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],

    	]);
    }
}
