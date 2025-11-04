<!-- \resources\gen_template\master\crud-newpage\views -->
<script src="<?php echo base_url('../resources/shared_js/moment/2.23.0/min/moment.min.js'); ?>"  crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.css'); ?>"  crossorigin="anonymous" />
<link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.print.min.css'); ?>"  crossorigin="anonymous" media="print" />
<script src="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.js'); ?>"  crossorigin="anonymous"></script>
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            Briefing Attendance (WIP)
        </li>
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
    <div class="box  box-primary">
        <div class="box-header with-border">
            <i class="fa fa-file-text-o"></i>

            <h3 class="box-title">Briefing Attendance (WIP)</h3>
            <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="row">
                <div class="col-md-12">
                    <div id="calendar"></div>

                </div>
            </div>
        </div>
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
                    url: '/wippermit/get_availableslot',
                    type: 'POST',
                    data: {},
                    success: function (data) {
                        obj = JSON.stringify(data);
                        console.log(obj);
                    },
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                    // color: 'green', // a non-ajax option
                    // textColor: 'white' // a non-ajax option
                },
                eventClick: function(calEvent, jsEvent, view) {
                    if (moment(calEvent.start).format('YYYY-MM-DD') <= moment().format("YYYY-MM-DD")) {
                        alert('past current date!. Please select other date.');
                    } else {
                        $(location).attr('href', "/admin/aVppermit/briefingattend/"+moment(calEvent.start).format('YYYY-MM-DD'));
                    }
                }
            })
        });
    });
</script>
<script>
    function redirect(url) {
        $(location).attr('href', url);
    }
</script>