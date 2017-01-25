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
use App\Models\Permissions;
use App\Models\PermissionsUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\Tree;

class PermissionsComposer
{
    public function compose(View $view)
    {
        $user_permission_id = [];
        $user = Auth::user();
        if(!$user->is_superman){
            //非超级管理员,检查权限
            $user_permission = PermissionsUser::select('permission_id')
                ->where('u_id','=',Auth::user()->id)
                ->get()
                ->toArray();
            $user_permission_id = [];
            foreach($user_permission as $value)
            {
                $user_permission_id[] = $value['permission_id'];
            }
        }
        $permission = Permissions::where('is_display','=',1)->get()->toArray();
        $tree = new Tree;
        $permission_init = [];
        foreach($permission as $info)
        {
            $permission_init[$info['id']] = $info;
        }
        $tree->init($permission_init);
        $permission_list = [];
        foreach($permission as $info)
        {
            if(!$info['parent_id'])
            {
                $child = $tree->get_all_child($info['id'],$user_permission_id);
                if($child)
                {
                    $info['icon'] = $info['icon'] ? : 'fa fa-pagelines';
                    $permission_list[$info['id']] = $info;
                    $permission_list[$info['id']]['child'] =$child;
                }
            }
        }
//        dd($permission_list);

        //视图服务者类中 注入 permission_tree 变量
        $view->with('permission_tree',$permission_list);
    }
}