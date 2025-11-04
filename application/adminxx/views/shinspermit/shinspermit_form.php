<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
<ol class="breadcrumb">
  <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
  <li><a href="<?php echo site_url('shinspermit');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('shinspermit');?> <?php echo $this->lang->line('list');?></a></li>
  <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('form');?> <?php echo $button ?></li>
</ol>
<div class="panel panel-info">
  <div class="panel-heading">
<h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('shinspermit');?> <?php echo $button ?></h4>
  </div>
  <div class="panel-body">

      
<div class="row">
    <div class="col-md-9">
      <form action="<?php echo $action; ?>" method="post">
<div class="row col-md-12">
<h5 class="pull-right"><?php echo $this->lang->line('legend');?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo $this->lang->line('required_field');?></h5>
</div>
         

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_permit_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('shinspermit_permit_id') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="shinspermit_permit_id" id="shinspermit_permit_id" placeholder="<?php echo $this->lang->line('shinspermit_permit_id');?>" value="<?php echo $shinspermit_permit_id; ?>" maxlength="11" />
         </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_vehicle_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('shinspermit_vehicle_id') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="shinspermit_vehicle_id" id="shinspermit_vehicle_id" placeholder="<?php echo $this->lang->line('shinspermit_vehicle_id');?>" value="<?php echo $shinspermit_vehicle_id; ?>" maxlength="11" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_required_briefing');?> <?php echo form_error('shinspermit_required_briefing') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="shinspermit_required_briefing" id="shinspermit_required_briefing" placeholder="<?php echo $this->lang->line('shinspermit_required_briefing');?>" value="<?php echo $shinspermit_required_briefing; ?>" maxlength="1"/>
          </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_attendbriefing');?> <?php echo form_error('shinspermit_attendbriefing') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="shinspermit_attendbriefing" id="shinspermit_attendbriefing" placeholder="<?php echo $this->lang->line('shinspermit_attendbriefing');?>" value="<?php echo $shinspermit_attendbriefing; ?>" maxlength="1"/>
          </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_approved_to_inspect');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('shinspermit_approved_to_inspect') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="shinspermit_approved_to_inspect" id="shinspermit_approved_to_inspect" placeholder="<?php echo $this->lang->line('shinspermit_approved_to_inspect');?>" value="<?php echo $shinspermit_approved_to_inspect; ?>" maxlength="11" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_ownchecked_by');?> <?php echo form_error('shinspermit_ownchecked_by') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="shinspermit_ownchecked_by" id="shinspermit_ownchecked_by" placeholder="<?php echo $this->lang->line('shinspermit_ownchecked_by');?>"value="<?php echo $shinspermit_ownchecked_by; ?>" maxlength="255" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_ownchecked_date');?> <?php echo form_error('shinspermit_ownchecked_date') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datetimepicker" name="shinspermit_ownchecked_date" id="shinspermit_ownchecked_date" placeholder="<?php echo $this->lang->line('shinspermit_ownchecked_date');?>" value="<?php echo $shinspermit_ownchecked_date; ?>" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_ownverified_by');?> <?php echo form_error('shinspermit_ownverified_by') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="shinspermit_ownverified_by" id="shinspermit_ownverified_by" placeholder="<?php echo $this->lang->line('shinspermit_ownverified_by');?>"value="<?php echo $shinspermit_ownverified_by; ?>" maxlength="255" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_ownverified_date');?> <?php echo form_error('shinspermit_ownverified_date') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datepicker" name="shinspermit_ownverified_date" id="shinspermit_ownverified_date" placeholder="<?php echo $this->lang->line('shinspermit_ownverified_date');?>" value="<?php echo $shinspermit_ownverified_date; ?>" />
         </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_result');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('shinspermit_result') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control" name="shinspermit_result" id="shinspermit_result" placeholder="<?php echo $this->lang->line('shinspermit_result');?>"value="<?php echo $shinspermit_result; ?>" maxlength="8" />
         </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_result_inspector_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('shinspermit_result_inspector_id') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="shinspermit_result_inspector_id" id="shinspermit_result_inspector_id" placeholder="<?php echo $this->lang->line('shinspermit_result_inspector_id');?>" value="<?php echo $shinspermit_result_inspector_id; ?>" maxlength="11" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_inspection_date');?> <?php echo form_error('shinspermit_inspection_date') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datetimepicker" name="shinspermit_inspection_date" id="shinspermit_inspection_date" placeholder="<?php echo $this->lang->line('shinspermit_inspection_date');?>" value="<?php echo $shinspermit_inspection_date; ?>" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_retest_result');?> <?php echo form_error('shinspermit_retest_result') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="shinspermit_retest_result" id="shinspermit_retest_result" placeholder="<?php echo $this->lang->line('shinspermit_retest_result');?>"value="<?php echo $shinspermit_retest_result; ?>" maxlength="8" />
         </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_retest_result_inspector_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('shinspermit_retest_result_inspector_id') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="shinspermit_retest_result_inspector_id" id="shinspermit_retest_result_inspector_id" placeholder="<?php echo $this->lang->line('shinspermit_retest_result_inspector_id');?>" value="<?php echo $shinspermit_retest_result_inspector_id; ?>" maxlength="11" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_retest_inspection_date');?> <?php echo form_error('shinspermit_retest_inspection_date') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datetimepicker" name="shinspermit_retest_inspection_date" id="shinspermit_retest_inspection_date" placeholder="<?php echo $this->lang->line('shinspermit_retest_inspection_date');?>" value="<?php echo $shinspermit_retest_inspection_date; ?>" />
         </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_managerverified_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('shinspermit_managerverified_id') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="shinspermit_managerverified_id" id="shinspermit_managerverified_id" placeholder="<?php echo $this->lang->line('shinspermit_managerverified_id');?>" value="<?php echo $shinspermit_managerverified_id; ?>" maxlength="11" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_managerverified_date');?> <?php echo form_error('shinspermit_managerverified_date') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datetimepicker" name="shinspermit_managerverified_date" id="shinspermit_managerverified_date" placeholder="<?php echo $this->lang->line('shinspermit_managerverified_date');?>" value="<?php echo $shinspermit_managerverified_date; ?>" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_recent_shins_serialno');?> <?php echo form_error('shinspermit_recent_shins_serialno') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="shinspermit_recent_shins_serialno" id="shinspermit_recent_shins_serialno" placeholder="<?php echo $this->lang->line('shinspermit_recent_shins_serialno');?>"value="<?php echo $shinspermit_recent_shins_serialno; ?>" maxlength="100" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_recent_shins_expirydate');?> <?php echo form_error('shinspermit_recent_shins_expirydate') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datetimepicker" name="shinspermit_recent_shins_expirydate" id="shinspermit_recent_shins_expirydate" placeholder="<?php echo $this->lang->line('shinspermit_recent_shins_expirydate');?>" value="<?php echo $shinspermit_recent_shins_expirydate; ?>" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_recent_shins_typecolor');?> <?php echo form_error('shinspermit_recent_shins_typecolor') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="shinspermit_recent_shins_typecolor" id="shinspermit_recent_shins_typecolor" placeholder="<?php echo $this->lang->line('shinspermit_recent_shins_typecolor');?>" value="<?php echo $shinspermit_recent_shins_typecolor; ?>" maxlength="1"/>
          </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_completed_docs');?> <?php echo form_error('shinspermit_completed_docs') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="shinspermit_completed_docs" id="shinspermit_completed_docs" placeholder="<?php echo $this->lang->line('shinspermit_completed_docs');?>" value="<?php echo $shinspermit_completed_docs; ?>" maxlength="1"/>
          </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_inspectionscheduled');?> <?php echo form_error('shinspermit_inspectionscheduled') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="shinspermit_inspectionscheduled" id="shinspermit_inspectionscheduled" placeholder="<?php echo $this->lang->line('shinspermit_inspectionscheduled');?>" value="<?php echo $shinspermit_inspectionscheduled; ?>" maxlength="1"/>
          </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('shinspermit_inspectionapproval');?> <?php echo form_error('shinspermit_inspectionapproval') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="shinspermit_inspectionapproval" id="shinspermit_inspectionapproval" placeholder="<?php echo $this->lang->line('shinspermit_inspectionapproval');?>" value="<?php echo $shinspermit_inspectionapproval; ?>" maxlength="1"/>
          </div></div>
         
<div class="row">
<div class="col-md-offset-3 col-md-9">
         <input type="hidden" name="shinspermit_id" value="<?php echo (isset($id)?$id:""); ?>" />
         <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
         <a href="<?php echo site_url('shinspermit') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
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
var arr = [  ];

$.each( arr, function( i, val ) {
  $("#"+val).prop("disabled", true);
  $("#"+val).after("<input type='hidden' name='"+val+"' id='"+val+"' value='"+$("#"+val).val()+"'>");
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
  jQuery("#testingDiv"+id).find(':input').each(function() {
    switch(this.type) {
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
$(function () {
  $(".clonedInput:first").before('<div id="add-buttons"><input class="btn btn-success" type="button" id="btnAdd" value="<?php echo $this->lang->line('add_more_child');?>"></div><hr style="width: 100%">');
if($('.clonedInput').length > 1){
  $('.clonedInput').each(function(){
  var pos = $(this).attr('id');
  pos = pos.replace('testingDiv','');
    $(this).append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="<?php echo $this->lang->line('x');?>" position="'+pos+'"/>');
    $(this).append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="<?php echo $this->lang->line('clear');?>" position="'+pos+'"/><hr style="width: 100%">');
 });

}else{
   $(".clonedInput:first").append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="<?php echo $this->lang->line('x');?>" position="1" disabled="disabled"/>');
    $(".clonedInput:first").append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="<?php echo $this->lang->line('clear');?>" position="1"/><hr style="width: 100%">');
}

    //$('#btnAdd').click(function () {
    $('body').on('click', '#btnAdd', function(){
        var num = $('.clonedInput').length, // how many "duplicatable" input fields we currently have
            newNum = new Number(num + 1), // the numeric ID of the new input field being added
            randomID = Math.floor((Math.random() * 1000) + 1),
            cleanelem = $(".clonedInput:last").find('select.select2').select2("destroy"),
            newElem = $(".clonedInput:last").clone(true,true).attr('id', 'testingDiv' + randomID).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
            newElem.find('.action-button').attr('position',randomID).prop("disabled", false);
            newElem.find('.datepicker').removeClass('hasDatepicker').attr('id','').datepicker();
            newElem.find('.datetimepicker').removeClass('hasDatepicker').attr('id','').datetimepicker();
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

  $('body').on('click', '#btnDel', function(){
    //$('#btnDel').click(function () {
    var position = $(this).attr("position");
    var num = $('.clonedInput').length;
    $('#testingDiv' + position).slideUp('slow', function () {
                $(this).remove();
                // if only one element remains, disable the "remove" button
                if (num - 1 === 1){
                  $('#btnDel:last').attr('disabled', true);
                }
                // enable the "add" button
                $('#btnAdd').attr('disabled', false).prop('value', "<?php echo $this->lang->line('add_to_form');?>");

            });
    });

    $('body').on('click', '#btnClear', function(){
      var position = $(this).attr("position");
      clear_form_elements(position);
    });

    });
</script>
