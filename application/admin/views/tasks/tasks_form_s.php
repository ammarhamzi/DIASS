
<div class="container-fluid">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('tasks'); ?> <?php echo $button; ?></h4>
            <h5 class="pull-right"><?php echo $this->lang->line('legend'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo $this->lang->line('required_field'); ?></h5>
        </div>
        <div class="panel-body">


            <form action="<?php echo $action; ?>" method="post">

                <?php
if ($button == "Create") {
    $attr = "display:none;";
} else {
    $attr = "";
}
?>
                <div class="row" style="<?php echo $attr; ?>">
                    <label class="col-md-4">
                        ID
                    </label>
                    <div class="col-md-8"><input type="text" class="form-control" name="task_id" id="task_id" value="<?php echo 'T'; ?><?php printf("%07d",
    $task_id);
?>" maxlength="200" readonly="readonly" />
                                 </div></div>

                <div class="row">
                    <label class="col-md-4">
<?php echo $this->lang->line('task_name'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo form_error('task_name'); ?>
                    </label>
                    <div class="col-md-8"><input type="text" class="form-control" name="task_name" id="task_name" placeholder="<?php echo $this->lang->line('task_name'); ?>"value="<?php echo $task_name; ?>" maxlength="200" <?php echo ($button
    == "Update" ? 'readonly="readonly"'
    : '');
?> />
                                 </div></div>


                <div class="row">
                    <label class="col-md-4">
<?php echo $this->lang->line('task_desc'); ?> <?php echo form_error('task_desc'); ?>
                    </label><div class="col-md-8"><textarea class="form-control" name="task_desc" id="task_desc" placeholder="<?php echo $this->lang->line('task_desc'); ?>" rows="5" cols="50"><?php echo $task_desc; ?></textarea>
                                 </div></div>

                <div class="row">
                    <label class="col-md-4">
<?php echo $this->lang->line('task_weight'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo form_error('task_weight'); ?>
                    </label>

                    <div class="col-md-8"><select class="form-control select2" name="task_weight" id="task_weight">
                            <option value="">-SELECT-</option>
                            <?php
foreach ($dropdown_task_weight as $value) {

    if ($value->id === $task_weight) {
        ?>
                                    <option value="<?php echo $value->id; ?>" <?php echo set_select('task_weight',
            $value->id, true);
        ?>><?php echo $value->value; ?></option>
                                            <?php
} else {
        ?>
                                    <option value="<?php echo $value->id; ?>" <?php echo set_select('task_weight',
            $value->id);
        ?>><?php echo $value->value; ?></option>
        <?php
}
}
?>
                        </select>
                                 </div></div>

                <div class="row">
                    <label class="col-md-4">
                            <?php echo $this->lang->line('task_priority'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo form_error('task_priority'); ?>
                    </label>

                    <div class="col-md-8"><select class="form-control select2" name="task_priority" id="task_priority">
                            <option value="">-SELECT-</option>
                                    <?php
foreach ($dropdown_task_priority as $value) {

    if ($value->id === $task_priority) {
        ?>
                                    <option value="<?php echo $value->id; ?>" <?php echo set_select('task_priority',
            $value->id, true);
        ?>><?php echo $value->value; ?></option>
                                            <?php
} else {
        ?>
                                    <option value="<?php echo $value->id; ?>" <?php echo set_select('task_priority',
            $value->id);
        ?>><?php echo $value->value; ?></option>
        <?php
}
}
?>
                        </select>
                                 </div></div>

                <div class="row">
                    <label class="col-md-4">
                        Related Task <?php echo form_error('task_from'); ?>
                    </label>
                    <div class="col-md-8"><select class="form-control select2" name="task_related" id="task_related">
                            <option value="">-SELECT-</option>
                            <?php
foreach ($all_task as $value) {
    ?>
                                <option value="<?php echo $value->task_id; ?>" <?php echo ($value->task_id
        === $task_related ? 'selected="selected"' : "");
    ?>><?php echo 'T'; ?><?php printf("%07d",
        $value->task_id);
    ?></option>
    <?php
}
?>
                        </select>
                                 </div></div>

                <div class="row">
                    <label class="col-md-4">
                            <?php echo $this->lang->line('task_to'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo form_error('task_to'); ?>
                    </label>

                    <div class="col-md-8"><select class="form-control select2" name="task_to" id="task_to">
                            <option value="">-SELECT-</option>
<?php
foreach ($wf_admin as $value) {
    ?>
                                <option value="<?php echo $value->user_id; ?>" <?php
echo ($value->user_id === $task_to || $value->user_id === $this->session->userdata('id')
        ? 'selected="selected"' : ($button == "Update" ? 'disabled="disabled"'
            : ''));
    ?>><?php echo $value->user_username; ?></option>
    <?php
}
?>
                        </select>
                                 </div></div>


                <div class="row">
                    <label class="col-md-4">
                                    <?php echo $this->lang->line('task_from'); ?> <?php echo form_error('task_from'); ?>
                    </label>
                    <div class="col-md-8"><select class="form-control select2" name="task_from" id="task_from">
                            <option value="">-SELECT-</option>
<?php
foreach ($wf_admin as $value) {
    ?>
                                <option value="<?php echo $value->user_id; ?>" <?php echo ($value->user_id
        === $task_from ? 'selected="selected"' : "");
    ?>><?php echo $value->user_username; ?></option>
    <?php
}
?>
                        </select>
                                 </div></div>

                <div class="row">
                    <label class="col-md-4">
                        Request <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo form_error('task_date'); ?>
                    </label>
                    <div class="col-md-8"><input type="text" class="form-control datepicker_local" name="task_date" id="task_date" placeholder="<?php echo $this->lang->line('task_date'); ?>" value="<?php echo $task_date; ?>" />
                                 </div></div>


                <div class="row">
                    <label class="col-md-4">
                        Finish <?php echo form_error('task_duedate'); ?>
                    </label><div class="col-md-8"><input type="text" class="form-control datepicker_local" name="task_duedate" id="task_duedate" placeholder="<?php echo $this->lang->line('task_duedate'); ?>" value="<?php echo $task_duedate; ?>" />
                                 </div></div>

                <div class="row">
                    <label class="col-md-4">
                        Work Minutes <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo form_error('task_hour'); ?>
                    </label>
                    <div class="col-md-8"><input type="text" class="form-control" name="task_hour" id="task_hour" placeholder="<?php echo $this->lang->line('task_hour'); ?>"value="<?php echo $task_hour; ?>" maxlength="200" />
                                 </div></div>

                <div class="row">
                    <label class="col-md-4">
                                    <?php echo $this->lang->line('task_status'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo form_error('task_status'); ?>
                    </label>

                    <div class="col-md-8"><select class="form-control select2" name="task_status" id="task_status">
                                    <?php
foreach ($dropdown_task_status as $value) {

    if ($value->id === $task_status) {
        ?>
                                    <option value="<?php echo $value->id; ?>" <?php echo set_select('task_status',
            $value->id, true);
        ?>><?php echo $value->value; ?></option>
                                <?php
} else {
        ?>
                                    <option value="<?php echo $value->id; ?>" <?php echo set_select('task_status',
            $value->id);
        ?>><?php echo $value->value; ?></option>
        <?php
}
}
?>
                        </select>
                                 </div></div>

                <div class="row">
                    <label class="col-md-4">
                                <?php echo $this->lang->line('task_progress'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo form_error('task_progress'); ?>
                    </label>
                    <div class="col-md-8"><input type="text" class="form-control isCurrency" name="task_progress" id="task_progress" placeholder="<?php echo $this->lang->line('task_progress'); ?>" value="<?php echo $task_progress; ?>" maxlength="3" />
                                 </div></div>

                <div class="row">
                    <label class="col-md-3 text-right">
<?php echo $this->lang->line('task_image'); ?> <?php echo form_error('task_image'); ?>
                    </label>
                    <div class="col-md-9"><div class = "upload-image-messages"><?php
if ($task_image) {
    ?>
                                <p><img src = "<?php echo base_url(); ?>resources/shared_img/<?php echo ($task_image
        ? $task_image : 'system/no-image.jpg');
    ?>" width="100" height="100" /></p>
                            <?php
}
?></div><input type="hidden" class="form-control" id="task_image" name="task_image" value="<?php echo (isset($task_image)
    ? $task_image : "")
; ?>" readonly><div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-remote-file">Browse …

                                </span>
                            </span>
                            <input type="text" class="form-control display_task_image" value="<?php echo (isset($task_image)
    ? $task_image : "")
; ?>" readonly>
                        </div><div class="uploadrestrict">(supported png,jpg,jpeg)</div></div></div>

                <div class="row">
                    <label class="col-md-4">
<?php echo $this->lang->line('task_remark'); ?> <?php echo form_error('task_remark'); ?>
                    </label><div class="col-md-8"><textarea class="form-control" name="task_remark" id="task_remark" placeholder="<?php echo $this->lang->line('task_remark'); ?>" rows="5" cols="50"><?php echo $task_remark; ?></textarea>

                        <input id="task_current" name="task_current" type="checkbox" value="1" <?php echo ($task_current
    == '1' ? 'checked="checked"' : "");
?>> Currently doing this task.<br><br>
                                 </div></div>

                <div class="row">
                    <div class="col-md-offset-4 col-md-8">
                        <input type="hidden" name="task_id" value="<?php echo (isset($id)
    ? $id : "");
?>" />
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button; ?></button>
                        <a href="javascript:parent.$.fancybox.close();" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo form_open_multipart('upload/do_upload',
    ['class' => 'upload-image']);
?>

<div class="input-group" style="display:none;">
    <span class="input-group-btn">
        <span class="btn btn-default btn-file">Browse &hellip;
            <input type="file" multiple = "multiple" class = "form-control" id="uploadimage" name="uploadfile[]">
        </span>
    </span>
    <input type="text" class="form-control" readonly><input type="submit" name = "submit" value="Upload" class = "btn btn-primary"/><input id="filetype" type="hidden" name="filetype" value="image">
</div>
</form><?php echo form_open_multipart('upload/do_upload',
    ['class' => 'upload-docs']);
?>

<div class="input-group" style="display:none;">
    <span class="input-group-btn">
        <span class="btn btn-default btn-file">Browse &hellip;
            <input type="file" multiple = "multiple" class = "form-control" id="uploadimage" name="uploadfile[]">
        </span>
    </span>
    <input type="text" class="form-control" readonly><input type="submit" name = "submit" value="Upload" class = "btn btn-primary"/><input id="filetype" type="hidden" name="filetype" value="image">
</div>
</form>
<script>
jQuery(document).ready(function ($)
  {

    var options = {
    beforeSend: function () {
        // Replace this with your loading gif image
        $(".upload-image-messages").html('<p><img src = "<?php echo base_url(); ?>resources/shared_img/system/ajax-loader.gif" class = "loader" /></p>');
      },
    complete: function (response) {
        // Output AJAX response to the div container
        arr = response.responseText.split('*');
        console.log(arr);
        if (arr[1] == "success") {
          $("#task_image").val(arr[0]);

          $(".upload-image-messages").html('<p><img src = "<?php echo base_url(); ?>resources/shared_img/' + arr[0] + '" width="100" height="100" /></p>');
        } else {
          $(".upload-image-messages").html('<p>' + arr[0] + '</p>');
        }
      }
    };
    // Submit the form
    $(".upload-image").ajaxForm(options);

    return false;

  }
);
</script>
<script>
$(document).ready(function ()
  {

    $(".btn-remote-file").click(function ()
      {
        $('input[type=file]').trigger('click');
      }
    );

    $(document).on('change', '.btn-file :file', function ()
      {
        var input = $(this),
        numFiles = input.get(0).files? input.get(0).files.length: 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect',[numFiles, label]);
      }
    );

    $(document).ready(function ()
      {
        $('.btn-file :file').on('fileselect', function (event, numFiles, label)
          {

            var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1? numFiles + ' files selected': label;

            if (input.length) {
              input.val(log);

              $(this).parents('.input-group').find(":submit").click();
            } else {
              //if( log ) alert(log);
            }

          }
        );
      }
    );
  }
);
</script>
<script>
function clear_form_elements(id) {
  jQuery("#testingDiv" + id).find(':input').each(function ()
    {
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
    }
  );
}
$(function ()
  {
    $(".clonedInput:first").before('<div id="add-buttons"><input class="btn btn-success" type="button" id="btnAdd" value="[ + ] add more child"></div><hr style="width: 100%">');
    if ($('.clonedInput').length > 1) {
      $('.clonedInput').each(function ()
        {
          var pos = $(this).attr('id');
          pos = pos.replace('testingDiv', '');
          $(this).append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="X" position="' + pos + '"/>');
          $(this).append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="Clear" position="' + pos + '"/><hr style="width: 100%">');
        }
      );

    } else {
      $(".clonedInput:first").append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="X" position="1" disabled="disabled"/>');
      $(".clonedInput:first").append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="Clear" position="1"/><hr style="width: 100%">');
    }

    //$('#btnAdd').click(function () {
    $('body').on('click', '#btnAdd', function ()
      {
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
        if (newNum == 5)
          $('#btnAdd').attr('disabled', true).prop('value', "You've reached the limit");
      }
    );

    $('body').on('click', '#btnDel', function ()
      {
        //$('#btnDel').click(function () {
        var position = $(this).attr("position");
        var num = $('.clonedInput').length;
        $('#testingDiv' + position).slideUp('slow', function ()
          {
            $(this).remove();
            // if only one element remains, disable the "remove" button
            if (num - 1 === 1) {
              $('#btnDel:last').attr('disabled', true);
            }
            // enable the "add" button
            $('#btnAdd').attr('disabled', false).prop('value', "[ + ] add to this form");

          }
        );
      }
    );

    $('body').on('click', '#btnClear', function ()
      {
        var position = $(this).attr("position");
        clear_form_elements(position);
      }
    );

  }
);
</script>
<script>
$(document).ready(function ()
  {
    $("#task_date").change(function ()
      {
        //$("#task_duedate").val($("#task_date").val());
      }
    );
    $("#task_status").change(function ()
      {
        if ($("#task_status").val() == "3") {
          $("#task_progress").val("100");
        } else {
          $("#task_progress").val("0");
        }
      }
    );
  }
);
</script>
