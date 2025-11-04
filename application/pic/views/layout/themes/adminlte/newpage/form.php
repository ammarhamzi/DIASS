<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo base_url('resources/shared_css/fonts.css'); ?>" />
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
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/dist/css/skins/_all-skins.min.css'); ?>">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/shared_css/custom.css?v=0.1'); ?>">
        <!-- cdn -->
		<script src="<?php echo base_url('resources/shared_js/jquery/3.7.0/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('resources/shared_js/jquery/3.4.1/jquery-migrate-3.4.1.min.js'); ?>"></script>
        

        <!-- include jhtmlarea css/js-->
        <link href="<?php echo base_url('resources/shared_js/jHtmlArea/src/jHtmlArea_Website/style/jHtmlArea.css'); ?>" rel="stylesheet">
        <!-- <link href="<?php echo base_url('resources/shared_js/jHtmlArea/src/jHtmlArea_Website/style/jHtmlArea.Editor.css'); ?>" rel="stylesheet"> -->
        <script src="<?php echo base_url('resources/shared_js/jHtmlArea/src/jHtmlArea_Website/scripts/jHtmlArea-0.8.min.js'); ?>"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/shared_js/DataTables/combined/datatables.min.css'); ?>"/>

        <script type="text/javascript" src="<?php echo base_url('resources/shared_js/DataTables/combined/datatables.min.js'); ?>"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="<?php echo base_url('resources/shared_js/html5shiv/dist/html5shiv.min.js'); ?>"></script>
        <script src="<?php echo base_url('resources/shared_js/respond/dest/respond.min.js'); ?>"></script>
        <![endif]-->
        <link rel="stylesheet" href="<?php echo base_url('resources/shared_css/jquery-ui-themes/themes/smoothness/jquery-ui.min.css'); ?>">
        <script src="<?php echo base_url('resources/shared_js/jquery-ui/jquery-ui.min.js'); ?>"></script>

        <link href="<?php echo base_url('resources/shared_js/select2/dist/css/select2.min.css'); ?>" rel="stylesheet" />
        <script src="<?php echo base_url('resources/shared_js/select2/dist/js/select2.min.js'); ?>"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/shared_js/jquery-ui-timepicker-addon/1.4.5/dist/jquery-ui-timepicker-addon.min.css'); ?>">
        <script src="<?php echo base_url('resources/shared_js/jquery-ui-timepicker-addon/1.4.5/dist/jquery-ui-timepicker-addon.min.js'); ?>"></script>
        <script src="<?php echo base_url('resources/shared_js/jquery-ui-timepicker-addon/1.4.5/dist/jquery-ui-sliderAccess.js'); ?>"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/shared_js/jquery-timepicker/1.8.8/jquery.timepicker.css'); ?>">
        <script src="<?php echo base_url('resources/shared_js/jquery-timepicker/1.8.8/jquery.timepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/shared_js/Minimal-Dropdown-Year/lib/year-select.js'); ?>"></script>

        <script src="<?php echo base_url('resources/shared_js/jquery.alphanum/jquery.alphanum.js'); ?>"></script>

        <script type = "text/javascript" src="<?php echo base_url('resources/shared_js/jquery.form/jquery.form.js'); ?>"	></script>



        <style>

            .btn-file {
                position: relative;
                overflow: hidden;
            }
            .btn-file input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                font-size: 100px;
                text-align: right;
                filter: alpha(opacity=0);
                opacity: 0;
                outline: none;
                background: white;
                cursor: inherit;
                display: block;
            }

            .uploadrestrict {
                margin-bottom:15px;
            }

            .col-md-1 {
                white-space: nowrap;
            }

            #preview{
                position:absolute;
                border:1px solid #ccc;
                background:#333;
                padding:5px;
                display:none;
                color:#fff;
            }

        </style>

        <script src="<?php echo base_url('resources/shared_js/custom.js?v=0.1') ?>"></script>
        <script>
            $(document).ready(function () {
                $('.dropdown-toggle').dropdown();
                $('#loading').delay(300).fadeOut('slow');
                
                if($('.datepicker_local').length)
                {
                    $('.datepicker_local').datepicker(
                      {
                      dateFormat: "dd-mm-yy",
                        /*   showOn: "button",*/
                      changeMonth: true,
                      changeYear: true,
                        //yearRange: "-100:+3",
                      yearRange: "2018:+11",
                        /*   buttonImage: "js/jqueryUI/img/calendar.gif",
                buttonImageOnly: true*/
                      }
                    ).keyup(function(e) {
                        if(e.keyCode == 8 || e.keyCode == 46) {
                          $.datepicker._clearDate(this);
                        }
                      }
                    );
                }
                
                if($('.datepicker_dob').length)
                {
                    $('.datepicker_dob').datepicker(
                    {
                        dateFormat: "dd-mm-yy",
                          /*   showOn: "button",*/
                        changeMonth: true,
                        changeYear: true,
                          //yearRange: "-100:+3",
                        yearRange: "1950:2099",
                          /*   buttonImage: "js/jqueryUI/img/calendar.gif",
                  buttonImageOnly: true*/
                    }
                  ).keyup(function(e) {
                      if(e.keyCode == 8 || e.keyCode == 46) {
                        $.datepicker._clearDate(this);
                      }
                    }
                  );
                }
                
                if($('.datepicker_local_insurancedate').length)
                {
                    var dateToday = new Date();
                            $('.datepicker_local_insurancedate').datepicker(
                              {
                              dateFormat: "dd-mm-yy",
                                /*   showOn: "button",*/
                              changeMonth: true,
                              changeYear: true,
                                //yearRange: "-100:+3",
                                minDate: dateToday,
                              yearRange: "2018:+3",
                                /*   buttonImage: "js/jqueryUI/img/calendar.gif",
                        buttonImageOnly: true*/
                              }
                            ).keyup(function(e) {
                                if(e.keyCode == 8 || e.keyCode == 46) {
                                  $.datepicker._clearDate(this);
                                }
                              }
                            );
                }
                if($('.yearpicker').length)
                {
                $('.yearpicker').yearselect({
                    start: 1979,
                    end: new Date().getFullYear(),
                    order: 'desc'
                });
                } 
                if($('.datetimepicker').length)
                {
                        $('.datetimepicker').datetimepicker(
                          {
                          ampm: true,
                          dateFormat: "yy-mm-dd",
                          timeFormat: 'HH:mm:ss',
                          }
                        );
                }
            });
        </script>
    </head>
    <?php
    if($this->session->userdata('menutype')=="top-nav"){
    ?>
    <body class="hold-transition skin-blue layout-top-nav">
    <?php
    }else{
   ?>
    <body class="hold-transition skin-blue sidebar-mini">
   <?php
    }
    ?>
        <div id="loading">
            <img id="loading-image" src="<?php echo base_url('resources/shared_img/preloader.GIF'); ?>" alt="Loading..." />
        </div>
        <!-- Site wrapper -->
        <div class="wrapper">
            <?php echo (isset($menu) ? $menu : ''); ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- <?php echo (isset($genlist) ? $genlist : ''); ?> -->
                <?php echo (isset($content) ? $content : ''); ?>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <?php echo $this->session->userdata('version_info'); ?>
                </div>
                <?php echo $this->session->userdata('copyright_notice'); ?>
            </footer>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <script src="<?php echo base_url('resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url('resources/themes/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url('resources/themes/AdminLTE/plugins/fastclick/fastclick.js'); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('resources/themes/AdminLTE/dist/js/app.min.js'); ?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url('resources/themes/AdminLTE/dist/js/demo.js'); ?>"></script>
        <script src="<?php echo base_url(); ?>resources/shared_js/thumb2full.js"></script>
    </body>
</html>