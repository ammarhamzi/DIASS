<!-- \resources\gen_template\master\crud-newpage\views -->
<style type="text/css">
    .nav-tabs {
        padding-left: 15px;
        margin-bottom: 0;
        border: none;
    }

    .tab-content {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 15px;
    }
</style>
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li><a href="<?php echo site_url('permittep'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('permittep'); ?> <?php echo $this->lang->line('list'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('permittep'); ?>
            <?php echo $this->lang->line('detail'); ?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('permittep'); ?>
                <?php echo $this->lang->line('detail'); ?>
            </h4>
        </div>
        <div class="panel-body">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#vehicleinfo" aria-controls="vehicleinfo" role="tab" data-toggle="tab">Vehicle Information</a></li>
                    <?php
if($permit_officialstatus=='COMPLETED'){
;?>
                    <li role="presentation"><a href="#permitinfo" aria-controls="permitinfo" role="tab" data-toggle="tab">Permit Information</a></li>


                    <?php
}
;?>
                    <li role="presentation"><a href="#inspectionresult" aria-controls="inspectionresult" role="tab" data-toggle="tab">Inspection</a></li>
                    <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab">History</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="vehicleinfo">

                        <div class="row">
                            <div class="col-md-5">
                                <table class="table table-condensed table-responsive">

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_year_manufacture'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_year_manufacture; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_chasis_no'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_chasis_no; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_enginetype_id'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_enginetype_id; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_engine_no'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_engine_no; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_engine_capacity'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_engine_capacity; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_activity_statusid'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_activity_statusid; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_application_date'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_application_date; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_blacklistedremark'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_blacklistedremark; ?>
                                        </td>
                                    </tr>

                                </table>

                            </div>
                            <div class="col-md-5">
                                <table class="table table-condensed table-responsive">
                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_company_id'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_company_id; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_registration_no'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_registration_no; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_type'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_type; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_insurance_policy_no'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_insurance_policy_no; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_insurance_expiry_date'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_insurance_expiry_date; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_vehicleequipmenttype_id'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_vehicleequipmenttype_id; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('vehicle_parkingarea_id'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_parkingarea_id; ?>
                                        </td>
                                    </tr>

                                </table>
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
                            <!--                            <div class="col-md-4">
                                <table>
                                    <tr>
                                        <th colspan="2">Trainer & Course Provider</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Trainer Name</th>
                                        <td>
                                            <?php echo $adppermit_certbytrainer; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Training Date</th>
                                        <td>
                                            <?php echo $adppermit_certbytrainer_date; ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>-->
                            <div class="col-md-4">
                                <table>
                                    <tr>
                                        <th colspan="2">Supporting Documents</th>
                                    </tr>
                                    <?php
if ($permit_files) {
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
                                    <?php echo $this->lang->line('driver_dob'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_dob; ?>
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

                        </table>-->

                    </div>
                    <div role="tabpanel" class="tab-pane" id="permitinfo">

                        <div class="row">
                            <div class="col-md-4">
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

 <!--                                   <tr>
                                        <th class="col-md-3 text-right">
                                            <?php echo $this->lang->line('permit_companyid'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_companyid; ?>
                                        </td>
                                    </tr>-->



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
                                            <?php echo $this->lang->line('permit_created_at'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_created_at; ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-condensed table-responsive">

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
                                            <?php echo 'RM '.$permit_payment_total; ?>
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

                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-condensed table-responsive">

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

                                </table>
                            </div>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="inspectionresult">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Inspection :
                                    <?php
                                     if($shinspermit_result == 'y'){
                                     echo '<span style="color:green">PASS</span>';
                                     }elseif($shinspermit_result == 'n'){
    echo '<span style="color:red">FAILED</span>';
                                     }elseif($shinspermit_result == ''){
    echo '<span style="color:#C2C200">Pending</span>';
                                     }

?></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Inspection Date: <b><?php echo $shinspermit_inspection_date; ?></b> </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Inspection By:<b><?php echo $shinspermit_result_inspector_id; ?></b> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Inspection Result</h3>
                                <div class="row">
                                    <?php
$i         = 0;
$countloop = count($shinschecklist_data);
foreach ($shinschecklist_data as $shinschecklist) {
     ++$i;
    if ($i == 1) {
        ?>
                                        <table id="mytable" class="table" style="width: 100% !important">

                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>
                                                        <?php echo $this->lang->line('shinschecklist_name'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('shinschecklist_desc'); ?>
                                                    </th>

                                                    <th class="no-sort">Self Inspect</th>
                                                    <th class="no-sort">MTW Inspect</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $shinschecklist->shinschecklist_name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $shinschecklist->shinschecklist_desc; ?>
                                                    </td>

                                                    <td style="text-align:center; white-space: nowrap;">
                                                        <div class="btn-group" role="group" aria-label="...">

                                                            <?php
echo '<input type="checkbox" ' . ($shinschecklist->shinschecklist_checked == "y" ? "checked" : "") . ' disabled>';
        ?>
                                                        </div>
                                                    </td>
                                                    <td style="text-align:center; white-space: nowrap;">
                                                        <div class="btn-group" role="group" aria-label="...">

                                                            <?php
echo '<input type="checkbox" ' . ($shinschecklist->shinschecklist_mtwchecked == "y" ? "checked" : "") . ' disabled>';
        ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
} elseif ($i == 20) {
        ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $shinschecklist->shinschecklist_name; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $shinschecklist->shinschecklist_desc; ?>
                                                        </td>

                                                        <td style="text-align:center; white-space: nowrap;">
                                                            <div class="btn-group" role="group" aria-label="...">

                                                                <?php
echo '<input type="checkbox" ' . ($shinschecklist->shinschecklist_checked == "y" ? "checked" : "") . ' disabled>';
        ?>
                                                            </div>
                                                        </td>
                                                        <td style="text-align:center; white-space: nowrap;">
                                                            <div class="btn-group" role="group" aria-label="...">

                                                                <?php
echo '<input type="checkbox" ' . ($shinschecklist->shinschecklist_mtwchecked == "y" ? "checked" : "") . ' disabled>';
        ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                        <table id="mytable" class="table" style="width: 100% !important">

                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>
                                                        <?php echo $this->lang->line('shinschecklist_name'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('shinschecklist_desc'); ?>
                                                    </th>

                                                    <th class="no-sort">Self Inspect</th>
                                                    <th class="no-sort">MTW Inspect</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
} elseif ($i == 40) {
        ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $shinschecklist->shinschecklist_name; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $shinschecklist->shinschecklist_desc; ?>
                                                        </td>

                                                        <td style="text-align:center; white-space: nowrap;">
                                                            <div class="btn-group" role="group" aria-label="...">

                                                                <?php
echo '<input type="checkbox" ' . ($shinschecklist->shinschecklist_checked == "y" ? "checked" : "") . ' disabled>';
        ?>
                                                            </div>
                                                        </td>
                                                        <td style="text-align:center; white-space: nowrap;">
                                                            <div class="btn-group" role="group" aria-label="...">

                                                                <?php
echo '<input type="checkbox" ' . ($shinschecklist->shinschecklist_mtwchecked == "y" ? "checked" : "") . ' disabled>';
        ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                        <table id="mytable" class="table" style="width: 100% !important">

                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>
                                                        <?php echo $this->lang->line('shinschecklist_name'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('shinschecklist_desc'); ?>
                                                    </th>

                                                    <th class="no-sort">Self Inspect</th>
                                                    <th class="no-sort">MTW Inspect</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
} elseif ($countloop == $i) {
        ?>
                                            </tbody>
                                        </table>
                                        <?php
} else {
        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $shinschecklist->shinschecklist_name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $shinschecklist->shinschecklist_desc; ?>
                                                </td>

                                                <td style="text-align:center; white-space: nowrap;">
                                                    <div class="btn-group" role="group" aria-label="...">

                                                        <?php
echo '<input type="checkbox" ' . ($shinschecklist->shinschecklist_checked == "y" ? "checked" : "") . ' disabled>';
        ?>
                                                    </div>
                                                </td>
                                                <td style="text-align:center; white-space: nowrap;">
                                                    <div class="btn-group" role="group" aria-label="...">

                                                        <?php
echo '<input type="checkbox" ' . ($shinschecklist->shinschecklist_mtwchecked == "y" ? "checked" : "") . ' disabled>';
        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
}

}

?>
                                </div>
                            </div>
                        </div>

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
                <!--                <br>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form autocomplete="off" id="submitform" name="submitform" action="/permittep/adp_submit/" method="POST">
                            <div class="row">
                                <h3>Your Action</h3>
                                <h4>Check submitted documents/Information in order to allow candidate to take the examination.</h4>
                                <table class="table">
                                    <tr>
                                        <td>Action Date</td>
                                        <td><input type="text" name="approvaldate" id="approvaldate" readonly value="<?php echo date('Y-m-d H:i:s'); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><input id="adminapproval" name="adminapproval" type="radio" value="y"> <span style="color: #339900">Approve candidate to take the exam</span> <br>
                                            <input id="adminapproval" name="adminapproval" type="radio" value="n"> <span style="color: #FF0000">Documents not complete</span></td>
                                    </tr>
                                    <tr>
                                        <td>Remark</td>
                                        <td><textarea id="remark" name="remark"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Exam Bank</td>
                                        <td>
                                            <select name="exambank_id" id="exambank_id">
           <option value="">-SELECT-</option>
           <?php
if ($exambank) {
    foreach ($exambank as $bank) {

        ?>
          <option value="<?php echo $bank->exambank_id; ?>"><?php echo $bank->exambank_title; ?></option>
           <?php
}
}
?>
       </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input id="agree" name="agree" type="checkbox" value="y"> I confirm that the information given in this form is true, complete and accurate.<input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary"></td>
                                    </tr>

                                </table>

                                <input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id; ?>">

                            </div>
                        </form>
                    </div>
                </div>-->

            </div> <br>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
    <a href="/permittep/termination/<?php echo $permit_id;?>" class="btn btn-info">Termination</a>
    <a href="/permittep/replacement/<?php echo $permit_id;?>" class="btn btn-success">Replacement</a>
            <!--            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>-->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
             var table =   $("#mytable").DataTable(
             {
               responsive: true,
        scrollY:        '50vh',
        scrollCollapse: true,
        paging:         false,
        "ordering": false,
        "info":     false,
        searching: false
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
