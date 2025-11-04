
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />

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

        <style type="text/css">        
            body{
                padding-top: 70px;
            }

            .bg {
                /* The image used */
                background-image: url(<?php echo base_url('resources/shared_img/background_pic.jpg'); ?>);

                /* Full height */
                height: 100%;

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="<?php echo base_url('../resources/shared_js/html5shiv/dist/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('../resources/shared_js/respond/dest/respond.min.js'); ?>"></script>
            <![endif]-->

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url('resources/shared_js/jquery/2.2.4/dist/jquery.min.js'); ?>"></script>

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
            /* $(document).ready(function () {
                $("#goto").click(function () {
                    $(location).attr('href', '<?php echo site_url('authentication'); ?>');
                });
            }); */
        </script>
    </head>
    <body class="hold-transition login-page bg">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="login-box-body">
                <div class="login-logo">
                    <img src="<?php echo base_url('resources/shared_img/logo.jpg'); ?>" width="300" alt="">
                </div>
                <h4 class="text-center">Proficiency Test for Airside Driving Permit</h4>                                          
                <form autocomplete="off" action="<?php echo site_url('Examdriver/do_exam'); ?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="booking_id" id="booking_id" placeholder="Booking ID" value="">
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="ic_no" id="ic_no" placeholder="IC No" value="">
                    </div>
                                    
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Go</button>
                        </div>
                        <div class="col-xs-8 bottom-align-text">
                            <?php print_r($message); ?>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
            <!-- /.login-box -->
    </body>
</html>