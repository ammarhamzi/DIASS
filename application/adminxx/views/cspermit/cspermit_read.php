<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('cspermit');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('cspermit');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('cspermit');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('cspermit');?>
                <?php echo $this->lang->line('detail');?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_permit_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_permit_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_driver_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_driver_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_recent_permitno');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_recent_permitno; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_recent_expirydate');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_recent_expirydate; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_driveracknowledgement');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_driveracknowledgement; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_driveracknowledgement_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_driveracknowledgement_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_certbyemployer');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_certbyemployer; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_certbyemployer_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_certbyemployer_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_certbytrainer');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_certbytrainer; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_certbytrainer_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_certbytrainer_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_course_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_course_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_csbriefingscheduled');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_csbriefingscheduled; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_csbriefingapproval');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_csbriefingapproval; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_attendcsbriefing');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_attendcsbriefing; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_completed_docs');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_completed_docs; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_approvedby_airside');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_approvedby_airside; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_created_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_created_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_updated_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_updated_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_deleted_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_deleted_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('cspermit_lastchanged_by');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $cspermit_lastchanged_by; ?>
                    </td>
                </tr>

            </table>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>