<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('vehicle');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('vehicle');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('vehicle');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('vehicle');?>
                <?php echo $this->lang->line('detail');?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_company_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_company_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_registration_no');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_registration_no; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_type');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_type; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_insurance_policy_no');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_insurance_policy_no; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_insurance_expiry_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_insurance_expiry_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_vehicleequipmenttype_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_vehicleequipmenttype_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_parkingarea_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_parkingarea_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_year_manufacture');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_year_manufacture; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_chasis_no');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_chasis_no; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_enginetype_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_enginetype_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_engine_no');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_engine_no; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_engine_capacity');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_engine_capacity; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_activity_statusid');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_activity_statusid; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_application_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_application_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vehicle_blacklistedremark');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vehicle_blacklistedremark; ?>
                    </td>
                </tr>

            </table>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>