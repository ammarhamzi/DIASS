<!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM | Log in</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <link rel="stylesheet" href="<?php echo base_url('resources/shared_css/fonts.css'); ?>" />
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
    background-image: url("<?php echo base_url('resources/shared_img/background_pic.jpg'); ?>");

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

        <div class="row" style="
    margin-top: 25px;
">
            <div class="col-md-3 pull-right">
                <!--<a href="/Examdriver/" class="btn btn-default">EXAM</a>-->
                <!--<a href="/" class="btn btn-default">INSPECTION</a>-->
            </div>
        </div>
            <div class="login-box">

                <!-- /.login-logo -->
                <div class="login-box-body">
                <div class="login-logo">
                    <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('resources/shared_img/logo.jpg'); ?>" width="300" alt=""></a>
                </div>
<!--                    <p class="login-box-msg">Log in to start your session</p> -->
                    <?php
if (validation_errors()) {
        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo validation_errors(); ?>
                        </div>
                        <?php
}
    ?>
                            <?php
if ($this->session->flashdata('message')) {
        ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div>
                                <?php
}
    ?>

                                    <form autocomplete="off" action="<?php echo site_url('authentication/login'); ?>" method="post">
                                        <div class="form-group has-feedback">
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="">
                                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <input type="password" type="password" class="form-control" name="password" id="password" placeholder="Password" value="">
                                            <input type="hidden" name="role" id="role" placeholder="role" value="2">
                                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        </div>
                                        <!--                        <div class="form-group has-feedback">
                            <select class="form-control" name="role" id="role" required>
                                <option value="" disabled selected>Role Group</option>
                                <?php
foreach ($rolelist as $value) {
        ?>
                                    <option value="<?php echo $value->usergroup_id; ?>" <?php
echo set_select('role',
            $value->usergroup_id,
            ($value->usergroup_id == 1 ? true : false));
        ?>><?php echo $value->usergroup_name; ?></option>
                                            <?php
}
    ?>
                            </select>

                        </div>-->
<!--                                        <div class="form-group has-feedback">
                                            <div class="g-recaptcha" data-sitekey="6LcZU4UUAAAAAKvv8THwdLnT7wSqDRD36LQMUWy7"></div>

                                        </div>-->
                                        <div class="row">
                                            <!--        <div class="col-xs-8">
                                      <div class="checkbox icheck">
                                        <label>
                                          <input type="checkbox"> Remember Me
                                        </label>
                                      </div>
                                    </div>-->
                                            <!-- /.col -->
                                            <div class="col-xs-4">
                                                <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
                                            </div>
                                            <div class="col-xs-8">
												<a href="">Forgot Password</a>
                                                <!-- <a href="<?php echo site_url('authentication/forgotpwd'); ?>">Forgot Password</a> -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </form>

                                    <!--                    <div class="social-auth-links text-center">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                            Facebook</a>
                        <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                            Google+</a>
                    </div>-->
                                    <!-- /.social-auth-links -->

<!--                                    <a href="<?php echo site_url('authentication/forgotpwd'); ?>">I forgot my password</a><br> -->
                                    <!--                    <a href="<?php echo site_url('authentication/register'); ?>" class="text-center">Register a new membership</a>-->
<!-- <hr style="width: 100%; height: 1px; background-color: #DDDDDD">
<p>ADMINISTRATION LOGIN</p>
<a href="/admin/" class="btn btn-default">Administrator</a> -->
<!--<a href="http://diass.admin.karyastaging.com/" class="btn btn-default">Payment</a>
<a href="http://diass.admin.karyastaging.com/" class="btn btn-default">Permit</a>-->
                </div>
                <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->

            <!-- jQuery 2.2.3 -->
            <!-- ori 2.1.4 -->
            <script src="<?php echo base_url('resources/shared_js/jquery/3.7.0/dist/jquery.min.js'); ?>"></script>

            <!-- Bootstrap 3.3.6 to 4.6.2 -->
            <!-- Latest compiled and minified JavaScript -->
            <script src="<?php echo base_url('resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>
            <!-- iCheck -->
            <script src="<?php echo base_url('resources/themes/AdminLTE/plugins/iCheck/icheck.min.js'); ?>"></script>
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