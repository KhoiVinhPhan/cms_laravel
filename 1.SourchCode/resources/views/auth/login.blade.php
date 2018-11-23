<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Đăng nhập</title>
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
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Đăng nhập</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group has-feedback">
                            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password">
                            <!-- <span class="fa fa-lock form-control-feedback"></span> -->
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Nhớ mật khẩu
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-sm btn-block btn-flat">Đăng nhập</button>
                            </div>
                        </div>
                    </form>

                    <div class="social-auth-links text-center mb-3">
                        <p>- OR -</p>
                        <a href="redirect/facebook" class="btn btn-block btn-primary">
                            <i class="fa fa-facebook mr-2"></i> Đăng nhập với facebook
                        </a>
                        <a href="redirect/google" class="btn btn-block btn-danger">
                            <i class="fa fa-google-plus mr-2"></i> Đăng nhập với google+
                        </a>
                    </div>

                    <p class="mb-1">
                        <a href="/">Trang chủ</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center">Đăng ký thành viên mới</a>
                    </p>
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
