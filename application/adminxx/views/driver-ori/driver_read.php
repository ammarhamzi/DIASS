<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('driver');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('driver');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('driver');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('driver');?>
                <?php echo $this->lang->line('detail');?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_name');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_name; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_dob');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_dob; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_ic');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_ic; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_designation');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_designation; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_department');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_department; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_nationality_country_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_nationality_country_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_address');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_address; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_officeno');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_officeno; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_hpno');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_hpno; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_email');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_email; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_drivinglicenseno');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_drivinglicenseno; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_drivingclass');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_drivingclass; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_licenseexpirydate');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_licenseexpirydate; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_blacklistedremark');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_blacklistedremark; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_permit_typeid');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_permit_typeid; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_activity_statusid');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_activity_statusid; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('driver_application_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $driver_application_date; ?>
                    </td>
                </tr>

            </table>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>