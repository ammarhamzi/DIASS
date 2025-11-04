<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="panel panel-info">
    <div class="panel-heading">
        <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('permittimelinedom');?>
            <?php echo $this->lang->line('detail');?>
        </h4>
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-responsive">

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('permit_timeline_permitid');?>
                </th>
                <td class="col-md-9">
                    <?php echo $permit_timeline_permitid; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('permit_timeline_userid');?>
                </th>
                <td class="col-md-9">
                    <?php echo $permit_timeline_userid; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('permit_timeline_name');?>
                </th>
                <td class="col-md-9">
                    <?php echo $permit_timeline_name; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('permit_timeline_desc');?>
                </th>
                <td class="col-md-9">
                    <?php echo $permit_timeline_desc; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('permit_timeline_status');?>
                </th>
                <td class="col-md-9">
                    <?php echo $permit_timeline_status; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('permit_timeline_officialstatus');?>
                </th>
                <td class="col-md-9">
                    <?php echo $permit_timeline_officialstatus; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('permit_timeline_created_at');?>
                </th>
                <td class="col-md-9">
                    <?php echo $permit_timeline_created_at; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('permit_timeline_lastchanged_by');?>
                </th>
                <td class="col-md-9">
                    <?php echo $permit_timeline_lastchanged_by; ?>
                </td>
            </tr>

        </table>

    </div>
</div>