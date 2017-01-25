<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Permissions;
use App\Http\Helpers\Tree;

/*
 * @todo 权限管理模块
 *
 */
class PermissionController extends Controller
{
    //
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function getView()
    {
        $permissions = Permissions::all()->toArray();
        $tree = new Tree;
        $tree->init($permissions);
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;';
        $str = "<tr data-tt-id='\$id' >
                    <td> </td>
					<td>\$spacer \$name \$is_display</td>
					<td>
					    <a href='/admin/permission/create?pid=\$id'>添加子权限</a> |
					    <a href='/admin/permission/modify?id=\$id'>修改</a> |
					    <a class='modal-remove' data-href='/admin/permission/remove' data-id='\$id' href='#'>删除</a>
					</td>
				</tr>";
        $permission_tree = $tree->get_tree(0, $str);

        return view('admin.permissions.view')->with('permission_tree',$permission_tree);
    }
    /*
     * @todo create permissions
     */
    public function getCreate()
    {
        $permissions = Permissions::all()->toArray();
        $tree = new Tree;
        $tree->init($permissions);
        $permission_tree = $tree->get_tree(0, "<option value='\$id' \$selected>\$spacer \$name</option>",$this->request->input('pid',0));

        return view('admin.permissions.create')->with('permission_tree',$permission_tree);
    }
    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:32',
        ]);
        $permissions = new Permissions;
        $permissions->name = $request->name;
        $permissions->parent_id = $request->parent_id;
        $permissions->path = $request->path;
        $permissions->icon = $request->icon;
        $permissions->is_display = $request->input('is_display',0);
        $permissions->save();
        return redirect()->route('permission')->with(['status'=>1,'text'=>'添加成功']);
    }
    /*
     * @todo modify permissions
     */
    public function getModify()
    {
        $permissions = Permissions::all()->toArray();
        $tree = new Tree;
        $tree->init($permissions);

        $modify_permission = Permissions::find($this->request->input('id'));
        $permission_tree = $tree->get_tree(0, "<option value='\$id' \$selected>\$spacer \$name</option>",$modify_permission->parent_id);

        $view_data['permission_tree'] = $permission_tree;
        $view_data['permission'] = $modify_permission;
        return view('admin.permissions.modify')->with($view_data);
    }
    public function postModify(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:32',
        ]);
        $permissions = Permissions::find($request->input('id'));
        $permissions->name = $request->name;
        $permissions->parent_id = $request->parent_id;
        $permissions->path = $request->path;
        $permissions->icon = $request->icon;
        $permissions->is_display = $request->input('is_display',0);
        $permissions->save();
        return redirect()->route('permission')->with(['status'=>1,'text'=>'修改成功']);
    }
    /*
     * @todo remove permissions
     * @params ajax post request
     */
    public function getRemove(Request $request)
    {
        Permissions::destroy($request->input('id'));
        return redirect()->route('permission')->with(['status'=>1,'text'=>'删除成功']);
    }
}
