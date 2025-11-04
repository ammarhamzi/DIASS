<script src="<?php echo base_url('../resources/shared_js/moment/2.29.4/min/moment.min.js'); ?>"  crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.css'); ?>"  crossorigin="anonymous" />
<link rel="stylesheet" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.print.min.css'); ?>"  crossorigin="anonymous" media="print" />
<script src="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.js'); ?>"  crossorigin="anonymous"></script>
<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            <?php echo $this->lang->line('pbbbriefingmanagement');?>
            <?php echo $this->lang->line('scheduler');?>
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
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                <?php echo $this->lang->line('pbbbriefingmanagement');?>
                <?php echo $this->lang->line('scheduler');?>
            </h4>
        </div>
        <div class="panel-body">

    <!-- pbb admin -->
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
                    url: '/Pbbbriefingmanagement/get_availableslot',
                    type: 'POST',
                    data: {},
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                    color: 'green', // a non-ajax option
                    textColor: 'white' // a non-ajax option
                },
				dayClick: function(date, jsEvent, view) {
					var data_param = date.format('YYYY-MM-DD');
					window.location.href = 'create/'+data_param;
				},
                eventClick: function(calEvent, jsEvent, view) {
                    if (moment(calEvent.start).format('YYYY-MM-DD') <= moment().format("YYYY-MM-DD")) {
                        alert('past current date!. Please select other date.');
                    } else {
//$(location).attr('href', "/pbbpermit/briefingattend/"+moment(calEvent.start).format('YYYY-MM-DD'));
alert('callback here.');
                    }
                }
            })
        });
    });
</script>