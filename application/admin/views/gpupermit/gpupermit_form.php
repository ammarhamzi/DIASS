<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('gpupermit');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('gpupermit');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
        </li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <?php echo $this->lang->line('gpupermit');?>
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
            <?php echo $this->lang->line('gpupermit_permit_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('gpupermit_permit_id') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="gpupermit_permit_id" id="gpupermit_permit_id" placeholder="<?php echo $this->lang->line('gpupermit_permit_id');?>" value="<?php echo $gpupermit_permit_id; ?>" maxlength="11"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_driver_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('gpupermit_driver_id') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="gpupermit_driver_id" id="gpupermit_driver_id" placeholder="<?php echo $this->lang->line('gpupermit_driver_id');?>" value="<?php echo $gpupermit_driver_id; ?>" maxlength="11"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_recent_permitno');?> <?php echo form_error('gpupermit_recent_permitno') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="gpupermit_recent_permitno" id="gpupermit_recent_permitno" placeholder="<?php echo $this->lang->line('gpupermit_recent_permitno');?>" value="<?php echo $gpupermit_recent_permitno; ?>"
                                    maxlength="150" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_recent_expirydate');?> <?php echo form_error('gpupermit_recent_expirydate') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="gpupermit_recent_expirydate" id="gpupermit_recent_expirydate" placeholder="<?php echo $this->lang->line('gpupermit_recent_expirydate');?>" value="<?php echo $gpupermit_recent_expirydate; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_driveracknowledgement');?> <?php echo form_error('gpupermit_driveracknowledgement') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="gpupermit_driveracknowledgement" id="gpupermit_driveracknowledgement" placeholder="<?php echo $this->lang->line('gpupermit_driveracknowledgement');?>" value="<?php echo $gpupermit_driveracknowledgement; ?>"
                                    maxlength="1" />           </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_driveracknowledgement_date');?> <?php echo form_error('gpupermit_driveracknowledgement_date') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="gpupermit_driveracknowledgement_date" id="gpupermit_driveracknowledgement_date" placeholder="<?php echo $this->lang->line('gpupermit_driveracknowledgement_date');?>"
                                    value="<?php echo $gpupermit_driveracknowledgement_date; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_certbyemployer');?> <?php echo form_error('gpupermit_certbyemployer') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="gpupermit_certbyemployer" id="gpupermit_certbyemployer" placeholder="<?php echo $this->lang->line('gpupermit_certbyemployer');?>" value="<?php echo $gpupermit_certbyemployer; ?>"
                                    maxlength="1" />           </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_certbyemployer_date');?> <?php echo form_error('gpupermit_certbyemployer_date') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="gpupermit_certbyemployer_date" id="gpupermit_certbyemployer_date" placeholder="<?php echo $this->lang->line('gpupermit_certbyemployer_date');?>" value="<?php echo $gpupermit_certbyemployer_date; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_certbytrainer');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('gpupermit_certbytrainer') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="gpupermit_certbytrainer" id="gpupermit_certbytrainer" placeholder="<?php echo $this->lang->line('gpupermit_certbytrainer');?>" value="<?php echo $gpupermit_certbytrainer; ?>"
                                    maxlength="11" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_certbytrainer_date');?> <?php echo form_error('gpupermit_certbytrainer_date') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="gpupermit_certbytrainer_date" id="gpupermit_certbytrainer_date" placeholder="<?php echo $this->lang->line('gpupermit_certbytrainer_date');?>" value="<?php echo $gpupermit_certbytrainer_date; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_course_date');?> <?php echo form_error('gpupermit_course_date') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="gpupermit_course_date" id="gpupermit_course_date" placeholder="<?php echo $this->lang->line('gpupermit_course_date');?>" value="<?php echo $gpupermit_course_date; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_gpubriefingscheduled');?> <?php echo form_error('gpupermit_gpubriefingscheduled') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="gpupermit_gpubriefingscheduled" id="gpupermit_gpubriefingscheduled" placeholder="<?php echo $this->lang->line('gpupermit_gpubriefingscheduled');?>" value="<?php echo $gpupermit_gpubriefingscheduled; ?>"
                                    maxlength="1" />           </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_gpubriefingapproval');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('gpupermit_gpubriefingapproval') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="gpupermit_gpubriefingapproval" id="gpupermit_gpubriefingapproval" placeholder="<?php echo $this->lang->line('gpupermit_gpubriefingapproval');?>" value="<?php echo $gpupermit_gpubriefingapproval; ?>"
                                    maxlength="11" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_attendgpubriefing');?> <?php echo form_error('gpupermit_attendgpubriefing') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="gpupermit_attendgpubriefing" id="gpupermit_attendgpubriefing" placeholder="<?php echo $this->lang->line('gpupermit_attendgpubriefing');?>" value="<?php echo $gpupermit_attendgpubriefing; ?>"
                                    maxlength="1" />           </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_completed_docs');?> <?php echo form_error('gpupermit_completed_docs') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="gpupermit_completed_docs" id="gpupermit_completed_docs" placeholder="<?php echo $this->lang->line('gpupermit_completed_docs');?>" value="<?php echo $gpupermit_completed_docs; ?>"
                                    maxlength="1" />           </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_approvedby_airside');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('gpupermit_approvedby_airside') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="gpupermit_approvedby_airside" id="gpupermit_approvedby_airside" placeholder="<?php echo $this->lang->line('gpupermit_approvedby_airside');?>" value="<?php echo $gpupermit_approvedby_airside; ?>"
                                    maxlength="11" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_created_at');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('gpupermit_created_at') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="gpupermit_created_at" id="gpupermit_created_at" placeholder="<?php echo $this->lang->line('gpupermit_created_at');?>" value="<?php echo $gpupermit_created_at; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_updated_at');?> <?php echo form_error('gpupermit_updated_at') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="gpupermit_updated_at" id="gpupermit_updated_at" placeholder="<?php echo $this->lang->line('gpupermit_updated_at');?>" value="<?php echo $gpupermit_updated_at; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_deleted_at');?> <?php echo form_error('gpupermit_deleted_at') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="gpupermit_deleted_at" id="gpupermit_deleted_at" placeholder="<?php echo $this->lang->line('gpupermit_deleted_at');?>" value="<?php echo $gpupermit_deleted_at; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('gpupermit_lastchanged_by');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('gpupermit_lastchanged_by') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="gpupermit_lastchanged_by" id="gpupermit_lastchanged_by" placeholder="<?php echo $this->lang->line('gpupermit_lastchanged_by');?>" value="<?php echo $gpupermit_lastchanged_by; ?>"
                                    maxlength="11" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="gpupermit_id" value="<?php echo (isset($id)?$id:" "); ?>" />
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
                                <a href="<?php echo site_url('gpupermit') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
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