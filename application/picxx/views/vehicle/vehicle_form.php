<!-- \resources\gen_template\master\crud-newpage\views -->
                    <!--<script src="<?php echo base_url('resources/shared_js/Minimal-Dropdown-Year/lib/year-select.js'); ?>"></script>-->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('vehicle');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('vehicle');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form');?>
            <?php echo $button ?>
        </li>
    </ol>
                    <div class="box  box-primary">
                        <div class="box-header with-border">
                                    <i class="fa fa-file-text-o"></i>

                                    <h3 class="box-title"><?php echo $button ?> Vehicle</h3>
                                    <div class="box-tools pull-right">

                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                        <!-- /.box-header -->
                        <div class="box-body">

            <div class="row">

                    <form autocomplete="off" action="<?php echo $action; ?>" method="post">
                        <div class="col-md-6">


<!--                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_company_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_company_id') ?>
          </label>

                            <select class="form-control select2" name="vehicle_company_id" id="vehicle_company_id">
<option value="">-SELECT-</option>
<?php
foreach ($company as $value) {
?>
<option value="<?php echo $value->company_id;?>" <?php echo ($value->company_id===$vehicle_company_id?'selected="selected"':"");?>><?php echo $value->company_name;?></option>
<?php
}
?>
</select>

                        </div>-->

                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_registration_no');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_registration_no') ?>
          </label>
                            <input type="text" class="form-control" name="vehicle_registration_no" id="vehicle_registration_no" placeholder="<?php echo $this->lang->line('vehicle_registration_no');?>" value="<?php echo $vehicle_registration_no; ?>" maxlength="150" style="text-transform:uppercase"
                                />

                        </div>

                        <div class="form-group">
                            <label for="">
            Operation Area <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_type') ?>
          </label>

                            <select class="form-control" name="vehicle_type" id="vehicle_type">
<option value="">-SELECT-</option>
<?php
foreach ($dropdown_vehicle_type as $value) {

if($value->id==trim($vehicle_type) ){
?>
<option value="<?php echo $value->id;?>" <?php echo set_select('vehicle_type', $value->id, TRUE); ?>><?php echo $value->value;?></option>
<?php
}else{
?>
<option value="<?php echo $value->id;?>" <?php echo set_select('vehicle_type', $value->id); ?>><?php echo $value->value;?></option>
<?php
}
}
?>
</select>

                        </div>
<!--                        <?php
                        if(trim($vehicle_type)=='EV'){
                        $style = 'display:none';
                        }elseif(trim($vehicle_type)=='AV'){
                        $style = '';
                        }else{
                        $style = 'display:none';
                        }
                        ?>

                                                <div class="form-group" style="<?php echo $style;?>" id="vehicle_distance_color_field">
                                                        <label for="vehicle_distance_color">
                        <?php echo $this->lang->line('vehicle_distance_color');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_distance_color') ?>
                    </label>
                                                        <select class="form-control" name="vehicle_distance_color" id="vehicle_distance_color">
<option value="yellow" <?php echo ($vehicle_distance_color=='yellow'?'selected':'');?>>YELLOW</option>
<option value="red" <?php echo ($vehicle_distance_color=='red'?'selected':'');?>>RED (Within 15M)</option>
</select>

                                                </div>-->

                                                <div class="form-group">
                                                        <label for="">
                       Equipment/Vehicle <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_group') ?><?php echo form_error('other_equipment') ?><span class="text-danger" id="other_equipment_error"></span>
                    </label>

                                                        <select class="form-control select2" name="vehicle_group" id="vehicle_group">
<option value="">-SELECT-</option>
<?php
foreach ($dropdown_vehicle_group as $value) {
$vehiclegroup[] = $value->vehiclegroup_name;
if($value->vehiclegroup_id==trim($vehicle_group) ){

?>
<option value="<?php echo $value->vehiclegroup_id;?>" <?php echo set_select('vehicle_group', $value->vehiclegroup_id, TRUE); ?>><?php echo $value->vehiclegroup_name;?></option>
<?php
}else{
?>
<option value="<?php echo $value->vehiclegroup_id;?>" <?php echo set_select('vehicle_group', $value->vehiclegroup_id); ?>><?php echo $value->vehiclegroup_name;?></option>
<?php
}
}
?>
<option value="99" <?php echo ($vehicle_group=="99"?"selected":"");?>>OTHERS</option>
</select>
<?php
if($vehicle_group=="99"){
$style_other_equipment  = "";
}else{
$style_other_equipment  = "display:none;";
}
?>
<input type="text" name="other_equipment" id="other_equipment" class="form-control" style=" <?php echo $style_other_equipment;?>margin-top: 15px;text-transform:uppercase" placeholder="key-in your other equipment/vehicle" value="<?php echo $other_equipment; ?>">

                                                </div>

<!--                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_insurance_policy_no');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_insurance_policy_no') ?>
          </label>
                            <input type="text" class="form-control" name="vehicle_insurance_policy_no" id="vehicle_insurance_policy_no" placeholder="<?php echo $this->lang->line('vehicle_insurance_policy_no');?>" value="<?php echo $vehicle_insurance_policy_no; ?>"
                                    maxlength="150" />

                        </div>

                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_insurance_expiry_date');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_insurance_expiry_date') ?>
          </label>
                            <input type="text" class="form-control datepicker_local_insurancedate" name="vehicle_insurance_expiry_date" id="vehicle_insurance_expiry_date" placeholder="<?php echo $this->lang->line('vehicle_insurance_expiry_date');?>" value="<?php echo ($vehicle_insurance_expiry_date?datelocal($vehicle_insurance_expiry_date):''); ?>"
                                autocomplete="off"/>

                        </div>-->

<!--                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_vehicleequipmenttype_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_vehicleequipmenttype_id') ?>
          </label>

                            <select class="form-control select2" name="vehicle_vehicleequipmenttype_id" id="vehicle_vehicleequipmenttype_id">
<option value="">-SELECT-</option>
<?php
foreach ($vehicleequipmenttype as $value) {
?>
<option value="<?php echo $value->vehicleequipmenttype_id;?>" <?php echo ($value->vehicleequipmenttype_id==trim($vehicle_vehicleequipmenttype_id)?'selected="selected"':"");?>><?php echo $value->vehicleequipmenttype_name;?></option>
<?php
}
?>
</select>

                        </div>-->

<!--                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_parkingarea_id');?> <span style="font-size: 8pt">(When not in use)</span> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_parkingarea_id') ?>
          </label>

                            <select class="form-control select2" name="vehicle_parkingarea_id" id="vehicle_parkingarea_id">
<option value="">-SELECT-</option>
<?php
foreach ($parkingarea as $value) {
?>
<option value="<?php echo $value->parkingarea_id;?>" <?php echo ($value->parkingarea_id==$vehicle_parkingarea_id?'selected="selected"':"");?>><?php echo $value->parkingarea_name;?></option>
<?php
}
?>
</select>

                        </div>-->

                                                    <div class="form-group">
                                                        <label for="">
                        <?php echo $this->lang->line('vehicle_year_manufacture');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_year_manufacture') ?>
                    </label>
                                                        <input type="text" class="form-control yearpicker" name="vehicle_year_manufacture" id="vehicle_year_manufacture" placeholder="<?php echo $this->lang->line('vehicle_year_manufacture');?>" value="<?php echo $vehicle_year_manufacture; ?>"
                                                                        maxlength="10" />

                                                </div>

                                                <div class="form-group">
                                                        <label for="">
                        <?php echo $this->lang->line('vehicle_chasis_no');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_chasis_no') ?>
                    </label>
                                                        <input type="text" class="form-control" name="vehicle_chasis_no" id="vehicle_chasis_no" placeholder="<?php echo $this->lang->line('vehicle_chasis_no');?>" value="<?php echo $vehicle_chasis_no; ?>" maxlength="150" style="text-transform:uppercase" />

                                                </div>
</div>


<div class="col-md-6">



                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_enginetype_id');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_enginetype_id') ?>
          </label>

                            <select class="form-control select2" name="vehicle_enginetype_id" id="vehicle_enginetype_id">
<option value="">-SELECT-</option>
<?php
foreach ($enginetype as $value) {
?>
<option value="<?php echo $value->enginetype_id;?>" <?php echo ($value->enginetype_id==$vehicle_enginetype_id?'selected="selected"':"");?>><?php echo $value->enginetype_name;?></option>
<?php
}
?>
</select>

                        </div>

                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_engine_no');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_engine_no') ?>
          </label>
                            <input type="text" class="form-control" name="vehicle_engine_no" id="vehicle_engine_no" placeholder="<?php echo $this->lang->line('vehicle_engine_no');?>" value="<?php echo $vehicle_engine_no; ?>" maxlength="150" style="text-transform:uppercase" />

                        </div>

                                                <div class="form-group">
                                                        <label for="">
                        <?php echo $this->lang->line('vehicle_engine_capacity');?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('vehicle_engine_capacity') ?>
                    </label>

                                                        <select class="form-control select2" name="vehicle_engine_capacity" id="vehicle_engine_capacity">
<option value="">-SELECT-</option>
<?php
foreach ($dropdown_vehicle_engine_capacity as $value) {
?>
<option value="<?php echo $value->enginecapacity_id;?>" <?php echo ($value->enginecapacity_id==$vehicle_engine_capacity?'selected="selected"':"");?>><?php echo $value->enginecapacity_name;?></option>
<?php
}
?>
</select>

                                                </div>

<!--                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_activity_statusid');?> <?php echo form_error('vehicle_activity_statusid') ?>
          </label>
                            <select class="form-control select2" name="vehicle_activity_statusid" id="vehicle_activity_statusid">
<option value="">-SELECT-</option>
<?php
foreach ($activity_status as $value) {
?>
<option value="<?php echo $value->activity_status_id;?>" <?php echo ($value->activity_status_id==$vehicle_activity_statusid?'selected="selected"':"");?>><?php echo $value->activity_status_name;?></option>
<?php
}
?>
</select>

                        </div>

                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_application_date');?> <?php echo form_error('vehicle_application_date') ?>
          </label>
                            <input type="text" class="form-control datepicker" name="vehicle_application_date" id="vehicle_application_date" placeholder="<?php echo $this->lang->line('vehicle_application_date');?>" value="<?php echo $vehicle_application_date; ?>"
                                />

                        </div>-->

<!--                                                <div class="form-group">
                                                        <label for="">
                        <?php echo $this->lang->line('vehicle_others');?>  <?php echo form_error('vehicle_others') ?>
                    </label>
                                                        <input type="text" class="form-control" name="vehicle_others" id="vehicle_others" placeholder="<?php echo $this->lang->line('vehicle_others');?>" value="<?php echo $vehicle_others; ?>"
                                                                        maxlength="150" />

                                                </div>-->

                        <div class="form-group">
                            <label for="">
            <?php echo $this->lang->line('vehicle_blacklistedremark');?> <?php echo form_error('vehicle_blacklistedremark') ?>
          </label>
                            <textarea class="form-control" name="vehicle_blacklistedremark" id="vehicle_blacklistedremark" placeholder="<?php echo $this->lang->line('vehicle_blacklistedremark');?>" rows="5" cols="50"><?php echo $vehicle_blacklistedremark; ?></textarea>

                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" name="vehicle_id" value="<?php echo (isset($id)?$id:" "); ?>" />
<input id="vehicle_company_id" type="hidden" name="vehicle_company_id" value="<?php echo $this->session->userdata('companyid');?>">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save</button>
                                <a href="<?php echo site_url('vehicle') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>
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

$(function() {
    $('#vehicle_registration_no').on('keypress', function(e) {
        if (e.which == 32)
            return false;
    });
});


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
    </script>
    <script>
    $(document).ready(function() {
    $("#vehicle_group").change(function () {
      if($("#vehicle_group").val()=='99'){
         $("#other_equipment").show();
      }else{
         $("#other_equipment").hide();
      }

    });
    });
    </script>
    <script>
    $(document).ready(function() {
    var vehiclegroup_array = [<?php echo '"'.implode('","', $vehiclegroup).'"' ?>];

    $("#other_equipment").change(function () {

      if($.inArray($("#other_equipment").val().toUpperCase(), vehiclegroup_array) != -1) {
   // console.log("is in array");
    $("#other_equipment").val("");
    $("#other_equipment_error").html('<span class="alert_custom">'+$("#other_equipment").val().toUpperCase()+' Exist In Equipment/Vehicle List</span>') ;
} else {
//console.log($("#other_equipment").val().toUpperCase());
//    console.log("is NOT in array");

}
    });
    });
    </script>