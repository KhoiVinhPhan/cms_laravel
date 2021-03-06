<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
        		'name' => 'administrator', 
        		'email' => 'administrator@gmail.com', 
        		'user_permission_id' => 1, 
        		'password' => bcrypt('123456'), 
        		'created_at' => now()
        	],
        	[
        		'name' => 'user', 
        		'email' => 'user@gmail.com', 
        		'user_permission_id' => 2, 
        		'password' => bcrypt('123456'), 
        		'created_at' => now()
        	],
        	[
        		'name' => 'customer', 
        		'email' => 'customer@gmail.com', 
        		'user_permission_id' => 3, 
        		'password' => bcrypt('123456'), 
        		'created_at' => now()
        	]
        ]);
    }
}

