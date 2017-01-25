<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\PermissionsUser;
use App\Http\Helpers\Tree;
use App\Models\Permissions;
use App\User;
use Illuminate\Support\Facades\DB;
/*
 * @todo 用户权限管理
 */

class UsersController extends Controller
{

    public function getView()
    {
        $users = User::paginate(15);
        return view('admin.users.view')->with('users',$users);
    }
    /*
     * @todo create permissions
     */
    public function getCreate()
    {
        return view('admin.users.create');
    }
    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:12',
            'email' => 'required|unique:sys_users|email',
            'password' => 'required|min:6|max:12'
        ]);
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->is_active = $request->input('is_active',0);
        $user->is_superman = $request->input('is_superman',0);
        $user->save();

        return redirect()->route('users')->with(['status'=>1,'text'=>'添加成功']);
    }
    /*
     * @todo modify permissions
     */
    public function getModify(Request $request)
    {
        $user_permissions = PermissionsUser::where('u_id',$request->input('id'))->get();
        $arr = $user_permissions->toArray();
        $user_permissions_arr = [];
        foreach($arr as $value)
        {
            $user_permissions_arr[$value['permission_id']] = $value;
        }
        $permissions = Permissions::all()->toArray();
        foreach($permissions as $key=>$val)
        {
            $permissions[$key] = $val;
            $permissions[$key]['checked'] = isset($user_permissions_arr[$val['id']]) ? 'checked':'';
            $permissions[$key]['create_checked'] = isset($user_permissions_arr[$val['id']]) && $user_permissions_arr[$val['id']]['create'] ? 'checked':'';
            $permissions[$key]['modify_checked'] = isset($user_permissions_arr[$val['id']]) && $user_permissions_arr[$val['id']]['modify'] ? 'checked':'';
            $permissions[$key]['remove_checked'] = isset($user_permissions_arr[$val['id']]) && $user_permissions_arr[$val['id']]['remove'] ? 'checked':'';
        }
        $tree = new Tree;
        $tree->init($permissions);
        $str = "<tr data-tt-id='\$id'>
						<td>\$spacer
						    <label for='ch_\$id' style='font-size:12px;line-height: 0;'>
						         <input type='checkbox' \$checked class='icheck' id='ch_\$id' name='perms_id[]' value='\$id'> \$name
						    </label>
						    <i class='fa fa-long-arrow-right'></i>
						    <input type='checkbox'  name='action[\$id][create]'  \$create_checked value='1'> 添加
						    <input type='checkbox'  name='action[\$id][modify]'  \$modify_checked value='1'> 修改
						    <input type='checkbox'  name='action[\$id][remove]'  \$remove_checked value='1'> 删除
						</td>
					</tr>";
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;';
        $top_permissions = $tree->get_child(0);
        foreach ($top_permissions as $key => $value){
            $tree->ret = '';
            $top_permissions[$key]['tree'] = $tree->get_tree($value['id'], $str);
        }

        $user = User::find($request->input('id'));
        $view_data['user'] = $user;
        $view_data['top_permissions'] = $top_permissions;
        return view('admin.users.modify')->with($view_data);
    }
    public function postModify(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:12',
            'password' => 'min:6|max:12'
        ]);
        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->is_active = $request->input('is_active',0);
        $user->is_superman = $request->input('is_superman',0);
        if($request->input('password'))
        {
            $this->password = bcrypt($request->input('password'));
        }
        $user->save();
        //每次更新前清除旧的权限
        PermissionsUser::where('u_id',$request->input('id'))->delete();
        $data = [];
        $action = $request->input('action');
        foreach($request->input('perms_id') as $permission_id)
        {
            $data[] = [
                'permission_id' => $permission_id,
                'u_id' => $request->input('id'),
                'modify' => isset($action[$permission_id]['modify'])?1:0,
                'remove' => isset($action[$permission_id]['remove'])?1:0,
                'create' => isset($action[$permission_id]['create'])?1:0
            ];
        }
        if($data)
            DB::table('sys_permissions_user')->insert($data);

        return redirect()->route('users')->with(['status'=>1,'text'=>'保存成功']);
    }
    /*
     * @todo remove permissions
     * @params ajax post request
     */
    public function getRemove(Request $request)
    {
        //Permissions::destroy($request->input('id'));
        return redirect()->route('users')->with(['status'=>1,'text'=>'删除成功']);
    }
}
