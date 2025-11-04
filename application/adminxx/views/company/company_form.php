<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('company');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('company');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
        </li>
    </ol>
    <div class="box  box-primary">
        <div class="box-header with-border">
            <i class="fa fa-file-text-o"></i>

            <h3 class="box-title"><?php echo $button ?> Company</h3>
            <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="row">
                <form action="<?php echo $action; ?>" method="post">
                <div class="col-md-6">

<!--                        <div class="row col-md-12">
                            <h5 class="pull-right">
                                <?php echo $this->lang->line('legend');?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span>
                                <?php echo $this->lang->line('required_field');?>
                            </h5>
                        </div>-->


    <div class="form-group">
        <label for="company_name"><?php echo $this->lang->line('company_name');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('company_name') ?></label>
        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="<?php echo $this->lang->line('company_name');?>" value="<?php echo $company_name; ?>" maxlength="255" />
    </div>

    <div class="form-group">
        <label for="company_address"><?php echo $this->lang->line('company_address');?> <?php echo form_error('company_address') ?></label>
        <textarea class="form-control" name="company_address" id="company_address" placeholder="<?php echo $this->lang->line('company_address');?>" rows="5" cols="50"><?php echo $company_address; ?></textarea>
    </div>

    <div class="form-group">
        <label for="company_userdepartment"><?php echo $this->lang->line('company_userdepartment');?> <?php echo form_error('company_userdepartment') ?></label>
        <input type="text" class="form-control" name="company_userdepartment" id="company_userdepartment" placeholder="<?php echo $this->lang->line('company_userdepartment');?>" value="<?php echo $company_userdepartment; ?>" maxlength="255"
                                />
    </div>

    <div class="form-group">
        <label for="company_registerednumber"><?php echo $this->lang->line('company_registerednumber');?> <?php echo form_error('company_registerednumber') ?></label>
        <input type="text" class="form-control" name="company_registerednumber" id="company_registerednumber" placeholder="<?php echo $this->lang->line('company_registerednumber');?>" value="<?php echo $company_registerednumber; ?>"
                                    maxlength="50" />
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="company_contact_person"><?php echo $this->lang->line('company_contact_person');?> <?php echo form_error('company_contact_person') ?></label>
        <input type="text" class="form-control" name="company_contact_person" id="company_contact_person" placeholder="<?php echo $this->lang->line('company_contact_person');?>" value="<?php echo $company_contact_person; ?>" maxlength="255"
                                />
    </div>

    <div class="form-group">
        <label for="company_contact_email"><?php echo $this->lang->line('company_contact_email');?> <?php echo form_error('company_contact_email') ?></label>
        <input type="text" class="form-control" name="company_contact_email" id="company_contact_email" placeholder="<?php echo $this->lang->line('company_contact_email');?>" value="<?php echo $company_contact_email; ?>" maxlength="150"
                                />
    </div>

    <div class="form-group">
        <label for="company_contact_phone"><?php echo $this->lang->line('company_contact_phone');?> <?php echo form_error('company_contact_phone') ?></label>
        <input type="text" class="form-control" name="company_contact_phone" id="company_contact_phone" placeholder="<?php echo $this->lang->line('company_contact_phone');?>" value="<?php echo $company_contact_phone; ?>" maxlength="50"
                                />
    </div>

    <div class="form-group">
        <label for="company_contact_fax"><?php echo $this->lang->line('company_contact_fax');?> <?php echo form_error('company_contact_fax') ?></label>
        <input type="text" class="form-control" name="company_contact_fax" id="company_contact_fax" placeholder="<?php echo $this->lang->line('company_contact_fax');?>" value="<?php echo $company_contact_fax; ?>" maxlength="50" />
    </div>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="company_id" value="<?php echo (isset($id)?$id:" "); ?>" />
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
                                <a href="<?php echo site_url('company') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
                            </div>
                        </div>
                    </div>
                </form>
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