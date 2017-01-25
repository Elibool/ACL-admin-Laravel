@extends('admin.layouts.container')

@section('title', '用户修改')
@section('content')
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>@yield('title')</h3>
            </div>
        </div>
        @include('admin.layouts.error')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>用户信息</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form  data-parsley-validate class="form-horizontal form-label-left form-parsley" action="{{ url('/admin/users/modify') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> 用户名 <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="name"  value="{{ $user['name'] }}" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> 登录邮箱 <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="email"  disabled="disabled" value="{{ $user['email'] }}" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> 重置密码 <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="password" value="" placeholder="输入需要设置的新密码" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> 是否启用?
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="flat icheck" name="is_active" value="1" @if($user['is_active']) checked="checked" @endif> 启用
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if($auth_user['is_superman'])
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> 超级管理员?
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="flat icheck" name="is_superman" value="1" @if($user['is_superman']) checked="checked" @endif> 是
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> 权限列表
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="x_content">
                                        <div class="col-xs-9">
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                @foreach($top_permissions as $key=>$top)
                                                    <div class="tab-pane  @if (!$key) active @endif" id="top-{{ $top['id'] }}">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                {!! $top['tree']  !!}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <!-- required for floating -->
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs tabs-right">
                                                @foreach($top_permissions as $key=>$top)
                                                    <li  @if (!$key) class="active" @endif>
                                                        <a href="#top-{{ $top['id'] }}" data-toggle="tab" aria-expanded="true"> {{ $top['name'] }} </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            @can('/admin/users/modify-modify')
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <input type="hidden" name="id" value="{{ $user['id'] }}" >
                                    <button type="submit" class="btn btn-success">保 存</button>
                                </div>
                            </div>
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){

        });
    </script>
@endsection
