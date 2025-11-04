<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/fonts.css'); ?>" />
        <style type="text/css">
            <!--
            body{
                font-family: 'Open Sans',sans-serif  !important;
            }
            -->
        </style>
        <!-- cdn -->
        <!-- 12062023 change ver 2.1.4 to 3.7.0 -->
		<script src="<?php echo base_url('../resources/shared_js/jquery/3.7.0/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('../resources/shared_js/jquery/3.4.1/jquery-migrate-3.4.1.min.js'); ?>"></script>
        

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

        <!-- Add fancyBox -->
        <link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fancybox/2.1.5/source/jquery.fancybox.css'); ?>" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url('../resources/shared_js/fancybox/2.1.5/source/jquery.fancybox.pack.js'); ?>"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_css/custom.css?v=0.1'); ?>">

        <style>
            body{
                padding: 70px;
                width: 100% !important;
            }

            .container-fluid {
                margin-right: auto;
                margin-left: auto;
                /*max-width: 960px !important;  or 950px */
            }

            .dataTables_length {
                width: 50%;
                float: left;
            }

            .dataTables_filter {
                width: 34%;
                float: left;
            }

            .dt-buttons {
                float: right;
            }

        </style>

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
    </head>
    <body>

        <div id="loading">
            <img id="loading-image" src="<?php echo base_url('../resources/shared_img/preloader.GIF'); ?>" alt="Loading..." />
        </div>

        <?php echo (isset($menu) ? $menu : ''); ?>
        <?php echo (isset($content) ? $content : ''); ?>

        <script src="<?php echo base_url('../resources/shared_js/custom.js?v=0.1'); ?>"></script>
    </body>
</html>