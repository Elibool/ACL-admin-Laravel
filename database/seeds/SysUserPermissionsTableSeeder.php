<?php

use Illuminate\Database\Seeder;

class SysUserPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_permissions_user')->insert(
            [
                'permission_id' => 11,
                'u_id' => 4,
                'modify' => 0,
                'create' => 0,
                'remove' => 0
            ],
            [
                'permission_id' => 10,
                'u_id' => 4,
                'modify' => 1,
                'create' => 0,
                'remove' => 1
            ],
            [
                'permission_id' => 12,
                'u_id' => 4,
                'modify' => 0,
                'create' => 0,
                'remove' => 0
            ]
        );
    }
}
