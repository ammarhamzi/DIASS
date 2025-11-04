
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Roles</li>
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
    <?php
if (($permission->cp_create == true && !isset($id)) || ($permission->cp_update
    == true && isset($id))) {
    ?>
                    <div class="box  box-primary">
                        <div class="box-header with-border">
                                    <i class="fa fa-file-text-o"></i>

                                    <h3 class="box-title">Roles</h3>
                                    <div class="box-tools pull-right">

                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                        <!-- /.box-header -->
                        <div class="box-body">


                <form action="<?php echo $action; ?>" method="post">
                    <div class="row col-md-12">
                        <h5 class="pull-right"><?php echo $this->lang->line('legend'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo $this->lang->line('required_field'); ?></h5>
                    </div>


                    <div class="row">
                        <label class="col-md-3 text-right">
    <?php echo $this->lang->line('usergroup_type'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('usergroup_type'); ?>
                        </label>

                        <div class="col-md-9"><select class="form-control select2" name="usergroup_type" id="usergroup_type">
                                <option value="">-SELECT-</option>
                                <?php
foreach ($usertype as $value) {
        ?>
                                    <option value="<?php echo $value->usertype_id; ?>" <?php echo ($value->usertype_id
            === $usergroup_type ? 'selected="selected"' : "");
        ?>><?php echo $value->usertype_name; ?></option>
                                            <?php
}
    ?>
                            </select>
                                     </div></div>

                    <div class="row">
                        <label class="col-md-3 text-right">
    <?php echo $this->lang->line('usergroup_name'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('usergroup_name'); ?>
                        </label>
                        <div class="col-md-9"><input type="text" class="form-control" name="usergroup_name" id="usergroup_name" placeholder="<?php echo $this->lang->line('usergroup_name'); ?>"value="<?php echo $usergroup_name; ?>" maxlength="255" />
                                     </div></div>

                    <div class="row">
                        <label class="col-md-3 text-right">
    <?php echo $this->lang->line('usergroup_desc'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('usergroup_desc'); ?>
                        </label>
                        <div class="col-md-9"><textarea class="form-control" name="usergroup_desc" id="usergroup_desc" placeholder="<?php echo $this->lang->line('usergroup_desc'); ?>" rows="5" cols="50"><?php echo $usergroup_desc; ?></textarea>
                                     </div></div>

                    <div class="row">
                        <div class="col-md-offset-1 col-md-11">
                            <input type="hidden" name="usergroup_id" value="<?php echo (isset($id)
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


                    <div class="box  box-primary">
                        <div class="box-header with-border">
                                    <i class="fa fa-file-text-o"></i>

                                    <h3 class="box-title">Roles</h3>
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
                        <th><?php echo $this->lang->line('usergroup_type'); ?></th>
                        <th><?php echo $this->lang->line('usergroup_name'); ?></th>
                        <th><?php echo $this->lang->line('usergroup_desc'); ?></th>

                        <!--<th class="no-sort">&nbsp;</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
$start = 0;
if ($usergroup_data) {
    foreach ($usergroup_data as $usergroup) {
        ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo $usergroup->usertype_name_usergroup_type; ?></td>
                                <td><?php echo $usergroup->usergroup_name; ?></td>
                                <td><?php echo $usergroup->usergroup_desc; ?></td>

<!--                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">
                                    <?php
$id = fixzy_encoder($usergroup->usergroup_id);
        if ($permission->cp_update == true) {
            echo anchor(site_url('usergroup/index/' . $id),
                '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>');
        }
        if ($permission->cp_delete == true) {

            echo anchor(site_url('usergroup/delete/' . $id),
                '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
                'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
        }
        ?>
                                    </div>
                                </td>-->
                            </tr>
                            <?php
}
}
?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('usergroup_type'); ?></th>
                        <th><?php echo $this->lang->line('usergroup_name'); ?></th>
                        <th><?php echo $this->lang->line('usergroup_desc'); ?></th>

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
          {
          extend: 'collection',
          text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> <?php echo $this->lang->line("export"); ?>',
          buttons:[

              {
              extend: 'excelHtml5',
              title: '<?php echo $this->lang->line("data_export"); ?>',
              exportOptions: {
                columns:[0, 1, 2, 3]
                }
              },
              {
              extend: 'pdfHtml5',
              title: '<?php echo $this->lang->line("data_export"); ?>',
              message: '<?php echo $this->lang->line("any_message"); ?>',
              download: 'open',
              exportOptions: {
                columns:[0, 1, 2, 3]
                }
              },
              {
              extend: 'print',
              title: '<?php echo $this->lang->line("data_export"); ?>',
              exportOptions: {
                columns:[0, 1, 2, 3]
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

