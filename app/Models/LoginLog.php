<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
 * @todo 登录日志 ORM
 *
 */
class LoginLog extends Model
{
    protected $table = 'sys_login_log';
    /*
     * 禁止自动打上时间戳
     */
    public $timestamps = false;

}
