<!-- \resources\gen_template\master\crud-newpage\views -->

<style>
    @media print { 
               .noprint { 
                  visibility: hidden; 
               } 
            } 
</style>
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
<!--        <li><a href="<?php echo site_url('evdppermit');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('evdppermit');?> <?php echo $this->lang->line('list');?></a></li>-->
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
Update Attendance
        </li>
    </ol>
    <form action="<?php echo $action; ?>" method="post">

        <div class="row" id="exporttoexcel">

            <div class="col-md-12">
    <div class="box  box-primary">
        <div class="box-header with-border">
            <i class="fa fa-file-text-o"></i>

            <h3 class="box-title">Check Attendance (EVDP) - Date:<?php echo $course_date;?>, Location:<?php echo $course_location;?></h3>
            <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

                        <table id="mytable" class="table" style="width: 100% !important">

                            <thead>
                                <tr>
                                    <th class="no-sort">#</th>
                                    <th></th>
                                    <th>
                                        <?php echo $this->lang->line('driver_name');?>
                                    </th>

                                    <th>
                                        <?php echo $this->lang->line('driver_ic');?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('company_name');?>
                                    </th>
                                    <th>
                                        Application Type (New / Renew)
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Selected Location
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$trainer = "";
$briefingdate = "";
$permit_id = "";
if($evdpbriefing){

$i=0;
foreach ($evdpbriefing as $value) {
$trainer = $value->evdppermit_certbytrainer;
$briefingdate = $value->evdppermit_certbytrainer_date;
/*$permit_id = $value->evdppermit_permit_id;*/
/*print_r($value);*/
?>
                                    <tr>
                                        <td>
                                            <?php echo ++$i?>
                                        </td>
                                        <td>
                                            <?php 
                                            $todayDate = date('Y-m-d');
                                            if($course_date >= $todayDate)
                                            {
                                            /*echo '<input type="checkbox" name="evdppermit_id[]" id="evdppermit_id" value="<?php echo $value->evdppermit_id;?>|<?php echo $value->evdppermit_permit_id;?> <?php echo ($value->evdppermit_attendterminalbriefing=="y"?"checked":"");?> <?php echo (empty($value->evdppermit_completed_docs)?"disabled":"");?> />';
                                            */ 
                                            echo '<input type="checkbox" name="evdppermit_id[]" id="evdppermit_id" value="'.$value->evdppermit_id.'|'.$value->evdppermit_permit_id.'" ';
                                            echo ($value->evdppermit_attendterminalbriefing=="y"?"checked":"");
                                            echo (empty($value->evdppermit_completed_docs)?"disabled":"");
                                            echo ' />';
                                             }
                                             else
                                             {
                                                echo '<input type="checkbox" name="evdppermit_id[]" id="evdppermit_id" value="'.$value->evdppermit_id.'|'.$value->evdppermit_permit_id.'" ';
                                                echo ($value->evdppermit_attendterminalbriefing=="y"?"checked":"");
                                                echo (" disabled ");
                                                echo ' />';
                                             }
                                            ?>
                                            
                                        </td>
                                        <td>
                                            
                                            
                                            <?php echo $value->driver_name?>
                                        </td>
                                        <td>
                                            <?php echo $value->driver_ic;?>
                                        </td>
                                        <td>
                                            <?php echo $value->company_name;?>
                                        </td>
                                        <th>
                                            <?php echo ($value->permit_condition == 1?'<span style="color: #CC0000">New</span>':'Renew');?>
                                        </th>
                                    <th>
                                        <?php echo (empty($value->evdppermit_completed_docs)?'<span style="color: #CC0000">Not Approved By MAHB</span>':'Approved');?>
                                    </th>

                                    <th>
                                        <?php echo $value->evdppermit_course_location;?>
                                    </th>
                                    </tr>
                                    <?php
}
}
?>
                            </tbody>
                        </table>
<table class="table">
<tr>
    <th width="20%">Trainer:</th>
    <td><input type="text" name="evdppermit_certbytrainer" id="evdppermit_certbytrainer" value="<?php echo $trainer;?>"></td>
</tr>
<tr>
    <th width="20%">Briefing Date:</th>
    <td><input type="text" name="evdppermit_certbytrainer_date" id="evdppermit_certbytrainer_date" class="datepicker" value="<?php echo $briefingdate;?>"></td>
</tr>
</table>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">

<input type="hidden" name="course_date" id="course_date" value="<?php echo $course_date;?>">
<!--<input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id;?>">-->

            <a href="javascript:history.go(-1)" class="btn btn-default noprint"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
            <?php 
                                            $todayDate = date('Y-m-d');
                                            if($course_date >= $todayDate)
                                            {
                                            echo '<button type="submit" class="btn btn-primary noprint"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Update</button>';
                                             }
                                ?>
                                <button type="button" class="btn btn-primary noprint" id="buttonPrint"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
                                <button type="button" onclick="tableToExcel('exporttoexcel', 'EVDP Briefing')" class="btn btn-primary noprint" id="buttonExcel"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Excel</button>
                                <!--         <a href="<?php echo site_url('exambanklist/index/'.$parent_id) ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<?php

if (isset($id)) {
?>
    <script>
        $(document).ready(function() {
            
            var arr = [];
            $.each(arr, function(i, val) {
                $("#" + val).prop("disabled", true);
                $("#" + val).after("<input type='hidden' name='" + val + "' id='" + val + "' value='" + $("#" + val).val() + "'>");
            });
            
            
        });
    </script>
    <?php
}
?>
    <script>

        
        $(document).ready(function() {


            $(".btn-remote-file").click(function() {
                $('input[type=file]').trigger('click');
            });
            $("#buttonPrint").click(function() {
                window.print();
            });
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });
            $(document).ready(function() {
                $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
                    var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;
                    if (input.length) {
                        input.val(log);
                        $(this).parents('.input-group').find(":submit").click();
                    } else {
                        //if( log ) alert(log);
                    }
                });
            });
        });
    </script>
    <script>
        var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()

                    
        function clear_form_elements(id) {
            jQuery("#testingDiv" + id).find(':input').each(function() {
                switch (this.type) {
                    case 'password':
                    case 'text':
                    case 'textarea':
                    case 'file':
                    case 'select-one':
                    case 'select-multiple':
                        jQuery(this).val('');
                        break;
                    case 'checkbox':
                    case 'radio':
                        this.checked = false;
                }
            });
        }
        $(function() {
            $(".clonedInput:first").before('<div id="add-buttons"><input class="btn btn-success" type="button" id="btnAdd" value="<?php echo $this->lang->line('
                add_more_child ');?>"></div><hr style="width: 100%">');
            if ($('.clonedInput').length > 1) {
                $('.clonedInput').each(function() {
                    var pos = $(this).attr('id');
                    pos = pos.replace('testingDiv', '');
                    $(this).append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="<?php echo $this->lang->line('
                        x ');?>" position="' + pos + '"/>');
                    $(this).append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="<?php echo $this->lang->line('
                        clear ');?>" position="' + pos + '"/><hr style="width: 100%">');
                });
            } else {
                $(".clonedInput:first").append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="<?php echo $this->lang->line('
                    x ');?>" position="1" disabled="disabled"/>');
                $(".clonedInput:first").append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="<?php echo $this->lang->line('
                    clear ');?>" position="1"/><hr style="width: 100%">');
            }
            //$('#btnAdd').click(function () {
            $('body').on('click', '#btnAdd', function() {
                var num = $('.clonedInput').length, // how many "duplicatable" input fields we currently have
                    newNum = new Number(num + 1), // the numeric ID of the new input field being added
                    randomID = Math.floor((Math.random() * 1000) + 1),
                    cleanelem = $(".clonedInput:last").find('select.select2').select2("destroy"),
                    newElem = $(".clonedInput:last").clone(true, true).attr('id', 'testingDiv' + randomID).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
                newElem.find('.action-button').attr('position', randomID).prop("disabled", false);
                newElem.find('.datepicker').removeClass('hasDatepicker').attr('id', '').datepicker();
                newElem.find('.datetimepicker').removeClass('hasDatepicker').attr('id', '').datetimepicker();
                // insert the new element after the last "duplicatable" input field
                $(".clonedInput:last").after(newElem);
                $("select.select2").select2();
                clear_form_elements(randomID);
                // manipulate the name/id values of the input inside the new element
                // enable the "remove" button
                $('#btnDel').attr('disabled', false);
                // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
                if (newNum == 5) $('#btnAdd').attr('disabled', true).prop('value', "<?php echo $this->lang->line('reach_limit');?>");
            });
            $('body').on('click', '#btnDel', function() {
                //$('#btnDel').click(function () {
                var position = $(this).attr("position");
                var num = $('.clonedInput').length;
                $('#testingDiv' + position).slideUp('slow', function() {
                    $(this).remove();
                    // if only one element remains, disable the "remove" button
                    if (num - 1 === 1) {
                        $('#btnDel:last').attr('disabled', true);
                    }
                    // enable the "add" button
                    $('#btnAdd').attr('disabled', false).prop('value', "<?php echo $this->lang->line('add_to_form');?>");
                });
            });
            $('body').on('click', '#btnClear', function() {
                var position = $(this).attr("position");
                clear_form_elements(position);
            });
        });
    </script>