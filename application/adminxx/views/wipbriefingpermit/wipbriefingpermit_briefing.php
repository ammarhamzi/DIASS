<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
<!--        <li><a href="<?php echo site_url('wipbriefingpermit');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('wipbriefingpermit');?> <?php echo $this->lang->line('list');?></a></li>-->
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
Update Attendance
        </li>
    </ol>
    <form action="<?php echo $action; ?>" method="post">

        <div class="row">

            <div class="col-md-12">
    <div class="box  box-primary">
        <div class="box-header with-border">
            <i class="fa fa-file-text-o"></i>

            <h3 class="box-title">Check Attendance (Work In Progress) - <?php echo datelocal($course_date);?></h3>
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
                                    <th>
                                        <?php echo $this->lang->line('driver_name');?>
                                    </th>

<!--                                    <th>
                                        <?php echo $this->lang->line('driver_ic');?>
                                    </th>-->
                                    <th>
                                        <?php echo $this->lang->line('company_name');?>
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$trainer = "";
$briefingdate = "";
$permit_id = "";
if($wipbriefing){
$i=0;
foreach ($wipbriefing as $value) {
$trainer = $value->wipbriefingpermit_certbytrainer;
$briefingdate = $value->wipbriefingpermit_certbytrainer_date;
/*$permit_id = $value->wipbriefingpermit_permit_id;*/
/*print_r($value);*/
?>
                                    <tr>
                                        <td>
                                            <?php echo ++$i?>
                                        </td>
                                        <td><input type="checkbox" name="wipbriefingpermit_id[]" id="wipbriefingpermit_id" value="<?php echo $value->wipbriefingpermit_id;?>|<?php echo $value->wipbriefingpermit_permit_id;?>" <?php echo ($value->wipbriefingpermit_attendwipbriefing=="y"?"checked":"");?> <?php echo (empty($value->wipbriefingpermit_completed_docs)?"disabled":"");?>
                                            />
                                            <?php echo $value->vehicle_registration_no;?>
                                        </td>
<!--                                        <td>
                                            <?php echo $value->driver_ic;?>
                                        </td>-->
                                        <td>
                                            <?php echo $value->company_name;?>
                                        </td>
                                    <th>
                                        <?php echo (empty($value->wipbriefingpermit_completed_docs)?'<span style="color: #CC0000">Not Approved By MAHB</span>':'Approved');?>
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
    <td><input type="text" name="wipbriefingpermit_certbytrainer" id="wipbriefingpermit_certbytrainer" value="<?php echo $trainer;?>"></td>
</tr>
<tr>
    <th width="20%">Briefing Date:</th>
    <td><input type="text" name="wipbriefingpermit_certbytrainer_date" id="wipbriefingpermit_certbytrainer_date" class="datepicker" value="<?php echo $briefingdate;?>"></td>
</tr>
</table>
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">

<input type="hidden" name="course_date" id="course_date" value="<?php echo $course_date;?>">
<!--<input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id;?>">-->

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Update</button>
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