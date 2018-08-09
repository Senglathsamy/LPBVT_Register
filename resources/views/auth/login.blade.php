<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/fw_fontend/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/fw_fontend/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/fw_fontend/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/fw_fontend/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/fw_fontend/plugins/iCheck/square/blue.css">

    {{--Custom CSS Font Phetsarath--}}
    <link rel="stylesheet" href="/css/custom.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">

    <div class="login-logo" style="font-family: 'Phetsarath_OT';">
        <B>ວິທະຍາໄລ ເຕັກນິກ<br>ວິຊາຊີບຫຼວງພະບາງ</B>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">

        <p class="login-box-msg">
            <span class="badge bg-blue-active"
                  style="padding-top: 5px; padding-bottom: 5px; padding-left: 15px; padding-right: 15px; font-size: 13px;">Sign in to start your session</span>
        </p>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-4 control-label">ຊື່ເຂົ້າໃຊ້ </label>

                <div class="col-md-6">
                    <input id="username" type="username" class="form-control" name="username"
                           value="{{ old('username') }}" placeholder="Username" required autofocus>

                    @if ($errors->has('username'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">ລະຫັດຜ່ານ</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                           required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label style="font-weight: bold">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
                            Remember
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn bg-blue" style="font-weight: bold">
                        <span class="glyphicon glyphicon-log-in"></span> &nbsp;ເຂົ້າສູ່ລະບົບ
                    </button>
                </div>
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="/fw_fontend/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/fw_fontend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/fw_fontend/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
