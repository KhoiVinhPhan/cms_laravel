<?php

use Illuminate\Database\Seeder;

class SystemPaginationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_pagination')->insert([
        	[
        		'pagination_id' => 1, 
        		'pagination_backend' => 25,
        		'pagination_frontend' => 25
        	]
        ]);
    }
}
