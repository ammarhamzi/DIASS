<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="panel panel-info">
    <div class="panel-heading">
        <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('adpdocs');?>
            <?php echo $this->lang->line('detail');?>
        </h4>
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-responsive">

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('adpdocs_adppermit_id');?>
                </th>
                <td class="col-md-9">
                    <?php echo $adpdocs_adppermit_id; ?>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p><img src="<?php echo base_url() ?>resources/shared_img/<?php echo ($adpdocs_attendanceslip?$adpdocs_attendanceslip:'system/no-image.jpg');?>" width="100" height="100" /></p>
                </td>
            </tr>

        </table>

    </div>
</div>