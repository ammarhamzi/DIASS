
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Apply Permit (Step 4 of 4)
                <small>Follow the process below to apply for permit.</small>
            </h1>
        <ol class="breadcrumb">
                <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
                <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                        <?php echo $this->lang->line('applypermit');?> </li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
                <div class="col-md-12 text-center">
                        <div id="message" style=" position: fixed;right: 25px;">
                                <?php echo $this->session->userdata('message') <> '' ? '<span class="alert alert-success" role="alert">'.$this->session->userdata('message').'</span>' : ''; ?>
                        </div>
                </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li><a href="#tab_1" class="disabled">Step 1</a></li>
                            <li><a href="#tab_2" class="disabled">Step 2</a></li>
                            <li><a href="#tab_3" class="disabled">Step 3</a></li>
                            <li class="active"><a href="#tab_4" data-toggle="tab">Step 4</a></li>
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-question"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_4">
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Application :</b> Electrical Vehicle Permit (EVP)</p>
                            </div>
                        </div>
            <form autocomplete="off" id="step_submit" name="step_submit" action="/Permit/submit" method="POST" onsubmit="return validateForm()">
<div class="box box-primary">
    <div class="box-body">
                <div class="row">
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Application Info</b></p>
                                <p>Condition :
                                    <?php echo ($condition=='renew'?'Renewal':'New');?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><b>Vehicle</b></p>
                                <p>Type :
                                    <?php echo $vehicle_vehiclegroup_name;?>

                                </p>
                                <p>Registration No :
                                    <?php echo $vehicle_registration_no;?>

                                </p>
                                <p>Manufacturing Year :
                                    <?php echo $vehicle_year_manufacture;?>

                                </p>

                            </div>
                            <div class="col-md-6">
                              <p>&nbsp;</p>
                                <p>Chasis No :
                                    <?php echo $vehicle_chasis_no;?>

                                </p>
                                <p>Engine No :
                                    <?php echo $vehicle_engine_no;?>

                                </p>
                                <p>Engine Type :
                                    <?php echo $vehicle_enginetype_name;?>

                                </p>
                                <p>Engine Capacity :
                                    <?php echo $vehicle_engine_capacity;?>

                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Inspection Date:</b></p>
                                <p>
                                    <span class="label label-warning"><?php echo datelocal($inspection_date);?></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Inspection Location:</b></p>
                                <p>
                                    <span class="label label-warning"><?php echo $location;?> </span>
                                </p>
                            </div>
                        </div>
                        <h3>Insurance</h3>
                        <div class="row">
                            <div class="col-md-4">Policy No:</div>
                            <div class="col-md-8">
                                <p>
                                    <?php echo $policyno;?>
                                </p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Policy Expiry Date:</div>
                            <div class="col-md-8">
                                <p>
                                    <?php echo datelocal($policyexpirydate);?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                Insurance supported docs
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
<th>File Name</th>
                                    </tr>
                                    <?php

        if(!empty($evp_insurancedoc_filename)){ foreach($evp_insurancedoc_filename as $file){
          $filename = explode("--", $file['uploadfiles_filename']);
          $ids[] = $file['uploadfiles_id'];
         ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo $this->config->item('base_url'); ?>/uploads/files/<?php echo $file['uploadfiles_filename']; ?>" target="_blank"><?php echo $filename[1]; ?></a>
                                            </td>
                                        </tr>
                                        <?php } }else{
        $ids[] = '';
        ?>
                                        <tr>
                                            <td colspan="3">File(s) not found.....
                                                <td>
                                        </tr>
                                        <?php }

         ?>
                                </table>
                            </div>
                        </div>

                        <h3>Other Documents</h3>
                        <div class="row">
                            <div class="col-md-12">

                                <table class="table">
                                    <tr>
                                        <th>File Name</th>
                                        <th>Document Name</th>
                                        <!--<td>Type</td>-->
                                    </tr>
                                    <?php

        if(!empty($evp_requireddoc_filename)){ foreach($evp_requireddoc_filename as $file){
          $filename = explode("--", $file['uploadfiles_filename']);
         ?>
                                        <tr>
                                            <td>
                                               <a href="<?php echo $this->config->item('base_url'); ?>/uploads/files/<?php echo $file['uploadfiles_filename']; ?>" target="_blank"> <?php echo $filename[1]; ?></a>
                                            </td>
                                            <td>
                                                <?php echo $file['uploadfiles_docname']; ?></td>
<!--                                            <td>
                                                <?php echo $file['uploadfiles_type']; ?>
                                            </td>-->
                                        </tr>
                                        <?php } }else{
        ?>
                                        <tr>
                                            <td colspan="2">File(s) not found.....
                                                <td>
                                        </tr>
                                        <?php }

         ?>
                                </table>
                            </div>

                        </div>
<!--                        <?php
                    if($condition=='renew'){   ?>

                            <h3>Detail of Recent AVP Permit</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Permit Serial No :
                                        <?php echo $serialno; ?>
                                    </p>
                                    <p>Expiry Date :
                                        <?php echo $expirydate; ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>-->
                    </div>

                        <div class="col-md-6">
<h3>Self Inspection:</h3>
            <table id="mytable" class="table" style="width: 100% !important">

               <thead>
                  <tr>
                     <th>#</th>
                     <th><?php echo $this->lang->line('mtwchecklist_name');?></th>
<th><?php echo $this->lang->line('mtwchecklist_desc');?></th>

                     <th class="no-sort">&nbsp;</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $start = 0;
                     if($mtwchecklist_data){

                     foreach ($mtwchecklist_data as $mtwchecklist)
                     {
                         ?>
                  <tr>
                     <td><?php echo ++$start ?></td>
                     <td><?php echo $mtwchecklist->mtwchecklist_name ?></td>
<td><?php echo $mtwchecklist->mtwchecklist_desc ?></td>

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">

                                    <?php
                                        echo '<input id="mtwchecklist_selected" name="mtwchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $evp_mtwchecked_selected)?"checked":""). ' disabled>';
                                    ?>
                                    </div>
                                </td>
                  </tr>
                  <?php
                     }
                     }
                     ?>
               </tbody>
            </table>
    </div>

                </div>
       <div class="box-footer">

                <div class="row">
 <div class="col-md-12">
 <p><b>Note For admin:</b> </p><textarea id="apply_remark" name="apply_remark" class="form-control"></textarea>
 </div>
                    <div class="col-md-1 text-right">
                     <span class="double"><input id="clarify" name="clarify" type="checkbox" value="clarify"></span> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('clarify') ?><span class="text-danger" id="clarify_error"></span>
                    </div>
                    <div class="col-md-11">

<ul>
<li>I hereby confirm that the information provided herein is accurate, correct and complete and that the documents submitted along with this application form are genuine.</li>
    <li>I certify that this “Vehicle” COMPLY with the requirement of Airport Standards Directive 506.</li>
    <li>I also certify that this vehicle complies with requirement of road worthiness, safe for operation and in good condition, and;</li>
    <li>I will take full responsibility of any issue or occurrences before and after the inspection.</li>
</ul>
                         <input id="to_step_four" name="to_step_four" type="submit" class="btn btn-primary" value="Submit">

                    </div>

                </div>
       </div>
    </div>
</div>

                <input id="permittype" type="hidden" name="permittype" value="evp">
                <input id="verify_status" type="hidden" name="verify_status" value="<?php echo $verify_status;?>">
                <input id="vehicle_id" type="hidden" name="vehicle_id" value="<?php echo $vehicle_id;?>">
                <input id="vehicle_vehiclegroup" type="hidden" name="vehicle_vehiclegroup" value="<?php echo $vehicle_vehiclegroup_name;?>">
                <input id="vehicle_registration_no" type="hidden" name="vehicle_registration_no" value="<?php echo $vehicle_registration_no;?>">
                <input id="vehicle_parkingarea_id" type="hidden" name="vehicle_parkingarea_id" value="<?php echo $vehicle_parkingarea_id;?>">
                <input id="vehicle_engine_capacity" type="hidden" name="vehicle_engine_capacity" value="<?php echo $vehicle_engine_capacity;?>">

                <input id="inspection_date" type="hidden" name="inspection_date" value="<?php echo $inspection_date;?>">
<input id="location" type="hidden" name="location" value="<?php echo $location;?>">
                <input id="evp_requireddoc" type="hidden" name="evp_requireddoc" value="<?php echo $evp_requireddoc;?>">

                <input id="evp_insurancedoc" type="hidden" name="evp_insurancedoc" value="<?php echo $evp_insurancedoc;?>">
                <input id="policyno" type="hidden" name="policyno" value="<?php echo $policyno;?>">
                <input id="policyexpirydate" type="hidden" name="policyexpirydate" value="<?php echo $policyexpirydate;?>">

<?php
foreach($evp_mtwchecked_selected as $value)
{
?>
                <input id="evp_mtwchecked_selected" type="hidden" name="evp_mtwchecked_selected[]" value="<?php echo $value;?>">
<?php
}
?>

                <!--<input id="adp_trainercert" type="hidden" name="adp_trainercert" value="">-->
                <!--<input id="driver_photo" type="hidden" name="driver_photo" value="">-->
                <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
<!--                <?php if($condition=='renew'){   ?>
                    <input id="serialno" type="hidden" name="serialno" value="<?php echo $serialno;?>">
                    <input id="expirydate" type="hidden" name="expirydate" value="<?php echo $expirydate;?>">
                    <input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
                    <?php }  ?>-->

            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<script>
    function redirect(url) {
        $(location).attr('href', url);
    }
</script>
<script>
function validateForm(){
var status = 0;
if($('#clarify'). prop("checked") == false) {
    $("#clarify_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}

if(status == 1){
return false;
}else{
$("#to_step_four").attr("disabled", true);
}

}
</script>