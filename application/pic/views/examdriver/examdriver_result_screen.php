<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> DIASS :: DIGITAL INTEGRATED AIRSIDE SERVICE SYSTEM</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
        <style type="text/css">
			body {
                padding-top: 15px;
            }
            
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

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url('resources/shared_js/jquery/2.1.4/dist/jquery.min.js'); ?>"></script>

        <!-- Bootstrap 3.3.6 -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo base_url('resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('resources/themes/AdminLTE/plugins/iCheck/icheck.min.js'); ?>"></script>
        <!-- js.cookie.js 2.2.0 -->
        <script src="<?php echo base_url('resources/shared_js/js.cookie.js'); ?>"></script>
        <script>
            var booking_id = "<?php Print($booking_id); ?>";
            var examtaker_id = "<?php Print($examtaker_id); ?>";
            
            $(document).ready(function () {
                $("#btnExit").click(function () {
                    $(location).attr('href', '<?php echo site_url('Examdriver/'); ?>');
                });

                $("#btnRetake").click(function () {
                    $('#formRetakeExam').submit();
                });
            }); 
        </script>
    </head>
    <body>        
        <div class="container">                
            <div class="row">  
                <div class="col-sm-3 col-xs-12"><img src="<?php echo base_url('resources/shared_img/logo.jpg'); ?>" width="200" alt=""></div>
                <div class="col-sm-6 col-xs-12">
                    <h2 class="text-center"><?php echo $this->lang->line('examdriver_title'); ?></h1>
                </div>
                <div class="col-sm-3 hidden-xs hidden-sm"></div>
            </div>
            <?php echo $driver; ?>
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left"><?php echo sprintf($this->lang->line('examdriver_result')); ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center"><b><?php echo $examsession_totalmark . '/' . $examsession_question_count ?></b></h1>                
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-6">
                    <h4 class="text-center">
                        <?php 
                            if($examsession_pass == 'y') {
                                echo $this->lang->line('examdriver_result_pass');
                            }
                            else if($examsession_pass == 'n') {
                                echo $this->lang->line('examdriver_result_fail');
                            }
                        ?>
                    </h4>
                    <br>
                </div>
                <div class="col-xs-3"></div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1 class="text-center">
                        <?php 
                            if($examsession_pass == 'y' || $examsession_count == 2) {
                                echo '<button id="btnExit" type="button" class="btn btn-primary" style="width:75px">'. $this->lang->line('examdriver_btn_exit') .'</button>';
                            }
                            else if($examsession_pass == 'n') {
                                echo '<button id="btnRetake" type="button" class="btn btn-primary" style="width:105px">'. $this->lang->line('examdriver_btn_retake') .'</button>';
                            }
                        ?>                        
                    </h1>                
                </div>
            </div>

            <div class="">
                <form autocomplete="off" id='formRetakeExam' method="post" action="<?php echo site_url('Examdriver/do_exam'); ?>">
                    <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                    <input type="hidden" name="ic_no" value="<?php echo $ic_no; ?>">
                    <input type="hidden" id="retake_exam" name="retake_exam" value="true">
                </form>
            </div>
        </div>       
    </body>
</html>





