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
                                <h3>Application : Ground Power Unit Driving Permit (GPU)</h3>
                            </div>
                        </div>
                        <form autocomplete="off" id="step_one" name="step_two" action="/Permit/stepfour" method="POST" onsubmit="return validateForm()">
                            <div class="box box-primary">

                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">

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
                                                    <p><b>GPU briefing Date:<sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('gpubriefing_date') ?><span class="text-danger" id="gpubriefing_date_error"></span></b></p>
                                                    <p>Please choose any available date to book for gpu briefing. Permit application can only proceed after driver has attend the briefing.</p>

                                                    <div id="calendar"></div>
                                                    <p>
<h3>Selected briefing Date/Location/Session: <span class="label label-warning" id="gpubriefing_date_display"></span></h3>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6 form-group">
                                            <!--     <h3>Supporting Documents</h3>
     <div class="row">
         <div class="col-md-4">Country:</div>
         <div class="col-md-8">
             <select class="select2" id="country" name="country">
                 <option value="">-SELECT-</option>
                 <?php
                 foreach ($countrylist as $value){
                   ?>
                   <option value="<?php echo $value->ref_country_id;?>"><?php echo $value->ref_country_printable_name;?></option>
                   <?php
                 }
                 ?>
             </select>

         </div>
     </div>
     <div class="row">
         <div class="col-md-4">License No:</div>
         <div class="col-md-8"><input type="text" id="licenseno" name="licenseno"></div>
     </div>
     <div class="row">
         <div class="col-md-4">Driving Class:</div>
         <div class="col-md-8"><input type="text" id="drivingclass" name="drivingclass"></div>
     </div>
      <div class="row">
         <div class="col-md-4">Expiry Date:</div>
         <div class="col-md-8"><input type="text" id="expirydate" name="expirydate" class="datepicker"></div>
     </div>-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    Driver Photo <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_photo') ?><span class="text-danger" id="driver_photo_error"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <iframe frameBorder="0" width="100%" height="250px" src="/Uploadfiles/driver_photo/<?php echo $driver_id;?>"></iframe>
                                                </div>
                                            </div>
                                            <h4>Other Documents <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('gpu_requireddoc') ?><span class="text-danger" id="gpu_requireddoc_error"></span></h4>
                                            <div class="row">
                                                <div class="col-md-12">
<p>Documentary Requirement.</p>
<ul>
    <!-- <li>Recent photograph</li> -->
    <li>IC/Passport/Working Permit/Employment Pass</li>
    <li>KLIA/KLIA2 Airport Pass</li>
    <li>Support letter from employer/company</li>
</ul>
                                                    <iframe frameBorder="0" width="100%" height="250px" src="/Uploadfiles/gpu_requireddoc/<?php echo $driver_id;?>"></iframe>
                                                </div>
                                                <!--         <div class="col-md-12">
             <input id="employer_driver_verify" name="employer_driver_verify" type="checkbox" value="y"> I hearby declare that ....
         </div>
         <div class="col-md-12">
         </div>-->
                                            </div>
<!--                                            <?php
                    if($condition=='renew'){   ?>

                                                <h3>Detail of Recent GPU Permit</h3>
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
                                    <input id="permittype" type="hidden" name="permittype" value="gpu">
                                    <input id="verify_status" type="hidden" name="verify_status" value="1">
                                    <input id="driver_id" type="hidden" name="driver_id" value="<?php echo $driver_id;?>">
                                    <input id="driver_name" type="hidden" name="driver_name" value="<?php echo $driver_name;?>">
                                    <input id="driver_ic" type="hidden" name="driver_ic" value="<?php echo $driver_ic;?>">
                                    <input id="gpubriefing_date" type="hidden" name="gpubriefing_date" value="">
<input id="gpubriefing_session" type="hidden" name="gpubriefing_session" value="">
<input id="gpubriefing_title" type="hidden" name="gpubriefing_title" value="">
                                    <input id="gpu_requireddoc" type="hidden" name="gpu_requireddoc" value="">
                                    <!--<input id="adp_trainercert" type="hidden" name="adp_trainercert" value="">-->
                                    <input id="driver_photo" type="hidden" name="driver_photo" value="">
                                    <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">

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
        if (processtype == 'gpu_requireddoc') {
            $("#gpu_requireddoc").val(data);
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
                    url: '/Ffgpubriefingmanagement/get_availableslot',
                    type: 'POST',
                    data: {},
                    error: function() {
                        alert('Briefing date not available!');
                    },
                    /*color: 'green',*/ // a non-ajax option
                    textColor: 'white' // a non-ajax option
                },
                eventClick: function(calEvent, jsEvent, view) {
                    if (moment(calEvent.start).format('YYYY-MM-DD') <= moment().format("YYYY-MM-DD")) {
                        alert('Past current date. Please select other date.');
                    } else if(moment(calEvent.start).format('YYYY-MM-DD') < moment().add(3,'days').format("YYYY-MM-DD")){
                       alert('At least 3 days. Please select other date.');
                    }else {
                    var exam_title = calEvent.title.split('-');
                    var location = exam_title[0];
                        $("#gpubriefing_date").val(moment(calEvent.start).format('YYYY-MM-DD'));
                        $("#gpubriefing_date_display").html(moment(calEvent.start).format('DD-MM-YYYY')+"/"+location+"/"+calEvent.className);
                        $("#gpubriefing_session").val(calEvent.className);
                        $("#gpubriefing_title").val(calEvent.title);
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
if($("#gpubriefing_date").val() == "") {
   $("#gpubriefing_date_error").html('<span class="alert_custom">Required</span>') ;
   status = 1;
}else{
$("#gpubriefing_date_error").html('') ;
}
if($("#driver_photo").val() == "") {
   $("#driver_photo_error").html('<span class="alert_custom">Required</span>') ;
   status = 1;
}else{
$("#driver_photo_error").html('') ;
}
if($("#gpu_requireddoc").val() == "") {
   $("#gpu_requireddoc_error").html('<span class="alert_custom">Required</span>') ;
   status = 1;
}else{
    var words = $('#gpu_requireddoc').val().split(',');
    //alert(words.length);
    if(words.length < 3){
     $("#gpu_requireddoc_error").html('<span class="alert_custom">Some required file(s) missing</span>') ;
     status = 1;
    }else{
$("#gpu_requireddoc_error").html('') ;
}
}

if(status == 1){
$('html, body').animate({ scrollTop: 0 }, 'slow');
return false;
}

}
</script>