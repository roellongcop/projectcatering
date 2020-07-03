<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Recto's Catering | Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?= base_url(). 'resources/bower_components/bootstrap/dist/css/bootstrap.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url(). 'resources/bower_components/font-awesome/css/font-awesome.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url(). 'resources/bower_components/Ionicons/css/ionicons.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url(). 'resources/dist/css/AdminLTE.min.css'; ?>">
        <link rel="stylesheet" href="<?= base_url(). 'resources/plugins/iCheck/square/blue.css'; ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a><b>RECTO's </b> Catering</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Username" id="username">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" id="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="hide" id="alert-invalid" style="color: red;">Invalid Username/Password.</div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-primary btn-block btn-flat" id="btnLogin">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>     
                <!-- /.social-auth-links -->
                <a href="#">I forgot my password</a><br>
            </div>
            <!-- /.login-box-body -->
        </div>
        <script src="<?= base_url(). 'resources/bower_components/jquery/dist/jquery.min.js'; ?>"></script>
        <script src="<?= base_url(). 'resources/bower_components/bootstrap/dist/js/bootstrap.min.js'; ?>"></script>
        <script src="<?= base_url(). 'resources/plugins/iCheck/icheck.min.js'; ?>"></script>
        <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
        </script>
        <script type="text/javascript">
            var base_url = "<?= base_url(); ?>";
        </script>
        <script>
        $(function () {
            $("#btnLogin").on('click', function() {
                var userName = $("#username").val(),
                    password = $("#password").val();

                $.ajax ({
                    url: base_url + 'dashboard/checklogin',
                    dataType: 'json',
                    method: 'POST',
                    data: {
                        username: userName,
                        password: password
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            location.href = base_url + 'dashboard';
                        } else {
                            $("#alert-invalid").removeClass('hide');
                        }
                    },
                    error: function (response) {
                        alert('An error occured while processing your request. Please Try again');
                    }
                });

            });
        });
        </script>
    </body>
</html>