<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('vdgspermit');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('vdgspermit');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('vdgspermit');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('vdgspermit');?>
                <?php echo $this->lang->line('detail');?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_permit_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_permit_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_driver_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_driver_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_recent_permitno');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_recent_permitno; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_recent_expirydate');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_recent_expirydate; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_driveracknowledgement');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_driveracknowledgement; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_driveracknowledgement_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_driveracknowledgement_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_certbyemployer');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_certbyemployer; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_certbyemployer_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_certbyemployer_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_certbytrainer');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_certbytrainer; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_certbytrainer_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_certbytrainer_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_course_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_course_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_vdgsbriefingscheduled');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_vdgsbriefingscheduled; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_vdgsbriefingapproval');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_vdgsbriefingapproval; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_attendvdgsbriefing');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_attendvdgsbriefing; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_completed_docs');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_completed_docs; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_approvedby_airside');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_approvedby_airside; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_created_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_created_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_updated_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_updated_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_deleted_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_deleted_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('vdgspermit_lastchanged_by');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $vdgspermit_lastchanged_by; ?>
                    </td>
                </tr>

            </table>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>