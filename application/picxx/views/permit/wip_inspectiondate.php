<!-- \resources\gen_template\master\crud-newpage\views -->
<script src="<?php echo base_url('resources/shared_js/moment/2.23.0/min/moment.min.js'); ?>" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url('resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.css'); ?>" crossorigin="anonymous" />
<link rel="stylesheet" href="<?php echo base_url('resources/shared_js/fullcalendar/3.9.0/fullcalendar.print.min.css'); ?>" crossorigin="anonymous" media="print" />
<script src="<?php echo base_url('resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.js'); ?>" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url('resources/shared_js/select2/dist/css/select2.min.css'); ?>" crossorigin="anonymous" />
<script src="<?php echo base_url('resources/shared_js/select2/dist/js/select2.min.js'); ?>" crossorigin="anonymous"></script>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Apply Permit (Step 3 of 4)
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
                            <li class="active"><a href="#tab_3" data-toggle="tab">Step 3</a></li>
                            <li><a href="#tab_4" class="disabled">Step 4</a></li>
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-question"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_3">
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Application :</b> TEP - Work In Progress (Runway & Taxiway)</p>
                            </div>
                        </div>
            <form autocomplete="off" id="step_one" name="step_two" action="/Permit/stepfour" method="POST" onsubmit="return validateForm()">
                                <div class="box box-primary">


                            <div class="box-body">
                <div class="row">
                    <div class="col-md-6  form-group">

                        <div class="row">
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
                                <h3>&nbsp;</h3>
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

                        <h3>Vehicle Insurance</h3>
                        <div class="row">
                            <div class="col-md-12">
  <div class="form-group">
    <label for="policyno">Policy No <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('policyno') ?><span class="text-danger" id="policyno_error"></span></label>
    <input type="text" class="form-control" id="policyno" name="policyno" placeholder="Policy No">
  </div>
  <div class="form-group">
    <label for="policyexpirydate">Policy Expiry Date <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('policyexpirydate') ?><span class="text-danger" id="policyexpirydate_error"></span></label>
    <input type="text" class="form-control datepicker_local_insurancedate" id="policyexpirydate" name="policyexpirydate" placeholder="Policy Expiry Date">
  </div>
  <div class="form-group">
    <label for="wip_insurancedoc">Insurance coverage <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wip_insurancedoc') ?><span class="text-danger" id="wip_insurancedoc_error"></span></label>

                                <iframe frameBorder="0" width="100%" height="250px" src="/Uploadfiles/wip_insurancedoc/<?php echo $vehicle_id;?>"></iframe>
  </div>

                            </div>

                        </div>
<div class="row">

<div class="col-md-12">
    <h3>Date Of Entry</h3>
  <div class="form-group">
    <label for="startdate">Start Date <span style="font-size: small"><!-- (At-least 3 working days) --></span>: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('startdate') ?><span class="text-danger" id="startdate_error"></span></label>
    <input type="text" class="form-control fromwip" id="startdate" name="startdate" placeholder="TEP Permit start date">
  </div>
  <div class="form-group">
    <label for="enddate">End Date: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('enddate') ?><span class="text-danger" id="enddate_error"></span></label>
    <input type="text" class="form-control towip" id="enddate" name="enddate" placeholder="TEP Permit end date">
  </div>
</div>
</div>

<div class="row">

<div class="col-md-12">
    <h3>Entry Details</h3>
  <div class="form-group">
    <label for="entrypurpose">Purpose of Entry: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('entrypurpose') ?><span class="text-danger" id="entrypurpose_error"></span></label>
    <input type="text" class="form-control" id="entrypurpose" name="entrypurpose" placeholder="">
  </div>
  <div class="form-group">
    <label for="entrypost">Entry Post: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('entrypost') ?><span class="text-danger" id="entrypost_error"></span></label>
    <!--<input type="text" class="form-control" id="entrypost" name="entrypost" placeholder="">-->
    <select class="form-control" id="entrypost" name="entrypost">
        <option value="">--SELECT--</option>
        <option value="post 1">post 1</option>
        <option value="post 2">post 2</option>
        <option value="post 3">post 3</option>
        <!--<option value="post 4">post 4</option>-->
        <option value="post 5">post 5</option>
        <option value="post 6">post 6</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exitpost">Exit Post: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('exitpost') ?><span class="text-danger" id="exitpost_error"></span></label>
    <!--<input type="text" class="form-control" id="exitpost" name="exitpost" placeholder="">-->
    <select class="form-control" id="exitpost" name="exitpost">
        <option value="">--SELECT--</option>
        <option value="post 1">post 1</option>
        <option value="post 2">post 2</option>
        <option value="post 3">post 3</option>
        <!--<option value="post 4">post 4</option>-->
        <option value="post 5">post 5</option>
        <option value="post 6">post 6</option>
    </select>
  </div>
</div>

<div class="col-md-12">
    <h3>Escort Details</h3>
<div class="form-group">
    <label for="escortservice">Escort Service: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('escortservice') ?><span class="text-danger" id="escortservice_error"></span></label>
<p><input type="radio" name="escortservice" value="y"> <span style="color: #009900">Escorted by airside</span> </p>
<p><input type="radio" name="escortservice" value="n"> <span style="color: #CC0000">Own escort (detail as below)</span></p>
</div>
  <div class="form-group">
    <label for="steerman_name">Steerman name: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('steerman_name') ?><span class="text-danger" id="steerman_name_error"></span></label>
    <input type="text" class="form-control" id="steerman_name" name="steerman_name" placeholder="" readonly>
  </div>
  <div class="form-group">
    <label for="steerman_icno">Steerman IC No: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('steerman_icno') ?><span class="text-danger" id="steerman_icno_error"></span></label>
    <input type="text" class="form-control" id="steerman_icno" name="steerman_icno" placeholder="" readonly>
  </div>
  <div class="form-group">
    <label for="steerman_adpno">Steerman ADP Number: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('steerman_adpno') ?><span class="text-danger" id="steerman_adpno_error"></span></label>
    <input type="text" class="form-control datepicker_local_insurancedate" id="steerman_adpno" name="steerman_adpno" placeholder="" readonly>
  </div>

</div>
</div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Inspection Date:</h3>
                                <p>Please choose any available date to book for inspection. Permit application can only proceed after vehicle pass the inspection.</p>

                                <div id="calendar"></div>

<br>
<div class="form-group">
    <label for="inspection_date">Selected Inspection Date <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('inspection_date') ?><span class="text-danger" id="inspection_date_error"></span></label>
   <h3><span class="label label-warning" id="inspection_date_display"></span></h3><br>
    </div>

<h3>Inspection Location</h3>
  <div class="form-group">
    <label for="location">Location <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('location') ?><span class="text-danger" id="location_error"></span></label>
    <select id="location" name="location" class="form-control">
        <option value="">-SELECT-</option>
        <option value="MTW">MTW</option>
        <option value="Airside KLIA">Airside KLIA</option>
        <option value="Airside KLIA2">Airside KLIA2</option>
    </select>
  </div>
                            </div>
                        </div>

                        <h3>Documentary Requirements</h3>
                        <div class="row">
                            <div class="col-md-12">
<p>Please upload the following documents <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wip_requireddoc') ?><span class="text-danger" id="wip_requireddoc_error"></span></p>
<ul>
    <li>Letter of employer/owner</li>
    <li>Letter of award/contract</li>
    <li>Registration card/proof of purchase</li>
    <li>Airside work permit</li>
    <li>Airside safety briefing attendance</li>
    <li>Previous Vehicle Service Sheet or PUSPAKOM Cert [All vehicle except motorcycle or bicycle]</li>
    <li>Perakuan kelayakan mesin angkat (PMA) [optional]</li>

</ul>
                                <iframe frameBorder="0" width="100%" height="250px" src="/Uploadfiles/wip_requireddoc/<?php echo $vehicle_id;?>"></iframe>
                            </div>

                        </div>
<!--                        <?php
                    if($condition=='renew'){   ?>

                            <h3>Detail of Recent WIP Permit</h3>
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

                        <div class="col-md-6  form-group">
<h3>Vehicle Checklist</h3>
<p>Guideline for vehicle inspection. <a href="/resources/tutorial/Guideline-for-vehicle-inspection.pdf" target="_blank" title="Inspection Guideline"><img src="/resources//shared_img/pdf_icons.png" width="24" height="24" alt="">Download</a></p>
<h4>General Requirement <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup></h4>
<div class="row">
<div class="col-md-6">

            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">
                     <th>Item</th>
<th>Declared</th>

                     <!--<th class="no-sort">&nbsp;</th>-->
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
                     <td><div><?php echo $mtwchecklist->mtwchecklist_name ?></div></td>
<!--<td><?php echo $mtwchecklist->mtwchecklist_desc ?></td>-->

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        echo '<input checked onclick="this.checked=!this.checked;" id="mtwchecklist_selected" name="mtwchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '">';
                                    ?>
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
<th>Declared</th>

                     <!--<th class="no-sort">&nbsp;</th>-->
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
                     <td><div><?php echo $mtwchecklist->mtwchecklist_name ?></div></td>
<!--<td><?php echo $mtwchecklist->mtwchecklist_desc ?></td>-->

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        echo '<input checked onclick="this.checked=!this.checked;" id="mtwchecklist_selected" name="mtwchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '">';
                                    ?>
                                    </div>
                                </td>
                  </tr>
                  <?php
                  }
                  }
                     }
                     }
                     ?>
               </tbody>
            </table>
</div>
</div>
                                <table class="table table-bordered" style="width: 100% !important">
                                    <tr style=" background-color: #C9D4E1">
                                       <th>&nbsp;</th>
                                       <th>Declared</th>

                                    </tr>
                                    <tr>
                                   <td>Smoke Condition (Diesel): <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('smokecondition') ?><span class="text-danger" id="smokecondition_error"></span></td>
                                   <td>
                                   <select id="smokecondition" name="smokecondition" size="1">
                                   <option value="L1">L1</option>
                                   <option value="L2">L2</option>
                                   <option value="L3">L3</option>
                                   <option value="L4">L4</option>
                                   <option value="L5">L5</option>
                                   </select>
                                    </td>
                                    </tr>
                                    <tr>
                                   <th colspan="3" style=" background-color: #C9D4E1">Fire Extinguisher Information <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('fireext_require') ?><span class="text-danger" id="fireext_require_error"></span></th>
                                    </tr>
                                    <tr>
                                   <td colspan="3">
<p><input type="radio" name="fireext_require" value="y"> <span style="color: #009900">This is 4 tires vehicle thus require fire extinguisher</span> </p>
<p><input type="radio" name="fireext_require" value="n"> <span style="color: #CC0000">This is 2 tires vehicle thus not require fire extinguisher</span></p>
                                   </td>
                                    </tr>
                                    <tr>
                                   <td>Serial No: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('fireext_serialno') ?><span class="text-danger" id="fireext_serialno_error"></span></td>
                                   <td><input id="fireext_serialno" name="fireext_serialno" disabled> </td>
                                    </tr>
                                    <tr>
                                   <td>Expiry Date: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('fireext_expirydate') ?><span class="text-danger" id="fireext_expirydate_error"></span></td>
                                   <td><input id="fireext_expirydate" name="fireext_expirydate" class="datepicker_local_insurancedate" disabled> </td>
                                    </tr>

                                    <tr>
                                   <th colspan="3" style=" background-color: #C9D4E1">All Tyres </th>
                                    </tr>
                                    <tr>
                                   <td>Manufacturing Date: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('tyre_manufacturingdate') ?><span class="text-danger" id="tyre_manufacturingdate_error"></span></td>
                                   <td><!--<input id="tyre_manufacturingdate" name="tyre_manufacturingdate" class="datepicker">--><textarea id="tyre_manufacturingdate" name="tyre_manufacturingdate" class="form-control" placeholder="" rows="5" disabled>

                                   </textarea>
(Please insert additional tyre information if required)
                                   </td>
                                    </tr>
                                </table>
<div class="row">
<div class="col-md-6">
<h4>Additional Requirement</h4>
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">
                     <th>Item</th>
<th>Declared</th>

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
                     <td><div><?php echo $mtwchecklist->mtwchecklist_name ?></div></td>
<!--<td><?php echo $mtwchecklist->mtwchecklist_desc ?></td>-->

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        echo '<input id="mtwchecklist_selected" name="mtwchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '">';
                                    ?>
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
<h4>Special Requirement</h4>
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">
                     <th>Item</th>
<th>Declared</th>

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
                     <td><div><?php echo $mtwchecklist->mtwchecklist_name ?></div></td>
<!--<td><?php echo $mtwchecklist->mtwchecklist_desc ?></td>-->

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        echo '<input id="mtwchecklist_selected" name="mtwchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '">';
                                    ?>
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


    </div>

                </div>
                <input id="permittype" type="hidden" name="permittype" value="wip">
                <input id="verify_status" type="hidden" name="verify_status" value="1">
                <input id="vehicle_id" type="hidden" name="vehicle_id" value="<?php echo $vehicle_id;?>">
                <input id="vehicle_registration_no" type="hidden" name="vehicle_registration_no" value="<?php echo $vehicle_registration_no;?>">
                <input id="vehicle_parkingarea_id" type="hidden" name="vehicle_parkingarea_id" value="<?php echo $vehicle_parkingarea_id;?>">
                <input id="vehicle_engine_capacity" type="hidden" name="vehicle_engine_capacity" value="<?php echo $vehicle_engine_capacity;?>">

                <input id="inspection_date" type="hidden" name="inspection_date" value="">
                <input id="inspection_title" type="hidden" name="inspection_title" value="">
                <input id="wip_requireddoc" type="hidden" name="wip_requireddoc" value="">
                <input id="wip_insurancedoc" type="hidden" name="wip_insurancedoc" value="">
                <!--<input id="driver_photo" type="hidden" name="driver_photo" value="">-->
                <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">

            <input id="vehicle_vehiclegroup_name" type="hidden" name="vehicle_vehiclegroup_name" value="<?php echo $vehicle_vehiclegroup_name;?>">
            <input id="vehicle_year_manufacture" type="hidden" name="vehicle_year_manufacture" value="<?php echo $vehicle_year_manufacture;?>">
            <input id="vehicle_chasis_no" type="hidden" name="vehicle_chasis_no" value="<?php echo $vehicle_chasis_no;?>">
            <input id="vehicle_engine_no" type="hidden" name="vehicle_engine_no" value="<?php echo $vehicle_engine_no;?>">
            <input id="vehicle_enginetype_name" type="hidden" name="vehicle_enginetype_name" value="<?php echo $vehicle_enginetype_name;?>">


<!--                <?php if($condition=='renew'){   ?>
                    <input id="serialno" type="hidden" name="serialno" value="<?php echo $serialno;?>">
                    <input id="expirydate" type="hidden" name="expirydate" value="<?php echo $expirydate;?>">
                    <input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
                    <?php }  ?>-->


                </div>
                            <div class="box-footer">
                  <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="to_step_four" name="to_step_four" type="submit" class="btn btn-primary pull-right" value="Next" >Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
                    </div>
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
$(document).ready(function() {

$("input[name='escortservice']").change(function () {
   if($("input[name='escortservice']:checked").val()=='y'){
   $("#steerman_name").prop("readonly", true);
   $("#steerman_icno").prop("readonly", true);
   $("#steerman_adpno").prop("readonly", true);
   $("#steerman_name").val("");
   $("#steerman_icno").val("");
   $("#steerman_adpno").val("");
   $("#steerman_name_error").html('') ;
   $("#steerman_icno_error").html('') ;
   $("#steerman_adpno_error").html('') ;
   }else{
   $("#steerman_name").prop("readonly", false);
   $("#steerman_icno").prop("readonly", false);
   $("#steerman_adpno").prop("readonly", false);
   }

});

});
</script>
<script>
    function redirect(url) {
        $(location).attr('href', url);
    }

    function getuploadfiles(processtype, data) {
        //alert(data);
        if (processtype == 'wip_requireddoc') {
            $("#wip_requireddoc").val(data);
        }
         if(processtype=='wip_insurancedoc'){
         $("#wip_insurancedoc").val(data);
         }
/*        if (processtype == 'driver_photo') {
            $("#driver_photo").val(data);
        }*/
    }
</script>
<script>
    $(document).ready(function() {
        $(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                weekends: false,
                defaultView: 'month',
                events: {
                    url: '/Tepinspectionmanagement/get_availableslot/',
                    type: 'POST',
                    data: {},
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                    /*color: 'green',*/ // a non-ajax option
                    textColor: 'white' // a non-ajax option
                },
                eventClick: function(calEvent, jsEvent, view) {
                    if (moment(calEvent.start).format('YYYY-MM-DD') <= moment().format("YYYY-MM-DD")) {
                        alert('past current date!. Please select other date.');
                    } else if(moment(calEvent.start).format('YYYY-MM-DD') < moment().add(3,'days').format("YYYY-MM-DD")){
                       alert('Atleast 3 days!. Please select other date.');
                    } else {
                    var exam_title = calEvent.title.split('-');
                    var location = exam_title[0];
                        $("#inspection_date").val(moment(calEvent.start).format('YYYY-MM-DD'));
                        //$("#inspection_date_display").html(moment(calEvent.start).format('DD-MM-YYYY')+"/"+location);
                        $("#inspection_date_display").html(moment(calEvent.start).format('DD-MM-YYYY'));
                        $("#inspection_title").val(calEvent.title);
/*                        $(".fc-event").css('background-color', 'green');
                        $(this).css('background-color', 'blue');*/
                    }
                }
            })
        });

             var table =   $("#mytable").DataTable(
             {
               responsive: true,
        scrollY:        '50vh',
        scrollCollapse: true,
        paging:         false,
        "ordering": false,
        "info":     false,
        searching: false
             });
    });
</script>
<script>
function validateForm(){
var status = 0;
if($("#inspection_date").val() == "") {
    $("#inspection_date_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#inspection_date_error").html('') ;
}

if($("input[name='escortservice']:checked").val() == null) {
    $("#escortservice_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#escortservice_error").html('') ;
}

if($("#entrypurpose").val() == "") {
   $("#entrypurpose_error").html('<span class="alert_custom">Required</span>') ;
   status = 1;
}else{
$("#entrypurpose_error").html('') ;
}

if($("#entrypost").val() == "") {
   $("#entrypost_error").html('<span class="alert_custom">Required</span>') ;
   status = 1;
}else{
$("#entrypost_error").html('') ;
}

if($("#exitpost").val() == "") {
   $("#exitpost_error").html('<span class="alert_custom">Required</span>') ;
   status = 1;
}else{
$("#exitpost_error").html('') ;
}

if($("input[name='escortservice']:checked").val()=='n'){
    if($("#steerman_name").val() == "") {
       $("#steerman_name_error").html('<span class="alert_custom">Required</span>') ;
       status = 1;
    }else{
    $("#steerman_name_error").html('') ;
    }

    if($("#steerman_icno").val() == "") {
       $("#steerman_icno_error").html('<span class="alert_custom">Required</span>') ;
       status = 1;
    }else{
    $("#steerman_icno_error").html('') ;
    }

    if($("#steerman_adpno").val() == "") {
       $("#steerman_adpno_error").html('<span class="alert_custom">Required</span>') ;
       status = 1;
    }else{
    $("#steerman_adpno_error").html('') ;
    }
}else{
   $("#steerman_name_error").html('') ;
   $("#steerman_icno_error").html('') ;
   $("#steerman_adpno_error").html('') ;
}

if($("#policyno").val() == "") {
    $("#policyno_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#policyno_error").html('') ;
}
if($("#policyexpirydate").val() == "") {
    $("#policyexpirydate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#policyexpirydate_error").html('') ;
}
if($("#wip_insurancedoc").val() == "") {
    $("#wip_insurancedoc_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#wip_insurancedoc_error").html('') ;
}
/*if($("#driver_photo").val() == "") {
    $("#driver_photo_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}
if($("#expirydate").val() == "") {
    $("#expirydate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}*/
if($("#wip_requireddoc").val() == "") {
    $("#wip_requireddoc_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
    var words = $('#wip_requireddoc').val().split(',');
    //alert(words.length);
    if(words.length < 5){
     $("#wip_requireddoc_error").html('<span class="alert_custom">Some required file(s) missing</span>') ;
     status = 1;
    }else{
$("#wip_requireddoc_error").html('') ;
}
}

if($("#smokecondition").val() == "") {
    $("#smokecondition_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#smokecondition_error").html('') ;
}

if($("#fireext_serialno").val() == "") {
    $("#fireext_serialno_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#fireext_serialno_error").html('') ;
}

if($("#fireext_expirydate").val() == "") {
    $("#fireext_expirydate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#fireext_expirydate_error").html('') ;
}

if($("#tyre_manufacturingdate").val() == "") {
    $("#tyre_manufacturingdate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#tyre_manufacturingdate_error").html('') ;
}

if($("#startdate").val() == "") {
    $("#startdate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#startdate_error").html('') ;
}

if($("#enddate").val() == "") {
    $("#enddate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#enddate_error").html('') ;
}

if($("#location").val() == "") {
    $("#location_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#location_error").html('') ;
}

if(status == 1){
$('html, body').animate({ scrollTop: 0 }, 'slow');
return false;
}

}
</script>
<script>
$(document).ready(function() {
 $("input[name='fireext_require']").click(function () {
   if($("input[name='fireext_require']:checked").val() == 'n') {
      $("#fireext_serialno").prop("disabled", true);
      $("#fireext_expirydate").prop("disabled", true);
      $("#tyre_manufacturingdate").prop("disabled", false);
      $("#fireext_serialno").val("NA");
      $("#fireext_expirydate").val("NA");
      $("#tyre_manufacturingdate").val("tyre front:\ntyre rear:");
$("#fireext_serialno_error").html('') ;
$("#fireext_expirydate_error").html('') ;

   }else{
      $("#fireext_serialno").prop("disabled", false);
      $("#fireext_expirydate").prop("disabled", false);
      $("#tyre_manufacturingdate").prop("disabled", false);
      $("#fireext_serialno").val("");
      $("#fireext_expirydate").val("");
      $("#tyre_manufacturingdate").val("tyre front right:\ntyre front left:\ntyre rear right:\ntyre rear left:");
   }

 });
});
</script>