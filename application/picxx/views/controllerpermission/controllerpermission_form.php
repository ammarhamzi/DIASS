<style type="text/css">
.titlecol {
    width: 20% !important;
}
</style>
<div class="container-fluid">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('controllerpermission'); ?> <?php echo $button; ?></h4>
        </div>
        <div class="panel-body">


            <div class="row">
                <div class="col-md-9">
                    <form autocomplete="off" action="<?php echo $action; ?>" method="post">
                        <div class="row col-md-12">
                            <h5 class="pull-right"><?php echo $this->lang->line('legend'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo $this->lang->line('required_field'); ?></h5>
                        </div>


                        <div class="row">
                            <label class="col-md-3 text-right">
                                <?php echo $this->lang->line('cp_controller_id'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('cp_controller_id'); ?>
                            </label>

                            <div class="col-md-9"><select class="form-control select2" name="cp_controller_id" id="cp_controller_id">
                                    <option value="">-SELECT-</option>
                                    <?php
foreach ($reg_controller as $value) {
    ?>
                                        <option value="<?php echo $value->control_id; ?>" <?php
echo ($value->control_id === $cp_controller_id
        ? 'selected="selected"' : "");
    ?>><?php echo $value->control_name; ?></option>
                                                <?php
}
?>
                                </select>
                                         </div></div>

                        <div class="row">
                            <label class="col-md-3 text-right">
<?php echo $this->lang->line('cp_usergroup'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('cp_usergroup'); ?>
                            </label>

                            <div class="col-md-9"><select class="form-control select2" name="cp_usergroup" id="cp_usergroup">
                                    <option value="">-SELECT-</option>
                                    <?php
foreach ($usergroup as $value) {
    ?>
                                        <option value="<?php echo $value->usergroup_id; ?>" <?php echo ($value->usergroup_id
        === $cp_usergroup ? 'selected="selected"'
        : "");
    ?>><?php echo $value->usergroup_name; ?></option>
    <?php
}
?>
                                </select>
                                         </div></div>
                        <table class="table">
                            <tr>
                                <th class="titlecol"><?php echo $this->lang->line('showlist'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('showlist'); ?></th>
                                <td><?php
foreach ($dropdown_showlist as $value) {
    ?>
                                        <p><input type="radio" name="showlist" id="showlist" value="<?php echo $value->id; ?>" <?php echo ($value->id
        == $showlist ? 'checked="checked"' : "");
    ?> /><?php echo $value->value; ?></p>
    <?php
}
?></td>
                            </tr>
                            <tr>
                                <th class="titlecol"><?php echo $this->lang->line('cp_create'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('cp_create'); ?></th>
                                <td><?php
foreach ($dropdown_cp_create as $value) {
    ?>
                                        <p><input type="radio" name="cp_create" id="cp_create" value="<?php echo $value->id; ?>" <?php echo ($value->id
        == $cp_create ? 'checked="checked"' : "");
    ?> /><?php echo $value->value; ?></p>
    <?php
}
?></td>
                            </tr>
                            <tr>
                                <th class="titlecol"><?php echo $this->lang->line('cp_update'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('cp_update'); ?></th>
                                <td><?php
foreach ($dropdown_cp_update as $value) {
    ?>
                                        <p><input type="radio" name="cp_update" id="cp_update" value="<?php echo $value->id; ?>" <?php echo ($value->id
        == $cp_update ? 'checked="checked"' : "");
    ?> /><?php echo $value->value; ?></p>
                                        <?php
}
?></td>
                            </tr>
                            <tr>
                                <th class="titlecol"><?php echo $this->lang->line('cp_delete'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('cp_delete'); ?></th>
                                <td><?php
foreach ($dropdown_cp_delete as $value) {
    ?>
                                        <p><input type="radio" name="cp_delete" id="cp_delete" value="<?php echo $value->id; ?>" <?php echo ($value->id
        == $cp_delete ? 'checked="checked"' : "");
    ?> /><?php echo $value->value; ?></p>
                                        <?php
}
?></td>
                            </tr>
                            <tr>
                                <th class="titlecol"><?php echo $this->lang->line('cp_read'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('cp_read'); ?></th>
                                <td><?php
foreach ($dropdown_cp_read as $value) {
    ?>
                                        <p><input type="radio" name="cp_read" id="cp_read" value="<?php echo $value->id; ?>" <?php echo ($value->id
        == $cp_read ? 'checked="checked"' : "");
    ?> /><?php echo $value->value; ?></p>
                                        <?php
}
?></td>
                            </tr>
                            <tr>
                                <th class="titlecol"><?php echo $this->lang->line('printlist'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('printlist'); ?></th>
                                <td><?php
foreach ($dropdown_printlist as $value) {
    ?>
                                        <p><input type="radio" name="printlist" id="printlist" value="<?php echo $value->id; ?>" <?php echo ($value->id
        == $printlist ? 'checked="checked"' : "");
    ?> /><?php echo $value->value; ?></p>
                                           <?php
}
?></td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="cp_id" value="<?php echo (isset($id)
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
    </div>
</div>


<?php
if (isset($id)) {
    ?>
    <script>
    $(document).ready(function ()
      {
        var arr =['cp_controller_id', 'cp_usergroup'];

        $.each(arr, function (i, val)
          {
            $("#" + val).prop("disabled", true);
            $("#" + val).after("<input type='hidden' name='" + val + "' id='" + val + "' value='" + $("#" + val).val() + "'>");
          }
        );
      }
    );
    </script>
    <?php
}
?>
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
    $(".clonedInput:first").before('<div id="add-buttons"><input class="btn btn-success" type="button" id="btnAdd" value="<?php echo $this->lang->line('add_more_child'); ?>"></div><hr style="width: 100%">');
    if ($('.clonedInput').length > 1) {
      $('.clonedInput').each(function ()
        {
          var pos = $(this).attr('id');
          pos = pos.replace('testingDiv', '');
          $(this).append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="<?php echo $this->lang->line('x'); ?>" position="' + pos + '"/>');
          $(this).append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="<?php echo $this->lang->line('clear'); ?>" position="' + pos + '"/><hr style="width: 100%">');
        }
      );

    } else {
      $(".clonedInput:first").append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="<?php echo $this->lang->line('x'); ?>" position="1" disabled="disabled"/>');
      $(".clonedInput:first").append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="<?php echo $this->lang->line('clear'); ?>" position="1"/><hr style="width: 100%">');
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
          $('#btnAdd').attr('disabled', true).prop('value', "<?php echo $this->lang->line('reach_limit'); ?>");
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
            $('#btnAdd').attr('disabled', false).prop('value', "<?php echo $this->lang->line('add_to_form'); ?>");

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

