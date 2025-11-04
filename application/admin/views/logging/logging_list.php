<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('logging'); ?> <?php echo $this->lang->line('list'); ?></li>
    </ol>
    <div class="row">
        <div class="col-md-12 text-center">
            <div id="message">
                <?php echo $this->session->userdata('message') != ''
? $this->session->userdata('message') : '';
?>
            </div>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('logging'); ?> <?php echo $this->lang->line('list'); ?></h4>
        </div>
        <div class="panel-body">
            <table id="mytable" class="display table">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th><?php echo $this->lang->line('user_id'); ?></th>
                        <th><?php echo $this->lang->line('string_query'); ?></th>
                        <th><?php echo $this->lang->line('query_type'); ?></th>
                        <th><?php echo $this->lang->line('datetime_query'); ?></th>
                        <th><?php echo $this->lang->line('executetime'); ?></th>

                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('user_id'); ?></th>
                        <th><?php echo $this->lang->line('string_query'); ?></th>
                        <th><?php echo $this->lang->line('query_type'); ?></th>
                        <th><?php echo $this->lang->line('datetime_query'); ?></th>
                        <th><?php echo $this->lang->line('executetime'); ?></th>

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

    $('#mytable thead th').each(function (i)
      {
        if (i == 2 || i == 4) {
          var title = $(this).text();
          $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        }
      }
    );

    var table = $("#mytable").DataTable(
      {
      "processing": true,
      "serverSide": true,
      "ajax": "<?php echo site_url('logging/get_json'); ?>",
      responsive: true,
      dom: 'lrBtip',
      buttons:[
          {
          extend: 'collection',
          text: '<?php echo $this->lang->line("export"); ?>',
          buttons:[

              {
              extend: 'excelHtml5',
              title: '<?php echo $this->lang->line("data_export"); ?>',
              exportOptions: {
                columns:[0, 1, 2, 3, 4, 5]
                }
              },
              {
              extend: 'pdfHtml5',
              title: '<?php echo $this->lang->line("data_export"); ?>',
              message: '<?php echo $this->lang->line("any_message"); ?>',
              download: 'open',
              exportOptions: {
                columns:[0, 1, 2, 3, 4, 5]
                }
              },
              {
              extend: 'print',
              title: '<?php echo $this->lang->line("data_export"); ?>',
              exportOptions: {
                columns:[0, 1, 2, 3, 4, 5]
                }
              }

            ]
          }
        ],
      columnDefs:[
          {targets: 'no-sort', orderable: false}
        ]
        ,
      initComplete: function () {
          this.api().columns().every(function (i)
            {
              if (i == 1 || i == 3) {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                .appendTo($(column.header()).empty())
                .on('change', function ()
                  {
                    var val = $.fn.dataTable.util.escapeRegex(
                      $(this).val()
                    );

                    column
                    .search(val? '^' + val + '$': '', true, false)
                    .draw();
                  }
                );

                column.data().unique().sort().each(function (d, j)
                  {
                    select.append('<option value="' + d + '">' + d + '</option>')
                  }
                );
              }
            }
          );
        }
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

