
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
                                <p><b>Application :</b> Electrical Vehicle Driving Permit (EVDP)</p>
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
                    <div class="col-md-4">

                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Application Info</b></p>
                                <p>Condition :
                                    <?php echo ($condition=='renew'?'Renewal':'New');?>
                                </p>
                            </div>
                            <div class="col-md-12">
                                <p><b>Driver</b></p>
                                <p>Name :
                                    <?php echo $driver_name;?>
                                </p>
                                <p>Ic/Passport :
                                    <?php echo $driver_ic;?>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Terminal Briefing Date:</b></p>
                                <p>
                                    <span class="label label-warning"><?php echo datelocal($terminalbriefing_date);?> </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Session:</b></p>
                                <p>
                                    <span class="label label-warning"><?php echo $terminalbriefing_session;?> </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Briefing Location:</b></p>
                                <p>
                                    <span class="label label-warning"><?php echo $location;?> </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!--     <h3>Supporting Documents</h3>
     <div class="row">
         <div class="col-md-4">Country:</div>
         <div class="col-md-8">
<p><?php echo $countryname;?></p>

         </div>
     </div>
     <div class="row">
         <div class="col-md-4">License No:</div>
         <p><?php echo $licenseno;?></p>
     </div>
     <div class="row">
         <div class="col-md-4">Driving Class:</div>
         <p><?php echo $drivingclass;?></p>
     </div>
      <div class="row">
         <div class="col-md-4">Expiry Date:</div>
         <p><?php echo $expirydate;?></p>
     </div>-->
                        <div class="row">
                            <div class="col-md-12">
                                Driver Photo
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <img src="<?php echo base_url('uploads/files/'.$driver_photo_filename); ?>" height="150" width="150">
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

        if(!empty($evdp_requireddoc_filename)){ foreach($evdp_requireddoc_filename as $file){
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
                            <!--         <div class="col-md-12">
             <input id="employer_driver_verify" name="employer_driver_verify" type="checkbox" value="y"> I hearby declare that ....
         </div>
         <div class="col-md-12">
         </div>-->
                        </div>
<!--                        <?php
                    if($condition=='renew'){   ?>

                            <h3>Detail of Recent EVDP Permit</h3>
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
                <input id="permittype" type="hidden" name="permittype" value="evdp">
                <input id="verify_status" type="hidden" name="verify_status" value="<?php echo $verify_status;?>">
                <input id="driver_id" type="hidden" name="driver_id" value="<?php echo $driver_id;?>">
                <input id="driver_name" type="hidden" name="driver_name" value="<?php echo $driver_name;?>">
                <input id="driver_ic" type="hidden" name="driver_ic" value="<?php echo $driver_ic;?>">
                <input id="terminalbriefing_date" type="hidden" name="terminalbriefing_date" value="<?php echo $terminalbriefing_date;?>">
                <input id="terminalbriefing_session" type="hidden" name="terminalbriefing_session" value="<?php echo $terminalbriefing_session;?>">
                <input id="evdp_requireddoc" type="hidden" name="evdp_requireddoc" value="<?php echo $evdp_requireddoc;?>">
                <!--<input id="adp_trainercert" type="hidden" name="adp_trainercert" value="<?php echo $adp_trainercert;?>">-->
                <input id="driver_photo" type="hidden" name="driver_photo" value="<?php echo $driver_photo;?>">
                <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
<input id="location" type="hidden" name="location" value="<?php echo $location;?>">

<!--                <?php if($condition=='renew'){   ?>
                    <input id="serialno" type="hidden" name="serialno" value="<?php echo $serialno;?>">
                    <input id="expirydate" type="hidden" name="expirydate" value="<?php echo $expirydate;?>">
                    <input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
                    <?php }  ?>-->
                <!--    <input id="country" type="hidden" name="country" value="<?php echo $country;?>">
    <input id="licenseno" type="hidden" name="licenseno" value="<?php echo $licenseno;?>">
    <input id="drivingclass" type="hidden" name="drivingclass" value="<?php echo $drivingclass;?>">
    <input id="expirydate" type="hidden" name="expirydate" value="<?php echo $expirydate;?>">
    <input id="trainername" type="hidden" name="trainername" value="<?php echo $trainername;?>">
    <input id="trainingdate" type="hidden" name="trainingdate" value="<?php echo $trainingdate;?>">-->
<!--                <div class="row">
                    <div class="col-md-12 text-right">
                        <input id="clarify" name="clarify" type="checkbox" value="clarify"> I hereby that ...<input id="to_step_four" name="to_step_four" type="submit" class="btn btn-primary" value="Next">
                    </div>
                </div>-->
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