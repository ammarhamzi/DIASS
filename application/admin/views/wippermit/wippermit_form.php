<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
<ol class="breadcrumb">
  <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
  <li><a href="<?php echo site_url('wippermit');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('wippermit');?> <?php echo $this->lang->line('list');?></a></li>
  <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('form');?> <?php echo $button ?></li>
</ol>
<div class="panel panel-info">
  <div class="panel-heading">
<h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('wippermit');?> <?php echo $button ?></h4>
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
            <?php echo $this->lang->line('wippermit_permit_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wippermit_permit_id') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="wippermit_permit_id" id="wippermit_permit_id" placeholder="<?php echo $this->lang->line('wippermit_permit_id');?>" value="<?php echo $wippermit_permit_id; ?>" maxlength="11" />
         </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_vehicle_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wippermit_vehicle_id') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="wippermit_vehicle_id" id="wippermit_vehicle_id" placeholder="<?php echo $this->lang->line('wippermit_vehicle_id');?>" value="<?php echo $wippermit_vehicle_id; ?>" maxlength="11" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_required_briefing');?> <?php echo form_error('wippermit_required_briefing') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="wippermit_required_briefing" id="wippermit_required_briefing" placeholder="<?php echo $this->lang->line('wippermit_required_briefing');?>" value="<?php echo $wippermit_required_briefing; ?>" maxlength="1"/>
          </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_attendbriefing');?> <?php echo form_error('wippermit_attendbriefing') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="wippermit_attendbriefing" id="wippermit_attendbriefing" placeholder="<?php echo $this->lang->line('wippermit_attendbriefing');?>" value="<?php echo $wippermit_attendbriefing; ?>" maxlength="1"/>
          </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_approved_to_inspect');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wippermit_approved_to_inspect') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="wippermit_approved_to_inspect" id="wippermit_approved_to_inspect" placeholder="<?php echo $this->lang->line('wippermit_approved_to_inspect');?>" value="<?php echo $wippermit_approved_to_inspect; ?>" maxlength="11" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_ownchecked_by');?> <?php echo form_error('wippermit_ownchecked_by') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="wippermit_ownchecked_by" id="wippermit_ownchecked_by" placeholder="<?php echo $this->lang->line('wippermit_ownchecked_by');?>"value="<?php echo $wippermit_ownchecked_by; ?>" maxlength="255" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_ownchecked_date');?> <?php echo form_error('wippermit_ownchecked_date') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datetimepicker" name="wippermit_ownchecked_date" id="wippermit_ownchecked_date" placeholder="<?php echo $this->lang->line('wippermit_ownchecked_date');?>" value="<?php echo $wippermit_ownchecked_date; ?>" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_ownverified_by');?> <?php echo form_error('wippermit_ownverified_by') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="wippermit_ownverified_by" id="wippermit_ownverified_by" placeholder="<?php echo $this->lang->line('wippermit_ownverified_by');?>"value="<?php echo $wippermit_ownverified_by; ?>" maxlength="255" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_ownverified_date');?> <?php echo form_error('wippermit_ownverified_date') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datepicker" name="wippermit_ownverified_date" id="wippermit_ownverified_date" placeholder="<?php echo $this->lang->line('wippermit_ownverified_date');?>" value="<?php echo $wippermit_ownverified_date; ?>" />
         </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_result');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wippermit_result') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control" name="wippermit_result" id="wippermit_result" placeholder="<?php echo $this->lang->line('wippermit_result');?>"value="<?php echo $wippermit_result; ?>" maxlength="8" />
         </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_result_inspector_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wippermit_result_inspector_id') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="wippermit_result_inspector_id" id="wippermit_result_inspector_id" placeholder="<?php echo $this->lang->line('wippermit_result_inspector_id');?>" value="<?php echo $wippermit_result_inspector_id; ?>" maxlength="11" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_inspection_date');?> <?php echo form_error('wippermit_inspection_date') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datetimepicker" name="wippermit_inspection_date" id="wippermit_inspection_date" placeholder="<?php echo $this->lang->line('wippermit_inspection_date');?>" value="<?php echo $wippermit_inspection_date; ?>" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_retest_result');?> <?php echo form_error('wippermit_retest_result') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="wippermit_retest_result" id="wippermit_retest_result" placeholder="<?php echo $this->lang->line('wippermit_retest_result');?>"value="<?php echo $wippermit_retest_result; ?>" maxlength="8" />
         </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_retest_result_inspector_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wippermit_retest_result_inspector_id') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="wippermit_retest_result_inspector_id" id="wippermit_retest_result_inspector_id" placeholder="<?php echo $this->lang->line('wippermit_retest_result_inspector_id');?>" value="<?php echo $wippermit_retest_result_inspector_id; ?>" maxlength="11" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_retest_inspection_date');?> <?php echo form_error('wippermit_retest_inspection_date') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datetimepicker" name="wippermit_retest_inspection_date" id="wippermit_retest_inspection_date" placeholder="<?php echo $this->lang->line('wippermit_retest_inspection_date');?>" value="<?php echo $wippermit_retest_inspection_date; ?>" />
         </div></div>

<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_managerverified_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wippermit_managerverified_id') ?>
          </label>
<div class="col-md-9"><input type="text" class="form-control isInteger" name="wippermit_managerverified_id" id="wippermit_managerverified_id" placeholder="<?php echo $this->lang->line('wippermit_managerverified_id');?>" value="<?php echo $wippermit_managerverified_id; ?>" maxlength="11" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_managerverified_date');?> <?php echo form_error('wippermit_managerverified_date') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datetimepicker" name="wippermit_managerverified_date" id="wippermit_managerverified_date" placeholder="<?php echo $this->lang->line('wippermit_managerverified_date');?>" value="<?php echo $wippermit_managerverified_date; ?>" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_recent_wip_serialno');?> <?php echo form_error('wippermit_recent_wip_serialno') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="wippermit_recent_wip_serialno" id="wippermit_recent_wip_serialno" placeholder="<?php echo $this->lang->line('wippermit_recent_wip_serialno');?>"value="<?php echo $wippermit_recent_wip_serialno; ?>" maxlength="100" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_recent_wip_expirydate');?> <?php echo form_error('wippermit_recent_wip_expirydate') ?>
          </label><div class="col-md-9"><input type="text" class="form-control datetimepicker" name="wippermit_recent_wip_expirydate" id="wippermit_recent_wip_expirydate" placeholder="<?php echo $this->lang->line('wippermit_recent_wip_expirydate');?>" value="<?php echo $wippermit_recent_wip_expirydate; ?>" />
         </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_recent_wip_typecolor');?> <?php echo form_error('wippermit_recent_wip_typecolor') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="wippermit_recent_wip_typecolor" id="wippermit_recent_wip_typecolor" placeholder="<?php echo $this->lang->line('wippermit_recent_wip_typecolor');?>" value="<?php echo $wippermit_recent_wip_typecolor; ?>" maxlength="1"/>
          </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_completed_docs');?> <?php echo form_error('wippermit_completed_docs') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="wippermit_completed_docs" id="wippermit_completed_docs" placeholder="<?php echo $this->lang->line('wippermit_completed_docs');?>" value="<?php echo $wippermit_completed_docs; ?>" maxlength="1"/>
          </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_inspectionscheduled');?> <?php echo form_error('wippermit_inspectionscheduled') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="wippermit_inspectionscheduled" id="wippermit_inspectionscheduled" placeholder="<?php echo $this->lang->line('wippermit_inspectionscheduled');?>" value="<?php echo $wippermit_inspectionscheduled; ?>" maxlength="1"/>
          </div></div>


<div class="row">
          <label class="col-md-3 text-right">
            <?php echo $this->lang->line('wippermit_inspectionapproval');?> <?php echo form_error('wippermit_inspectionapproval') ?>
          </label><div class="col-md-9"><input type="text" class="form-control" name="wippermit_inspectionapproval" id="wippermit_inspectionapproval" placeholder="<?php echo $this->lang->line('wippermit_inspectionapproval');?>" value="<?php echo $wippermit_inspectionapproval; ?>" maxlength="1"/>
          </div></div>
         
<div class="row">
<div class="col-md-offset-3 col-md-9">
         <input type="hidden" name="wippermit_id" value="<?php echo (isset($id)?$id:""); ?>" />
         <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button ?></button>
         <a href="<?php echo site_url('wippermit') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
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
