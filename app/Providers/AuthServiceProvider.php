<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\PermissionsUser;
use App\Models\Permissions;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     *
     * 注册策略组
     * @var array
     */
    protected $policies = [
        // Acl::class => AclPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->registerPolicies();
        //用户权限定义,只有在前端 can 语句判断时才去调用 define 的回调方法
        $permissionsUser = new PermissionsUser;
        $permissions = Permissions::where('parent_id','>','0')->get()->toArray();
        foreach($permissions as $info)
        {
            //循环定义 view  create modify remove 权限
            Gate::define($info['path'], function ($user) use ($info,$permissionsUser) {
                return $user->is_superman ? true: $permissionsUser->hasPermission($user->id,$info['id'],'view');
            });
            Gate::define($info['path'].'-create', function ($user) use ($info,$permissionsUser) {
                return $user->is_superman ? true: $permissionsUser->hasPermission($user->id,$info['id'],'create');
            });
            Gate::define($info['path'].'-modify', function ($user) use ($info,$permissionsUser) {
                return $user->is_superman ? true: $permissionsUser->hasPermission($user->id,$info['id'],'modify');
            });
            Gate::define($info['path'].'-remove', function ($user) use ($info,$permissionsUser) {
                return $user->is_superman ? true: $permissionsUser->hasPermission($user->id,$info['id'],'remove');
            });
        }
    }
}
