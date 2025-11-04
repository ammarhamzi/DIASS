
<div class="container-fluid">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('refstate'); ?> <?php echo $this->lang->line('list'); ?></h4>
        </div>
        <div class="panel-body">
            <table id="mytable" class="table" style="width: 100% !important">

                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('ref_state_code'); ?></th>
                        <th><?php echo $this->lang->line('ref_state_name'); ?></th>
                        <th><?php echo $this->lang->line('ref_state_capital'); ?></th>
                        <th><?php echo $this->lang->line('ref_state_plate'); ?></th>

                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$start = 0;
foreach ($refstate_data as $refstate) {
    ?>
                        <tr>
                            <td><?php echo ++$start; ?></td>
                            <td><?php echo $refstate->ref_state_code; ?></td>
                            <td><?php echo $refstate->ref_state_name; ?></td>
                            <td><?php echo $refstate->ref_state_capital; ?></td>
                            <td><?php echo $refstate->ref_state_plate; ?></td>

                            <td style="text-align:center">
                                <?php
$id = fixzy_encoder($refstate->ref_state_id);
    echo anchor(site_url('refstate/index/' . $id),
        $this->lang->line('edit'));
    echo ' ';
    echo anchor(site_url('refstate/delete/' . $id),
        $this->lang->line('delete'),
        'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
    ?>
                            </td>
                        </tr>
                        <?php
}
?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('ref_state_code'); ?></th>
                        <th><?php echo $this->lang->line('ref_state_name'); ?></th>
                        <th><?php echo $this->lang->line('ref_state_capital'); ?></th>
                        <th><?php echo $this->lang->line('ref_state_plate'); ?></th>

                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php
if (isset($id)) {
    ?>
    <script>
    $(document).ready(function ()
      {
        var arr =[];

        $.each(arr, function (i, val)
          {
            $("#" + val).prop("disabled", true);
            $("#" + val).after("<input type='hidden' name='" + val + "' id='" + val + "' value='" + $("#" + val).val() + "'>");
          }
        );
      }
    );
    </script>
    <?php
}
?>
<script type="text/javascript">
$(document).ready(function ()
  {



    var table = $("#mytable").DataTable(
      {
      responsive: true,
      dom: 'lfrBtip',
      buttons:[
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

