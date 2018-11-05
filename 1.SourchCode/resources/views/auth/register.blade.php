<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Đăng ký</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
        <!-- Ionicons -->
        <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminLTE3/dist/css/adminlte.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/iCheck/square/blue.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Đăng ký thành viên</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group has-feedback">
                            <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Tên đầy đủ" name="name" value="{{ old('name') }}" autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Mật khẩu" name="password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="password-confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="password_confirmation">
                            <span class="fa fa-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-8">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-sm btn-block btn-flat">Đăng ký</button>
                            </div>
                        </div>
                    </form>

                    <a href="{{ route('login') }}" class="text-center">Tôi đã có tài khoản</a>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('adminLTE3/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ asset('adminLTE3/plugins/iCheck/icheck.min.js') }}"></script>
        <script>
            $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass   : 'iradio_square-blue',
                increaseArea : '20%'
            })
        })
        </script>
    </body>
</html>
