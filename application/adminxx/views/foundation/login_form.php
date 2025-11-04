        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title> Administration DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM | Log in</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/fonts.css'); ?>" />
            <!-- Bootstrap 3.3.6 -->
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>"  crossorigin="anonymous">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/font-awesome/css/font-awesome.min.css'); ?>">
            <!-- Ionicons -->
            <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/ionicons/css/ionicons.min.css'); ?>">
            <!-- Theme style -->
            <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/dist/css/AdminLTE.min.css'); ?>">
            <!-- iCheck -->
            <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/plugins/iCheck/square/blue.css'); ?>">
            <!--<script src='https://www.google.com/recaptcha/api.js'></script>-->

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="<?php echo base_url('../resources/shared_js/html5shiv/dist/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('../resources/shared_js/respond/dest/respond.min.js'); ?>"></script>
            <![endif]-->
<style>
body, html {
    height: 100%;
    margin: 0;
}

.bg {
    /* The image used */
    background-image: url("<?php echo base_url('../resources/shared_img/background_admin.jpg'); ?>");

    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
        </head>

        <body class="hold-transition login-page bg">
            <div class="login-box">

                <!-- /.login-logo -->
                <div class="login-box-body">
                <div class="login-logo">
                    <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('../resources/shared_img/logo.jpg'); ?>" width="300" alt=""></a>
                </div>
                    <p class="login-box-msg"><b>
                        Administration<br />
                        Please login using Staff Email and Password.
                    </b></p>
                    <?php
if (validation_errors()) {
        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo validation_errors(); ?>
                        </div>
                        <?php
}
    ?>
                    <?php //echo $this->session->set_flashdata('message','[Error Login 001] Wrong Username/Password combination. Please try again.'); ?>
                            <?php
if ($this->session->flashdata('message')) {
        ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $this->session->flashdata('message'); ?>
                                    
                                </div>
                                <?php
}
    ?>

                                    <form action="<?php echo site_url('authentication/login'); ?>" method="post" autocomplete="off">
                                        <div class="form-group has-feedback">
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="">
                                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <input type="password" type="password" class="form-control" name="password" id="password" placeholder="Password" value="">
                                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        </div>

                                        <div class="row">
                                            <!-- /.col -->
                                            <div class="col-xs-4">
                                                <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </form>
                                    <!-- /.social-auth-links -->

<!--                                    <a href="<?php echo site_url('authentication/forgotpwd'); ?>">I forgot my password</a><br> -->
                                    <!--                    <a href="<?php echo site_url('authentication/register'); ?>" class="text-center">Register a new membership</a>-->

                </div>
                <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->

            <!-- jQuery 2.2.3 -->
            <script src="<?php echo base_url('../resources/shared_js/jquery/2.1.4/dist/jquery.min.js'); ?>"></script>
            
            <!-- Bootstrap 3.3.6 -->
            <!-- Latest compiled and minified JavaScript -->
            <script src="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>
            <!-- iCheck -->
            <script src="<?php echo base_url('../resources/themes/AdminLTE/plugins/iCheck/icheck.min.js'); ?>"></script>
            <script>
                $(function() {
                    $('input').iCheck({
                        checkboxClass: 'icheckbox_square-blue',
                        radioClass: 'iradio_square-blue',
                        increaseArea: '20%' // optional
                    });
                });
            </script>
        </body>

        </html>