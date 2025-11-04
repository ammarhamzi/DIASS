<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        <!-- cdn -->
        <script src="<?php echo base_url('../resources/shared_js/jquery/2.1.4/dist/jquery.min.js'); ?>"></script>
        
        <link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>"  crossorigin="anonymous">
        <script src="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>"  crossorigin="anonymous"></script>
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
        <style>
            body{
                padding-top: 70px;
                width: 100% !important;
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
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6"><?php echo $this->session->userdata('copyright_notice'); ?></div>
                <div class="col-md-6 text-right"><?php echo $this->session->userdata('version_info'); ?></div>
            </div>
        </div>
    </body>
</html>