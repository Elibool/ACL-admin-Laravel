<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>yi admin</title>

    <!-- Bootstrap -->
    <link href="{{ $cdn_path }}/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ $cdn_path }}/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- NProgress -->
    <link href="{{ $cdn_path }}/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{ $cdn_path }}/admin/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="{{ $cdn_path }}/admin/css/custom.css" rel="stylesheet">
</head>

<body class="nav-md" style="overflow: hidden">
<div class="container body">
    <div class="main_container">
        <!-- left permissions tree start-->
        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Yi Admin!</span></a>
                </div>
                <div class="clearfix"></div>
                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                    </div>
                    <div class="profile_info">
                        <span>Welcome {{ $auth_user['name'] }}</span>
                        <h2> {{ $auth_user['email'] }} </h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
                <br>
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section active">
                        <h3>General</h3>
                        <ul class="nav side-menu" >
                            @foreach($permission_tree as $info)
                                <li>
                                    <a class="menu_tile"><i class="{{ $info['icon'] }}"></i> {{ $info['name'] }} <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none;">
                                        @foreach($info['child'] as $child)
                                            <li>
                                                <a @if(isset($child['child'])) class="menu_tile" @endif href="#{{ $child['path'] }}" title=" {{ $child['name'] }}">
                                                    {{ $child['name'] }}
                                                    @if(isset($child['child'])) <span class="fa fa-chevron-down"></span> @endif
                                                </a>
                                                @if(isset($child['child']))
                                                    <ul class="nav child_menu" style="display: block;">
                                                        @foreach($child['child'] as $second_child)
                                                            <li>
                                                                <a href="#{{ $second_child['path'] }}" title=" {{ $second_child['name'] }}">
                                                                    {{ $second_child['name'] }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @if($auth_user['is_superman'])
                        <div class="menu_section">
                            <h3>Super M</h3>
                            <ul class="nav side-menu">
                                <li>
                                    <a class="menu_tile">
                                        <i class="fa fa-steam"></i> Permissions <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li><a href="#/admin/permission/view" title="权限管理">权限管理</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- /sidebar menu -->
                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="退出系统">
                        <i class="glyphicon glyphicon-off" aria-hidden="true"></i>
                        <span style="font-size: 2rem">Exit</span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>
        <!-- left permissions tree end-->
        <!-- top notices start-->
        <div class="top_nav">
            <div class="nav_menu" >
                <nav class="row">
                    <div class="col-md-1" style="width: 5%;">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                    <ul id="tab_index" class="nav navbar-nav navbar-left col-md-9" style="height: 57px;overflow: hidden">

                    </ul>
                    <ul class="nav navbar-nav  navbar-right col-md-2">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                {{ $auth_user['name'] }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li>
                                    <a href="javascript:;"> Profile</a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">Help</a>
                                </li>
                                <li><a href="/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- top notices end-->
        <div class="right_col"  role="main" id="tab_pages">
            <iframe id="page_tab1_id_index0" frameborder="0" width="100%" height="100%" src="/admin/welcome" ></iframe>
            <div class="loading-container">
                <i class="fa fa-spinner loading"></i>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="{{ $cdn_path }}/admin/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ $cdn_path }}/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- NProgress -->
<script src="{{ $cdn_path }}/admin/vendors/nprogress/nprogress.js"></script>
<!-- jQuery custom content scroller -->
<script src="{{ $cdn_path }}/admin/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="{{ $cdn_path }}/admin/js/custom.js"></script>
</body>
</html>