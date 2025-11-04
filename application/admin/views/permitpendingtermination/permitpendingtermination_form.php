<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('permitpendingtermination');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('permitpendingtermination');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
        </li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <?php echo $this->lang->line('permitpendingtermination');?>
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
            <?php echo $this->lang->line('permit_groupid');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('permit_groupid') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="permit_groupid" id="permit_groupid">
<option value="">-SELECT-</option>
<?php
foreach ($permit_group as $value) {
?>
<option value="<?php echo $value->permit_group_id;?>" <?php echo ($value->permit_group_id===$permit_groupid?'selected="selected"':"");?>><?php echo $value->permit_group_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_typeid');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('permit_typeid') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="permit_typeid" id="permit_typeid">
<option value="">-SELECT-</option>
<?php
foreach ($permit_type as $value) {
?>
<option value="<?php echo $value->permit_type_id;?>" <?php echo ($value->permit_type_id===$permit_typeid?'selected="selected"':"");?>><?php echo $value->permit_type_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_condition');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('permit_condition') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="permit_condition" id="permit_condition">
<option value="">-SELECT-</option>
<?php
foreach ($permit_condition as $value) {
?>
<option value="<?php echo $value->permit_condition_id;?>" <?php echo ($value->permit_condition_id===$permit_condition?'selected="selected"':"");?>><?php echo $value->permit_condition_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_bookingid');?> <?php echo form_error('permit_bookingid') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="permit_bookingid" id="permit_bookingid" placeholder="<?php echo $this->lang->line('permit_bookingid');?>" value="<?php echo $permit_bookingid; ?>" maxlength="25" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_picid');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('permit_picid') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="permit_picid" id="permit_picid">
<option value="">-SELECT-</option>
<?php
foreach ($pic as $value) {
?>
<option value="<?php echo $value->pic_id;?>" <?php echo ($value->pic_id===$permit_picid?'selected="selected"':"");?>><?php echo $value->pic_fullname;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_companyid');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('permit_companyid') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="permit_companyid" id="permit_companyid">
<option value="">-SELECT-</option>
<?php
foreach ($company as $value) {
?>
<option value="<?php echo $value->company_id;?>" <?php echo ($value->company_id===$permit_companyid?'selected="selected"':"");?>><?php echo $value->company_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_issuance_serialno');?> <?php echo form_error('permit_issuance_serialno') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="permit_issuance_serialno" id="permit_issuance_serialno" placeholder="<?php echo $this->lang->line('permit_issuance_serialno');?>" value="<?php echo $permit_issuance_serialno; ?>"
                                    maxlength="150" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_issuance_date');?> <?php echo form_error('permit_issuance_date') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datepicker" name="permit_issuance_date" id="permit_issuance_date" placeholder="<?php echo $this->lang->line('permit_issuance_date');?>" value="<?php echo $permit_issuance_date; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_issuance_startdate');?> <?php echo form_error('permit_issuance_startdate') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datepicker" name="permit_issuance_startdate" id="permit_issuance_startdate" placeholder="<?php echo $this->lang->line('permit_issuance_startdate');?>" value="<?php echo $permit_issuance_startdate; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_issuance_expirydate');?> <?php echo form_error('permit_issuance_expirydate') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datepicker" name="permit_issuance_expirydate" id="permit_issuance_expirydate" placeholder="<?php echo $this->lang->line('permit_issuance_expirydate');?>" value="<?php echo $permit_issuance_expirydate; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_issuance_processedby');?> <?php echo form_error('permit_issuance_processedby') ?>
          </label>
                            <div class="col-md-9"><select class="form-control select2" name="permit_issuance_processedby" id="permit_issuance_processedby">
<option value="">-SELECT-</option>
<?php
foreach ($user as $value) {
?>
<option value="<?php echo $value->user_id;?>" <?php echo ($value->user_id===$permit_issuance_processedby?'selected="selected"':"");?>><?php echo $value->user_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_payment_invoiceno');?> <?php echo form_error('permit_payment_invoiceno') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="permit_payment_invoiceno" id="permit_payment_invoiceno" placeholder="<?php echo $this->lang->line('permit_payment_invoiceno');?>" value="<?php echo $permit_payment_invoiceno; ?>"
                                    maxlength="150" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_payment_trainingfee');?> <?php echo form_error('permit_payment_trainingfee') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isCurrency" name="permit_payment_trainingfee" id="permit_payment_trainingfee" placeholder="<?php echo $this->lang->line('permit_payment_trainingfee');?>" value="<?php echo $permit_payment_trainingfee; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_payment_new');?> <?php echo form_error('permit_payment_new') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isCurrency" name="permit_payment_new" id="permit_payment_new" placeholder="<?php echo $this->lang->line('permit_payment_new');?>" value="<?php echo $permit_payment_new; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_payment_renew_oneyear');?> <?php echo form_error('permit_payment_renew_oneyear') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isCurrency" name="permit_payment_renew_oneyear" id="permit_payment_renew_oneyear" placeholder="<?php echo $this->lang->line('permit_payment_renew_oneyear');?>" value="<?php echo $permit_payment_renew_oneyear; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_payment_renew_prorated');?> <?php echo form_error('permit_payment_renew_prorated') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isCurrency" name="permit_payment_renew_prorated" id="permit_payment_renew_prorated" placeholder="<?php echo $this->lang->line('permit_payment_renew_prorated');?>" value="<?php echo $permit_payment_renew_prorated; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_payment_sst');?> <?php echo form_error('permit_payment_sst') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isCurrency" name="permit_payment_sst" id="permit_payment_sst" placeholder="<?php echo $this->lang->line('permit_payment_sst');?>" value="<?php echo $permit_payment_sst; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_payment_total');?> <?php echo form_error('permit_payment_total') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isCurrency" name="permit_payment_total" id="permit_payment_total" placeholder="<?php echo $this->lang->line('permit_payment_total');?>" value="<?php echo $permit_payment_total; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_payment_processedby');?> <?php echo form_error('permit_payment_processedby') ?>
          </label>
                            <div class="col-md-9"><select class="form-control select2" name="permit_payment_processedby" id="permit_payment_processedby">
<option value="">-SELECT-</option>
<?php
foreach ($user as $value) {
?>
<option value="<?php echo $value->user_id;?>" <?php echo ($value->user_id===$permit_payment_processedby?'selected="selected"':"");?>><?php echo $value->user_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_status');?> <?php echo form_error('permit_status') ?>
          </label>
                            <div class="col-md-9"><select class="form-control select2" name="permit_status" id="permit_status">
<option value="">-SELECT-</option>
<?php
foreach ($permit_status as $value) {
?>
<option value="<?php echo $value->permit_status_id;?>" <?php echo ($value->permit_status_id===$permit_status?'selected="selected"':"");?>><?php echo $value->permit_status_desc;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_officialstatus');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('permit_officialstatus') ?>
          </label>

                            <div class="col-md-9"><select class="form-control select2" name="permit_officialstatus" id="permit_officialstatus">
<option value="">-SELECT-</option>
<?php
foreach ($permit_officialstatus as $value) {
?>
<option value="<?php echo $value->permit_officialstatus_name;?>" <?php echo ($value->permit_officialstatus_name==$permit_officialstatus?'selected="selected"':"");?>><?php echo $value->permit_officialstatus_name;?></option>
<?php
}
?>
</select>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_remark');?> <?php echo form_error('permit_remark') ?>
          </label>
                            <div class="col-md-9"><textarea class="form-control" name="permit_remark" id="permit_remark" placeholder="<?php echo $this->lang->line('permit_remark');?>" rows="5" cols="50"><?php echo $permit_remark; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_timeline');?> <?php echo form_error('permit_timeline') ?>
          </label>
                            <div class="col-md-9"><textarea class="form-control" name="permit_timeline" id="permit_timeline" placeholder="<?php echo $this->lang->line('permit_timeline');?>" rows="5" cols="50"><?php echo $permit_timeline; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('permit_created_at');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('permit_created_at') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="permit_created_at" id="permit_created_at" placeholder="<?php echo $this->lang->line('permit_created_at');?>" value="<?php echo $permit_created_at; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="permit_id" value="<?php echo (isset($id)?$id:" "); ?>" />
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
                                <a href="<?php echo site_url('permitpendingtermination') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
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