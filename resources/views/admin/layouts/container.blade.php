<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','welcome')</title>
    <!-- Bootstrap -->
    <link href="{{ $cdn_path }}/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ $cdn_path }}/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ $cdn_path }}/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ $cdn_path }}/admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ $cdn_path }}/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    @if (session('status'))
        <!-- PNotify -->
        <link href="{{ $cdn_path }}/admin/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="{{ $cdn_path }}/admin/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    @endif
    <!-- Custom Theme Style -->
    <link href="{{ $cdn_path }}/admin/css/custom.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ $cdn_path }}/admin/vendors/jquery/dist/jquery.min.js"></script>
</head>
</head>
<body style="background: #F7F7F7;">

    <div class="main_container"  style="background: #F7F7F7;padding: 10px 20px 0">
        <!-- page begin -->
        @yield('content')
        <!-- page end -->
    </div>

    <footer>
        <div class="pull-right">
            Bootstrap Admin Template by <a target="_blank" href="https://github.com/puikinsh/gentelella">gentelella</a>
        </div>
        <div class="clearfix"></div>
    </footer>

    <!-- Bootstrap -->
    <script src="{{ $cdn_path }}/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="{{ $cdn_path }}/admin/vendors/nprogress/nprogress.js"></script>
    <!-- Parsley input 校验 -->
    <script src="{{ $cdn_path }}/admin/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- iCheck -->
    <script src="{{ $cdn_path }}/admin/vendors/iCheck/icheck.min.js"></script>
    @if (session('status'))
        <!-- PNotify -->
        <script src="{{ $cdn_path }}/admin/vendors/pnotify/dist/pnotify.js"></script>
        <script src="{{ $cdn_path }}/admin/vendors/pnotify/dist/pnotify.buttons.js"></script>
    @endif
    <!-- Custom Theme Scripts -->
    <script src="{{ $cdn_path }}/admin/js/custom.js"></script>

    <script>
        $(function(){
            @if (session('status'))
                //notice message with PNotify
                new PNotify({
                    title: '操作成功!',
                    text: '{{ session('text') }}',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            @endif
            //iCheck
            $('.icheck').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    </script>
</body>
</html>