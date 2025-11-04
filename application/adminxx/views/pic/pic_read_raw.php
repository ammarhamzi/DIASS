<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="panel panel-info">
    <div class="panel-heading">
        <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('pic');?>
            <?php echo $this->lang->line('detail');?>
        </h4>
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-responsive">

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('pic_company_id');?>
                </th>
                <td class="col-md-9">
                    <?php echo $pic_company_id; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('pic_fullname');?>
                </th>
                <td class="col-md-9">
                    <?php echo $pic_fullname; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('pic_ic');?>
                </th>
                <td class="col-md-9">
                    <?php echo $pic_ic; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('pic_phoneoffice');?>
                </th>
                <td class="col-md-9">
                    <?php echo $pic_phoneoffice; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('pic_handphone');?>
                </th>
                <td class="col-md-9">
                    <?php echo $pic_handphone; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('pic_email');?>
                </th>
                <td class="col-md-9">
                    <?php echo $pic_email; ?>
                </td>
            </tr>

        </table>

    </div>
</div>