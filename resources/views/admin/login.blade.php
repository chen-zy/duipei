<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Mion Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/iCheck/square/blue.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Mion</b>Admin</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="{{ route('admin.login') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback{{ $errors->has('mobile') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Mobile" name="mobile" value="{{ old('mobile') }}">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                @if ($errors->has('mobile'))
                    <span class="help-block">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"{{ old('remember') ? ' checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
    </div>
    <script src="/vendor/adminlte/plugins/jquery/dist/jquery.min.js"></script>
    <script src="/vendor/adminlte/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/vendor/adminlte/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
</body>
</html>