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
    </head>
    <body class="hold-transition login-page">

        <div class="container">
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                    <div class="login-logo">
                        <a href="<?php echo site_url(); ?>">DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM</a>
                    </div>
                    <section class="col-lg-12 col-md-12 col-sm-12"  style=" background-color: white;    padding: 25px 25px 50px 25px; border-radius: 10px;">
                        <p>Thank you for your registration.<br /><br /></p>
                        <p>Please check your email and confirm it. Please check in your spam email too if  not receive it more than 5 minutes. <br /><br />You will redirected to login page after confirm your email.<br /><br /><input type="submit" id="goto" value="Go to login page" style="float:right" class="btn btn-primary btn-block btn-flat"/></p>

                    </section>
                </div>
                <div class="col-md-3">&nbsp;</div>
            </div>
            <div class="row">

            </div>
        </div>

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
        </script>
        <script>
            $(document).ready(function () {
                $("#goto").click(function () {
                    $(location).attr('href', '<?php echo site_url('authentication/index/ver'); ?>');
                });
            });
        </script>
    </body>
</html>
