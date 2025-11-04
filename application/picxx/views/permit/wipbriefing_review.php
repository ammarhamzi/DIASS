
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
                            <li><a href="javacript:return false;" class="disabled">Step 1</a></li>
                            <li><a href="javacript:return false;" class="disabled">Step 2</a></li>
                            <li><a href="javacript:return false;" class="disabled">Step 3</a></li>
                            <li class="active"><a href="javacript:return false;" data-toggle="tab">Step 4</a></li>
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-question"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_4">
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Application :</b> TEP - Work In Progress (Other Areas)</p>
                            </div>
                        </div>
            <form autocomplete="off" id="step_submit" name="step_submit" action="/Permit/submit" method="POST" onsubmit="return validateForm()">
                                            <!-- general form elements -->
                            <div class="box box-primary">
                                <!--                        <div class="box-header with-border">
                            <h3 class="box-title">Quick Example</h3>
                        </div>-->

                                <div class="box-body">
                <div class="row">
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Application Information</h3>
                                <p>Condition :
                                    <?php echo ($condition=='renew'?'Renewal':'New');?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h3>Vehicle Information</h3>
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
                                <h3>Date of entry:</h3>
                                <p>
                                    <span class="label label-warning">
<?php
$start = strtotime($startdate);
$end = strtotime($enddate);

$diff = $end - $start;

$days = floor($diff / (3600 * 24));
?>
                                    <?php echo datelocal($startdate);?> to <?php echo datelocal($enddate);?> (<?php echo $days+1;?> days)</span>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h3>Entry Details</h3>

                                <p>Purpose of entry :
                                    <?php echo $entrypurpose;?>

                                </p>
                                <p>Entry Post :
                                    <?php echo $entrypost;?>

                                </p>
								
                                <p>Exit Post :
                                    <?php echo $exitpost;?>

                                </p>

                            </div>
                            <div class="col-md-6">
                             <h3>Escort Details</h3>

                                <p>Escort Service :
                                    <?php echo ($escortservice=='y'?'<span style="color: #009900">Escorted by airside</span>':'<span style="color: #CC0000">Own escort (detail as below)</span>');?>

                                </p>
<?php
if($escortservice!='y'){
?>
                                <p>Steerman Name :
                                    <?php echo $steerman_name;?>

                                </p>

                                <p>Steerman IC No :
                                    <?php echo $steerman_icno;?>

                                </p>
                                <p>Steerman ADP Number :
                                    <?php echo $steerman_adpno;?>

                                </p>
<?php
}
?>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Work In progress Briefing Date:</b></p>
                                <p>
                                    <span class="label label-warning"><?php echo datelocal($wipbriefing_date);?> </span>
                                </p>
                            </div>

                                                         <div class="col-md-12">
                                <p><b>Operation Location:</b></p>
                                <p>
                                   <span class="label label-warning"> <?php echo $wipbriefing_location;?> </span>
                                </p>
                            </div>                        </div>
<!--                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Briefing Location:</b></p>
                                <p>
                                    <span class="label label-warning"><?php echo $location;?> </span>
                                </p>
                            </div>
                        </div>-->

<!--                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Work In Progress Briefing Date:</b></p>
                                <p>
                                    <?php echo datelocal($wipbriefing_date);?>
                                </p>
                            </div>
                        </div>-->

                    </div>
                    <div class="col-md-6">

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
<h3>Insurance supported docs</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <th>File Name</th>
<!--                                        <td>Size</td>
                                        <td>Type</td>-->
                                    </tr>
                                    <?php

        if(!empty($wipbriefing_insurancedoc_filename)){ foreach($wipbriefing_insurancedoc_filename as $file){
          $filename = explode("--", $file['uploadfiles_filename']);
          $ids[] = $file['uploadfiles_id'];
         ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo $this->config->item('base_url'); ?>/uploads/files/<?php echo $file['uploadfiles_filename']; ?>" target="_blank"><?php echo $filename[1]; ?></a>
                                            </td>
<!--                                            <td>
                                                <?php echo $file['uploadfiles_filesize']; ?>KB</td>
                                            <td>
                                                <?php echo $file['uploadfiles_type']; ?>
                                            </td>-->
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
<!--                                        <td>Type</td> -->
                                    </tr>
                                    <?php

        if(!empty($wipbriefing_requireddoc_filename)){ foreach($wipbriefing_requireddoc_filename as $file){
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
                                            <td colspan="3">File(s) not found.....
                                                <td>
                                        </tr>
                                        <?php }

         ?>
                                </table>
                            </div>

                        </div>
<!--                        <?php
                    if($condition=='renew'){   ?>

                            <h3>Detail of Recent Work In Progress Permit</h3>
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
                    <!--    <div class="col-md-4">
     <h3>Trainer & Courser Provider</h3>
     <div class="row">
         <div class="col-md-4">Trainer Name:</div>
         <div class="col-md-8">
             <p><?php echo $trainername;?></p>

         </div>
     </div>
      <div class="row">
         <div class="col-md-4">Training Date:</div>
         <div class="col-md-8"><p><?php echo $trainingdate;?></p></div>
     </div>
     <div class="row">
         <div class="col-md-12">
             Certification By Trainer
         </div>
     </div>
     <div class="row">
         <div class="col-md-12">
    <table class="table">
        <tr>
          <td>File Name</td>
          <td>Size</td>
          <td>Type</td>
        </tr>
        <?php

        if(!empty($adp_trainercert_filename)){ foreach($adp_trainercert_filename as $file){
          $filename = explode("--", $file['uploadfiles_filename']);
          $ids[] = $file['uploadfiles_id'];
         ?>
        <tr>
            <td><?php echo $filename[1]; ?></td>
            <td><?php echo $file['uploadfiles_filesize']; ?>KB</td>
            <td><?php echo $file['uploadfiles_type']; ?></td>
        </tr>
        <?php } }else{
        $ids[] = '';
        ?>
        <tr>
        <td colspan="3">Image(s) not found.....<td>
        </tr>
        <?php }

         ?>
        </table>
         </div>
     </div>
    </div>-->
                </div>
                <input id="permittype" type="hidden" name="permittype" value="wipbriefing">
                <input id="verify_status" type="hidden" name="verify_status" value="<?php echo $verify_status;?>">
                <input id="vehicle_id" type="hidden" name="vehicle_id" value="<?php echo $vehicle_id;?>">
                <input id="vehicle_vehiclegroup" type="hidden" name="vehicle_vehiclegroup" value="<?php echo $vehicle_vehiclegroup_name;?>">
                <input id="vehicle_registration_no" type="hidden" name="vehicle_registration_no" value="<?php echo $vehicle_registration_no;?>">
                <input id="vehicle_parkingarea_id" type="hidden" name="vehicle_parkingarea_id" value="<?php echo $vehicle_parkingarea_id;?>">
                <input id="vehicle_engine_capacity" type="hidden" name="vehicle_engine_capacity" value="<?php echo $vehicle_engine_capacity;?>">

                <input id="wipbriefing_date" type="hidden" name="wipbriefing_date" value="<?php echo $wipbriefing_date;?>">

                <input id="wipbriefing_requireddoc" type="hidden" name="wipbriefing_requireddoc" value="<?php echo $wipbriefing_requireddoc;?>">

                <input id="wipbriefing_insurancedoc" type="hidden" name="wipbriefing_insurancedoc" value="<?php echo $wipbriefing_insurancedoc;?>">
                <input id="policyno" type="hidden" name="policyno" value="<?php echo $policyno;?>">
                <input id="policyexpirydate" type="hidden" name="policyexpirydate" value="<?php echo $policyexpirydate;?>">
                    <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
<input id="location" type="hidden" name="location" value="<?php echo $location;?>">
<input id="permit_issuance_startdate" type="hidden" name="permit_issuance_startdate" value="<?php echo $startdate;?>">
<input id="permit_issuance_expirydate" type="hidden" name="permit_issuance_expirydate" value="<?php echo $enddate;?>">

<input id="entrypurpose" type="hidden" name="entrypurpose" value="<?php echo $entrypurpose;?>">
<input id="entrypost" type="hidden" name="entrypost" value="<?php echo $entrypost;?>">
<input id="exitpost" type="hidden" name="exitpost" value="<?php echo $exitpost;?>">
<input id="steerman_name" type="hidden" name="steerman_name" value="<?php echo $steerman_name;?>">
<input id="steerman_icno" type="hidden" name="steerman_icno" value="<?php echo $steerman_icno;?>">
<input id="steerman_adpno" type="hidden" name="steerman_adpno" value="<?php echo $steerman_adpno;?>">
<input id="escortservice" type="hidden" name="escortservice" value="<?php echo $escortservice;?>">
<!--                <?php if($condition=='renew'){   ?>
                    <input id="serialno" type="hidden" name="serialno" value="<?php echo $serialno;?>">
                    <input id="expirydate" type="hidden" name="expirydate" value="<?php echo $expirydate;?>">
                    <input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
                    <?php }  ?>-->

                                </div>

                                <div class="box-footer">
 <div class="col-md-12">
 <p><b>Note For admin:</b> </p><textarea id="apply_remark" name="apply_remark" class="form-control"></textarea>
 </div>
                                    <div class="col-md-12">
                        <span class="double"><input id="clarify" name="clarify" type="checkbox" value="clarify"></span>  I hereby confirm that the information provided herein is accurate, correct and complete and that the documents submitted along with this application form are genuine. <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('clarify') ?><span class="text-danger" id="clarify_error"></span> <br><input id="to_step_four" name="to_step_four" type="submit" class="btn btn-primary" value="Submit">
                                    </div>

                                </div>
                            </div>

            </form>      </div>
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