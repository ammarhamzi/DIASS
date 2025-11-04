<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM | Change Password</title>
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
        </head>
        <body class="hold-transition login-page">
            <div class="login-box">
<!--                <div class="login-logo">
                    <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('resources/shared_img/logo.jpg'); ?>" width="300" alt=""></a>
                </div>-->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="message" style=" position: fixed;right: 50%;">
                            <?php
echo $this->session->userdata('message') != '' ? '<span class="alert alert-danger" role="alert">' . $this->session->userdata('message') . '</span>'
    : '';
    ?>
                        </div>
                    </div>
                </div>
                <!-- /.login-logo -->
                <div class="login-box-body">
                    <div style="text-align:center"><a href="<?php echo site_url(); ?>" class="text-center"><img src="<?php echo base_url('resources/shared_img/logo.jpg'); ?>" width="300" alt=""></a></div><br><br>
                    <p class="login-box-msg">Enter your new password</p>

                    <form autocomplete="off" action="<?php echo site_url('authentication/changepwd_action'); ?>" method="post">
                        <input type="hidden" name="secret" value="<?php echo $secret; ?>"/>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="newpassword" id="newpassword" placeholder="Password"><?php echo form_error('newpassword'); ?>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="rpassword" id="rpassword" placeholder="Repeat Password"><?php echo form_error('rpassword'); ?>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
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
            </script><script>
                $(document).ready(function () {
                    setTimeout(function () {
                        $('.alert').fadeOut(400);
                    }, 4000);
                });
            </script>
        </body>
    </html>


