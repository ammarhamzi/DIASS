<!-- \resources\gen_template\master\crud-newpage\views -->
<script src="<?php echo base_url('resources/shared_js/moment/2.23.0/min/moment.min.js'); ?>" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url('resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.css'); ?>" crossorigin="anonymous" />
<link rel="stylesheet" href="<?php echo base_url('resources/shared_js/fullcalendar/3.9.0/fullcalendar.print.min.css'); ?>" crossorigin="anonymous" media="print" />
<script src="<?php echo base_url('resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.js'); ?>" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url('resources/shared_js/select2/dist/css/select2.min.css'); ?>" crossorigin="anonymous" />
<script src="<?php echo base_url('resources/shared_js/select2/dist/js/select2.min.js'); ?>" crossorigin="anonymous"></script>
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
                <div class="col-md-3"><span class="step_active">Step 3</span><br>Choose date for exam</div>
                <div class="col-md-3">Step 4</div>
            </div>
        </div>
        <div class="panel-body">

            <form autocomplete="off" id="step_one" name="step_two" action="/Permit/stepfour" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Application :</b> Electrical Vehicle Driving Permit (EVDP)</p>
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
                            <div class="col-md-4">
                                <p><b>Terminal briefing Date:</b></p>
                                <p>Please choose any available date to book for terminal briefing. Permit application can only proceed after driver has attend the briefing.</p>
                            </div>
                            <div class="col-md-8">
                                <div id="calendar"></div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
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
                                Driver Photo
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <iframe frameBorder="0" src="/Uploadfiles/driver_photo/<?php echo $driver_id;?>"></iframe>
                            </div>
                        </div>
                        <h3>Other Documents</h3>
                        <div class="row">
                            <div class="col-md-12">

                                <iframe frameBorder="0" src="/Uploadfiles/evdp_requireddoc/<?php echo $driver_id;?>"></iframe>
                            </div>
                            <!--         <div class="col-md-12">
             <input id="employer_driver_verify" name="employer_driver_verify" type="checkbox" value="y"> I hearby declare that ....
         </div>
         <div class="col-md-12">
         </div>-->
                        </div>
                        <?php
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
                        <?php } ?>
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
                <input id="permittype" type="hidden" name="permittype" value="evdp">
                <input id="verify_status" type="hidden" name="verify_status" value="1">
                <input id="driver_id" type="hidden" name="driver_id" value="<?php echo $driver_id;?>">
                <input id="driver_name" type="hidden" name="driver_name" value="<?php echo $driver_name;?>">
                <input id="driver_ic" type="hidden" name="driver_ic" value="<?php echo $driver_ic;?>">
                <input id="terminalbriefing_date" type="hidden" name="terminalbriefing_date" value="">
                <input id="evdp_requireddoc" type="hidden" name="evdp_requireddoc" value="">
                <!--<input id="adp_trainercert" type="hidden" name="adp_trainercert" value="">-->
                <input id="driver_photo" type="hidden" name="driver_photo" value="">
                <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">

                <?php if($condition=='renew'){   ?>
                    <input id="serialno" type="hidden" name="serialno" value="<?php echo $serialno;?>">
                    <input id="expirydate" type="hidden" name="expirydate" value="<?php echo $expirydate;?>">
                    <input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
                    <?php }  ?>

                <div class="row">
                    <div class="col-md-12 text-right">
                        <input id="to_step_four" name="to_step_four" type="submit" class="btn btn-primary" value="Next">
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

    function getuploadfiles(processtype, data) {
        //alert(data);
        if (processtype == 'evdp_requireddoc') {
            $("#evdp_requireddoc").val(data);
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
                    url: '/Terminalbriefingmanagement/get_availableslot',
                    type: 'POST',
                    data: {},
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                    color: 'green', // a non-ajax option
                    textColor: 'white' // a non-ajax option
                },
                eventClick: function(calEvent, jsEvent, view) {
                    if (moment(calEvent.start).format('YYYY-MM-DD') <= moment().format("YYYY-MM-DD")) {
                        alert('past current date!. Please select other date.');
                    } else {
                        $("#terminalbriefing_date").val(moment(calEvent.start).format('YYYY-MM-DD'));
                        $(".fc-event").css('background-color', 'green');
                        $(this).css('background-color', 'red');
                    }
                }
            })
        });
    });
</script>