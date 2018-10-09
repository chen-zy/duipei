<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MION Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/Ionicons/css/ionicons.min.css">
    @yield('css')
    <link rel="stylesheet" href="/vendor/adminlte/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/css/admin.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="#" class="logo">
            <span class="logo-mini"><b>M</b>A</span>
            <span class="logo-lg"><b>Mion</b>Admin</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('admin.logout') }}"><i class="fa fa-btn fa-sign-out"></i>退出</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/vendor/adminlte/img/user-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->mobile }} (ID:{{ Auth()->id() }})</p>
                    <a href="#"><span><i class="fa fa-user-circle-o"></i> 我的</span></a>
                    &nbsp;&nbsp;
                    <a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out"></i> <span>退出</span></a>
                </div>
            </div>
            <ul class="sidebar-menu MA_menu" data-widget="tree">
                @if(auth()->user()->can('dashboard'))
                    <li>
                        <a href="{{ route('admin.dashboard') }}" ma-tab="控制台"><i class="fa fa-dashboard"></i>
                            <span>控制台</span></a>
                    </li>
                @endif
                @if(auth()->user()->can('*-user') || auth()->user()->can('*-role') || auth()->user()->can('*-permission'))
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i> <span>用户/角色/权限</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if(auth()->user()->can('*-user'))
                                <li>
                                    <a href="{{ route('admin.user.index') }}" ma-tab="用户"><i class="fa fa-user"></i>
                                        用户</a></li>
                            @endif
                            @if(auth()->user()->can('*-role'))
                                <li>
                                    <a href="{{ route('admin.role.index') }}" ma-tab="角色"><i class="fa fa-users"></i>
                                        角色</a></li>
                            @endif
                            @if(auth()->user()->can('*-permission'))
                                <li>
                                    <a href="{{ route('admin.permission.index') }}" ma-tab="权限"><i class="fa fa-key"></i>
                                        权限</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cubes"></i> <span>Demo</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/demo/form" ma-tab="Form"><i class="fa fa-table"></i>
                                <span>Form</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <div class="MA_tabs">
            <div class="nav-tabs-custom tab-success">
                <ul class="nav nav-tabs">
                </ul>
                <div class="tab-content">
                </div>
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2009-{{ date('Y') }} <a href="https://www.mion.cn" target="_blank">名扬网络</a>.</strong>
        All rights reserved.
    </footer>
</div>
<script src="/vendor/adminlte/plugins/jquery/dist/jquery.min.js"></script>
<script src="/vendor/adminlte/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/vendor/adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/vendor/adminlte/plugins/fastclick/lib/fastclick.js"></script>
@yield('js')
<script src="/vendor/adminlte/js/adminlte.min.js"></script>
<script src="/js/admin.js"></script>
@yield('script')
{!! \Krucas\Notification\Facades\Notification::showAll() !!}
</body>
</html>