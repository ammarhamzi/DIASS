
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('controllerpermission'); ?> <?php echo $this->lang->line('list'); ?></li>
    </ol>
    <div class="row">
        <div class="col-md-12 text-center">
            <div id="message" style=" position: fixed;right: 25px;">
                <?php
echo $this->session->userdata('message') != '' ? '<span class="alert alert-success" role="alert">' . $this->session->userdata('message') . '</span>'
: '';
?>
            </div>
        </div>
    </div>
    <div class="row" style="padding-bottom:25px;padding-left:25px;">
        <button type="button" class="btn btn-default btn-lg" id="goto">Register Controller</button>
        <button type="button" class="btn btn-primary btn-lg">Add Permission</button>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('controllerpermission'); ?> <?php echo $this->lang->line('list'); ?></h4>
        </div>
        <div class="panel-body">
            <a class="fancybox" data-fancybox-type="iframe" href="controllerpermission/create" id="addnew"></a>
            <table id="mytable" class="table" style="width: 100% !important">

                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('cp_controller_id'); ?></th>
                        <th><?php echo $this->lang->line('cp_usergroup'); ?></th>
                        <th><?php echo $this->lang->line('showlist'); ?></th>
                        <th><?php echo $this->lang->line('cp_create'); ?></th>
                        <th><?php echo $this->lang->line('cp_update'); ?></th>
                        <th><?php echo $this->lang->line('cp_delete'); ?></th>
                        <th><?php echo $this->lang->line('cp_read'); ?></th>
                        <th><?php echo $this->lang->line('printlist'); ?></th>

                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$start = 0;
if ($controllerpermission_data) {
    foreach ($controllerpermission_data as $controllerpermission) {
        ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo $controllerpermission->control_name_cp_controller_id; ?></td>
                                <td><?php echo $controllerpermission->usergroup_name_cp_usergroup; ?></td>
                                <td><?php echo $controllerpermission->showlist; ?></td>
                                <td><?php echo $controllerpermission->cp_create; ?></td>
                                <td><?php echo $controllerpermission->cp_update; ?></td>
                                <td><?php echo $controllerpermission->cp_delete; ?></td>
                                <td><?php echo $controllerpermission->cp_read; ?></td>
                                <td><?php echo $controllerpermission->printlist; ?></td>

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">
                                    <?php
$id = fixzy_encoder($controllerpermission->cp_id);
        if ($permission->cp_read == true) {
            echo anchor(site_url('controllerpermission/read/' . $id),
                '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>',
                ['class' => 'fancybox', 'data-fancybox-type' => 'iframe']);
        }
        if ($permission->cp_update == true) {

            echo anchor(site_url('controllerpermission/update/' . $id),
                '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>',
                ['class' => 'fancybox', 'data-fancybox-type' => 'iframe']);
        }
        if ($permission->cp_delete == true) {

            echo anchor(site_url('controllerpermission/delete/' . $id),
                '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
                'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
        }
        ?>
                                    </div>
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
                        <th><?php echo $this->lang->line('cp_controller_id'); ?></th>
                        <th><?php echo $this->lang->line('cp_usergroup'); ?></th>
                        <th><?php echo $this->lang->line('showlist'); ?></th>
                        <th><?php echo $this->lang->line('cp_create'); ?></th>
                        <th><?php echo $this->lang->line('cp_update'); ?></th>
                        <th><?php echo $this->lang->line('cp_delete'); ?></th>
                        <th><?php echo $this->lang->line('cp_read'); ?></th>
                        <th><?php echo $this->lang->line('printlist'); ?></th>

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
    $(".fancybox").fancybox();
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
                  $("#addnew").click();
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
                        columns:[0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                      },
                      {
                      extend: 'pdfHtml5',
                      title: '<?php echo $this->lang->line("data_export"); ?>',
                      message: '<?php echo $this->lang->line("any_message"); ?>',
                      download: 'open',
                      exportOptions: {
                        columns:[0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                      },
                      {
                      extend: 'print',
                      title: '<?php echo $this->lang->line("data_export"); ?>',
                      exportOptions: {
                        columns:[0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                      }

                    ]
                  },

<?php }?>
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
    $("#goto").click(function ()
      {

        redirect('<?php
echo site_url('regcontroller');

?>');
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

