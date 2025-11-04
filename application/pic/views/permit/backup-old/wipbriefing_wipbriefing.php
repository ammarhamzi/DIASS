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
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li><a href="javacript:return false;" class="disabled">Step 1</a></li>
                    <li><a href="javacript:return false;" class="disabled">Step 2</a></li>
                    <li class="active"><a href="javacript:return false;" data-toggle="tab">Step 3</a></li>
                    <li><a href="javacript:return false;" class="disabled">Step 4</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-question"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_3">
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Application :</b> TEP - Work In Progress (Other Areas)</p>
                            </div>
                        </div>
                        <form autocomplete="off" id="step_one" name="step_two" action="/Permit/stepfour" method="POST" onsubmit="return validateForm()">
                            <div class="box box-primary">

                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">

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
<div class="row">

<div class="col-md-12">
    <h3>Date Of Entry</h3>
  <div class="form-group">
    <label for="startdate">Start Date: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('startdate') ?><span class="text-danger" id="startdate_error"></span></label>
    <input type="text" class="form-control from" id="startdate" name="startdate" placeholder="TEP Permit start date">
  </div>
  <div class="form-group">
    <label for="enddate">End Date: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('enddate') ?><span class="text-danger" id="enddate_error"></span></label>
    <input type="text" class="form-control to" id="enddate" name="enddate" placeholder="TEP Permit end date">
  </div>
</div>
</div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Entry Date:</h3>
                                                    <p><b>Work in progress briefing Date:<sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wipbriefing_date') ?><span class="text-danger" id="wipbriefing_date_error"></span></b></p>
                                                    <p>Please choose any available date to book for Work in progress briefing. Permit application can only proceed after driver has attend the briefing.</p>

                                                    <div id="calendar"></div>
                                                    <p>
<h3>Selected Inspection Date/Location: <span class="label label-warning" id="wipbriefing_date_display"></span></h3>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6 form-group">
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
    <label for="wipbriefing_insurancedoc">Insurance coverage <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wipbriefing_insurancedoc') ?><span class="text-danger" id="wipbriefing_insurancedoc_error"></span></label>

                                <iframe frameBorder="0" width="100%" height="250px" src="/Uploadfiles/wipbriefing_insurancedoc/<?php echo $vehicle_id;?>"></iframe>
  </div>

                            </div>

                        </div>
                        <h4>Other Documents <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('wipbriefing_requireddoc') ?><span class="text-danger" id="wipbriefing_requireddoc_error"></span></h4>
                        <div class="row">
                            <div class="col-md-12">
<p>Documentary Requirement.</p>
<ul>
    <li>Letter of employer/owner</li>
    <li>Registration card/proof of purchase</li>
    <li>Previous Vehicle Service Sheet or PUSPAKOM Cert</li>
    <li>Perakuan kelayakan mesin angkat (PMA)</li>
</ul>
                                <iframe frameBorder="0" width="100%" height="250px" src="/Uploadfiles/wipbriefing_requireddoc/<?php echo $vehicle_id;?>"></iframe>
                            </div>

                        </div>
                                        </div>
                                        <!--    <div class="col-md-4">
     <h3>Trainer & Courser Provider</h3>
     <div class="row">
         <div class="col-md-4">Trainer Name:</div>
         <div class="col-md-8">
             <input type="text" id="trainername" name="trainername">

         </div>
     </div>
      <div class="row">
         <div class="col-md-4">Training Date:</div>
         <div class="col-md-8"><input type="text" id="trainingdate" name="trainingdate" class="datepicker"></div>
     </div>
     <div class="row">
         <div class="col-md-12">
             Certification By Trainer
         </div>
     </div>
     <div class="row">
         <div class="col-md-12">

      <iframe frameBorder="0" src="/Uploadfiles/adp_trainercert/<?php echo $driver_id;?>"></iframe>
         </div>
     </div>
    </div>-->
                                    </div>
                <input id="permittype" type="hidden" name="permittype" value="wipbriefing">
                <input id="verify_status" type="hidden" name="verify_status" value="1">
                <input id="vehicle_id" type="hidden" name="vehicle_id" value="<?php echo $vehicle_id;?>">
                <input id="vehicle_registration_no" type="hidden" name="vehicle_registration_no" value="<?php echo $vehicle_registration_no;?>">
                <input id="vehicle_parkingarea_id" type="hidden" name="vehicle_parkingarea_id" value="<?php echo $vehicle_parkingarea_id;?>">
                <input id="vehicle_engine_capacity" type="hidden" name="vehicle_engine_capacity" value="<?php echo $vehicle_engine_capacity;?>">
                                    <input id="wipbriefing_date" type="hidden" name="wipbriefing_date" value="">
                                    <input id="wipbriefing_title" type="hidden" name="wipbriefing_title" value="">
                                    <input id="wipbriefing_requireddoc" type="hidden" name="wipbriefing_requireddoc" value="">
                <input id="wipbriefing_insurancedoc" type="hidden" name="wipbriefing_insurancedoc" value="">
                <!--<input id="driver_photo" type="hidden" name="driver_photo" value="">-->
                <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">

            <input id="vehicle_vehiclegroup_name" type="hidden" name="vehicle_vehiclegroup_name" value="<?php echo $vehicle_vehiclegroup_name;?>">
            <input id="vehicle_year_manufacture" type="hidden" name="vehicle_year_manufacture" value="<?php echo $vehicle_year_manufacture;?>">
            <input id="vehicle_chasis_no" type="hidden" name="vehicle_chasis_no" value="<?php echo $vehicle_chasis_no;?>">
            <input id="vehicle_engine_no" type="hidden" name="vehicle_engine_no" value="<?php echo $vehicle_engine_no;?>">
            <input id="vehicle_enginetype_name" type="hidden" name="vehicle_enginetype_name" value="<?php echo $vehicle_enginetype_name;?>">

<!--                                    <?php if($condition=='renew'){   ?>
                                    <input id="serialno" type="hidden" name="serialno" value="<?php echo $serialno;?>">
                                    <input id="expirydate" type="hidden" name="expirydate" value="<?php echo $expirydate;?>">
                                    <input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
                                    <?php }  ?>-->

                                </div>

                                <div class="box-footer">
                                    <button id="to_step_four" name="to_step_four" type="submit" class="btn btn-primary pull-right" value="Next" >Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
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
        if (processtype == 'wipbriefing_requireddoc') {
            $("#wipbriefing_requireddoc").val(data);
        }

         if(processtype=='wipbriefing_insurancedoc'){
         $("#wipbriefing_insurancedoc").val(data);
         }
        /* if(processtype=='adp_trainercert'){
         $("#adp_trainercert").val(data);
         }*/
        if (processtype == 'driver_photo') {
            $("#driver_photo").val(data);
        }
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
                    url: '/tepbriefingmanagement/get_availableslot',
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
                    }else {
                    var exam_title = calEvent.title.split('-');
                    var location = exam_title[0];
                        $("#wipbriefing_date").val(moment(calEvent.start).format('YYYY-MM-DD'));
                        $("#wipbriefing_date_display").html(moment(calEvent.start).format('DD-MM-YYYY')+"/"+location);
                        $("#wipbriefing_title").val(calEvent.title);
/*                        $(".fc-event").css('background-color', 'green');
                        $(this).css('background-color', 'blue');*/
                        //alert(moment().add(3,'days').format("YYYY-MM-DD"));
                    }
                }
            })
        });
    });
</script>
<script>
function validateForm(){
var status = 0;
if($("#wipbriefing_date").val() == "") {
   $("#wipbriefing_date_error").html('<span class="alert_custom">Required</span>') ;
   status = 1;
}
if($("#driver_photo").val() == "") {
   $("#driver_photo_error").html('<span class="alert_custom">Required</span>') ;
   status = 1;
}
if($("#wipbriefing_requireddoc").val() == "") {
   $("#wipbriefing_requireddoc_error").html('<span class="alert_custom">Required</span>') ;
   status = 1;
}

if($("#startdate").val() == "") {
    $("#startdate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}

if($("#enddate").val() == "") {
    $("#enddate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}

if($("#policyno").val() == "") {
    $("#policyno_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}
if($("#policyexpirydate").val() == "") {
    $("#policyexpirydate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}
if($("#wipbriefing_insurancedoc").val() == "") {
    $("#wipbriefing_insurancedoc_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}

if(status == 1){
$('html, body').animate({ scrollTop: 0 }, 'slow');
return false;
}

}
</script>