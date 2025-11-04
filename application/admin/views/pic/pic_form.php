<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('pic');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('pic');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
        </li>
    </ol>
                    <div class="box  box-primary">
                        <div class="box-header with-border">
                                    <i class="fa fa-file-text-o"></i>

                                    <h3 class="box-title"><?php echo $button ?> PIC</h3>
                                    <div class="box-tools pull-right">

                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                        <!-- /.box-header -->
                        <div class="box-body">


                    <form action="<?php echo $action; ?>" method="post">
<!--                        <div class="row col-md-12">
                            <h5 class="pull-right">
                                <?php echo $this->lang->line('legend');?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span>
                                <?php echo $this->lang->line('required_field');?>
                            </h5>
                        </div>-->
<div class="row">
    <div class="col-md-6">

        <div class="form-group">
        <label for="pic_company_id"><?php echo $this->lang->line('pic_company_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('pic_company_id') ?></label>
        <select class="form-control select2" name="pic_company_id" id="pic_company_id">
<option value="">-SELECT-</option>
<?php
foreach ($company as $value) {
?>
<option value="<?php echo $value->company_id;?>" <?php echo ($value->company_id==trim($pic_company_id)?'selected="selected"':"");?>><?php echo $value->company_name;?></option>
<?php
}
?>
</select>
    </div>

    <div class="form-group">
        <label for="pic_fullname"><?php echo $this->lang->line('pic_fullname');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('pic_fullname') ?></label>
        <input type="text" class="form-control" name="pic_fullname" id="pic_fullname" placeholder="<?php echo $this->lang->line('pic_fullname');?>" value="<?php echo $pic_fullname; ?>" maxlength="255" />
    </div>

    <div class="form-group">
        <label for="pic_ic"><?php echo $this->lang->line('pic_ic');?> <?php echo form_error('pic_ic') ?> </label>
        <input type="text" class="form-control" name="pic_ic" id="pic_ic" placeholder="<?php echo $this->lang->line('pic_ic');?>" value="<?php echo $pic_ic; ?>" maxlength="12" />
    </div>

    <div class="form-group">
        <label for="pic_phoneoffice"><?php echo $this->lang->line('pic_phoneoffice');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('pic_phoneoffice') ?></label>
        <input type="text" class="form-control" name="pic_phoneoffice" id="pic_phoneoffice" placeholder="<?php echo $this->lang->line('pic_phoneoffice');?>" value="<?php echo $pic_phoneoffice; ?>" maxlength="25" />
    </div>

    <div class="form-group">
        <label for="pic_handphone"><?php echo $this->lang->line('pic_handphone');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('pic_handphone') ?></label>
        <input type="text" class="form-control" name="pic_handphone" id="pic_handphone" placeholder="<?php echo $this->lang->line('pic_handphone');?>" value="<?php echo $pic_handphone; ?>" maxlength="25" />
    </div>


<!--                                                <div class="row">
                                                        <label class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_company_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('pic_company_id') ?>
                    </label>

                                                        <div class="col-md-9"><select class="form-control select2" name="pic_company_id" id="pic_company_id">
<option value="">-SELECT-</option>
<?php
foreach ($company as $value) {
?>
<option value="<?php echo $value->company_id;?>" <?php echo ($value->company_id==trim($pic_company_id)?'selected="selected"':"");?>><?php echo $value->company_name;?></option>
<?php
}
?>
</select>
                                                        </div>
                                                </div>-->

<!--                                                <div class="row">
                                                        <label class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_fullname');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('pic_fullname') ?>
                    </label>
                                                        <div class="col-md-9"><input type="text" class="form-control" name="pic_fullname" id="pic_fullname" placeholder="<?php echo $this->lang->line('pic_fullname');?>" value="<?php echo $pic_fullname; ?>" maxlength="255" />
                                                        </div>
                                                </div>-->

<!--                                                <div class="row">
                                                        <label class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_ic');?> <?php echo form_error('pic_ic') ?>
                    </label>
                                                        <div class="col-md-9"><input type="text" class="form-control" name="pic_ic" id="pic_ic" placeholder="<?php echo $this->lang->line('pic_ic');?>" value="<?php echo $pic_ic; ?>" maxlength="12" />
                                                        </div>
                                                </div>-->

<!--                                                <div class="row">
                                                        <label class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_phoneoffice');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('pic_phoneoffice') ?>
                    </label>
                                                        <div class="col-md-9"><input type="text" class="form-control" name="pic_phoneoffice" id="pic_phoneoffice" placeholder="<?php echo $this->lang->line('pic_phoneoffice');?>" value="<?php echo $pic_phoneoffice; ?>" maxlength="25" />
                                                        </div>
                                                </div>-->

<!--                                                <div class="row">
                                                        <label class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_handphone');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('pic_handphone') ?>
                    </label>
                                                        <div class="col-md-9"><input type="text" class="form-control" name="pic_handphone" id="pic_handphone" placeholder="<?php echo $this->lang->line('pic_handphone');?>" value="<?php echo $pic_handphone; ?>" maxlength="25" />
                                                        </div>
                                                </div>-->

<!--                                                <div class="row">
                                                        <label class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_email');?> <?php echo form_error('pic_email') ?>
                    </label>
                                                        <div class="col-md-9"><input type="text" class="form-control" name="pic_email" id="pic_email" placeholder="<?php echo $this->lang->line('pic_email');?>" value="<?php echo $pic_email; ?>" maxlength="255" />
                                                        </div>
                                                </div>-->


    </div>
    <div class="col-md-6">

    <div class="form-group">
        <label for="pic_email"><?php echo $this->lang->line('pic_email');?>/Username <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('pic_email') ?></label>
        <input type="text" class="form-control" name="pic_email" id="pic_email" placeholder="<?php echo $this->lang->line('pic_email');?>" value="<?php echo $pic_email; ?>" maxlength="255" />
    </div>
                        <?php
                        if($button=='Create'){
?>
    <div class="form-group">
        <label for="user_password"><?php echo $this->lang->line('user_password'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('user_password'); ?></label>
        <input type="text" class="form-control" name="user_password" id="user_password" placeholder="<?php echo $this->lang->line('user_password'); ?>"value="" maxlength="250" />
    </div>
    <?php
                        }else{
?>
    <div class="form-group">
        <label for="change_password_todefault"><?php echo $this->lang->line('user_password'); ?>  </label> <span style="font-size: 9pt">check this for PICs that forgot their password & not use airport email.</span><br>
        <input type="checkbox" name="change_password_todefault" id="change_password_todefault" value="changetodefault" /> Change Password to default (!Asd123#)
    </div>
<?php
                        }
                        ?>
<!--                        <div class="row">
                            <label class="col-md-3 text-right">
                                <?php echo $this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('user_username'); ?>
                            </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="user_username" id="user_username" placeholder="<?php echo $this->lang->line('user_username'); ?>"value="<?php echo $user_username; ?>" maxlength="50" />
                                         </div></div>-->
<!--                        <?php
                        if($button=='Create'){
?>
                        <div class="row">
                            <label class="col-md-3 text-right">
                                <?php echo $this->lang->line('user_password'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('user_password'); ?>
                            </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="user_password" id="user_password" placeholder="<?php echo $this->lang->line('user_password'); ?>"value="" maxlength="250" />
                                         </div></div>
<?php
                        }
                        ?>-->


<!--                        <div class="row">
                            <label class="col-md-3 text-right">
                                <?php echo $this->lang->line('user_name'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('user_name'); ?>
                            </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="user_name" id="user_name" placeholder="<?php echo $this->lang->line('user_name'); ?>"value="<?php echo $user_name; ?>" maxlength="150" />
                                         </div></div>-->

<!--                        <div class="row">
                            <label class="col-md-3 text-right">
                                <?php echo $this->lang->line('user_email'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('user_email'); ?>
                            </label>
                            <div class="col-md-9"><input type="text" class="form-control" name="user_email" id="user_email" placeholder="<?php echo $this->lang->line('user_email'); ?>"value="<?php echo $user_email; ?>" maxlength="100" />
                                         </div></div>-->


<!--                        <div class="row">
                            <label class="col-md-3 text-right">
                                <?php echo $this->lang->line('user_photo'); ?> <?php echo form_error('user_photo'); ?>
                            </label>
                            <div class="col-md-9"><div class = "upload-image-messages"><?php
if ($user_photo) {
    ?>
                                        <p><img src = "<?php echo base_url(); ?>resources/shared_img/<?php echo ($user_photo
        ? $user_photo : 'system/no-image.jpg');
    ?>" width="100" height="100" /></p>
                                            <?php
}
?></div><input type="hidden" class="form-control" id="user_photo" name="user_photo" value="<?php echo (isset($user_photo)
    ? $user_photo : "")
; ?>" readonly><div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-remote-file">Browse …

                                        </span>
                                    </span>
                                    <input type="text" class="form-control display_user_photo" value="<?php echo (isset($user_photo)
    ? $user_photo : "")
; ?>" readonly>
                                </div><div class="uploadrestrict">(supported png,jpg,jpeg)</div></div></div>-->
                                                <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                                <input type="hidden" name="pic_id" value="<?php echo (isset($id)?$id:" "); ?>" />
<input type="hidden" name="user_id" value="<?php echo (isset($user_id)?$user_id:" ");?>" />
                                                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
                                                                <a href="<?php echo site_url('pic') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
                                                        </div>
                                                </div>
    </div>

</div>

                    </form>

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