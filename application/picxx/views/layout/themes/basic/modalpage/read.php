<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>

        <!-- cdn -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>"  crossorigin="anonymous">

        <!-- Optional theme -->
        <!--<link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/bootstrap/css/bootstrap-theme.min.css'); ?>"  crossorigin="anonymous">-->


        <style>
            body{
                padding-top: 70px;
            }

            .container-fluid {
                margin-right: auto;
                margin-left: auto;
                /*max-width: 960px !important;  or 950px */
            }
        </style>
    </head>
    <body>
        <?php echo (isset($menu) ? $menu : ''); ?>
        <?php echo (isset($content) ? $content : ''); ?>
    </body>
</html>