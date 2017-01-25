@extends('admin.layouts.container')

@section('title', '权限列表')
@section('content')
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>@yield('title') <a href="{{ url('/admin/permission/create') }}" title="添加权限" class="btn btn-primary open-page-tab">添加</a></h3>
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
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>权限名</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {!! $permission_tree !!}
                            </tbody>
                        </table>
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
