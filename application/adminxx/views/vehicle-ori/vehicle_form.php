<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('vehicle');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('vehicle');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
        </li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <?php echo $this->lang->line('vehicle');?>
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
            <?php echo $this->lang->line('vehicle_company_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_company_id') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="vehicle_company_id" id="vehicle_company_id">
<option value="">-SELECT-</option>
<?php
foreach ($company as $value) {
?>
<option value="<?php echo $value->company_id;?>" <?php echo ($value->company_id===$vehicle_company_id?'selected="selected"':"");?>><?php echo $value->company_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_registration_no');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_registration_no') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="vehicle_registration_no" id="vehicle_registration_no" placeholder="<?php echo $this->lang->line('vehicle_registration_no');?>" value="<?php echo $vehicle_registration_no; ?>" maxlength="150"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_type');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_type') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="vehicle_type" id="vehicle_type">
<option value="">-SELECT-</option>
<?php
foreach ($dropdown_vehicle_type as $value) {

if($value->id===$vehicle_type ){
?>
<option value="<?php echo $value->id;?>" <?php echo set_select('vehicle_type', $value->id, TRUE); ?>><?php echo $value->value;?></option>
<?php
}else{
?>
<option value="<?php echo $value->id;?>" <?php echo set_select('vehicle_type', $value->id); ?>><?php echo $value->value;?></option>
<?php
}
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_insurance_policy_no');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_insurance_policy_no') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="vehicle_insurance_policy_no" id="vehicle_insurance_policy_no" placeholder="<?php echo $this->lang->line('vehicle_insurance_policy_no');?>" value="<?php echo $vehicle_insurance_policy_no; ?>"
                                    maxlength="150" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_insurance_expiry_date');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_insurance_expiry_date') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datepicker" name="vehicle_insurance_expiry_date" id="vehicle_insurance_expiry_date" placeholder="<?php echo $this->lang->line('vehicle_insurance_expiry_date');?>" value="<?php echo $vehicle_insurance_expiry_date; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_vehicleequipmenttype_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_vehicleequipmenttype_id') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="vehicle_vehicleequipmenttype_id" id="vehicle_vehicleequipmenttype_id">
<option value="">-SELECT-</option>
<?php
foreach ($vehicleequipmenttype as $value) {
?>
<option value="<?php echo $value->vehicleequipmenttype_id;?>" <?php echo ($value->vehicleequipmenttype_id===$vehicle_vehicleequipmenttype_id?'selected="selected"':"");?>><?php echo $value->vehicleequipmenttype_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_parkingarea_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_parkingarea_id') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="vehicle_parkingarea_id" id="vehicle_parkingarea_id">
<option value="">-SELECT-</option>
<?php
foreach ($parkingarea as $value) {
?>
<option value="<?php echo $value->parkingarea_id;?>" <?php echo ($value->parkingarea_id===$vehicle_parkingarea_id?'selected="selected"':"");?>><?php echo $value->parkingarea_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_year_manufacture');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_year_manufacture') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="vehicle_year_manufacture" id="vehicle_year_manufacture" placeholder="<?php echo $this->lang->line('vehicle_year_manufacture');?>" value="<?php echo $vehicle_year_manufacture; ?>"
                                    maxlength="10" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_chasis_no');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_chasis_no') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="vehicle_chasis_no" id="vehicle_chasis_no" placeholder="<?php echo $this->lang->line('vehicle_chasis_no');?>" value="<?php echo $vehicle_chasis_no; ?>" maxlength="150" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_enginetype_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_enginetype_id') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="vehicle_enginetype_id" id="vehicle_enginetype_id">
<option value="">-SELECT-</option>
<?php
foreach ($enginetype as $value) {
?>
<option value="<?php echo $value->enginetype_id;?>" <?php echo ($value->enginetype_id===$vehicle_enginetype_id?'selected="selected"':"");?>><?php echo $value->enginetype_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_engine_no');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_engine_no') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="vehicle_engine_no" id="vehicle_engine_no" placeholder="<?php echo $this->lang->line('vehicle_engine_no');?>" value="<?php echo $vehicle_engine_no; ?>" maxlength="150" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_engine_capacity');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_engine_capacity') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="vehicle_engine_capacity" id="vehicle_engine_capacity" placeholder="<?php echo $this->lang->line('vehicle_engine_capacity');?>" value="<?php echo $vehicle_engine_capacity; ?>" maxlength="10"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_activity_statusid');?> <?php echo form_error('vehicle_activity_statusid') ?>
          </label>
                            <div class="col-md-9"><select class="form-control select2" name="vehicle_activity_statusid" id="vehicle_activity_statusid">
<option value="">-SELECT-</option>
<?php
foreach ($activity_status as $value) {
?>
<option value="<?php echo $value->activity_status_id;?>" <?php echo ($value->activity_status_id===$vehicle_activity_statusid?'selected="selected"':"");?>><?php echo $value->activity_status_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_application_date');?> <?php echo form_error('vehicle_application_date') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datepicker" name="vehicle_application_date" id="vehicle_application_date" placeholder="<?php echo $this->lang->line('vehicle_application_date');?>" value="<?php echo $vehicle_application_date; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('vehicle_blacklistedremark');?> <?php echo form_error('vehicle_blacklistedremark') ?>
          </label>
                            <div class="col-md-9"><textarea class="form-control" name="vehicle_blacklistedremark" id="vehicle_blacklistedremark" placeholder="<?php echo $this->lang->line('vehicle_blacklistedremark');?>" rows="5" cols="50"><?php echo $vehicle_blacklistedremark; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="vehicle_id" value="<?php echo (isset($id)?$id:" "); ?>" />
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
                                <a href="<?php echo site_url('vehicle') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
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