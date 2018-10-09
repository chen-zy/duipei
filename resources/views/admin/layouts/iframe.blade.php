<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IFRAME</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/summernote/dist/summernote.css">
    @yield('css')
    <link rel="stylesheet" href="/vendor/adminlte/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/css/admin.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="MA_iframe">
@yield('content')
<script src="/vendor/adminlte/plugins/jquery/dist/jquery.min.js"></script>
<script src="/vendor/adminlte/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/vendor/adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/vendor/adminlte/plugins/fastclick/lib/fastclick.js"></script>
<script src="/vendor/adminlte/plugins/summernote/dist/summernote.min.js"></script>
@yield('js')
<script src="/vendor/adminlte/js/adminlte.min.js"></script>
<script src="/js/admin.js"></script>
@yield('script')
{!! \Krucas\Notification\Facades\Notification::showAll() !!}
</body>
</html>