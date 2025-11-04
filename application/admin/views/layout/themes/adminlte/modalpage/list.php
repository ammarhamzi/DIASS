<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/fonts.css'); ?>" />
        <style type="text/css">
            <!--
            body{
                font-family: 'Open Sans',sans-serif  !important;
            }

            #preview{
                position:absolute;
                border:1px solid #ccc;
                background:#333;
                padding:5px;
                display:none;
                color:#fff;
            }
            -->
        </style>
        <!-- cdn -->
        <!-- 12062023 change ver 2.1.4 to 3.7.0 -->
        <script src="<?php echo base_url('../resources/shared_js/jquery/3.7.0/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('../resources/shared_js/jquery/3.4.1/jquery-migrate-3.4.1.min.js'); ?>"></script>
        

        <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/jquery-ui-themes/themes/smoothness/jquery-ui.min.css'); ?>">
        <script src="<?php echo base_url('../resources/shared_js/jquery-ui/jquery-ui.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>"  crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/font-awesome/css/font-awesome.min.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/ionicons/css/ionicons.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/dist/css/AdminLTE.min.css'); ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/dist/css/skins/_all-skins.min.css'); ?>">

<!-- Datatables requirement -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_js/DataTables/1.10.13/media/css/jquery.dataTables.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('../resources/shared_js/DataTables/1.10.13/media/js/jquery.dataTables.min.js'); ?>"></script>

 <link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_js/DataTables/Buttons-1.2.4/css/buttons.dataTables.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('../resources/shared_js/DataTables/Buttons-1.2.4/js/dataTables.buttons.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('../resources/shared_js/DataTables/Buttons-1.2.4/js/buttons.colVis.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('../resources/shared_js/DataTables/Buttons-1.2.4/js/buttons.flash.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('../resources/shared_js/DataTables/Buttons-1.2.4/js/buttons.html5.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('../resources/shared_js/DataTables/Buttons-1.2.4/js/buttons.print.min.js'); ?>"></script>

 <link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_js/DataTables/Responsive-2.1.1/css/responsive.dataTables.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('../resources/shared_js/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('../resources/shared_js/jszip/3.1.3/dist/jszip.js'); ?>"></script>
<script src="<?php echo base_url('../resources/shared_js/pdfmake/0.1.26/build/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('../resources/shared_js/pdfmake/0.1.26/build/vfs_fonts.js'); ?>"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="<?php echo base_url('../resources/shared_js/html5shiv/dist/html5shiv.min.js'); ?>"></script>
        <script src="<?php echo base_url('../resources/shared_js/respond/dest/respond.min.js'); ?>"></script>
        <![endif]-->
        <!-- Add fancyBox -->
        <link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fancybox/2.1.5/source/jquery.fancybox.css'); ?>" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url('../resources/shared_js/fancybox/2.1.5/source/jquery.fancybox.pack.js'); ?>"></script>
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
            });
        </script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_css/custom.css?v=0.1'); ?>">

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
            <img id="loading-image" src="<?php echo base_url('../resources/shared_img/preloader.GIF'); ?>" alt="Loading..." />
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

        <script src="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url('../resources/themes/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url('../resources/themes/AdminLTE/plugins/fastclick/fastclick.js'); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('../resources/themes/AdminLTE/dist/js/app.min.js'); ?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url('../resources/themes/AdminLTE/dist/js/demo.js'); ?>"></script>

        <script src="<?php echo base_url('../resources/shared_js/custom.js?v=0.1'); ?>"></script>
        <script src="<?php echo base_url('../resources/shared_js/thumb2full.js') ?>"></script>
    </body>
</html>