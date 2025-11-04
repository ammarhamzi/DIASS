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
                                <p><b>Application :</b> Electrical Vehicle Permit (EVP)</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Vehicle</b></p>
                                <p>Registration No :
                                    <?php echo $vehicle_registration_no;?>
                                </p>
                                <p>Parking Area :
                                    <?php echo $vehicle_parkingarea_id;?>
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
                                    <?php echo $inspection_date;?>
                                </p>
                            </div>
                        </div>

                    </div>

                        <div class="col-md-4">
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
                    <div class="col-md-4">

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

        if(!empty($evp_requireddoc_filename)){ foreach($evp_requireddoc_filename as $file){
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

                        </div>
                        <?php
                    if($condition=='renew'){   ?>

                            <h3>Detail of Recent EVP Permit</h3>
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
                <input id="permittype" type="hidden" name="permittype" value="evp">
                <input id="verify_status" type="hidden" name="verify_status" value="<?php echo $verify_status;?>">
                <input id="vehicle_id" type="hidden" name="vehicle_id" value="<?php echo $vehicle_id;?>">
                <input id="vehicle_registration_no" type="hidden" name="vehicle_registration_no" value="<?php echo $vehicle_registration_no;?>">
                <input id="vehicle_parkingarea_id" type="hidden" name="vehicle_parkingarea_id" value="<?php echo $vehicle_parkingarea_id;?>">
                <input id="vehicle_engine_capacity" type="hidden" name="vehicle_engine_capacity" value="<?php echo $vehicle_engine_capacity;?>">

                <input id="inspection_date" type="hidden" name="inspection_date" value="<?php echo $inspection_date;?>">
                <input id="evp_requireddoc" type="hidden" name="evp_requireddoc" value="<?php echo $evp_requireddoc;?>">
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