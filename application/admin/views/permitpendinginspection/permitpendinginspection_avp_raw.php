<?php
if($permit_statusname == 'inspectionpending' || $permit_statusname == 'inspectionkiv'){
?>
<div class="container-fluid">
                            <div class="box box-primary">
                                                        <div class="box-header with-border">
                            <h3 class="box-title">Your Action : MTW Inspection</h3>
                            <div class="box-tools pull-right">
<!--                                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                            </div>
                        </div>
                        <form id="submitform" name="submitform" action="/admin/permitpendinginspection/avp_submit/" method="POST">
                            <div class="box-body">
<div class="form-group">
<label for="picremark">PIC Remark</label>
<div>
<?php echo ($permit_apply_remark?$permit_apply_remark:"<i>- No Remark -</i>");?>
</div>
</div>
<div class="row">
<div class="col-md-12">
<h3>You are <span style="color: #CC0000">REQUIRED</span> to download/read these files and ensure that the files comply with the requirement of Airport Standards Directive 506.</h3>
                                    <?php
if($permit_files){
									$count = 0;$inspection_required_to_read = '';
foreach ($permit_files as $file) {
    $filename = explode("--", $file->uploadfiles_filename);

//inspection required

if($file->uploadfiles_docname=="Previous Vehicle Service Sheet or PUSPAKOM Cert" or $file->uploadfiles_docname == "Perakuan kelayakan mesin angkat (PMA)"){
$inspection_required_to_read .= '<li><a href="' .$this->config->item('client_url'). '/uploads/files/' .$file->uploadfiles_filename. '" target="_blank">'.$file->uploadfiles_docname.'</a></li>';
}
}
}
?>
<div class="row">
  <div class="col-md-12">
<ul>
<?php echo $inspection_required_to_read;?>
</ul>
  </div>
</div>
<h3>General Requirement <span style="font-size: 10pt"><sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup></span></h3>
<div class="row">
<div class="col-md-6">
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">
                     <th>Item</th>
<th nowrap>Declared</th>
<th nowrap>MTW Inspected</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($mtwchecklist_data){
                       $count = 0;
                     foreach ($mtwchecklist_data as $mtwchecklist)
                     {


                     if($mtwchecklist->mtwchecklist_group == 'g'){
                      ++$count;
                      if($count <= 18){
                         ?>
                  <tr>

                     <td><?php echo $mtwchecklist->mtwchecklist_name ?></td>


                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">

                                    <?php
                                        echo '<input onclick="this.checked=!this.checked;"  id="selfchecklist_selected" name="selfchecklist_selected[]"  type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_selfchecked_selected)?"checked":""). ' >';
                                    ?>
                                    </div>
                                </td>
                                <td style="text-align:left; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        //echo '<input  id="mtwchecklist_selected" name="mtwchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '"' .(in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_selected)?"checked":""). '>';
                                    ?>

                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>"  value="y" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_y_selected)?"checked":"");?>
                                            /> <span style="color: #00CC00">PASS</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_n_selected)?"checked":"");?>
                                            /> <span style="color: #CC0000">FAIL</span>
											<br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n/a" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_na_selected)?"checked":"");?>
                                            /> <span style="color: black">N/A</span>
                                        <input id="mtwchecklist_ids" type="hidden" name="mtwchecklist_ids[]" value="<?php echo $mtwchecklist->mtwchecklist_id;?>">
                                    </div>
                                </td>
                  </tr>
                  <?php
                       }
                     } }
                     }
                     ?>
               </tbody>
            </table>
</div>
<div class="col-md-6">
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">
                     <th>Item</th>
<th nowrap>Declared</th>
<th nowrap>MTW Inspected</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($mtwchecklist_data){
                       $count = 0;
                     foreach ($mtwchecklist_data as $mtwchecklist)
                     {


                     if($mtwchecklist->mtwchecklist_group == 'g'){
                      ++$count;
                      if($count > 18){
                         ?>
                  <tr>

                     <td><?php echo $mtwchecklist->mtwchecklist_name ?></td>


                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">

                                    <?php
                                        echo '<input onclick="this.checked=!this.checked;"  id="selfchecklist_selected" name="selfchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_selfchecked_selected)?"checked":""). ' >';
                                    ?>
                                    </div>
                                </td>
                                <td style="text-align:left; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        //echo '<input  id="mtwchecklist_selected" name="mtwchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '"' .(in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_selected)?"checked":""). '>';
                                    ?>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>"  value="y" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_y_selected)?"checked":"");?>
                                            /> <span style="color: #00CC00">PASS</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_n_selected)?"checked":"");?>
                                            /> <span style="color: #CC0000">FAIL</span>
											<br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n/a" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_na_selected)?"checked":"");?>
                                            /> <span style="color: black">N/A</span>
                                        <input id="mtwchecklist_ids" type="hidden" name="mtwchecklist_ids[]" value="<?php echo $mtwchecklist->mtwchecklist_id;?>">
                                    </div>
                                </td>
                  </tr>
                  <?php
                       }
                     } }
                     }
                     ?>
               </tbody>
            </table>
</div>
</div>

<div class="row">
   <div class="col-md-12">
                                <table class="table table-bordered" style="width: 100% !important">
                                    <tr style=" background-color: #C9D4E1">
                                       <th>&nbsp;</th>
                                       <th>Declared</th>
                                       <th>MTW inspected</th>
                                    </tr>
                                    <tr>
                                   <td>Smoke Condition (Diesel): </td>
                                   <td>
                                   <?php echo $avppermit_smokecondition;?>
                                    </td>
                                    <td><!--<input type="checkbox" name="smokecondition_checked" value="y">-->

                                    <?php
 if($avppermit_smokecondition_mtw == '-'){
?>
                    <select id="smokecondition_mtw" name="smokecondition_mtw" size="1">
                   <option value="L1" <?php echo ($avppermit_smokecondition=='L1'?"selected":"");?>>L1</option>
                   <option value="L2" <?php echo ($avppermit_smokecondition=='L2'?"selected":"");?>>L2</option>
                   <option value="L3" <?php echo ($avppermit_smokecondition=='L3'?"selected":"");?>>L3</option>
                   <option value="L4" <?php echo ($avppermit_smokecondition=='L4'?"selected":"");?>>L4</option>
                   <option value="L5" <?php echo ($avppermit_smokecondition=='L5'?"selected":"");?>>L5</option>
                   </select>
<?php
 }else{
?>
                    <select id="smokecondition_mtw" name="smokecondition_mtw" size="1">
                   <option value="L1" <?php echo ($avppermit_smokecondition_mtw=='L1'?"selected":"");?>>L1</option>
                   <option value="L2" <?php echo ($avppermit_smokecondition_mtw=='L2'?"selected":"");?>>L2</option>
                   <option value="L3" <?php echo ($avppermit_smokecondition_mtw=='L3'?"selected":"");?>>L3</option>
                   <option value="L4" <?php echo ($avppermit_smokecondition_mtw=='L4'?"selected":"");?>>L4</option>
                   <option value="L5" <?php echo ($avppermit_smokecondition_mtw=='L5'?"selected":"");?>>L5</option>
                   </select>
<?php
 }
                                    ?>

                                    </td>
                                    </tr>
                                    <tr>
                                   <th colspan="3" style=" background-color: #C9D4E1">Fire Extinguisher </th>
                                    </tr>
                                    <tr>
                                   <td>Serial No: </td>
                                   <td><?php echo $avppermit_fireext_serialno;?> </td>
                                   <td><!--<input type="checkbox" name="fireext_serialno_checked" value="y">-->
                                   <input id="fireext_serialno_mtw" name="fireext_serialno_mtw" value="<?php echo ($avppermit_fireext_serialno_mtw=='-'?$avppermit_fireext_serialno:$avppermit_fireext_serialno_mtw);?>">
                                   </td>
                                    </tr>
                                    <tr>
                                   <td>Expiry Date: </td>
                                   <td><?php echo datelocal($avppermit_fireext_expirydate);?> </td>
                                   <td><!--<input type="checkbox" name="fireext_expirydate_checked" value="y">-->
                                   <input id="fireext_expirydate_mtw" name="fireext_expirydate_mtw" class="datepicker_local" value="<?php echo ($avppermit_fireext_expirydate_mtw=='-'?datelocal($avppermit_fireext_expirydate):datelocal($avppermit_fireext_expirydate_mtw));?>">
                                   </td>
                                    </tr>

                                    <tr>
                                   <th colspan="3" style=" background-color: #C9D4E1">All Tyres </th>
                                    </tr>
                                    <tr>
                                   <td>Manufacturing Date: </td>
                                   <td><?php echo $avppermit_tyre_manufacturingdate;?> </td>
                                   <td><!--<input type="checkbox" name="tyre_manufacturingdate_checked" value="y">-->
                                   <textarea id="tyre_manufacturingdate_mtw" name="tyre_manufacturingdate_mtw" class="form-control" placeholder="" rows="5">
<?php echo str_replace(array('<br>','<br />'),array('',''),($avppermit_tyre_manufacturingdate_mtw=='-'?$avppermit_tyre_manufacturingdate:$avppermit_tyre_manufacturingdate_mtw));?>
                                   </textarea>
                                   </td>
                                    </tr>
<!--                                    <tr>
                                       <td colspan="3">
                                           <button id="save_draf" name="safe_draf" class="btn btn-warning">Save As DRAF<br><span style="font-size: x-small">save without submit</span></button>
                                       </td>
                                    </tr>-->
                                </table>
   </div>
</div>
<div class="row">
<div class="col-md-6">
<h3>Additional Requirement</h3>
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">
                     <th>Item</th>
<th>Declared</th>
<th>MTW Inspected</th>

                     <!--<th class="no-sort">&nbsp;</th>-->
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($mtwchecklist_data){

                     foreach ($mtwchecklist_data as $mtwchecklist)
                     {


                     if($mtwchecklist->mtwchecklist_group == 'a'){

                         ?>
                  <tr>

                     <td><?php echo $mtwchecklist->mtwchecklist_name ?></td>


                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">

                                    <?php
                                        echo '<input onclick="this.checked=!this.checked;"  id="selfchecklist_selected" name="selfchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_selfchecked_selected)?"checked":""). ' >';
                                    ?>
                                    </div>
                                </td>
                                <td style="text-align:left; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        //echo '<input  id="mtwchecklist_selected" name="mtwchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '"' .(in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_selected)?"checked":""). '>';
                                    ?>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>"  value="y" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_y_selected)?"checked":"");?>
                                            /> <span style="color: #00CC00">PASS</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_n_selected)?"checked":"");?>
                                            /> <span style="color: #CC0000">FAIL</span>
											<br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n/a" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_na_selected)?"checked":"");?>
                                            /> <span style="color: black">N/A</span>
                                        <input id="mtwchecklist_ids" type="hidden" name="mtwchecklist_ids[]" value="<?php echo $mtwchecklist->mtwchecklist_id;?>">
                                    </div>
                                </td>
                  </tr>
                  <?php

                     }
                      }
                     }
                     ?>
               </tbody>
            </table>
</div>
<div class="col-md-6">
<h3>Special Requirement</h3>
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr  style=" background-color: #C9D4E1">
                     <th>Item</th>
<th>Declared</th>
<th>MTW Inspected</th>

                     <!--<th class="no-sort">&nbsp;</th>-->
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($mtwchecklist_data){

                     foreach ($mtwchecklist_data as $mtwchecklist)
                     {


                     if($mtwchecklist->mtwchecklist_group == 's'){

                         ?>
                  <tr>

                     <td><?php echo $mtwchecklist->mtwchecklist_name ?></td>


                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">

                                    <?php
                                        echo '<input onclick="this.checked=!this.checked;"  id="selfchecklist_selected" name="selfchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_selfchecked_selected)?"checked":""). ' >';
                                    ?>
                                    </div>
                                </td>
                                <td style="text-align:left; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        //echo '<input  id="mtwchecklist_selected" name="mtwchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '"' .(in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_selected)?"checked":""). '>';
                                    ?>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>"  value="y" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_y_selected)?"checked":"");?>
                                            /> <span style="color: #00CC00">PASS</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_n_selected)?"checked":"");?>
                                            /> <span style="color: #CC0000">FAIL</span>
											<br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n/a" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_na_selected)?"checked":"");?>
                                            /> <span style="color: black">N/A</span>
                                        <input id="mtwchecklist_ids" type="hidden" name="mtwchecklist_ids[]" value="<?php echo $mtwchecklist->mtwchecklist_id;?>">
                                    </div>
                                </td>
                  </tr>
                  <?php

                     }
                      }
                     }
                     ?>
               </tbody>
            </table>
</div>
</div>

  <div class="form-group">
    <h3>Upload Reference Files </h3>

                                <iframe frameBorder="0" width="100%" height="250px" src="/admin/Uploadfiles/avp_inspectordoc/<?php echo $vehicle_id;?>/<?php echo $raw_permit_id;?>"></iframe>
  </div>
<button id="save_draf" name="safe_draf" class="btn btn-warning">Save As DRAF<br><span style="font-size: x-small">save without submit</span></button>
<!--<div class="row">
  <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                   <th colspan="2">DECLARATION </th>
                                    </tr>
                                    <tr>
                                        <td>Status <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('adminapproval') ?></td>
                                        <td><input id="adminapproval" name="adminapproval" type="radio" value="y"><span style="color: #339900"> I certify that this vehicle (<?php echo $vehicle_registration_no;?>) COMPLY </span> <br>
                                            <input id="adminapproval" name="adminapproval" type="radio" value="n"> <span style="color: #FF0000">I certify that this vehicle (<?php echo $vehicle_registration_no;?>) NOT COMPLY</span></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><input id="agree" name="agree" type="checkbox" value="y"> I hereby confirm that the information provided herein is accurate, correct and complete and that the documents submitted along with this application form are genuine.  <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('agree') ?><br><input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary"></td>
                                    </tr>

                                </table>
  </div>
  <div class="col-md-6">            <table class="table">
                                    <tr>
                                        <th>Remark</th>
                                        <td><textarea class="form-control"  id="remark" name="remark"><?php echo $permit_inspection_remark;?></textarea></td>
                                    </tr>
                                    </table>
  </div>
</div>-->

<div class="row">
  <div class="col-md-12">
<h3>Check submitted information & documents. </h3>
    <div class="form-group">
        <label for="activitydate">Inspection Date: </label>
        <input id="activitydate" name="activitydate" class="form-control datepicker" value="<?php echo $avppermit_inspection_date;?>">
    </div>

    <div class="form-group">
        <label for="inspectionresult">Inspection Result: </label>
<p><input id="adminapproval" name="adminapproval" type="radio" value="y"> I certify that this "Vehicle" <span style="color: #339900">COMPLY</span> with the requirement of Airport Standards Directive 506 during the time and date of the inspection.  <br>
<input id="adminapproval" name="adminapproval" type="radio" value="n"> I certify that for the reason (s) shown above this "Vehicle" <span style="color: #FF0000">DOES NOT COMPLY</span> with the requirement of Airport Standards Directive 506 during the time and date of the inspection.</p>
    </div>

    <div class="form-group">
        <label for="remark">Remark </label>
        <textarea class="form-control"  id="remark" name="remark"><?php echo $permit_inspection_remark;?></textarea>
    </div>

<input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary pull-right">
  </div>
</div>
                                <input type="hidden" name="approvaldate" id="approvaldate" readonly value="<?php echo date('Y-m-d H:i:s');?>">
                                <input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id; ?>">
    </div>
    </div>
    </div>
    </form>
                </div>
            </div>
<?php
}else{

}
?>

