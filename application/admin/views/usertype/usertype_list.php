
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('usertype'); ?> <?php echo $this->lang->line('list'); ?></li>
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
    <?php
if (($permission->cp_create == true && !isset($id)) || ($permission->cp_update
    == true && isset($id))) {
    ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('usertype'); ?> <?php echo $button; ?></h4>
            </div>
            <div class="panel-body">


                <form action="<?php echo $action; ?>" method="post">
                    <div class="row col-md-12">
                        <h5 class="pull-right"><?php echo $this->lang->line('legend'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo $this->lang->line('required_field'); ?></h5>
                    </div>


                    <div class="row">
                        <label class="col-md-3 text-right">
    <?php echo $this->lang->line('usertype_name'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('usertype_name'); ?>
                        </label>
                        <div class="col-md-9"><input type="text" class="form-control" name="usertype_name" id="usertype_name" placeholder="<?php echo $this->lang->line('usertype_name'); ?>"value="<?php echo $usertype_name; ?>" maxlength="50" />
                                     </div></div>

                    <div class="row">
                        <label class="col-md-3 text-right">
    <?php echo $this->lang->line('usertype_desc'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('usertype_desc'); ?>
                        </label>
                        <div class="col-md-9"><textarea class="form-control" name="usertype_desc" id="usertype_desc" placeholder="<?php echo $this->lang->line('usertype_desc'); ?>" rows="5" cols="50"><?php echo $usertype_desc; ?></textarea>
                                     </div></div>
                              <input type='hidden' name="usertype_updateby" id="usertype_updateby" value="<?php
echo $this->session->userdata('id');

    ?>" />
                              <input type='hidden' name="usertype_lastupdate" id="usertype_lastupdate" value="<?php
echo date('Y-m-d H:i:s');

    ?>" />

                    <div class="row">
                        <div class="col-md-offset-1 col-md-11">
                            <input type="hidden" name="usertype_id" value="<?php echo (isset($id)
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
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('usertype'); ?> <?php echo $this->lang->line('list'); ?></h4>
        </div>
        <div class="panel-body">
            <table id="mytable" class="table" style="width: 100% !important">

                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('usertype_name'); ?></th>
                        <th><?php echo $this->lang->line('usertype_desc'); ?></th>

                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$start = 0;
if ($usertype_data) {

    foreach ($usertype_data as $usertype) {
        ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo $usertype->usertype_name; ?></td>
                                <td><?php echo $usertype->usertype_desc; ?></td>

                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">
                                    <?php
$idloop = fixzy_encoder($usertype->usertype_id);
        if ($permission->cp_update == true) {
            echo anchor(site_url('usertype/index/' . $idloop),
                '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>');
        }
        if ($permission->cp_delete == true) {

            echo anchor(site_url('usertype/delete/' . $idloop),
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
                        <th><?php echo $this->lang->line('usertype_name'); ?></th>
                        <th><?php echo $this->lang->line('usertype_desc'); ?></th>

                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function ()
  {

    $(".btn-remote-file").click(function ()
      {
        $('input[type=file]').trigger('click');
      }
    );
    $(document).on('change', '.btn-file :file', function ()
      {
        var input = $(this),
        numFiles = input.get(0).files? input.get(0).files.length: 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect',[numFiles, label]);
      }
    );
    $(document).ready(function ()
      {
        $('.btn-file :file').on('fileselect', function (event, numFiles, label)
          {

            var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1? numFiles + ' files selected': label;
            if (input.length) {
              input.val(log);
              $(this).parents('.input-group').find(":submit").click();
            } else {
              //if( log ) alert(log);
            }

          }
        );
      }
    );
  }
);
</script>
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
  }
);
</script>
<script>
function redirect(url) {
  $(location).attr('href', url);
}
</script>

