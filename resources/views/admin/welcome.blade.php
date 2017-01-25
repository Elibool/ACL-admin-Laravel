@extends('admin.layouts.container')

@section('content')
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Welcome Page</h3>
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
                        <h2> 序 </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="bs-example" data-example-id="simple-jumbotron">
                            <div class="jumbotron" style="padding:40px 60px;border-radius:6px;">
                                <h1>Hello, Yi Admin!</h1>
                                <p>
                                    Yi Admin 基于 Laravel 5.3 开发的后台 ACL 权限管理系统的 DEMO,
                                    <br>
                                    前端这块使用的是 MIT 协议的 <a href="https://github.com/puikinsh/gentelella" >gentelella</a>  Bootstrap 风格模板,在其基础上实现了历史页面切换 Page 功能,  <br>
                                    Page Tabs js 亦已编写和封装好
                                    <br>
                                    通知系统使用 Laravel 的一次性 session 机制结合前端 PNotify js 实现
                                    <br>
                                    <br>
                                    权限控制系统这块 ,主要运用了 Laravel 自带的 Gate 来实现,<br>
                                    这是一个需自主开发的过程,并且需要在编写 Controller 时约定好各个方法的命名规则 <br>
                                    有两种权限定义模式: <br>
                                    1.宽松模式; 2.严格模式 ; 且严格模式 > 宽松模式
                                    <br><br>
                                    例:<br>
                                    用有列表权限后,同时拥有列表单项的查看和修改权限 (宽松模式定义)<br>
                                    单独定义 列表项的 查看和修改权限,如拥有查看但禁止修改 (严格模式订单)
                                    <br>
                                    happy coding!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
