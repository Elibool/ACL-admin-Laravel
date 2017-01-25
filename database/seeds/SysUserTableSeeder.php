<?php

use Illuminate\Database\Seeder;

class SysUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_users')->insert([
            'id' => 2,
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$rVBZlZ1EIBsXVICuVQIfkuowrKY3Zakjene6/SMHKtTZ76D9fQ3ym',
            'is_active' => '1',
            'is_superman' => '1',
        ],[
            'id' => 4,
            'name' => 'eli',
            'email' => 'elibool@outlook.com',
            'password' => '$2y$10$KHef3ajxaIlhBBoOPgsPfuF99rsXSDL/8OCajefVd2q/QgmW9hQES',
            'is_active' => '1',
            'is_superman' => '0',
        ]);
    }
}
