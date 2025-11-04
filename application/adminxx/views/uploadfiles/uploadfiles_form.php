<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('uploadfiles');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('uploadfiles');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
        </li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <?php echo $this->lang->line('uploadfiles');?>
                <?php echo $button ?>
            </h4>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-9">
                    <form action="<?php echo $action; ?>" method="post">
                        <div class="row col-md-12">
                            <h5 class="pull-right">
                                <?php echo $this->lang->line('legend');?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span>
                                <?php echo $this->lang->line('required_field');?>
                            </h5>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('uploadfiles_filename');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('uploadfiles_filename') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="uploadfiles_filename" id="uploadfiles_filename" placeholder="<?php echo $this->lang->line('uploadfiles_filename');?>" value="<?php echo $uploadfiles_filename; ?>" maxlength="255"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('uploadfiles_filesize');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('uploadfiles_filesize') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="uploadfiles_filesize" id="uploadfiles_filesize" placeholder="<?php echo $this->lang->line('uploadfiles_filesize');?>" value="<?php echo $uploadfiles_filesize; ?>" maxlength="11"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('uploadfiles_ext');?> <?php echo form_error('uploadfiles_ext') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="uploadfiles_ext" id="uploadfiles_ext" placeholder="<?php echo $this->lang->line('uploadfiles_ext');?>" value="<?php echo $uploadfiles_ext; ?>" maxlength="10" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('uploadfiles_type');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('uploadfiles_type') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="uploadfiles_type" id="uploadfiles_type" placeholder="<?php echo $this->lang->line('uploadfiles_type');?>" value="<?php echo $uploadfiles_type; ?>" maxlength="100" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('uploadfiles_company_id');?> <?php echo form_error('uploadfiles_company_id') ?>
          </label>
                            <div class="col-md-9"><select class="form-control select2" name="uploadfiles_company_id" id="uploadfiles_company_id">
<option value="">-SELECT-</option>
<?php
foreach ($company as $value) {
?>
<option value="<?php echo $value->company_id;?>" <?php echo ($value->company_id===$uploadfiles_company_id?'selected="selected"':"");?>><?php echo $value->company_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('uploadfiles_permit_id');?> <?php echo form_error('uploadfiles_permit_id') ?>
          </label>
                            <div class="col-md-9"><select class="form-control select2" name="uploadfiles_permit_id" id="uploadfiles_permit_id">
<option value="">-SELECT-</option>
<?php
foreach ($permit as $value) {
?>
<option value="<?php echo $value->permit_id;?>" <?php echo ($value->permit_id===$uploadfiles_permit_id?'selected="selected"':"");?>><?php echo $value->permit_bookingid;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('uploadfiles_driver_id');?> <?php echo form_error('uploadfiles_driver_id') ?>
          </label>
                            <div class="col-md-9"><select class="form-control select2" name="uploadfiles_driver_id" id="uploadfiles_driver_id">
<option value="">-SELECT-</option>
<?php
foreach ($driver as $value) {
?>
<option value="<?php echo $value->driver_id;?>" <?php echo ($value->driver_id===$uploadfiles_driver_id?'selected="selected"':"");?>><?php echo $value->driver_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('uploadfiles_vehicle_id');?> <?php echo form_error('uploadfiles_vehicle_id') ?>
          </label>
                            <div class="col-md-9"><select class="form-control select2" name="uploadfiles_vehicle_id" id="uploadfiles_vehicle_id">
<option value="">-SELECT-</option>
<?php
foreach ($vehicle as $value) {
?>
<option value="<?php echo $value->vehicle_id;?>" <?php echo ($value->vehicle_id===$uploadfiles_vehicle_id?'selected="selected"':"");?>><?php echo $value->vehicle_registration_no;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('uploadfiles_fixedfacilities_id');?> <?php echo form_error('uploadfiles_fixedfacilities_id') ?>
          </label>
                            <div class="col-md-9"><select class="form-control select2" name="uploadfiles_fixedfacilities_id" id="uploadfiles_fixedfacilities_id">
<option value="">-SELECT-</option>
<?php
foreach ($fixedfacilitiespermit as $value) {
?>
<option value="<?php echo $value->fixedfacilitiespermit_id;?>" <?php echo ($value->fixedfacilitiespermit_id===$uploadfiles_fixedfacilities_id?'selected="selected"':"");?>><?php echo $value->fixedfacilitiespermit_recent_permitno;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('uploadfiles_processtype');?> <?php echo form_error('uploadfiles_processtype') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="uploadfiles_processtype" id="uploadfiles_processtype" placeholder="<?php echo $this->lang->line('uploadfiles_processtype');?>" value="<?php echo $uploadfiles_processtype; ?>" maxlength="25"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="uploadfiles_id" value="<?php echo (isset($id)?$id:" "); ?>" />
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
                                <a href="<?php echo site_url('uploadfiles') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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