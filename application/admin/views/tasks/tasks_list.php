
<div class="container-fluid">
    <!--<ol class="breadcrumb">
      <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
      <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> tasks List</li>
    </ol>-->
    <div class="row">
        <div class="col-md-12 text-center">
            <div id="message">
                <?php echo $this->session->userdata('message') != ''
? $this->session->userdata('message') : '';
?>
            </div>
        </div>
    </div>

    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo $this->lang->line('your_task'); ?></a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php echo $this->lang->line('other_staff_task'); ?></a></li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4> <?php echo $this->lang->line('task_stat'); ?></h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <td><?php echo $this->lang->line('all_task'); ?>
                                    <span class="badge"><?php echo $alltask; ?></span></td>

                                <td><?php echo $this->lang->line('on_going'); ?> <span class="badge"><?php echo $ongoing; ?></span></td>

                                <td><?php echo $this->lang->line('completed'); ?> <span class="badge"><?php echo $completed; ?></span></td>

                                <td><?php echo $this->lang->line('kiv'); ?> <span class="badge"><?php echo $pending; ?></span></td>

                            </tr>

                        </table>
                      <!--  <form id="searchme" name="searchme" action="<?php site_url() . '/task/index';?>" method="POST">

                        <table style=" margin-bottom:25px;">
                      <tr>
                        <td>Start:</td>
                        <td><input type="text" name="startdate" class="datepicker" value="<?php echo $startdate; ?>"></td>
                        <td>End:</td>
                        <td><input type="text" name="enddate" class="datepicker" value="<?php echo $enddate; ?>"></td>
                        <td><input type="submit" name="submit" value="submit"></td>
                      </tr>
                        </table>

                        </form>-->

                        <form class="form-inline"  id="searchme" name="searchme" action="<?php site_url() . '/task/index';?>" method="POST" style=" border: 1px #fff solid; background-color: #F5F5F5; padding:10px; border-radius:3px;margin-bottom:15px;">
                            <div class="form-group">
                                <label for="startdate">Start:</label>
                                <input type="text" name="startdate" class="datepicker" value="<?php echo $startdate; ?>">
                            </div>
                            <div class="form-group">
                                <label for="enddate">&nbsp;&nbsp;&nbsp;End:</label>
                                <input type="text" name="enddate" class="datepicker" value="<?php echo $enddate; ?>">
                            </div>
                            <input type="submit" name="submit" value="submit">
                        </form>
                        <table class="table table-bordered">
                            <tr>
                                <td>Total Hours Spending
                                    <span class="badge"><?php echo $workinghour; ?></span></td>

                            </tr>

                        </table>
                        <div style="float:right;"><?php echo $this->lang->line('legend'); ?> <span style="background-color:#DDDDDD;width:15px;border:1px #646161 solid;"><?php echo $this->lang->line('doing_this'); ?></span></div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4><?php echo $this->lang->line('tasks'); ?> <?php echo $this->lang->line('list'); ?></h4>
                            </div>
                            <div class="panel-body">
                                <a class="fancybox addnew" data-fancybox-type="iframe" href="<?php echo site_url('tasks/create'); ?>"></a>
                                <table id="mytable_own" class="table" style="width: 100% !important">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Task</th>
                                            <th>By</th>
                                            <th>Request</th>
                                            <th>Finish</th>
                                            <th>Work Minutes</th>
                                            <th><?php echo $this->lang->line('task_status'); ?></th>
                                            <!--<th><?php echo $this->lang->line('task_progress'); ?></th>-->
                                            <th><?php echo $this->lang->line('task_priority'); ?></th>
                                            <th>Rel. Task</th>
                                            <!--<th><?php echo $this->lang->line('task_remark'); ?></th>-->

                                            <th class="no-sort">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$start = 0;
foreach ($tasks_data_own as $tasks) {
    if ($tasks->task_current == "1") {
        $style = 'style="background-color:#DDDDDD;"';
    } else {
        $style = '';
    }
    ?>
                                            <tr <?php echo $style; ?>>
                                                <td><?php echo ++$start; ?></td>
                                                <td><?php echo 'T'; ?><?php printf("%07d",
        $tasks->task_id)
    ;?></td>
                                                <td><?php echo $tasks->task_name; ?></td>
                                                <td><?php echo $tasks->username_task_from; ?></td>
                                                <td><?php echo $tasks->task_date; ?></td>
                                                <td><?php echo $tasks->task_duedate; ?></td>
                                                <td><?php echo $tasks->task_hour; ?></td>
                                                <td><?php echo $tasks->task_status . '(' . $tasks->task_progress . '%)'; ?></td>
                                                <!--<td><?php echo $tasks->task_progress; ?></td>-->
                                                <td><?php echo $tasks->task_priority; ?></td>
                                                <td>
                                                    <?php
if (!empty($tasks->task_related)) {
        ?>
                                                        <?php echo 'T'; ?><?php printf("%07d",
            $tasks->task_related)
        ;?>
        <?php
}
    ?>
                                                </td>
                                                <!--<td><?php echo $tasks->task_remark; ?></td> -->

                                                <td style="text-align:center">
                                                    <?php
echo anchor(site_url('tasks/read/' . $tasks->task_id),
        'Detail',
        ['class' => 'fancybox',
            'data-fancybox-type' => 'iframe']);
    echo ' <br> ';
    echo anchor(site_url('tasks/update/' . $tasks->task_id),
        'Update',
        ['class' => 'fancybox',
            'data-fancybox-type' => 'iframe']);
    ?>
                                                </td>
                                            </tr>
    <?php
}
?>
                                    </tbody>
                     <!--               <tfoot>
                                       <tr>
                                          <th>#</th>
                                          <th><?php echo $this->lang->line('task_name'); ?></th>
                     <th><?php echo $this->lang->line('task_from'); ?></th>
                     <th><?php echo $this->lang->line('task_date'); ?></th>
                     <th><?php echo $this->lang->line('task_duedate'); ?></th>
                     <th><?php echo $this->lang->line('task_status'); ?></th>
                     <th><?php echo $this->lang->line('task_progress'); ?></th>
                     <th><?php echo $this->lang->line('task_remark'); ?></th>

                                          <th>&nbsp;</th>
                                       </tr>
                                    </tfoot>-->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <table class="table">
                    <tr>
                        <td><p><?php echo $this->lang->line('select_staff'); ?>
                                <select name="staffid" id="staffid" class="">
                                    <option value="">-SELECT-</option>
                                    <?php
foreach ($stafflist as $staff) {
    ?>
                                        <option value="<?php echo $staff->user_id; ?>"><?php echo $staff->user_username; ?></option>
    <?php
}
?>
                                </select>
                            </p></td>
                    </tr>
                </table>
                <span id="ajaxresult"></span>
                <div style="float:right;"><?php echo $this->lang->line('legend'); ?> <span style="background-color:#DDDDDD;width:15px;border:1px #B7B4B4 solid;"><?php echo $this->lang->line('doing_this'); ?></span></div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('all_task_list'); ?></h4>
                    </div>
                    <div class="panel-body">

                        <table id="mytable" class="table" style="width: 100% !important">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Task</th>
                                    <th>To</th>
                                    <th>By</th>
                                    <th>Request</th>
                                    <th>Finish</th>
                                    <th>Work Minutes</th>
                                    <th><?php echo $this->lang->line('task_status'); ?></th>
                                    <!--<th><?php echo $this->lang->line('task_progress'); ?></th>-->
                                    <th><?php echo $this->lang->line('task_priority'); ?></th>
                                    <th>Rel. Task</th>
                                    <!--<th><?php echo $this->lang->line('task_remark'); ?></th>-->

                                    <th class="no-sort">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$start = 0;
foreach ($tasks_data as $tasks) {
    if ($tasks->task_current == "1") {
        $style = 'style="background-color:#DDDDDD;"';
    } else {
        $style = '';
    }
    ?>
                                    <tr <?php echo $style; ?>>
                                        <td><?php echo ++$start; ?></td>
                                        <td><?php echo 'T'; ?><?php printf("%07d",
        $tasks->task_id)
    ;?></td>
                                        <td><?php echo $tasks->task_name; ?></td>
                                        <td><?php echo $tasks->username_task_to; ?></td>
                                        <td><?php echo $tasks->username_task_from; ?></td>
                                        <td><?php echo $tasks->task_date; ?></td>
                                        <td><?php echo $tasks->task_duedate; ?></td>
                                        <td><?php echo $tasks->task_hour; ?></td>
                                        <td><?php echo $tasks->task_status . '(' . $tasks->task_progress . '%)'; ?></td>
                                        <!--<td><?php echo $tasks->task_progress; ?></td>-->
                                        <td><?php echo $tasks->task_priority; ?></td>
                                        <td>
                                            <?php
if (!empty($tasks->task_related)) {
        ?>
                                                <?php echo 'T'; ?><?php printf("%07d",
            $tasks->task_related)
        ;?>
        <?php
} else {
        echo "&nbsp;";
    }
    ?>
                                        </td>
                                        <!--<td><?php echo $tasks->task_remark; ?></td>-->

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">
                                            <?php
echo anchor(site_url('tasks/read/' . $tasks->task_id),
        '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>',
        ['class' => 'fancybox', 'data-fancybox-type' => 'iframe']);
    if ($is_superadmin == '1') {
        echo ' <br> ';
        echo anchor(site_url('tasks/update/' . $tasks->task_id . '/1'),
            '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>',
            ['class' => 'fancybox',
                'data-fancybox-type' => 'iframe']);
        echo ' <br> ';
        echo anchor(site_url('tasks/delete/' . $tasks->task_id),
            '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
            'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
    }
    ?>
                                            </div>
                                        </td>
                                    </tr>
    <?php
}
?>
                            </tbody>
             <!--               <tfoot>
                               <tr>
                                  <th>#</th>
                                  <th><?php echo $this->lang->line('task_name'); ?></th>
             <th><?php echo $this->lang->line('task_to'); ?></th>
             <th><?php echo $this->lang->line('task_from'); ?></th>
             <th><?php echo $this->lang->line('task_date'); ?></th>
             <th><?php echo $this->lang->line('task_duedate'); ?></th>
             <th><?php echo $this->lang->line('task_status'); ?></th>
             <th><?php echo $this->lang->line('task_progress'); ?></th>
             <th><?php echo $this->lang->line('task_remark'); ?></th>

                                  <th>&nbsp;</th>
                               </tr>
                            </tfoot>-->
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<script type="text/javascript">
$(document).ready(function ()
  {

    /*    $('#mytable_own thead th').each( function (i) {
   if(i==3 || i==4) {
   var title = $(this).text();
   $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
   }
   } );*/

    $("select.select2").select2();
    $(".fancybox").fancybox();

    var table = $("#mytable_own").DataTable(
      {
      "pageLength": 50,
      responsive: true,
      dom: 'lfrBtip',
      buttons:[
          {text: '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $this->lang->line("add_new"); ?>',
          action: function (e, dt, node, config) {
              $(".addnew").click();
            }
          },
          {
          extend: 'collection',
          text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> Export',
          buttons:[

              {
              extend: 'excelHtml5',
              title: 'Data export',
              exportOptions: {
                columns:[0, 1, 2, 3, 4, 5, 7, 8, 9]
                }
              },
              {
              extend: 'pdfHtml5',
              title: 'Data export',
              message: 'Any message include to result.',
              download: 'open',
              exportOptions: {
                columns:[0, 1, 2, 3, 4, 5, 7, 8, 9]
                }
              },
              {
              extend: 'print',
              title: 'Data export',
              exportOptions: {
                columns:[0, 1, 2, 3, 4, 5, 7, 8, 9]
                }
              }

            ]
          },
          {
          extend: 'colvis',
          columns: ':not(:first-child,:last-child)',
          postfixButtons:['colvisRestore']
          }
        ],
      columnDefs:[
          {targets: 'no-sort', orderable: false}
        ]
      }
    );
    var oTable = $("#mytable").DataTable(
      {
      "pageLength": 50,
      responsive: true,
      dom: 'lfrBtip',
      buttons:[
          {text: '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $this->lang->line("add_new"); ?>',
          action: function (e, dt, node, config) {
              $(".addnew").click();
            }
          },
          /*                     {
      extend: 'collection',
      text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> Export',
      buttons: [

      {
      extend: 'excelHtml5',
      title: 'Data export',
      exportOptions: {
      columns: [0,1,2,3,4,5,6,7]
      }
      },
      {
      extend: 'pdfHtml5',
      title: 'Data export',
      message: 'Any message include to result.',
      download: 'open',
      exportOptions: {
      columns: [0,1,2,3,4,5,6,7]
      }
      },
      {
      extend: 'print',
      title: 'Data export',
      exportOptions: {
      columns: [0,1,2,3,4,5,6,7]
      }
      }

      ]
      }*/
          {
          extend: 'colvis',
          columns: ':not(:first-child,:last-child)'
          }
        ],
      columnDefs:[
          {targets: 'no-sort', orderable: false}
        ]
      }
    );

    $("#staffid").change(function ()
      {
        if ($("#staffid option:selected").text() == '-SELECT-') {
          var filterme = '';
        } else {
          var filterme = $("#staffid option:selected").text();
          regex = '\\b' + filterme + '\\b';
        }
        oTable.column(2).search(regex, true, false).draw();
        $.ajax(
          {
          type: "POST",
          data: {
            id: $("#staffid").val(),
            },
          url: "<?php echo site_url(); ?>/tasks/ajaxStat",
          success: function (data) {
              $('#ajaxresult').html(data);
            }
          }
        );
      }
    );

    // Apply the search
    /*    table.columns().every( function () {
   var that = this;

   $( 'input', this.header() ).on( 'keyup change', function () {
   if ( that.search() !== this.value ) {
   that
   .search( this.value )
   .draw();
   }
   } );
   } );*/
  }
);
</script>
<script>
function redirect(url) {
  $(location).attr('href', url);
}
</script>
<link href="<?php echo base_url('../resources/shared_js/select2/dist/css/select2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('../resources/shared_js/select2/dist/js/select2.min.js'); ?>"></script>
