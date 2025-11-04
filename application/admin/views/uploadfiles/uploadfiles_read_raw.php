<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="panel panel-info">
    <div class="panel-heading">
        <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('uploadfiles');?>
            <?php echo $this->lang->line('detail');?>
        </h4>
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-responsive">

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('uploadfiles_filename');?>
                </th>
                <td class="col-md-9">
                    <?php echo $uploadfiles_filename; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('uploadfiles_filesize');?>
                </th>
                <td class="col-md-9">
                    <?php echo $uploadfiles_filesize; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('uploadfiles_ext');?>
                </th>
                <td class="col-md-9">
                    <?php echo $uploadfiles_ext; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('uploadfiles_type');?>
                </th>
                <td class="col-md-9">
                    <?php echo $uploadfiles_type; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('uploadfiles_company_id');?>
                </th>
                <td class="col-md-9">
                    <?php echo $uploadfiles_company_id; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('uploadfiles_permit_id');?>
                </th>
                <td class="col-md-9">
                    <?php echo $uploadfiles_permit_id; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('uploadfiles_driver_id');?>
                </th>
                <td class="col-md-9">
                    <?php echo $uploadfiles_driver_id; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('uploadfiles_vehicle_id');?>
                </th>
                <td class="col-md-9">
                    <?php echo $uploadfiles_vehicle_id; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('uploadfiles_fixedfacilities_id');?>
                </th>
                <td class="col-md-9">
                    <?php echo $uploadfiles_fixedfacilities_id; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('uploadfiles_processtype');?>
                </th>
                <td class="col-md-9">
                    <?php echo $uploadfiles_processtype; ?>
                </td>
            </tr>

        </table>

    </div>
</div>