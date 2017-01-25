<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateSysUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sys_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('email', 56);
            $table->string('password', 255);
            $table->string('remember_token', 100);
            $table->tinyInteger('is_active')->default(1)->comment('是否启用');
            $table->tinyInteger('is_superman')->comment('是否超级管理员');
            $table->timestamps();

            $table->unique('email', 'users_email_unique');

            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_users');
    }
}
