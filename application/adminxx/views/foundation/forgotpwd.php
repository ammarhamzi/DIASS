<?php
if ($theme == 'basic') {
    ?>
    <!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>FixzyGen - Codeigniter Generator</title>
            <!-- cdn -->
            <script src="<?php echo base_url('../resources/shared_js/jquery/2.1.4/dist/jquery.min.js'); ?>"></script>
            

            <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/jquery-ui-themes/themes/smoothness/jquery-ui.min.css'); ?>">
            <script src="<?php echo base_url('../resources/shared_js/jquery-ui/jquery-ui.min.js'); ?>"></script>

            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>"  crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap-theme.min.css'); ?>"  crossorigin="anonymous">

            <!-- Latest compiled and minified JavaScript -->
            <script src="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>

            <script src="<?php echo base_url('../resources/shared_js/jquery.alphanum/jquery.alphanum.js'); ?>"></script>

            <script type = "text/javascript" src="<?php echo base_url('../resources/shared_js/jquery.form/jquery.form.js'); ?>"	></script>
            <script src="<?php echo base_url('../resources/shared_js/custom.js?v=0.1'); ?>"></script>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <style type="text/css">
                <!--
                html, body, .container-fluid {
                    height: 100%;
                }
                .container-fluid {
                    display: table;
                    vertical-align: middle;
                }
                .vertical-center-row {
                    display: table-cell;
                    vertical-align: middle;
                }
                -->
            </style>
        </head>
        <body>
            <div class="container-fluid">
                <div class="vertical-center-row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Login Form</h3>
                        </div>
                        <div class="panel-body">
                            <?php
if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
    }
    ?>
                            <form class="form-horizontal" action="<?php echo site_url('authentication/login'); ?>" method="post">
                                <div class="form-group">
                                    <label for="username" class="col-sm-4 control-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="username" class="form-control" name="username" id="username" placeholder="Username" value="super_admin">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-4 control-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="123">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
} elseif ($theme == 'adminlte') {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM | Log in</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/fonts.css'); ?>" />
            <style type="text/css">
                <!--
                body{
                    font-family: 'Open Sans',sans-serif  !important;
                }
                -->
            </style>
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

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="<?php echo base_url('../resources/shared_js/html5shiv/dist/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('../resources/shared_js/respond/dest/respond.min.js'); ?>"></script>
            <![endif]-->
            <!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
        </head>
        <body class="hold-transition login-page">
            <div class="login-box">
                <div class="login-logo">
                    <a href="<?php echo site_url(); ?>">FixzyRAD</a>
                </div>
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
                    <p class="login-box-msg">Enter your email & username</p>
                    <?php
if (validation_errors()) {
        ?>
                        <div class="alert alert-danger" role="alert"><?php echo validation_errors(); ?></div>
                        <?php
}
    ?>
                    <form action="<?php echo site_url('authentication/forgotpwd_action'); ?>" method="post">

                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?php echo $username; ?>" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="g-recaptcha" data-sitekey="6Le_ww0UAAAAAFj73AF5N9Fv5Dx8dOlv5Vs4j48X"></div>
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
                    <a href="<?php echo site_url(); ?>" class="text-center">Login Page</a>
                    <span>or</span>
                    <a href="<?php echo site_url('authentication/register'); ?>" class="text-center">Register a new membership</a>

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

    <?php
} elseif ($theme == 'bscore') {
    ?>
    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
    <!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

        <!-- BEGIN HEAD -->
        <head>
            <meta charset="UTF-8" />
            <title>BCORE Admin Dashboard Template | Login Page</title>
            <meta content="width=device-width, initial-scale=1.0" name="viewport" />
            <meta content="" name="description" />
            <meta content="" name="author" />
            <!--[if IE]>
               <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
               <![endif]-->
            <!-- GLOBAL STYLES -->
            <!-- PAGE LEVEL STYLES -->
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>"  crossorigin="anonymous">
            <link rel="stylesheet" href="<?php echo base_url('../resources/themes/bs-admin-bcore/template/assets/css/login.css'); ?>" />
            <link rel="stylesheet" href="<?php echo base_url('../resources/themes/bs-admin-bcore/template/assets/plugins/magic/magic.css'); ?>" />
            <!-- END PAGE LEVEL STYLES -->
            <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!--[if lt IE 9]>
              <script src="<?php echo base_url('../resources/shared_js/html5shiv/dist/html5shiv.min.js'); ?>"></script>
              <script src="<?php echo base_url('../resources/shared_js/respond/dest/respond.min.js'); ?>"></script>
            <![endif]-->
        </head>
        <!-- END HEAD -->

        <!-- BEGIN BODY -->
        <body >

            <!-- PAGE CONTENT -->
            <div class="container">
                <div class="text-center">
                    <img src="<?php echo base_url('../resources/themes/bs-admin-bcore/template/assets/img/logo.png'); ?>" id="logoimg" alt=" Logo" />
                </div>
                <div class="tab-content">
                    <div id="login" class="tab-pane active">
                        <form action="<?php echo site_url('authentication/login'); ?>" class="form-signin" method="post">
                            <p class="text-muted text-center btn-block btn btn-primary btn-rect">
                                Enter your username and password
                            </p>
                            <input type="text" name="username" id="username" placeholder="Username" value="super_admin" class="form-control" />
                            <input type="password" name="password" id="password" placeholder="Password" value="123" class="form-control" />
                            <button class="btn text-muted text-center btn-danger" type="submit">Sign in</button>
                        </form>
                    </div>
                    <div id="forgot" class="tab-pane">
                        <form action="index.html" class="form-signin">
                            <p class="text-muted text-center btn-block btn btn-primary btn-rect">Enter your valid e-mail</p>
                            <input type="email"  required="required" placeholder="Your E-mail"  class="form-control" />
                            <br />
                            <button class="btn text-muted text-center btn-success" type="submit">Recover Password</button>
                        </form>
                    </div>
                    <div id="signup" class="tab-pane">
                        <form action="index.html" class="form-signin">
                            <p class="text-muted text-center btn-block btn btn-primary btn-rect">Please Fill Details To Register</p>
                            <input type="text" placeholder="First Name" class="form-control" />
                            <input type="text" placeholder="Last Name" class="form-control" />
                            <input type="text" placeholder="Username" class="form-control" />
                            <input type="email" placeholder="Your E-mail" class="form-control" />
                            <input type="password" placeholder="password" class="form-control" />
                            <input type="password" placeholder="Re type password" class="form-control" />
                            <button class="btn text-muted text-center btn-success" type="submit">Register</button>
                        </form>
                    </div>
                </div>
                <div class="text-center">
                    <ul class="list-inline">
                        <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
                        <li><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li>
                        <li><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li>
                    </ul>
                </div>


            </div>

            <!--END PAGE CONTENT -->

            <!-- PAGE LEVEL SCRIPTS -->
            <script src="<?php echo base_url('../resources/shared_js/jquery/2.1.4/dist/jquery.min.js'); ?>"></script>
            
            <!-- Bootstrap 3.3.6 -->
            <!-- Latest compiled and minified JavaScript -->
            <script src="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>
            <script src="<?php echo base_url('../resources/themes/bs-admin-bcore/template/assets/js/login.js'); ?>"></script>
            <!--END PAGE LEVEL SCRIPTS -->

        </body>
        <!-- END BODY -->
    </html>

    <?php
}
?>

