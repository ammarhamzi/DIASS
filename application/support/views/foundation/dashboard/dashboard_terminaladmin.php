<script src="<?php echo base_url('../resources/shared_js/moment/2.23.0/min/moment.min.js'); ?>" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.css'); ?>" crossorigin="anonymous" />
<link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.print.min.css'); ?>" crossorigin="anonymous" media="print" />
<script src="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.js'); ?>" crossorigin="anonymous"></script>
<section class="content-header">
    <h1>
        Dashboard
        <small>Terminal Admin</small>
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

            <li  class="active"><a href="#tab_3" data-toggle="tab" aria-expanded="false">Attendances</a></li>

        </ul>
        <div class="tab-content">
            <!-- /.tab-pane -->
            <div class="tab-pane active" id="tab_3">
<h3>Attendance</h3>
<table id="attendance_list" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>EVDP Briefing</td>
                <td><a href="evdppermit/attendance/">View All</a></td>
            </tr>
        </tbody>
    </table>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>

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
