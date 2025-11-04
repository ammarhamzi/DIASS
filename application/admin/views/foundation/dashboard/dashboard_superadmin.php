<script src="<?php echo base_url('../resources/shared_js/moment/2.29.4/min/moment.min.js'); ?>" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.css'); ?>" crossorigin="anonymous" />
<link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.print.min.css'); ?>" crossorigin="anonymous" media="print" />
<script src="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.js'); ?>" crossorigin="anonymous"></script>
<section class="content-header">
    <h1>
        Dashboard
        <small>Super Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<hr style="width: 100%; height: 1px; background-color: #DDDDDD">
<?php
/*print_r($this->session);*/
?>
<div class="container-fluid">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">

            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Requires Your Actions</a></li>

            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Inspections</a></li>


            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Attendances</a></li>

            <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Summary</a></li>
            <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">User Manual</a></li>
            <!--<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>-->
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
<h3>Permits Application</h3>
<table id="actions_list" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>


            <tr>
                <td>Verify Documents</td>
                <td>Permit submitted and waiting for verification<br>(ADP, EVDP & FFOP)</td>
                <td><?php echo $pending_checkdoc;?></td>
                <td><a href="permitpendingdocscheck/index/">View All</a></td>
            </tr>


            <tr>
                <td>Verify Documents</td>
                <td>Permit submitted and waiting for verification<br>(AVP, EVP & TEP)</td>
                <td><?php echo $pending_checkdocvehicle;?></td>
                <td><a href="permitpendingdocscheckvehicle/index/">View All</a></td>
            </tr>
            <tr>
                <td>Pending Approval</td>
                <td>All permits that are require approval from Airside Approver</td>
                <td><?php echo $pending_approval;?></td>
                <td><a href="permitpendingapproval/index/">View All</a></td>
            </tr>
            <tr>
                <td>Pending Payment</td>
                <td>All permits that are pending for payment</td>
                <td><?php echo $pending_payment;?></td>
                <td><a href="permitpendingpayment/index/">View All</a></td>
            </tr>
            <tr>
                <td>Permits Issuance</td>
                <td>All permits that are pending for collection</td>
                <td><?php echo $pending_printout;?></td>
                <td><a href="Permitcollect/index">View All</a></td>
            </tr>
            <tr>
                <td>Termination</td>
                <td>All permits that are terminated</td>
                <td><?php echo $permit_terminate;?></td>
                <td><a href="Permitpendingtermination/index">View All</a></td>
            </tr>
            <tr>
                <td>Replacement</td>
                <td>All permits that are pending for replacement</td>
                <td><?php echo $permit_replace;?> </td>
                <td><a href="Permitpendingreplacement/index">View All</a></td>
            </tr>
            <tr>
                <td>Suspension</td>
                <td>All permits that are suspended</td>
                <td><?=$permit_suspend_count?></td>
                <td><a href="suspensionpermit/index">View All</a></td>
            </tr>
            <tr>
                <td>Cancellation</td>
                <td>All permits that are cancelled by person in charge</td>
                <td><?php echo $permit_cancel;?></td>
                <td><a href="Permitcanceled/index">View All</a></td>
            </tr>
        </tbody>
<!--        <tfoot>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </tfoot>-->
    </table>

<h3>Assessment</h3>
<table id="actions_list_pbb" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>PBB Assessment Result</td>
                <td>Update PBB's result</td>
                <td><a href="Pbbpermit/assessment">View All</a></td>
            </tr>
        </tbody>
    </table>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
<div class="row">
    <div class="col-md-6">
<h3>MTW Inspection</h3>
<table id="inspection_list" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>AVP/EVP Inspection</td>
                <td><a href="Avppermit/avpevpinspectioncalendar/">View All</a></td>
            </tr>
            <tr>
                <td>TEP Inspection (WIP - runway & taxiway)</td>
                <td><a href="Wippermit/inspectioncalendar/">View All</a></td>
            </tr>
<!--            <tr>
                <td>TEP Inspection (Stakeholder)</td>
                <td><a href="Shinspermit/inspectioncalendar/">View All</a></td>
            </tr>-->
        </tbody>
    </table>

    </div>
    <div class="col-md-6">
<h3>MTW Approval</h3>
<table id="inspectionmanager_list" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>MTW Approval</td>
                <td><a href="Permitpendinginspectionmanager/">View All</a></td>
            </tr>
        </tbody>
    </table>

    </div>
</div>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
<h3>Attendance</h3>
<table id="attendance_list" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<!--
            <tr>
                <td>ADP Briefing</td>
                <td><a href="adppermit/attendance/">View All</a></td>
            </tr>
            <tr>
                <td>ADP Exam</td>
                <td><a href="adppermit/exam/">View All</a></td>
            </tr>
-->
            <tr>
                <td>EVDP Briefing</td>
                <td><a href="evdppermit/attendance/">View All</a></td>
            </tr>
            <tr>
                <td>VGDS Briefing</td>
                <td><a href="vdgspermit/attendance/">View All</a></td>
            </tr>
<!--            <tr>
                <td>GPU Briefing</td>
                <td><a href="gpupermit/attendance/">View All</a></td>
            </tr>
            <tr>
                <td>PCA Briefing</td>
                <td><a href="pcapermit/attendance/">View All</a></td>
            </tr>-->
<!--            <tr>
                <td>TEP Briefing - Stakeholder</td>
                <td><a href="shpermit/attendance/">View All</a></td>
            </tr>
            <tr>
                <td>TEP Briefing - Commercial</td>
                <td><a href="cspermit/attendance/">View All</a></td>
            </tr>
            <tr>
                <td>TEP Briefing - WIP</td>
                <td><a href="wipbriefingpermit/attendance/">View All</a></td>
            </tr>-->
        </tbody>
    </table>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_4">

<h3>Completed Permits</h3>
<table id="summary_list" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Permit Name</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
if(!empty($permit_summary)){
foreach ($permit_summary as $permit){
?>
            <tr style=" background-color: #F9F9F9">
                <td>
                    <?php echo $permit->permit_type_desc;?>
                </td>
                <td>
                    <?php echo $permit->total;?>
                </td>
            </tr>

<?php
if($permit->permit_typeid==1){
foreach ($adppermit_summary as $adppermit){
?>
            <tr>
                <td>
                    <?php echo str_repeat("&nbsp;", 10).$adppermit->adppermit_verifybymahb_drivingarea;?>
                </td>
                <td>
                    <?php echo $adppermit->total;?>
                </td>
            </tr>
<?php
}
}elseif($permit->permit_typeid==4){
foreach ($avppermit_summary as $avppermit){
?>
            <tr>
                <td>
                    <?php echo str_repeat("&nbsp;", 10).ucfirst($avppermit->avppermit_avpcategory);?>
                </td>
                <td>
                    <?php echo $avppermit->total;?>
                </td>
            </tr>
<?php
}
}
?>
            <?php
}
}else{
?>
            <tr>
                <td>Airside Driving Permit</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Electrical Vehicle Driving Permit</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Airside Vehicle Permit</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Electrical Vehicle Permit</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Passenger Boarding Bridge</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Visual Docking Guidance System</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Preconditioned Air Unit</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Ground Power Unit</td>
                <td>0</td>
            </tr>
            <?php
}
?>
        </tbody>
    </table>
            </div>

            <div class="tab-pane" id="tab_5">
<p>Super Admin User Manual - <a href="/resources/tutorial/superadmin-user-support.pdf" target="_blank">Download User Manual</a></p>
<p>General Admin User Manual</p>
            <ul>
<li>ADP - <a href="/resources/tutorial/user-manual-adp.pdf" target="_blank">Download User Manual</a></li>
<li>AVP - <a href="/resources/tutorial/user-manual-avp.pdf" target="_blank">Download User Manual</a></li>
<li>EVP - <a href="/resources/tutorial/user-manual-evp.pdf" target="_blank">Download User Manual</a></li>

<li>EVDP - <a href="/resources/tutorial/user-manual-evdp.pdf" target="_blank">Download User Manual</a></li>
<li>CC & ASC - <a href="/resources/tutorial/user-manual-cc-asc.pdf" target="_blank">Download User Manual</a></li>

<li>Schedule - <a href="/resources/tutorial/user-manual-schedule-mgmt.pdf" target="_blank">Download User Manual</a></li>
<li>Exam - <a href="/resources/tutorial/user-manual-exam-mgmt.pdf" target="_blank">Download User Manual</a></li>
            </ul>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
    <?php
    if($this->session->userdata('role')=='1' or $this->session->userdata('role')=='9'){
?>

        <?php
    }
    ?>

</div>
<script>
    $(document).ready(function() {
        $(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                weekends: false,
                defaultView: 'month',
                events: {
                    url: 'Terminalbriefingmanagement/get_availableslot',
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
                        $(location).attr('href', "evdppermit/briefingattend/" + moment(calEvent.start).format('YYYY-MM-DD'));
                    }
                }
            })
        });
        $("#briefingschedule").click(function() {
            $("#calendar").hide();
            $("#calendar2").show();
            $('#attendance').removeClass('btn btn-primary');
            $("#attendance").addClass("btn btn-default");
            $('#briefingschedule').removeClass('btn btn-default');
            $("#briefingschedule").addClass("btn btn-primary");
        });
        $("#attendance").click(function() {
            $("#calendar2").hide();
            $("#calendar").show();
            $('#attendance').removeClass('btn btn-default');
            $("#attendance").addClass("btn btn-primary");
            $('#briefingschedule').removeClass('btn btn-primary');
            $("#briefingschedule").addClass("btn btn-default");
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(function() {
            // page is now ready, initialize the calendar...
            $('#calendar2').fullCalendar({
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
                        //$(location).attr('href', "/evdppermit/briefingattend/"+moment(calEvent.start).format('YYYY-MM-DD'));
                        alert('callback here.');
                    }
                }
            })
        });
    });

$(document).ready(function() {
    $('#actions_list,#actions_list_pbb,#inspection_list,#inspectionmanager_list,#attendance_list,#summary_list').DataTable( {
        "paging":   false,
        "info":     false,
        "searching": false,
        "ordering": false,
    } );
} );
</script>
