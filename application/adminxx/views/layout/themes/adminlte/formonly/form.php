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
        <script src="<?php echo base_url('../resources/shared_js/jquery/2.1.4/dist/jquery.min.js'); ?>"></script>
        

        <link rel="stylesheet" href="<?php echo base_url('../resources/shared_css/jquery-ui-themes/themes/smoothness/jquery-ui.min.css'); ?>">
        <script src="<?php echo base_url('../resources/shared_js/jquery-ui/jquery-ui.min.js'); ?>"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_css/custom.css?v=0.1') ?>">
        <!-- include jhtmlarea css/js-->
        <link href="<?php echo base_url('../resources/shared_js/jHtmlArea/src/jHtmlArea_Website/style/jHtmlArea.css'); ?>" rel="stylesheet">
        <!-- <link href="<?php echo base_url('../resources/shared_js/jHtmlArea/src/jHtmlArea_Website/style/jHtmlArea.Editor.css'); ?>" rel="stylesheet"> -->
        <script src="<?php echo base_url('../resources/shared_js/jHtmlArea/src/jHtmlArea_Website/scripts/jHtmlArea-0.8.min.js'); ?>"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>"  crossorigin="anonymous">

        <!-- Optional theme -->
        <!--<link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap-theme.min.css'); ?>"  crossorigin="anonymous"> -->

        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>

        <link href="<?php echo base_url('../resources/shared_js/select2/dist/css/select2.min.css'); ?>" rel="stylesheet" />
        <script src="<?php echo base_url('../resources/shared_js/select2/dist/js/select2.min.js'); ?>"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_js/jquery-ui-timepicker-addon/1.4.5/dist/jquery-ui-timepicker-addon.min.css'); ?>">
        <script src="<?php echo base_url('../resources/shared_js/jquery-ui-timepicker-addon/1.4.5/dist/jquery-ui-timepicker-addon.min.js'); ?>"></script>
        <script src="<?php echo base_url('../resources/shared_js/jquery-ui-timepicker-addon/1.4.5/dist/jquery-ui-sliderAccess.js'); ?>"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_js/jquery-timepicker/1.8.8/jquery.timepicker.css'); ?>">
        <script src="<?php echo base_url('../resources/shared_js/jquery-timepicker/1.8.8/jquery.timepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('../resources/shared_js/Minimal-Dropdown-Year/lib/year-select.js'); ?>"></script>

        <script src="<?php echo base_url('../resources/shared_js/jquery.alphanum/jquery.alphanum.js'); ?>"></script>

        <script type = "text/javascript" src="<?php echo base_url('../resources/shared_js/jquery.form/jquery.form.js'); ?>"	></script>

        <style>

            body{
                padding: 70px;
            }

            .container-fluid {
                margin-right: auto;
                margin-left: auto;
                /*max-width: 960px !important;  or 950px */
            }

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
        </style>

        <script src="<?php echo base_url('../resources/shared_js/custom.js?v=0.1') ?>"></script>
        <script>
            $(document).ready(function () {
                $('.dropdown-toggle').dropdown();
            });
        </script>
    </head>
    <body>
        <div id="loading">
            <img id="loading-image" src="<?php echo base_url('../resources/shared_img/preloader.GIF'); ?>" alt="Loading..." />
        </div>
        <?php echo (isset($menu) ? $menu : ''); ?>
        <!-- <?php echo (isset($genlist) ? $genlist : ''); ?> -->
        <?php echo (isset($content) ? $content : ''); ?>
    </body>
</html>