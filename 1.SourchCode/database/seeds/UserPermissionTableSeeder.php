<?php

use Illuminate\Database\Seeder;

class UserPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_permission')->insert([
        	[
        		'user_permission_id' => 1, 
        		'name_permission' => 'Quản trị hệ thống',
        		'detail_permission' => 'Có quyền hạn cao nhất trong hệ thống, thay đổi mọi cấu hình hệ thống'
        	],
        	[
        		'user_permission_id' => 2, 
        		'name_permission' => 'Nhân viên',
        		'detail_permission' => 'Có quyền hạn quản lý hệ thống nhưng không thay đổi được cấu hình hệ thống'
        	],
        	[
        		'user_permission_id' => 3, 
        		'name_permission' => 'Khách hàng',
        		'detail_permission' => 'Có quyền hạn xứ lý bài viết của cá nhân, không có quyền quản lý hệ thống'
        	]
        ]);
    }
}
