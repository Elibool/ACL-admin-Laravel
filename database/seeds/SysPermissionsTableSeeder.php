<?php

use Illuminate\Database\Seeder;

class SysPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_permissions')->insert(
            [
                'id' => 1,
                'parent_id' => 0,
                'path' => '',
                'name' => '用户中心',
                'icon' => 'fa fa-home',
                'is_display' => 1,
            ],
            [
                'id' => 9,
                'parent_id' => 0,
                'path' => '',
                'name' => '用户管理',
                'icon' => 'fa fa-user',
                'is_display' => 1,
            ],
            [
                'id' => 10,
                'parent_id' => 9,
                'path' => '/admin/users/view',
                'name' => '用户列表',
                'icon' => '',
                'is_display' => 1,
            ],
            [
                'id' => 11,
                'parent_id' => 1,
                'path' => '/admin/welcome',
                'name' => '欢迎页',
                'icon' => '',
                'is_display' => 1,
            ],
            [
                'id' => 12,
                'parent_id' => 10,
                'path' => '/admin/users/modify',
                'name' => '用户修改',
                'icon' => '',
                'is_display' => 0,
            ]
        );
    }
}
