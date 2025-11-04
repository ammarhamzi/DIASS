<script src="<?php echo base_url('../resources/shared_js/moment/2.29.4/min/moment.min.js'); ?>" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.css'); ?>" crossorigin="anonymous" />
<link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.print.min.css'); ?>" crossorigin="anonymous" media="print" />
<script src="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.js'); ?>" crossorigin="anonymous"></script>
<style>
    <style type="text/css">
		html {
			overflow: auto;
		}
		
		html,
		body,
		div,
		iframe {
			margin: 0px;
			padding: 0px;
			height: 100%;
			border: none;
		}
		
		iframe {
			display: block;
			width: 100%;
			border: none;
			overflow-y: auto;
			overflow-x: hidden;
		}
	</style>
</style>
<section class="content-header">
    <h1>
<!--        Examination-->
<div style="text-align:center; color: red;"><strong>Please do not close or refresh this browser!!!<br/><br/></strong></div>
    </h1>
<!--    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>-->
</section>
<!--<hr style="width: 100%; height: 1px; background-color: #DDDDDD">-->
<?php
/*print_r($this->session);*/
?>
<!--<div class="container-fluid">
    
    <iframe id="fraDisabled" src="<?php echo site_url('authentication/goto_exam'); ?>"></iframe>
    <?php
    if($this->session->userdata('role')=='1' or $this->session->userdata('role')=='9'){
?>

        <?php
    }
    ?>

</div>-->
<iframe id="fraDisabled" src="<?php echo site_url('authentication/goto_exam'); ?>"></iframe>
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
