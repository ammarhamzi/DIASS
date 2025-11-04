
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('refstate'); ?> <?php echo $this->lang->line('list'); ?></li>
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
    <?php
if (($permission->cp_create == true && !isset($id)) || ($permission->cp_update
    == true && isset($id))) {
    ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('refstate'); ?> <?php echo $button; ?></h4>
            </div>
            <div class="panel-body">


                <form autocomplete="off" action="<?php echo $action; ?>" method="post">
                    <div class="row col-md-12">
                        <h5 class="pull-right"><?php echo $this->lang->line('legend'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo $this->lang->line('required_field'); ?></h5>
                    </div>


                    <div class="row">
                        <label class="col-md-1">
    <?php echo $this->lang->line('ref_state_code'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('ref_state_code'); ?>
                        </label>
                        <div class="col-md-11"><input type="text" class="form-control" name="ref_state_code" id="ref_state_code" placeholder="<?php echo $this->lang->line('ref_state_code'); ?>" value="<?php echo $ref_state_code; ?>" maxlength="3"/>
                                      </div></div>

                    <div class="row">
                        <label class="col-md-1">
    <?php echo $this->lang->line('ref_state_name'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('ref_state_name'); ?>
                        </label>
                        <div class="col-md-11"><input type="text" class="form-control" name="ref_state_name" id="ref_state_name" placeholder="<?php echo $this->lang->line('ref_state_name'); ?>"value="<?php echo $ref_state_name; ?>" maxlength="25" />
                                     </div></div>

                    <div class="row">
                        <label class="col-md-1">
    <?php echo $this->lang->line('ref_state_capital'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('ref_state_capital'); ?>
                        </label>
                        <div class="col-md-11"><input type="text" class="form-control" name="ref_state_capital" id="ref_state_capital" placeholder="<?php echo $this->lang->line('ref_state_capital'); ?>"value="<?php echo $ref_state_capital; ?>" maxlength="150" />
                                     </div></div>

                    <div class="row">
                        <label class="col-md-1">
    <?php echo $this->lang->line('ref_state_plate'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('ref_state_plate'); ?>
                        </label>
                        <div class="col-md-11"><input type="text" class="form-control" name="ref_state_plate" id="ref_state_plate" placeholder="<?php echo $this->lang->line('ref_state_plate'); ?>" value="<?php echo $ref_state_plate; ?>" maxlength="1"/>
                                      </div></div>

                    <div class="row">
                        <div class="col-md-offset-1 col-md-11">
                            <input type="hidden" name="ref_state_id" value="<?php echo (isset($id)
        ? $id : "");
    ?>" />
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
}
?>


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
if ($refstate_data) {
    foreach ($refstate_data as $refstate) {
        ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo $refstate->ref_state_code; ?></td>
                                <td><?php echo $refstate->ref_state_name; ?></td>
                                <td><?php echo $refstate->ref_state_capital; ?></td>
                                <td><?php echo $refstate->ref_state_plate; ?></td>

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">
                                    <?php
$id = fixzy_encoder($refstate->ref_state_id);
        if ($permission->cp_update == true) {
            echo anchor(site_url('refstate/index/' . $id),
                '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>');
        }
        if ($permission->cp_delete == true) {

            echo anchor(site_url('refstate/delete/' . $id),
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

