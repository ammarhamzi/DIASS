<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="panel panel-info">
    <div class="panel-heading">
        <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('inspectionmanagement');?>
            <?php echo $this->lang->line('detail');?>
        </h4>
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-responsive">

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('inspectionmanagement_date');?>
                </th>
                <td class="col-md-9">
                    <?php echo $inspectionmanagement_date; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('inspectionmanagement_slot');?>
                </th>
                <td class="col-md-9">
                    <?php echo $inspectionmanagement_slot; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('inspectionmanagement_slottaken');?>
                </th>
                <td class="col-md-9">
                    <?php echo $inspectionmanagement_slottaken; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('inspectionmanagement_location');?>
                </th>
                <td class="col-md-9">
                    <?php echo $inspectionmanagement_location; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('inspectionmanagement_officer_pic');?>
                </th>
                <td class="col-md-9">
                    <?php echo $inspectionmanagement_officer_pic; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('inspectionmanagement_remark');?>
                </th>
                <td class="col-md-9">
                    <?php echo $inspectionmanagement_remark; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('inspectionmanagement_type');?>
                </th>
                <td class="col-md-9">
                    <?php echo $inspectionmanagement_type; ?>
                </td>
            </tr>

        </table>

    </div>
</div>