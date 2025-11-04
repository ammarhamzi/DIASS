<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('driver');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('driver');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
        </li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <?php echo $this->lang->line('driver');?>
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
            <?php echo $this->lang->line('driver_name');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_name') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="driver_name" id="driver_name" placeholder="<?php echo $this->lang->line('driver_name');?>" value="<?php echo $driver_name; ?>" maxlength="255" />
                            </div>
                        </div>
                        <input type='hidden' name="driver_company_id" id="driver_company_id" value="<?php echo $companyid; ?>" />

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_dob');?> <?php echo form_error('driver_dob') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datepicker" name="driver_dob" id="driver_dob" placeholder="<?php echo $this->lang->line('driver_dob');?>" value="<?php echo $driver_dob; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_ic');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_ic') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="driver_ic" id="driver_ic" placeholder="<?php echo $this->lang->line('driver_ic');?>" value="<?php echo $driver_ic; ?>" maxlength="12" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_designation');?> <?php echo form_error('driver_designation') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="driver_designation" id="driver_designation" placeholder="<?php echo $this->lang->line('driver_designation');?>" value="<?php echo $driver_designation; ?>" maxlength="150" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_department');?> <?php echo form_error('driver_department') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="driver_department" id="driver_department" placeholder="<?php echo $this->lang->line('driver_department');?>" value="<?php echo $driver_department; ?>" maxlength="150" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_nationality_country_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_nationality_country_id') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="driver_nationality_country_id" id="driver_nationality_country_id">
<option value="">-SELECT-</option>
<?php
foreach ($ref_country as $value) {
?>
<option value="<?php echo $value->ref_country_id;?>" <?php echo ($value->ref_country_id===$driver_nationality_country_id?'selected="selected"':"");?>><?php echo $value->ref_country_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_address');?> <?php echo form_error('driver_address') ?>
          </label>
                            <div class="col-md-9"><textarea class="form-control" name="driver_address" id="driver_address" placeholder="<?php echo $this->lang->line('driver_address');?>" rows="5" cols="50"><?php echo $driver_address; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_officeno');?> <?php echo form_error('driver_officeno') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="driver_officeno" id="driver_officeno" placeholder="<?php echo $this->lang->line('driver_officeno');?>" value="<?php echo $driver_officeno; ?>" maxlength="25" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_hpno');?> <?php echo form_error('driver_hpno') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="driver_hpno" id="driver_hpno" placeholder="<?php echo $this->lang->line('driver_hpno');?>" value="<?php echo $driver_hpno; ?>" maxlength="25" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_email');?> <?php echo form_error('driver_email') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="driver_email" id="driver_email" placeholder="<?php echo $this->lang->line('driver_email');?>" value="<?php echo $driver_email; ?>" maxlength="150" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_drivinglicenseno');?> <?php echo form_error('driver_drivinglicenseno') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="driver_drivinglicenseno" id="driver_drivinglicenseno" placeholder="<?php echo $this->lang->line('driver_drivinglicenseno');?>" value="<?php echo $driver_drivinglicenseno; ?>" maxlength="50"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_drivingclass');?> <?php echo form_error('driver_drivingclass') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="driver_drivingclass" id="driver_drivingclass" placeholder="<?php echo $this->lang->line('driver_drivingclass');?>" value="<?php echo $driver_drivingclass; ?>" maxlength="50" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_licenseexpirydate');?> <?php echo form_error('driver_licenseexpirydate') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datepicker" name="driver_licenseexpirydate" id="driver_licenseexpirydate" placeholder="<?php echo $this->lang->line('driver_licenseexpirydate');?>" value="<?php echo $driver_licenseexpirydate; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_blacklistedremark');?> <?php echo form_error('driver_blacklistedremark') ?>
          </label>
                            <div class="col-md-9"><textarea class="form-control" name="driver_blacklistedremark" id="driver_blacklistedremark" placeholder="<?php echo $this->lang->line('driver_blacklistedremark');?>" rows="5" cols="50"><?php echo $driver_blacklistedremark; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_permit_typeid');?> <?php echo form_error('driver_permit_typeid') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="driver_permit_typeid" id="driver_permit_typeid" placeholder="<?php echo $this->lang->line('driver_permit_typeid');?>" value="<?php echo $driver_permit_typeid; ?>"
                                    maxlength="11" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_activity_statusid');?> <?php echo form_error('driver_activity_statusid') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="driver_activity_statusid" id="driver_activity_statusid" placeholder="<?php echo $this->lang->line('driver_activity_statusid');?>" value="<?php echo $driver_activity_statusid; ?>"
                                    maxlength="11" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('driver_application_date');?> <?php echo form_error('driver_application_date') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datepicker" name="driver_application_date" id="driver_application_date" placeholder="<?php echo $this->lang->line('driver_application_date');?>" value="<?php echo $driver_application_date; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="driver_id" value="<?php echo (isset($id)?$id:" "); ?>" />
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
                                <a href="<?php echo site_url('driver') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
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
            var arr = ['driver_blacklistedremark', 'driver_permit_typeid', 'driver_activity_statusid', 'driver_application_date'];
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