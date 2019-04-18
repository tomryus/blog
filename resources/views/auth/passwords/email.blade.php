<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{asset("fonts-icons/font-awesome.min.css")}}>
    <!-- Ionicons -->
    <link rel="stylesheet" href={{asset("fonts-icons/ionicons.min.css")}}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{asset("dist/css/AdminLTE.min.css")}}>
    <!-- iCheck -->
    <link rel="stylesheet" href={{asset("plugins/iCheck/square/blue.css")}}>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Laravel Blog </b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Enter email to reset your password</p>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
        
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required><span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-2">                        
                </div>
                <div class="col-xs-8">
                    <button type="submit" class="btn btn-primary">
                    Send Password Reset Link
                    </button>
                </div>
                <div class="col-xs-2">
                </div>
                    
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->
        </div>
  <!-- /.login-box-body -->
</div>

<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src={{asset("plugins/jQuery/jquery-2.2.3.min.js")}}></script>
<!-- Bootstrap 3.3.6 -->
<script src={{asset("bootstrap/js/bootstrap.min.js")}}></script>
<!-- iCheck -->
<script src={{asset("plugins/iCheck/icheck.min.js")}}></script>
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









