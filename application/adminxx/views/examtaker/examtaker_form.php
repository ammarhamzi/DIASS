<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('examtaker');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('examtaker');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
        </li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <?php echo $this->lang->line('examtaker');?>
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
            <?php echo $this->lang->line('examtaker_driverid');?> <?php echo form_error('examtaker_driverid') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="examtaker_driverid" id="examtaker_driverid" placeholder="<?php echo $this->lang->line('examtaker_driverid');?>" value="<?php echo $examtaker_driverid; ?>" maxlength="10"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_exammanagement_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('examtaker_exammanagement_id') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="examtaker_exammanagement_id" id="examtaker_exammanagement_id" placeholder="<?php echo $this->lang->line('examtaker_exammanagement_id');?>" value="<?php echo $examtaker_exammanagement_id; ?>"
                                    maxlength="11" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_exambank_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('examtaker_exambank_id') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="examtaker_exambank_id" id="examtaker_exambank_id" placeholder="<?php echo $this->lang->line('examtaker_exambank_id');?>" value="<?php echo $examtaker_exambank_id; ?>"
                                    maxlength="11" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_examno');?> <?php echo form_error('examtaker_examno') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="examtaker_examno" id="examtaker_examno" placeholder="<?php echo $this->lang->line('examtaker_examno');?>" value="<?php echo $examtaker_examno; ?>" maxlength="10" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_date');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('examtaker_date') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datepicker" name="examtaker_date" id="examtaker_date" placeholder="<?php echo $this->lang->line('examtaker_date');?>" value="<?php echo $examtaker_date; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_startdatetime');?> <?php echo form_error('examtaker_startdatetime') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="examtaker_startdatetime" id="examtaker_startdatetime" placeholder="<?php echo $this->lang->line('examtaker_startdatetime');?>" value="<?php echo $examtaker_startdatetime; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_enddatetime');?> <?php echo form_error('examtaker_enddatetime') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="examtaker_enddatetime" id="examtaker_enddatetime" placeholder="<?php echo $this->lang->line('examtaker_enddatetime');?>" value="<?php echo $examtaker_enddatetime; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_exact_enddatetime');?> <?php echo form_error('examtaker_exact_enddatetime') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="examtaker_exact_enddatetime" id="examtaker_exact_enddatetime" placeholder="<?php echo $this->lang->line('examtaker_exact_enddatetime');?>" value="<?php echo $examtaker_exact_enddatetime; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_totalmark');?> <?php echo form_error('examtaker_totalmark') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="examtaker_totalmark" id="examtaker_totalmark" placeholder="<?php echo $this->lang->line('examtaker_totalmark');?>" value="<?php echo $examtaker_totalmark; ?>" maxlength="11"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_pass');?> <?php echo form_error('examtaker_pass') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="examtaker_pass" id="examtaker_pass" placeholder="<?php echo $this->lang->line('examtaker_pass');?>" value="<?php echo $examtaker_pass; ?>" maxlength="1" />           </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_remark');?> <?php echo form_error('examtaker_remark') ?>
          </label>
                            <div class="col-md-9"><textarea class="form-control" name="examtaker_remark" id="examtaker_remark" placeholder="<?php echo $this->lang->line('examtaker_remark');?>" rows="5" cols="50"><?php echo $examtaker_remark; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_created_at');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('examtaker_created_at') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="examtaker_created_at" id="examtaker_created_at" placeholder="<?php echo $this->lang->line('examtaker_created_at');?>" value="<?php echo $examtaker_created_at; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_updated_at');?> <?php echo form_error('examtaker_updated_at') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="examtaker_updated_at" id="examtaker_updated_at" placeholder="<?php echo $this->lang->line('examtaker_updated_at');?>" value="<?php echo $examtaker_updated_at; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_deleted_at');?> <?php echo form_error('examtaker_deleted_at') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="examtaker_deleted_at" id="examtaker_deleted_at" placeholder="<?php echo $this->lang->line('examtaker_deleted_at');?>" value="<?php echo $examtaker_deleted_at; ?>"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            <?php echo $this->lang->line('examtaker_lastchanged_by');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('examtaker_lastchanged_by') ?>
          </label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="examtaker_lastchanged_by" id="examtaker_lastchanged_by" placeholder="<?php echo $this->lang->line('examtaker_lastchanged_by');?>" value="<?php echo $examtaker_lastchanged_by; ?>"
                                    maxlength="11" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="examtaker_id" value="<?php echo (isset($id)?$id:" "); ?>" />
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
                                <a href="<?php echo site_url('examtaker') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
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