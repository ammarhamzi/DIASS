
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Countries</li>
    </ol>
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

                                    <h3 class="box-title">Countries</h3>
                                    <div class="box-tools pull-right">

                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                        <!-- /.box-header -->
                        <div class="box-body">
            <table id="mytable" class="table" style="width: 100% !important">

                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('ref_country_iso'); ?></th>
                        <th><?php echo $this->lang->line('ref_country_name'); ?></th>
                        <th><?php echo $this->lang->line('ref_country_printable_name'); ?></th>
                        <th><?php echo $this->lang->line('ref_country_iso3'); ?></th>
                        <th><?php echo $this->lang->line('ref_country_numcode'); ?></th>

                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$start = 0;
if ($refcountry_data) {

    foreach ($refcountry_data as $refcountry) {
        ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo $refcountry->ref_country_iso; ?></td>
                                <td><?php echo $refcountry->ref_country_name; ?></td>
                                <td><?php echo $refcountry->ref_country_printable_name; ?></td>
                                <td><?php echo $refcountry->ref_country_iso3; ?></td>
                                <td><?php echo $refcountry->ref_country_numcode; ?></td>

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
$id = fixzy_encoder($refcountry->ref_country_id);
/*        if ($permission->cp_read == true) {
            echo anchor(site_url('refcountry/read/' . $id),
                '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>');
        }*/
        if ($permission->cp_update == true) {

            echo anchor(site_url('refcountry/update/' . $id),
                '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>');
        }
/*        if ($permission->cp_delete == true) {

            echo anchor(site_url('refcountry/delete/' . $id),
                '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
                'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
        }*/
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
                        <th><?php echo $this->lang->line('ref_country_iso'); ?></th>
                        <th><?php echo $this->lang->line('ref_country_name'); ?></th>
                        <th><?php echo $this->lang->line('ref_country_printable_name'); ?></th>
                        <th><?php echo $this->lang->line('ref_country_iso3'); ?></th>
                        <th><?php echo $this->lang->line('ref_country_numcode'); ?></th>

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
/*<?php
if ($permission->cp_create == true) {
    ?>
              {text: '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $this->lang->line("add_new"); ?>',
              action: function (e, dt, node, config) {
                  redirect("<?php echo site_url('refcountry/create'); ?>");
                }
              },
<?php }?>*/
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
        ],
      "language": {
        "emptyTable": "My Custom Message On Empty Table"
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
