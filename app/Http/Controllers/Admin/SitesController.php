<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/*
 * @desc 后台入口主目录文件
 * @auth pengliu186@163.com
 *
 */
class SitesController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    //定义后台外层核心 html
    public function index()
    {
        return view('admin.sites');
    }
    public function welcome()
    {

        return view('admin.welcome');
    }
    public function show()
    {

        return 'hello ';

    }
}
