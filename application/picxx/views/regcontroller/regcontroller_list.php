
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('regcontroller'); ?> <?php echo $this->lang->line('list'); ?></li>
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
        <button type="button" class="btn btn-primary btn-lg">Register Controller</button>
        <button type="button" class="btn btn-default btn-lg" id="goto">Add Permission</button>
    </div>
    <?php
if (($permission->cp_create == true && !isset($id)) || ($permission->cp_update
    == true && isset($id))) {
    ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('regcontroller'); ?> <?php echo $button; ?></h4>
            </div>
            <div class="panel-body">


                <form autocomplete="off" action="<?php echo $action; ?>" method="post">
                    <div class="row col-md-12">
                        <h5 class="pull-right"><?php echo $this->lang->line('legend'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo $this->lang->line('required_field'); ?></h5>
                    </div>


                    <div class="row">
                        <label class="col-md-3 text-right">
    <?php echo $this->lang->line('control_name'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('control_name'); ?>
                        </label>
                        <div class="col-md-9"><input type="text" class="form-control" name="control_name" id="control_name" placeholder="<?php echo $this->lang->line('control_name'); ?>"value="<?php echo $control_name; ?>" maxlength="250" />
                                     </div></div>


                    <div class="row">
                        <label class="col-md-3 text-right">
    <?php echo $this->lang->line('control_desc'); ?> <?php echo form_error('control_desc'); ?>
                        </label><div class="col-md-9"><textarea class="form-control" name="control_desc" id="control_desc" placeholder="<?php echo $this->lang->line('control_desc'); ?>" rows="5" cols="50"><?php echo $control_desc; ?></textarea>
                                     </div></div>

                    <div class="row">
                        <div class="col-md-offset-1 col-md-11">
                            <input type="hidden" name="control_id" value="<?php echo (isset($id)
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
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('regcontroller'); ?> <?php echo $this->lang->line('list'); ?></h4>
        </div>
        <div class="panel-body">
            <table id="mytable" class="table" style="width: 100% !important">

                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('control_name'); ?></th>
                        <th><?php echo $this->lang->line('control_desc'); ?></th>

                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$start = 0;
if ($regcontroller_data) {

    foreach ($regcontroller_data as $regcontroller) {
        ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo $regcontroller->control_name; ?></td>
                                <td><?php echo $regcontroller->control_desc; ?></td>

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">
                                    <?php
$id = fixzy_encoder($regcontroller->control_id);
        echo anchor(site_url('regcontroller/index/' . $id),
            '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>');

        echo anchor(site_url('regcontroller/delete/' . $id),
            '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
            'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
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
                        <th><?php echo $this->lang->line('control_name'); ?></th>
                        <th><?php echo $this->lang->line('control_desc'); ?></th>

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
    setTimeout(function ()
      {
        $('.alert').fadeOut(400);
      }, 4000
    );
    var table = $("#mytable").DataTable(
      {
      responsive: true,
      dom: 'lfrBtip',
      buttons:[
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
                    columns:[0, 1, 2]
                    }
                  },
                  {
                  extend: 'pdfHtml5',
                  title: '<?php echo $this->lang->line("data_export"); ?>',
                  message: '<?php echo $this->lang->line("any_message"); ?>',
                  download: 'open',
                  exportOptions: {
                    columns:[0, 1, 2]
                    }
                  },
                  {
                  extend: 'print',
                  title: '<?php echo $this->lang->line("data_export"); ?>',
                  exportOptions: {
                    columns:[0, 1, 2]
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
    $("#goto").click(function ()
      {

        redirect('<?php
echo site_url('controllerpermission');

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

