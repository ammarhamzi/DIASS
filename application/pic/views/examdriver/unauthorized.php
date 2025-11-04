<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Bootstrap 3.3.6 -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>"  crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('resources/shared_css/font-awesome/css/font-awesome.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/dist/css/AdminLTE.min.css'); ?>">

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

            #overlay {
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,0.7);
                z-index: 2;
                cursor: pointer;
            }

            #text{
                position: absolute;
                top: 50%;
                left: 50%;
                font-size: 50px;
                color: red;
                text-shadow: -0.5px 0 white, 0 1px white, 0.5px 0 white, 0 -0.5px white;
                transform: translate(-50%,-50%);
                -ms-transform: translate(-50%,-50%);
            }
        </style>
    </head>
    <body class="hold-transition login-page bg">
        <div id="overlay">
            <div id="text"><strong>UNAUTHORIZED IP ADDRESS</strong></div>
        </div>
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
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
            <!-- /.login-box -->
    </body>
</html>