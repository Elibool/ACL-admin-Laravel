<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionsUser extends Model
{
    //
    protected $table = 'sys_permissions_user';
    public $timestamps = false;


    /*
     * @todo 判断当前 user 是否拥有某权限
     * @params object $user
     * @params init $pid
     * @params string $type
     * @return bool
     */
    public function hasPermission($uid,$pid,$type)
    {
        $permission = self::where([
            ['permission_id','=',$pid],
            ['u_id','=',$uid]
        ])->first();
        if($permission)
        {
            if('view' == $type)
                return true;
            if('create' == $type && $permission->create)
                return true;
            if('modify' == $type && $permission->modify)
                return true;
            if('remove' == $type && $permission->remove)
                return true;
        }
        return false;

    }
}
