@extends('admin.layouts.container')

@section('title', '用户列表')
@section('content')
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>@yield('title')
                    @can('/admin/users/view-create')
                    <a href="{{ url('/admin/users/create') }}" title="添加用户" class="btn btn-primary open-page-tab">添加</a>
                    @endcan
                </h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>列表详情 </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div  class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>用户名</th>
                                            <th>登录邮箱</th>
                                            <th>是否启用?</th>
                                            <th>超级管理员?</th>
                                            <th>数据更新时间</th>
                                            <th>最后登录时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td> {{ $user['id'] }} </td>
                                                <td> {{ $user['name'] }} </td>
                                                <td> {{ $user['email'] }} </td>
                                                <td>
                                                    @if($user['is_active'])
                                                        <i class="fa fa-check green"></i>
                                                    @else
                                                        <i class="fa fa-close red"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user['is_superman'])
                                                        <i class="fa fa-check green"></i>
                                                    @else
                                                        <i class="fa fa-close red"></i>
                                                    @endif
                                                </td>
                                                <td> {{ $user['created_at'] }}</td>
                                                <td> {{ $user['updated_at'] }}</td>
                                                <td>
                                                    @can('/admin/users/view-modify' )
                                                    <a class="open-page-tab" title="用户修改" href="{{ url('/admin/users/modify') }}?id={{ $user["id"] }}"> 详情 </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" role="status" aria-live="polite">
                                        共 {{ $users->count() }} 条数据,
                                        {{ $users->total() }} 页
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate">
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('.modal-remove').on('click',function(e){
                e.preventDefault();
                Ga.handle.remove({msg:'确定删除该权限',url:$(this).attr('data-href'),data:'id='+$(this).attr('data-id')});
            });
        });
    </script>
@endsection
