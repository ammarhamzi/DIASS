<!-- \resources\gen_template\master\crud-newpage\views -->
<script src="<?php echo base_url('resources/shared_js/moment/2.29.4/min/moment.min.js'); ?>" crossorigin="anonymous"></script>
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
                <div class="col-md-3"><span class="step_active">Step 3</span><br>Choose date for inspection</div>
                <div class="col-md-3">Step 4</div>
            </div>
        </div>
        <div class="panel-body">

            <form autocomplete="off" id="step_one" name="step_two" action="/Permit/stepfour" method="POST">
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
                            <div class="col-md-4">
                                <p><b>Inspection Date:</b></p>
                                <p>Please choose any available date to book for inspection. Permit application can only proceed after vehicle pass the inspection.</p>
                            </div>
                            <div class="col-md-8">
                                <div id="calendar"></div>
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
                                        echo '<input id="mtwchecklist_selected" name="mtwchecklist_selected[]" type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '">';
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

                                <iframe frameBorder="0" src="/Uploadfiles/evp_requireddoc/<?php echo $vehicle_id;?>"></iframe>
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
                <input id="verify_status" type="hidden" name="verify_status" value="1">
                <input id="vehicle_id" type="hidden" name="vehicle_id" value="<?php echo $vehicle_id;?>">
                <input id="vehicle_registration_no" type="hidden" name="vehicle_registration_no" value="<?php echo $vehicle_registration_no;?>">
                <input id="vehicle_parkingarea_id" type="hidden" name="vehicle_parkingarea_id" value="<?php echo $vehicle_parkingarea_id;?>">
                <input id="vehicle_engine_capacity" type="hidden" name="vehicle_engine_capacity" value="<?php echo $vehicle_engine_capacity;?>">

                <input id="inspection_date" type="hidden" name="inspection_date" value="">
                <input id="evp_requireddoc" type="hidden" name="evp_requireddoc" value="">
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
        if (processtype == 'evp_requireddoc') {
            $("#evp_requireddoc").val(data);
        }
        /* if(processtype=='adp_trainercert'){
         $("#adp_trainercert").val(data);
         }*/
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
                    url: '/Inspectionmanagement/get_availableslot/evp',
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
                        $("#inspection_date").val(moment(calEvent.start).format('YYYY-MM-DD'));
                        $(".fc-event").css('background-color', 'green');
                        $(this).css('background-color', 'red');
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