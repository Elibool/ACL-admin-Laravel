<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permissions;
/*
 * @todo 权限检查中间件
 *
 */
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * create -> get /view ,post /create
         * modify -> get /view,post /modify
         * remove -> get /remove
         *
         * 两种情况
         * 1. 严格模式 => permissions 权限表有定义,严格定义 get 和 post 权限差异,
         *      如有 modify view get 权限,无 modify post 权限;
         * 2. 宽松模式 => 继承自上级权限, 如有 modify get 同时享有 post 权限
         *
         */
        $path = $request->path();
        $user = $request->user();
        if($user->is_superman)
        {
            return $next($request);
        }
        //严格模式
        if(Permissions::where('path','/'.$path)->first())
        {
            $gate_name = $this->getGateName($request->method(),$path,1);
            if($user->can($gate_name))
            {
                return $next($request);
            }
            return redirect('/no-permission');
        }
        //宽松模式
        $gate_name = $this->getGateName($request->method(),$path);
        if($user->can($gate_name))
        {
            return $next($request);
        }
        return redirect('/no-permission');
    }
    /**
     * @todo 自定 gete 依据路由和方法名组装权限
     * @param string $method
     * @param string $path
     * @param int $type
     * @return array
     *
     */
    protected function getGateName($method,$path,$type=0)
    {
        $gate_names = '';
        $path_arr = explode('/',$path);
        $action_name = array_pop($path_arr);
        if(1 == $type)
        {
            if('GET' == $method)
            {
                $gate_names = '/'.$path;
            }
            if('POST' == $method)
            {
                $gate_names = '/'.$path.'-'.$action_name;
            }
        }
        else
        {
            if('view' == $action_name)
            {
                $gate_names = '/'.$path;
            }
            else
            {
                $view_gate = array_merge($path_arr,['view']);
                $gate_names = '/'.join('/',$view_gate).'-'.$action_name;
            }
        }
        return $gate_names;
    }

}
