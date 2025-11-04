<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('wipbriefingmanagement');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('wipbriefingmanagement');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
        </li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <?php echo $this->lang->line('wipbriefingmanagement');?>
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
                        <div class="form-group">
    						<label for="wipbriefingmanagement_date"><?php echo $this->lang->line('wipbriefingmanagement_date');?> <?php echo form_error('wipbriefingmanagement_date') ?></label>
    						<input type="text" class="form-control datepicker" name="wipbriefingmanagement_date" id="wipbriefingmanagement_date" placeholder="<?php echo $this->lang->line('wipbriefingmanagement_date');?>" value="<?php echo $wipbriefingmanagement_date; ?>"
                                />
  						</div>

  						<div class="form-group">
    						<label for="wipbriefingmanagement_slot"><?php echo $this->lang->line('wipbriefingmanagement_slot');?> <?php echo form_error('wipbriefingmanagement_slot') ?></label>
    						<input type="text" class="form-control isInteger" name="wipbriefingmanagement_slot" id="wipbriefingmanagement_slot" placeholder="<?php echo $this->lang->line('wipbriefingmanagement_slot');?>" value="<?php echo $wipbriefingmanagement_slot; ?>"
                                    maxlength="11" />
  						</div>
						<!--
                        <div class="row">
                            <label class="col-md-3 text-right">
            					<?php echo $this->lang->line('wipbriefingmanagement_slottaken');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wipbriefingmanagement_slottaken') ?>
          					</label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="wipbriefingmanagement_slottaken" id="wipbriefingmanagement_slottaken" placeholder="<?php echo $this->lang->line('wipbriefingmanagement_slottaken');?>" value="<?php echo $wipbriefingmanagement_slottaken; ?>"
                                    maxlength="11" />
                            </div>
                        </div>
						-->

						<div class="form-group">
    						<label for="wipbriefingmanagement_location"><?php echo $this->lang->line('wipbriefingmanagement_location');?> <?php echo form_error('wipbriefingmanagement_location') ?></label>
    						<input type="text" class="form-control" name="wipbriefingmanagement_location" id="wipbriefingmanagement_location" placeholder="<?php echo $this->lang->line('wipbriefingmanagement_location');?>" value="<?php echo $wipbriefingmanagement_location; ?>"
                                    maxlength="150" />
  						</div>

  						<div class="form-group">
    						<label for="wipbriefingmanagement_officer_pic"><?php echo $this->lang->line('wipbriefingmanagement_officer_pic');?> <?php echo form_error('wipbriefingmanagement_officer_pic') ?></label>
    						<input type="text" class="form-control isInteger" name="wipbriefingmanagement_officer_pic" id="wipbriefingmanagement_officer_pic" placeholder="<?php echo $this->lang->line('wipbriefingmanagement_officer_pic');?>"
                                    value="<?php echo $wipbriefingmanagement_officer_pic; ?>" maxlength="11" />
  						</div>

  						<div class="form-group">
    						<label for="wipbriefingmanagement_remark"><?php echo $this->lang->line('wipbriefingmanagement_remark');?> <?php echo form_error('wipbriefingmanagement_remark') ?></label>
    						<textarea class="form-control" name="wipbriefingmanagement_remark" id="wipbriefingmanagement_remark" placeholder="<?php echo $this->lang->line('wipbriefingmanagement_remark');?>" rows="5" cols="50"><?php echo $wipbriefingmanagement_remark; ?></textarea>
  						</div>

                     
						<!--
                        <div class="row">
                            <label class="col-md-3 text-right">
            					<?php echo $this->lang->line('wipbriefingmanagement_created_at');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wipbriefingmanagement_created_at') ?>
          					</label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="wipbriefingmanagement_created_at" id="wipbriefingmanagement_created_at" placeholder="<?php echo $this->lang->line('wipbriefingmanagement_created_at');?>"
                                    value="<?php echo $wipbriefingmanagement_created_at; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            					<?php echo $this->lang->line('wipbriefingmanagement_updated_at');?> <?php echo form_error('wipbriefingmanagement_updated_at') ?>
          					</label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="wipbriefingmanagement_updated_at" id="wipbriefingmanagement_updated_at" placeholder="<?php echo $this->lang->line('wipbriefingmanagement_updated_at');?>"
                                    value="<?php echo $wipbriefingmanagement_updated_at; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            					<?php echo $this->lang->line('wipbriefingmanagement_deleted_at');?> <?php echo form_error('wipbriefingmanagement_deleted_at') ?>
          					</label>
                            <div class="col-md-9"><input type="text" class="form-control datetimepicker" name="wipbriefingmanagement_deleted_at" id="wipbriefingmanagement_deleted_at" placeholder="<?php echo $this->lang->line('wipbriefingmanagement_deleted_at');?>"
                                    value="<?php echo $wipbriefingmanagement_deleted_at; ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 text-right">
            					<?php echo $this->lang->line('wipbriefingmanagement_lastchanged_by');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wipbriefingmanagement_lastchanged_by') ?>
          					</label>
                            <div class="col-md-9"><input type="text" class="form-control isInteger" name="wipbriefingmanagement_lastchanged_by" id="wipbriefingmanagement_lastchanged_by" placeholder="<?php echo $this->lang->line('wipbriefingmanagement_lastchanged_by');?>"
                                    value="<?php echo $wipbriefingmanagement_lastchanged_by; ?>" maxlength="10" />
                            </div>
                        </div>
						-->
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="wipbriefingmanagement_id" value="<?php echo (isset($id)?$id:" "); ?>" />
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
                                <a href="<?php echo site_url('wipbriefingmanagement') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
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