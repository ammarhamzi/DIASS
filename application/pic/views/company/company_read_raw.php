<div class="panel panel-info">
    <div class="panel-heading">
        <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('company');?>
            <?php echo $this->lang->line('detail');?>
        </h4>
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-responsive">

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('company_name');?>
                </th>
                <td class="col-md-9">
                    <?php echo $company_name; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('company_address');?>
                </th>
                <td class="col-md-9">
                    <?php echo $company_address; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('company_userdepartment');?>
                </th>
                <td class="col-md-9">
                    <?php echo $company_userdepartment; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('company_registerednumber');?>
                </th>
                <td class="col-md-9">
                    <?php echo $company_registerednumber; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('company_contact_person');?>
                </th>
                <td class="col-md-9">
                    <?php echo $company_contact_person; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('company_contact_email');?>
                </th>
                <td class="col-md-9">
                    <?php echo $company_contact_email; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('company_contact_phone');?>
                </th>
                <td class="col-md-9">
                    <?php echo $company_contact_phone; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('company_contact_fax');?>
                </th>
                <td class="col-md-9">
                    <?php echo $company_contact_fax; ?>
                </td>
            </tr>

        </table>

    </div>
</div>