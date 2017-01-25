<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
 * @todo 所有通知或错误提示视图
 */

class NoticeController extends Controller
{
    //后台用户无权限
    public function AdminUserNoPermission(Request $request)
    {
        return '没有权限';

    }

}
