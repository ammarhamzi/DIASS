<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        <!-- cdn -->
        <!-- 12062023 change ver 2.1.4 to 3.7.0 -->
        <script src="<?php echo base_url('../resources/shared_js/jquery/3.7.0/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('../resources/shared_js/jquery/3.4.1/jquery-migrate-3.4.1.min.js'); ?>"></script>
        
        <script src="<?php echo base_url('../resources/shared_js/thumb2full.js') ?>"></script>
        <script src="<?php echo base_url('../resources/shared_js/printThis/1.7.0/printThis.js'); ?>"></script>
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
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>"  crossorigin="anonymous">

        <!-- Optional theme -->
        <!--<link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap-theme.min.css'); ?>"  crossorigin="anonymous">-->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_css/custom.css?v=0.1'); ?>">

        <script src="<?php echo base_url('../resources/shared_js/custom.js?v=0.1'); ?>"></script>
        <style>
            body{
                /*padding-top: 70px;*/
            }

            .container-fluid {
                margin-right: auto;
                margin-left: auto;
                /*max-width: 960px !important;  or 950px */
            }
        </style>
    </head>
    <body>
        <!--<div id="loading">
          <img id="loading-image" src="<?php echo base_url('../resources/shared_img/preloader.GIF'); ?>" alt="Loading..." />
        </div>-->
        <?php echo (isset($menu) ? $menu : ''); ?>
        <!-- <?php echo (isset($genlist) ? $genlist : ''); ?> -->
        <?php echo (isset($content) ? $content : ''); ?>

        <script>
            $(document).ready(function () {
                $("#printthis").click(function () {
                    $('.table').printThis({
                        importStyle: true,
                        removeInline: true,
                        pageTitle: "Detail",
                    });
                });

            });
        </script>
    </body>
</html>