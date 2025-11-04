<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM | Log in</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
            <style type="text/css">
                <!--
                body{
                    font-family: 'Open Sans',sans-serif  !important;
                }
                -->
            </style>
            <!-- Bootstrap 3.3.6 -->
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>"  crossorigin="anonymous">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="<?php echo base_url('resources/shared_css/font-awesome/css/font-awesome.min.css'); ?>">
            <!-- Ionicons -->
            <link rel="stylesheet" href="<?php echo base_url('resources/shared_css/ionicons/css/ionicons.min.css'); ?>">
            <!-- Theme style -->
            <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/dist/css/AdminLTE.min.css'); ?>">
            <!-- iCheck -->
            <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/plugins/iCheck/square/blue.css'); ?>">

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="<?php echo base_url('../resources/shared_js/html5shiv/dist/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('../resources/shared_js/respond/dest/respond.min.js'); ?>"></script>
            <![endif]-->
            <script src='https://www.google.com/recaptcha/api.js'></script>
        </head>
        <body class="hold-transition login-page">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="message">
                            <?php
echo $this->session->userdata('message') != '' ? '<span class="alert alert-danger" role="alert">' . $this->session->userdata('message') . '</span>'
    : '';
    ?>
                        </div>
                    </div>
                </div>
            <div class="login-box">
<!--                <div class="login-logo">
                    <a href="<?php echo site_url(); ?>">FixzyRAD</a>
                </div>-->

                <!-- /.login-logo -->
                <div class="login-box-body">
                <div class="login-logo">
                    <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('resources/shared_img/logo.jpg'); ?>" width="300" alt=""></a>
                </div>
                    <p class="login-box-msg">Enter your email</p>
                    <?php
if (validation_errors()) {
        ?>
                        <div class="alert alert-danger" role="alert"><?php echo validation_errors(); ?></div>
                        <?php
}
    ?>
                    <form autocomplete="off" action="<?php echo site_url('authentication/forgotpwd_action'); ?>" method="post">

                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" name="captcha" class="form-control" value="" placeholder="key-in number from captcha image below" required /><br>
                            <?php echo $captchaImg;?>
<!-- <?php echo $this->session->userdata('valuecaptchaCode');?> -->
<!--                            <div class="g-recaptcha" data-sitekey="6LcZU4UUAAAAAKvv8THwdLnT7wSqDRD36LQMUWy7"></div>-->
                            <!--<span class="glyphicon glyphicon-lock form-control-feedback"></span>-->
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Request</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <!--    <div class="social-auth-links text-center">
                          <p>- OR -</p>
                          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                            Facebook</a>
                          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                            Google+</a>
                        </div>-->
                    <!-- /.social-auth-links -->
                    <p><hr style="width: 100%; height: 1px"></p>
                    <a href="<?php echo site_url(); ?>" class="btn btn-default">Login Page</a>
<!--                    <span>or</span>
                    <a href="<?php echo site_url('authentication/register'); ?>" class="text-center">Register a new membership</a>-->

                </div>
                <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->

            <!-- jQuery 2.2.3 -->
            <script src="<?php echo base_url('resources/shared_js/jquery/2.1.4/dist/jquery.min.js'); ?>"></script>

            <!-- Bootstrap 3.3.6 -->
            <!-- Latest compiled and minified JavaScript -->
            <script src="<?php echo base_url('resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>
            <!-- iCheck -->
            <script src="<?php echo base_url('resources/themes/AdminLTE/plugins/iCheck/icheck.min.js'); ?>"></script>
            <script>
                $(function () {
                    $('input').iCheck({
                        checkboxClass: 'icheckbox_square-blue',
                        radioClass: 'iradio_square-blue',
                        increaseArea: '20%' // optional
                    });
                });
            </script><!-- <script>
                $(document).ready(function () {
                    setTimeout(function () {
                        $('.alert').fadeOut(400);
                    }, 4000);
                });
            </script> -->
        </body>
    </html>