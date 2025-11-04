<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            <?php echo $this->lang->line('applypermit');?> </li>
    </ol>

    <!--parentchildmenu-->

    <?php
      if(!empty($this->session->userdata('message'))){
?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                <?php echo $this->session->userdata('message');?>
                            </div>
<?php
      }
    ?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <!--            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                <?php echo $this->lang->line('applypermit');?>
            </h4>-->
            <div class="row">
                <div class="col-md-3">Step 1</div>
                <div class="col-md-3">Step 2</div>
                <div class="col-md-3">Step 3</div>
                <div class="col-md-3"><span class="step_active">Step 4</span><br>Review before sending for approval</div>

            </div>
        </div>
        <div class="panel-body">

            <form autocomplete="off" id="step_submit" name="step_submit" action="/Permit/submit" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Application :</b> Airside Driving Permit (ADP)</p>
                            </div>
                        </div>
                        <div class="row">
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
                                <p><b>Exam Date:</b></p>
                                <p>
                                    <?php echo $examtaker_date;?>
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <h3>Supporting Documents</h3>
                        <div class="row">
                            <div class="col-md-4">Country:</div>
                            <div class="col-md-8">
                                <p>
                                    <?php echo $countryname;?>
                                </p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">License No:</div>
                            <p>
                                <?php echo $licenseno;?>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Driving Class:</div>
                            <p>
                                <?php echo $drivingclass;?>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Expiry Date:</div>
                            <p>
                                <?php echo $expirydate;?>
                            </p>
                        </div>
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
                                        <td>File Name</td>
                                        <td>Size</td>
                                        <td>Type</td>
                                    </tr>
                                    <?php

        if(!empty($adp_requireddoc_filename)){ foreach($adp_requireddoc_filename as $file){
          $filename = explode("--", $file['uploadfiles_filename']);
         ?>
                                        <tr>
                                            <td>
                                                <?php echo $filename[1]; ?>
                                            </td>
                                            <td>
                                                <?php echo $file['uploadfiles_filesize']; ?>KB</td>
                                            <td>
                                                <?php echo $file['uploadfiles_type']; ?>
                                            </td>
                                        </tr>
                                        <?php } }else{
        ?>
                                        <tr>
                                            <td colspan="3">Image(s) not found.....
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
                    </div>
                    <div class="col-md-4">
                        <h3>Trainer & Courser Provider</h3>
                        <div class="row">
                            <div class="col-md-4">Trainer Name:</div>
                            <div class="col-md-8">
                                <p>
                                    <?php echo $trainername;?>
                                </p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Training Date:</div>
                            <div class="col-md-8">
                                <p>
                                    <?php echo $trainingdate;?>
                                </p>
                            </div>
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
                                            <td>
                                                <?php echo $filename[1]; ?>
                                            </td>
                                            <td>
                                                <?php echo $file['uploadfiles_filesize']; ?>KB</td>
                                            <td>
                                                <?php echo $file['uploadfiles_type']; ?>
                                            </td>
                                        </tr>
                                        <?php } }else{
        $ids[] = '';
        ?>
                                        <tr>
                                            <td colspan="3">Image(s) not found.....
                                                <td>
                                        </tr>
                                        <?php }

         ?>
                                </table>
                            </div>
                        </div>
                        <?php
                    if($condition=='renew'){   ?>

                            <h3>Detail of Recent ADP Permit</h3>
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
                        <?php } ?>
                    </div>
                </div>
                <input id="permittype" type="hidden" name="permittype" value="adp">
                <input id="verify_status" type="hidden" name="verify_status" value="<?php echo $verify_status;?>">
                <input id="driver_id" type="hidden" name="driver_id" value="<?php echo $driver_id;?>">
                <input id="driver_name" type="hidden" name="driver_name" value="<?php echo $driver_name;?>">
                <input id="driver_ic" type="hidden" name="driver_ic" value="<?php echo $driver_ic;?>">
                <input id="examtaker_date" type="hidden" name="examtaker_date" value="<?php echo $examtaker_date;?>">
                <input id="adp_requireddoc" type="hidden" name="adp_requireddoc" value="<?php echo $adp_requireddoc;?>">
                <input id="adp_trainercert" type="hidden" name="adp_trainercert" value="<?php echo $adp_trainercert;?>">
                <input id="driver_photo" type="hidden" name="driver_photo" value="<?php echo $driver_photo;?>">

                <input id="country" type="hidden" name="country" value="<?php echo $country;?>">
                <input id="licenseno" type="hidden" name="licenseno" value="<?php echo $licenseno;?>">
                <input id="drivingclass" type="hidden" name="drivingclass" value="<?php echo $drivingclass;?>">
                <input id="expirydate" type="hidden" name="expirydate" value="<?php echo $expirydate;?>">
                <input id="trainername" type="hidden" name="trainername" value="<?php echo $trainername;?>">
                <input id="trainingdate" type="hidden" name="trainingdate" value="<?php echo $trainingdate;?>">
                <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">

                <?php if($condition=='renew'){   ?>
                    <input id="serialno" type="hidden" name="serialno" value="<?php echo $serialno;?>">
                    <input id="expirydate" type="hidden" name="expirydate" value="<?php echo $expirydate;?>">
                    <input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
                    <?php }  ?>

                <div class="row">
                    <div class="col-md-12 text-right">
                        <input id="clarify" name="clarify" type="checkbox" value="clarify"> I hereby that ...<input id="to_step_four" name="to_step_four" type="submit" class="btn btn-primary" value="Next">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function redirect(url) {
        $(location).attr('href', url);
    }
</script>