<!-- \resources\gen_template\master\crud-newpage\views -->
<script src="<?php echo base_url('resources/shared_js/moment/2.29.4/min/moment.min.js'); ?>" crossorigin="anonymous"></script>
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
                                <p><b>Application :</b> Electrical Vehicle Permit (EVP)</p>
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
    <label for="evp_insurancedoc">Insurance coverage <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('evp_insurancedoc') ?><span class="text-danger" id="evp_insurancedoc_error"></span></label>

                                <iframe frameBorder="0" width="100%" height="250px" src="/Uploadfiles/evp_insurancedoc/<?php echo $vehicle_id;?>"></iframe>
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
        <option value="Terminal KLIA">Terminal KLIA</option>
        <option value="Terminal KLIA2">Terminal KLIA2</option>
    </select>
  </div>
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

                        <div class="col-md-6  form-group">
                        <h3>Documentary Requirements</h3>
                        <div class="row">
                            <div class="col-md-12">
<p>Please upload the following documents <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('evp_requireddoc') ?><span class="text-danger" id="evp_requireddoc_error"></span></p>
<ul>
    <li>Letter of employer/owner</li>
    <li>Registration card/proof of purchase</li>
    <li>Previous Vehicle Service Sheet or PUSPAKOM Cert</li>
    <li>Perakuan kelayakan mesin angkat (PMA)</li>

</ul>
                                <iframe frameBorder="0" width="100%" height="250px" src="/Uploadfiles/evp_requireddoc/<?php echo $vehicle_id;?>"></iframe>
                            </div>

                        </div>    
<h3>Vehicle Checklist <span style="font-size: 10pt">(All items are required)</span></h3>
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">

                     <th>Item</th>
                     <th>Detail</th>
                     <th class="no-sort">Declared</th>
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
                    <!-- <td><?php echo ++$start ?></td>-->
                     <td><?php echo $mtwchecklist->mtwchecklist_name ?></td>
<td><?php echo $mtwchecklist->mtwchecklist_desc ?></td>

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
                     ?>
               </tbody>
            </table>
    </div>

                </div>
                <input id="permittype" type="hidden" name="permittype" value="evp">
                <input id="verify_status" type="hidden" name="verify_status" value="1">
                <input id="vehicle_id" type="hidden" name="vehicle_id" value="<?php echo $vehicle_id;?>">
                <input id="vehicle_registration_no" type="hidden" name="vehicle_registration_no" value="<?php echo $vehicle_registration_no;?>">
                <input id="vehicle_parkingarea_id" type="hidden" name="vehicle_parkingarea_id" value="<?php echo $vehicle_parkingarea_id;?>">
                <input id="vehicle_engine_capacity" type="hidden" name="vehicle_engine_capacity" value="<?php echo $vehicle_engine_capacity;?>">

                <input id="inspection_date" type="hidden" name="inspection_date" value="">
                <input id="inspection_title" type="hidden" name="inspection_title" value="">
                <input id="evp_requireddoc" type="hidden" name="evp_requireddoc" value="">
                <input id="evp_insurancedoc" type="hidden" name="evp_insurancedoc" value="">
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
    function redirect(url) {
        $(location).attr('href', url);
    }

    function getuploadfiles(processtype, data) {
        //alert(data);
        if (processtype == 'evp_requireddoc') {
            $("#evp_requireddoc").val(data);
        }
         if(processtype=='evp_insurancedoc'){
         $("#evp_insurancedoc").val(data);
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
                    url: '/Avpevpinspectionmanagement/get_availableslot/evp',
                    type: 'POST',
                    data: {},
                    error: function() {
                        alert('Inspection date not available!');
                    },
                    /*color: 'green',*/ // a non-ajax option
                    textColor: 'white' // a non-ajax option
                },
                eventClick: function(calEvent, jsEvent, view) {
                    if (moment(calEvent.start).format('YYYY-MM-DD') <= moment().format("YYYY-MM-DD")) {
                        alert('Past current date. Please select other date.');
                    } else if(moment(calEvent.start).format('YYYY-MM-DD') < moment().add(3,'days').format("YYYY-MM-DD")){
                       alert('At least 3 days. Please select other date.');
                    } else {
                        if(calEvent.taken < calEvent.available)
                        {
                    //var exam_title = calEvent.title.split('-');
                    //var location = exam_title[0];
                        $("#inspection_date").val(moment(calEvent.start).format('YYYY-MM-DD'));
                        //$("#inspection_date_display").html(moment(calEvent.start).format('DD-MM-YYYY')+"/"+location);
                        $("#inspection_date_display").html(moment(calEvent.start).format('DD-MM-YYYY'));
                        $("#inspection_title").val(calEvent.title);
/*                        $(".fc-event").css('background-color', 'green');
                        $(this).css('background-color', 'blue');*/
                }
                    else
                            alert('The inspection slots are fully booked. Please choose other date.');
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
if($("#evp_insurancedoc").val() == "") {
    $("#evp_insurancedoc_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#evp_insurancedoc_error").html('') ;
}
/*if($("#driver_photo").val() == "") {
    $("#driver_photo_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}
if($("#expirydate").val() == "") {
    $("#expirydate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}*/
if($("#evp_requireddoc").val() == "") {
    $("#evp_requireddoc_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
    var words = $('#evp_requireddoc').val().split(',');
    //alert(words.length);
    if(words.length < 4){
     $("#evp_requireddoc_error").html('<span class="alert_custom">Some required file(s) missing</span>') ;
     status = 1;
    }else{
$("#evp_requireddoc_error").html('') ;
}
}

if($("#location").val() == "") {
    $("#location_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#vehicleclass_error").html('') ;
}

if(status == 1){
$('html, body').animate({ scrollTop: 0 }, 'slow');
return false;
}

}
</script>