
<div class="container-fluid">

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
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> radbackup <?php echo $this->lang->line('list'); ?></h4>
        </div>
        <div class="panel-body">
            <table id="mytable" class="table" style="width: 100% !important">

                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('radbackup_datetime'); ?></th>

                        <th class="no-sort">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$start = 0;
foreach ($radbackup_data as $radbackup) {
    ?>
                        <tr>
                            <td><?php echo ++$start; ?></td>
                            <td><?php echo $radbackup->radbackup_datetime; ?></td>

                            <td style="text-align:center">
                                <?php
$id = fixzy_encoder($radbackup->radbackup_id);
    echo anchor(site_url('radbackup/rollback/' . $id),
        $this->lang->line('Roll_Back_This'));
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
                        <th><?php echo $this->lang->line('radbackup_datetime'); ?></th>

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



    var table = $("#mytable").DataTable(
      {
      "paging": false,
      "ordering": false,
      "info": false,
      "searching": false,
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
