
<div class="container-fluid">
<ol class="breadcrumb">
  <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
  <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('taskchat'); ?> <?php echo $this->lang->line('list'); ?></li>
</ol>
      <div class="row">
         <div class="col-md-12 text-center">
            <div id="message" style=" position: fixed;right: 25px;">
               <?php echo $this->session->userdata('message') != '' ? '<span class="alert alert-success" role="alert">' . $this->session->userdata('message') . '</span>' : ''; ?>
            </div>
         </div>
      </div>
<div class="panel panel-info">
  <div class="panel-heading">
         <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('taskchat'); ?> <?php echo $this->lang->line('list'); ?></h4>
  </div>
  <div class="panel-body">
            <table id="mytable" class="table" style="width: 100% !important">

               <thead>
                  <tr>
                     <th>#</th>
                     <th><?php echo $this->lang->line('task_id'); ?></th>
<th><?php echo $this->lang->line('taskchat_memberid'); ?></th>
<th><?php echo $this->lang->line('taskchat_content'); ?></th>
<th><?php echo $this->lang->line('taskchat_date'); ?></th>

                     <th class="no-sort">&nbsp;</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
$start = 0;
if ($taskchat_data) {

    foreach ($taskchat_data as $taskchat) {
        ?>
                  <tr>
                     <td><?php echo ++$start; ?></td>
                     <td><?php echo $taskchat->task_id; ?></td>
<td><?php echo $taskchat->taskchat_memberid; ?></td>
<td><?php echo $taskchat->taskchat_content; ?></td>
<td><?php echo $taskchat->taskchat_date; ?></td>

                     <td style="text-align:center">
                        <?php
$id = fixzy_encoder($taskchat->taskchat_id);
        if ($permission->cp_read == true) {
            echo anchor(site_url('taskchat/read/' . $id), $this->lang->line('detail'));
        }
        if ($permission->cp_update == true) {
            echo ' ';
            echo anchor(site_url('taskchat/update/' . $id), $this->lang->line('edit'));
        }
        if ($permission->cp_delete == true) {
            echo ' ';
            echo anchor(site_url('taskchat/delete/' . $id), $this->lang->line('delete'), 'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
        }
        ?>
                     </td>
                  </tr>
                  <?php
}
}
?>
               </tbody>
               <tfoot>
                  <tr>
                     <th>#</th>
                     <th><?php echo $this->lang->line('task_id'); ?></th>
<th><?php echo $this->lang->line('taskchat_memberid'); ?></th>
<th><?php echo $this->lang->line('taskchat_content'); ?></th>
<th><?php echo $this->lang->line('taskchat_date'); ?></th>

                     <th>&nbsp;</th>
                  </tr>
               </tfoot>
            </table>
         </div>
      </div>
     </div>
      <script type="text/javascript">
      $(document).ready(function ()
        {
          setTimeout(function() {$('.alert').fadeOut(400);}, 4000);


          var table = $("#mytable").DataTable(
            {
            responsive: true,
            dom: 'lfrBtip',
            buttons:[
          <?php
if ($permission->cp_create == true) {
    ?>

                    {text: '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $this->lang->line("add_new"); ?>',
                    action: function (e, dt, node, config) {
                        redirect("<?php echo site_url('taskchat/create'); ?>");
                      }
                    },
         <?php }?>
          <?php
if ($permission->printlist == true) {
    ?>
                        {
                        extend: 'collection',
                        text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> <?php echo $this->lang->line("export"); ?>',
                        buttons:[

                            {
                            extend: 'excelHtml5',
                            title: '<?php echo $this->lang->line("data_export"); ?>',
                            exportOptions: {
                              columns:[0, 1, 2, 3, 4]
                              }
                            },
                            {
                            extend: 'pdfHtml5',
                            title: '<?php echo $this->lang->line("data_export"); ?>',
                            message: '<?php echo $this->lang->line("any_message"); ?>',
                            download: 'open',
                            exportOptions: {
                              columns:[0, 1, 2, 3, 4]
                              }
                            },
                            {
                            extend: 'print',
                            title: '<?php echo $this->lang->line("data_export"); ?>',
                            exportOptions: {
                              columns:[0, 1, 2, 3, 4]
                              }
                            }

                          ]
                        }

         <?php }?>
              ],
            columnDefs:[
                {targets: 'no-sort', orderable: false}
              ]

            }
          );

          // Apply the search
          table.columns().every(function ()
            {
              var that = this;

              $('input', this.header()).on('keyup change', function ()
                {
                  if (that.search() !== this.value) {
                    that
                    .search(this.value)
                    .draw();
                  }
                }
              );
            }
          );
        }
      );
      </script>
      <script>
      function redirect(url) {
        $(location).attr('href', url);
      }
      </script>
