<link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.css'); ?>">
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('../resources/shared_js/fullcalendar/3.0.1/fullcalendar.print.css'); ?>">-->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>-->
<script src="<?php echo base_url('../resources/shared_js/moment/2.29.4/min/moment.min.js'); ?>"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/locale/ms.js"></script> -->
<script src="<?php echo base_url('../resources/shared_js/fullcalendar/3.9.0/fullcalendar.min.js'); ?>"></script>

<div class="container-fluid">
    <section class="content-header">
        <h1>
            Events Calendar
            <small>Manage events</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Events Calendar</li>
        </ol>
    </section>
    <div id="calendar"></div>



</div>
<div id="createEventModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel1">Create Events</h3>
            </div>
            <div class="modal-body">
                <form id="createAppointmentForm" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="inputPatient">Patient:</label>
                        <div class="controls">
                            <input type="text" name="patientName" id="patientName" style="margin: 0 auto;">
                            <input type="hidden" id="apptStartTime"/>
                            <input type="hidden" id="apptEndTime"/>
                            <input type="hidden" id="apptAllDay" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="when">When:</label>
                        <div class="controls controls-row" id="when" style="margin-top:5px;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function ()
  {
    $('#calendar').fullCalendar(
      {
        // put your options and callbacks here
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,listWeek,basicDay,listDay,agendaWeek'
        },

        // customize the button names,
        // otherwise they'd all just say "list"
      views: {
        listDay: {buttonText: 'list day'},
        listWeek: {buttonText: 'list week'}
        },

      defaultView: 'month',
        /*defaultDate: '2016-09-12',*/
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events:
<?php echo $fullcalendar_event; ?>
        ,
      selectable: true,
      selectHelper: true,
      select: function (start, end) {
          var title = prompt('Event Title:');
          var eventData;
          if (title) {
            eventData = {
            title: title,
            start: start,
            end: end
            };

            $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true

          }
          $('#calendar').fullCalendar('unselect');
          //alert(start);
          var titlex = title;
          var startx = start.format("YYYY-MM-DD[T]HH:mm:ss");
          var endx = end.format("YYYY-MM-DD[T]HH:mm:ss");
          $.ajax(
            {
            type: "POST",
            data: {
              dbtitle: titlex,
              dbstart: startx,
              dbend: endx
              },
            url: "<?php echo site_url(); ?>fullcalendar/insert",
            success: function (data) {
                console.log(data);
              },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
              }
            }
          );
        },
      eventClick: function (calEvent, jsEvent, view) {
          var title = prompt('Event Title:', calEvent.title, {buttons: {Ok: true, Cancel: false}});

          if (title) {
            calEvent.title = title;
            $('#calendar').fullCalendar('updateEvent', calEvent);
            var titlex = title;
            var idx = calEvent.id;
            $.ajax(
              {
              type: "POST",
              data: {
                dbtitle: titlex,
                id: idx
                },
              url: "<?php echo site_url(); ?>fullcalendar/update",
              success: function (data) {
                  console.log(data);
                },
              error: function (jqXHR, textStatus, errorThrown) {
                  console.log(textStatus + ': ' + errorThrown);
                }
              }
            );
          }
        }

      }
    );

  }
);
</script>
