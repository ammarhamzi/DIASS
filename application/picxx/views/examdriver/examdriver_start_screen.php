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
            body{
                padding-top: 15px;
            }

            .navlang {
                padding-right: 20px;
            }

            div.vcenter {
                display: inline-block;
                vertical-align: middle;
                float: none;
                padding-top: 12px;
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
        <script src="<?php echo base_url('resources/shared_js/jquery/2.2.4/dist/jquery.min.js'); ?>"></script>

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
                $("#btnStart").click(function () {
                    // var cookiename = 'examsession:' + examtaker_id;
                    // if (!!Cookies.get(cookiename)) {
                    //     // alert('have cookie');
                    //     alert('Please refresh the page');
                    // } 
                    // else {
                    //     var inOneHour = new Date(new Date().getTime() + 60 * 60 * 1000);
                    //     var start_time = new Date(new Date().getTime());
                    //     var cookievalues = {
                    //         language:"eng", 
                    //         booking_id: booking_id,
                    //         status: 'created',
                    //         answers: {},
                    //         current_question: 0,
                    //         start_time: null,
                    //         end_time: null,
                    //         expired_time: null,
                    //         expired_time: null
                    //     };
                        
                    //     Cookies.set(cookiename, cookievalues, {
                    //         expires: inOneHour
                    //     });
                        
                        // $(location).attr('href', '<?php echo site_url('Examdriver/do_exam'); ?>');
                        $("#formStart").submit();
                    // }
                });

                $("#lang_eng").click(function () {
                    data = $(this).data();
                    $('#language').val(data.language);
                    $('#formRefresh').submit();
                });

                $("#lang_my").click(function () {
                    data = $(this).data();
                    $('#language').val(data.language);
                    $('#formRefresh').submit();
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
                <div class="col-sm-3 col-xs-12 vcenter">
                    <div class="pull-right" style="width:130px;">
                        <div><span style="font-size: 40px; float: left;" class="glyphicon glyphicon-time"></span></div>
                        <div class="text-right">
                            <strong><?php echo sprintf($this->lang->line('examdriver_minutes'), $timelimit); ?></strong>
                        </div>
                        <div class="text-right">
                            <?php echo date('d M Y') ?>
                        </div>
                    </div>
                </div>
            </div>   
            <?php echo $driver; ?>                  
            <div class="jumbotron">
                <div class="hidden">
                    <form autocomplete="off" id='formStart' method="post" action="<?php echo site_url('Examdriver/do_exam'); ?>">
                        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                        <input type="hidden" name="ic_no" value="<?php echo $ic_no; ?>">
                        <input type="hidden" name="starting" value="true">
                    </form>
                    <form autocomplete="off" id='formRefresh' method="post" action="<?php echo site_url('Examdriver/do_exam'); ?>">
                        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                        <input type="hidden" name="ic_no" value="<?php echo $ic_no; ?>">
                        <input type="hidden" id="language" name="language" value="">
                    </form>
                </div>
                <div class="btn-group dropdown pull-right">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
                        <span class="lang-sm lang-lbl-full" lang="en">
                            <?php 
                                if(strtolower($driver_category) == 'a') {
                                    echo 'Bahasa Melayu';
                                }
                                else {
                                    if($this->session->userdata('exam_language') == 'english') {
                                        echo 'English';
                                    }
                                    else {
                                        echo 'Bahasa Melayu';
                                    }
                                }                                
                            ?>
                        </span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            if(strtolower($driver_category) != 'a') {
                                echo '<li><a id="lang_eng" data-language="english" href="#">English</a></li>';
                            } 
                        ?>                        
                        <li><a id="lang_my" data-language="malay" href="#">Bahasa Melayu</a></li>
                    </ul>
                </div>                
                <div class="row">
                    <div class="col-xs-12">
                        <p class="text-center"><b><?php echo $this->lang->line('examdriver_instruction_title'); ?></b></p>                
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3"></div>
                    <div class="col-xs-6">
                        <h4>
                            1. <?php echo $this->lang->line('examdriver_instruction0'); ?><br><br> 
                            2. <?php echo sprintf($this->lang->line('examdriver_instruction1'), $question_count); ?><br><br>
                            3. <?php echo $this->lang->line('examdriver_instruction2'); ?><br><br>
                            4. <?php echo $this->lang->line('examdriver_instruction3'); ?><br><br>
                            5. <?php echo sprintf($this->lang->line('examdriver_instruction4'), $schema); ?><br><br>
                        </h4>
                        <br>
                    </div>
                    <div class="col-xs-3"></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p>
                            <a id="btnStart" target="_blank" class="btn btn-primary"><?php echo $this->lang->line('examdriver_btn_start'); ?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>        
    </body>
</html>





