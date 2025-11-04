<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('adppermit');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('adppermit');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('adppermit');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('adppermit');?>
                <?php echo $this->lang->line('detail');?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_permit_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_permit_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_driver_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_driver_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_driveracknowledgement');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_driveracknowledgement; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_verifybyemployer');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_verifybyemployer; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_certbytrainer');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_certbytrainer; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_certbytrainer_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_certbytrainer_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_verifybymahb');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_verifybymahb; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_verifybymahb_drivingarea');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo trim($adppermit_verifybymahb_drivingarea); ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_verifybymahb_vehicleclass');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_verifybymahb_vehicleclass; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_course_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_course_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_competencytest_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_competencytest_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_attendbriefing');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_attendbriefing; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_attendanceslip');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_attendanceslip; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_examscheduled');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_examscheduled; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_approvedtotakeexam_by');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_approvedtotakeexam_by; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_exampass');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_exampass; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_completed_docs');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_completed_docs; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_approvedby_airside');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_approvedby_airside; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_created_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_created_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_updated_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_updated_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_deleted_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_deleted_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('adppermit_lastchanged_by');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $adppermit_lastchanged_by; ?>
                    </td>
                </tr>

            </table>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>