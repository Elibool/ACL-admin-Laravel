<?php
/**
 * Created by PhpStorm.
 * User: liupeng
 * Date: 16/12/27
 * Time: 上午11:24
 * Desc: 定义 admin 左边权限树 数据来源
 */
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;


class  LayoutComposer
{
    public function compose(View $view)
    {
        //获取 auth user information
        $user = Auth::user();
        $view->with('auth_user',$user);

    }
}