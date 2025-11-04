<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li><a href="<?php echo site_url('permitpendingreplacement'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('permitpendingreplacement'); ?> <?php echo $this->lang->line('list'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('permitpendingreplacement'); ?>
            <?php echo $this->lang->line('detail'); ?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('permitpendingreplacement'); ?>
                <?php echo $this->lang->line('detail'); ?>
            </h4>
        </div>
        <div class="panel-body">

            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#driverinfo" aria-controls="driverinfo" role="tab" data-toggle="tab">Driver Information</a></li>
                    <!--    <li role="presentation"><a href="#permitinfo" aria-controls="permitinfo" role="tab" data-toggle="tab">Permit Information</a></li>-->
                    <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab">History</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="driverinfo">
                        <div class="row">
                            <div class="col-md-5">
                                <table class="table table-condensed table-responsive">
                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('driver_name'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $driver_name; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('driver_ic'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $driver_ic; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('driver_nationality_country_id'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $driver_nationality_country_id; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('driver_drivingclass'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $driver_drivingclass; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-5">
                                <table class="table table-condensed table-responsive">
                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('driver_hpno'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $driver_hpno; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('driver_email'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $driver_email; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('driver_drivinglicenseno'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $driver_drivinglicenseno; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('driver_licenseexpirydate'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $driver_licenseexpirydate; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2">
                                <img src="<?php echo $this->config->item('client_url'); ?>/uploads/files/<?php echo ($driver_photo->uploadfiles_filename?$driver_photo->uploadfiles_filename:'no-image-single.png'); ?>" alt="" height="150" width="150">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <table>
                                    <tr>
                                        <th colspan="2">Offence(s)</th>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table>
                                    <tr>
                                        <th colspan="2">Briefing Information</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Date</th>
                                        <td>
                                            <?php echo $pbbpermit_course_date;?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-4">
                                <table>
                                    <tr>
                                        <th colspan="2">Supporting Documents</th>
                                    </tr>
                                    <?php
if($permit_files){
									$count = 0;
foreach ($permit_files as $file) {
    $filename = explode("--", $file->uploadfiles_filename);
    ?>
                                        <tr>
                                            <td>
                                                <?php echo ++$count; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $this->config->item('client_url'); ?>/uploads/files/<?php echo $file->uploadfiles_filename; ?>" target="_blank">
                                                    <?php echo $filename[1]; ?>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
}
}
?>
                                </table>
                            </div>
                        </div>

                        <!--                        <table class="table table-condensed table-responsive">

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_name'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_name; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_dob'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_dob; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_ic'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_ic; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_designation'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_designation; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_department'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_department; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_nationality_country_id'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_nationality_country_id; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_address'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_address; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_officeno'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_officeno; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_hpno'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_hpno; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_email'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_email; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_jpjdrivinglicenseno'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_jpjdrivinglicenseno; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_jpjdrivingclass'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_jpjdrivingclass; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_jpjlicenseexpirydate'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_jpjlicenseexpirydate; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_drivinglicenseno'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_drivinglicenseno; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_drivingclass'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_drivingclass; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_licenseexpirydate'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_licenseexpirydate; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_blacklistedremark'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_blacklistedremark; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_permit_typeid'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_permit_typeid; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_activity_statusid'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_activity_statusid; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('driver_application_date'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_application_date; ?>
                                </td>
                            </tr>

                        </table>
                        <table>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                            </tr>
                            <?php
$count = 0;
foreach ($permit_files as $file) {
    $filename = explode("--", $file->uploadfiles_filename);
    ?>
                                <tr>
                                    <td>
                                        <?php echo ++$count; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo $this->config->item('client_url'); ?>/uploads/files/<?php echo $file->uploadfiles_filename; ?>" target="_blank">
                                            <?php echo $filename[1]; ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php
}
?>
                        </table>
                        <img src="<?php echo $this->config->item('client_url'); ?>/uploads/files/<?php echo $driver_photo->uploadfiles_filename; ?>" alt="">-->
                    </div>
                    <div role="tabpanel" class="tab-pane" id="permitinfo">
                        <table class="table table-condensed table-responsive">

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_groupid'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_groupid; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_typeid'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_typeid; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_condition'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_condition; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_bookingid'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_bookingid; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_picid'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_picid; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_companyid'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_companyid; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_issuance_serialno'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_issuance_serialno; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_issuance_date'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_issuance_date; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_issuance_startdate'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_issuance_startdate; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_issuance_expirydate'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_issuance_expirydate; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_issuance_processedby'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_issuance_processedby; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_payment_invoiceno'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_payment_invoiceno; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_payment_trainingfee'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_payment_trainingfee; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_payment_new'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_payment_new; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_payment_renew_oneyear'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_payment_renew_oneyear; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_payment_renew_prorated'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_payment_renew_prorated; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_payment_sst'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_payment_sst; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_payment_total'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_payment_total; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_payment_processedby'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_payment_processedby; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_status'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_status; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_officialstatus'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_officialstatus; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_remark'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_remark; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_timeline'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_timeline; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_created_at'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $permit_created_at; ?>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="history">
                        <table id="mytable" class="table" style="width: 100% !important">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <!--                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_permitid'); ?>
                                    </th>-->
                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_userid'); ?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_name'); ?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_desc'); ?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_status'); ?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_officialstatus'); ?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_created_at'); ?>
                                    </th>
                                    <!--                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_lastchanged_by'); ?>
                                    </th>-->

                                </tr>
                            </thead>
                            <tbody>
                                <?php
$start = 0;
if ($timeline) {

    foreach ($timeline as $permittimelinedom) {
        ?>
                                    <tr>
                                        <td>
                                            <?php echo ++$start; ?>
                                        </td>
                                        <!--                                        <td>
                                            <?php echo $permittimelinedom->permit_timeline_permitid; ?>
                                        </td>-->
                                        <td>
                                            <?php echo $permittimelinedom->user_name_permit_timeline_userid; ?>
                                        </td>
                                        <td>
                                            <?php echo $permittimelinedom->permit_timeline_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $permittimelinedom->permit_timeline_desc; ?>
                                        </td>
                                        <td>
                                            <?php echo $permittimelinedom->permit_status_desc_permit_timeline_status; ?>
                                        </td>
                                        <td>
                                            <?php echo $permittimelinedom->permit_officialstatus_name_permit_timeline_officialstatus; ?>
                                        </td>
                                        <td>
                                            <?php echo $permittimelinedom->permit_timeline_created_at; ?>
                                        </td>
                                        <!--                                        <td>
                                            <?php echo $permittimelinedom->permit_timeline_lastchanged_by; ?>
                                        </td>-->

                                    </tr>
                                    <?php
}
}
?>
                            </tbody>

                        </table>
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="submitform" name="submitform" action="/admin/permitpendingreplacement/pbb_submit/" method="POST">
                            <div class="row">
                                <h3>Your Action</h3>
                                <h4>Check submitted documents.</h4>
                                <table class="table">
                                    <tr>
                                        <td>Action Date <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('approvaldate') ?></td>
                                        <td><input type="text" name="approvaldate" id="approvaldate" readonly value="<?php echo date('Y-m-d H:i:s');?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Status <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('adminapproval') ?></td>
                                        <td><input id="adminapproval" name="adminapproval" type="radio" value="y"><span style="color: #339900"> All documents are complete </span> <br>
                                            <input id="adminapproval" name="adminapproval" type="radio" value="n"> <span style="color: #FF0000">Documents not complete</span></td>
                                    </tr>
                                    <tr>
                                        <td>Remark</td>
                                        <td><textarea id="remark" name="remark"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input id="agree" name="agree" type="checkbox" value="y"> I hereby ....<?php echo form_error('agree') ?><br><input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary"></td>
                                    </tr>

                                </table>

                                <input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id; ?>">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
            <!--
            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>-->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $("#mytable").DataTable({
            responsive: true,
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href") // activated tab
            if (target == '#history') {
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust()
                        .responsive.recalc();
                });
            }
        });
    });
</script>