<!-- \resources\gen_template\master\crud-newpage\views -->
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

    </div>
</div>