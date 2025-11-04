 <!-- \resources\gen_template\master\crud-newpage\views -->
       <!-- Add fancyBox -->
        <link rel="stylesheet" href="/resources/shared_js/fancybox/2.1.5/source/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="/resources/shared_js/fancybox/2.1.5/source/jquery.fancybox.pack.js"></script>
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
<?php
if($this->router->fetch_class()=="permitpendingdocscheckvehicle"){
  ?>
<li><a href="<?php echo site_url('permitpendingdocscheckvehicle/index'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Verify Documents</a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            Permit Detail
        </li>
  <?php
}elseif($this->router->fetch_class()=="permitpendinginspection"){
?>
<li><a href="<?php echo site_url('permitpendinginspection/list/avp/'.$avppermit_inspection_date); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Inspection List</a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            Inspection Detail
        </li>
    <?php
}elseif($this->router->fetch_class()=="permitpendingdocscheck"){
?>
<li><a href="<?php echo site_url('permitpendingdocscheck/index'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Verify Documents</a></li>
<li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
        Permit Detail
</li>
<?php
}elseif($this->router->fetch_class()=="permitpendingapproval"){
?>
<li><a href="<?php echo site_url('permitpendingapproval/index'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Pending Approval Permits</a></li>
<li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
        Permit Detail
</li>
<?php
}elseif($this->router->fetch_class()=="permitpendingpayment"){
?>
<li><a href="<?php echo site_url('permitpendingpayment/index'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Payment Pending Permits</a></li>
<li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
        Permit Detail
</li>
<?php
}elseif($this->router->fetch_class()=="permitcollect"){
?>
<li><a href="<?php echo site_url('permitcollect/index'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Uncollected Permits</a></li>
<li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
        Permit Detail
</li>
<?php
}elseif($this->router->fetch_class()=="permitpendingtermination"){
?>
<li><a href="<?php echo site_url('permitpendingtermination/index'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Pending terminated Permits</a></li>
<li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
        Permit Detail
</li>
<?php
}elseif($this->router->fetch_class()=="permitpendingreplacement"){
?>
<li><a href="<?php echo site_url('permitpendingreplacement/index'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Pending Replacement Permits</a></li>
<li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
        Permit Detail
</li>
<?php
}elseif($this->router->fetch_class()=="permitcanceled"){
?>
<li><a href="<?php echo site_url('permitcanceled/index'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Canceled Permits</a></li>
<li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
        Permit Detail
</li>
<?php
}elseif($this->router->fetch_class()==""){
?>

<?php
}
?>

    </ol>

    <!--parentchildmenu-->
    <?php
      if(!empty($this->session->userdata('message'))){
?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                <?php echo $this->session->userdata('message');?>
                            </div>
<?php
      }
    ?>

    <?php
      if(!empty($this->session->userdata('message_notcompleted'))){
?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-close"></i> Unsubmitted!</h4>
                                <?php echo $this->session->userdata('message_notcompleted');?>
                            </div>
<?php
      }
    ?>
                            <div class="box box-primary">
                                                        <div class="box-header with-border">
                            <h3 class="box-title">Permit Detail</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
<!--                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                            </div>
                        </div>

                                <div class="box-body">
            <div>
<div class="row">
    <div class="col-md-6">

        <h3>
        <?php
        echo $permit_type_desc." (<span style='color:#800000'>".ucfirst($permit_condition)."</span>)";
        ?>
        </h3>

    </div>

<?php
            if ($permit_officialstatus == 'completed') {
                $officialstatus = '<span class="label label-success">' . $permit_officialstatus . '</span>';
            } elseif ($permit_officialstatus == 'inprogress') {
                $officialstatus = '<span class="label label-primary">' . $permit_officialstatus . '</span>';
            } elseif ($permit_officialstatus == 'pending') {
                $officialstatus = '<span class="label label-warning">' . $permit_officialstatus . '</span>';
            } elseif ($permit_officialstatus == 'failed') {
                $officialstatus = '<span class="label label-danger">' . $permit_officialstatus . '</span>';
            } elseif ($permit_officialstatus == 'pendingpayment') {
                $officialstatus = '<span class="label label-warning">' . $permit_officialstatus . '</span>';
            } elseif ($permit_officialstatus == 'rejected') {
                $officialstatus = '<span class="label label-danger">' . $permit_officialstatus . '</span>';
            } elseif ($permit_officialstatus == 'suspended') {
                $officialstatus = '<span class="label label-danger">' . $permit_officialstatus . '</span>';
            } elseif ($permit_officialstatus == 'canceled') {
                $officialstatus = '<span class="label label-danger">' . $permit_officialstatus . '</span>';
            } elseif ($permit_officialstatus == 'terminated') {
                $officialstatus = '<span class="label label-danger">' . $permit_officialstatus . '</span>';
            } elseif ($permit_officialstatus == 'expired') {
                $officialstatus = '<span class="label label-danger">' . $permit_officialstatus . '</span>';
            } elseif ($permit_officialstatus == 'paid') {
                $officialstatus = '<span class="label label-primary">' . $permit_officialstatus . '</span>';
            }
?>
    <div class="col-md-6">
     <h3 class=" pull-right">
         Status: <?php echo $officialstatus;?>
<?php
//if(empty($permit_issuance_serialno)){
if ($permit_officialstatus != 'completed' && $permit_officialstatus != 'rejected' && $permit_officialstatus != 'canceled' && $permit_officialstatus != 'suspended' && $permit_officialstatus != 'terminated' && $permit_officialstatus != 'failed') {
?>
     <a class="fancybox fancybox.iframe btn btn-default" href="/admin/permitall/changetoreject/<?php echo $permit_id;?>" title="quick rejection"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="font-size: 12pt"></span></a>
<?php
}
?>
</h3>
    </div>
    <hr style="width: 100%; height: 1px">
</div>

<div class="row">
    <div class="col-md-3"><?php
if(empty($permit_issuance_serialno)){
?>
<p>Booking ID: <b><?php echo $permit_bookingid;?></b></p>
<?php
}else{
?>
<p>Serial No: <b><?php echo $permit_issuance_serialno;?></b></p>
<?php
}
?></div>

<?php
if(empty($avppermit_result)){
?>
    <div class="col-md-3">

    <p>Inspection Date: </p><input id="change_opdate" name="change_opdate" type="text" class="datepicker_local" value="<?php echo datelocal($avppermit_inspection_date);?>">
    <input id="current_opdate" type="hidden" name="current_opdate" value="<?php echo $avppermit_inspection_date;?>">
		<input id="change_opdate_button" name="change_opdate_button" type="button" value="Change"></div>
<?php
}else{
?>
        <div class="col-md-3"><p>Inspection Date: <b><?php echo datelocal($avppermit_inspection_date);?></b></p></div>
<?php
}
?>

    <div class="col-md-3"><p>Location: <b><?php echo ($avppermit_inspection_location?$avppermit_inspection_location:"KLIA");?></b></p></div>
<!--    <div class="col-md-3"><p>Session: <b><?php echo ($adppermit_competencytest_session?$adppermit_competencytest_session:"All Day");?></b></p></div>-->
</div>
<br>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#vehicleinfo" aria-controls="vehicleinfo" role="tab" data-toggle="tab">Vehicle Information</a></li>
<?php
/*echo $permit_status.'<----------------';*/
if(!empty($permit_issuance_serialno)){
?>
                    <li role="presentation"><a href="#permitinfo" aria-controls="permitinfo" role="tab" data-toggle="tab">Permit Information</a></li>


                    <?php
}
;?>
<?php
if($permit_status!='inspectionpending' or $this->router->fetch_class() != 'permitpendinginspection'){
?>
                    <li role="presentation"><a href="#inspectionresult" aria-controls="inspectionresult" role="tab" data-toggle="tab">Inspection</a></li>
<?php
}
?>

                    <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab">Application Timeline</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="vehicleinfo">

                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-condensed table-responsive">

                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_year_manufacture'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_year_manufacture; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_chasis_no'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_chasis_no; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_enginetype_id'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_enginetype_id; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_engine_no'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_engine_no; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_engine_capacity'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_engine_capacity; ?>
                                        </td>
                                    </tr>

<!--
                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_activity_statusid'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_activity_statusid; ?>
                                        </td>
                                    </tr>
-->

                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_application_date'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo datelocal($vehicle_application_date); ?>
                                        </td>
                                    </tr>



                                </table>

                            </div>
                            <div class="col-md-4">
                                <table class="table table-condensed table-responsive">
<!--                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('vehicle_company_id'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $vehicle_company_id; ?>
                                        </td>
                                    </tr>-->

                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_registration_no'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_registration_no; ?> <span style="display: none;">(<a href="/admin/Enforcement/create_vehicle/?i=<?php echo $vehicle_id;?>" target="_blank">detail</a>)</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-6">
                                            Operation Area
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_type; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-6">
                                         AVP Category
                                        </th>
                                        <td class="col-md-6">
<select id="change_avpcat" name="change_avpcat">
    <option value="green" <?php echo ($avppermit_avpcategory=="green"?"selected":"")?>>GREEN</option>
    <option value="red" <?php echo ($avppermit_avpcategory=="red"?"selected":"")?>>RED</option>
    <option value="yellow" <?php echo ($avppermit_avpcategory=="yellow"?"selected":"")?>>YELLOW</option>
</select>

    <input id="current_avpcat" type="hidden" name="current_avpcat" value="<?php echo $avppermit_avpcategory;?>">
		<input id="change_avpcat_button" name="change_avpcat_button" type="button" value="Change">

                                        </td>
                                    </tr>

<!--
                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_insurance_policy_no'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_insurance_policy_no; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_insurance_expiry_date'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo datelocal($vehicle_insurance_expiry_date); ?>
                                        </td>
                                    </tr>
-->

<!--
                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_vehicleequipmenttype_id'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_vehicleequipmenttype_id; ?>
                                        </td>
                                    </tr>
-->

                                    <tr>
                                        <th class="col-md-6">
                                            Equipment/Vehicle
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_vehiclegroup_name;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-6">
                                            <?php echo $this->lang->line('vehicle_blacklistedremark'); ?>
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $vehicle_blacklistedremark; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <!--<h3>Insurance</h3>-->
                                <table class="table table-condensed table-responsive">
                                    <tr>
                                        <th class="col-md-6">
                                            Insurance Policy Number
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo $avppermit_policyno;?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-6">
                                            Policy Expiry Date
                                        </th>
                                        <td class="col-md-6">
                                            <?php echo datelocal($avppermit_policyexpirydate); ?>
                                        </td>
                                    </tr>

                                </table>
<!--                                <table>
                                    <tr>
                                        <th colspan="2">Insurance supported docs</th>
                                    </tr>
                                    <?php
if ($insurance_files) {
    $count = 0;
    foreach ($insurance_files as $file) {
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
                                </table>-->
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-md-4">
                                <table>
                                    <tr>
                                        <th colspan="2">Offence(s)</th>
                                    </tr>
                                </table>
                            </div> -->
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
<div class="col-md-5">
<?php
if($permit_condition == 'renew'){


?>
<h3>Others</h3>
                                <table class="table">

                                    <tr>
                                        <th>Previous Permit Serial No:</th>
                                        <td>
                                            <?php echo ($permit_recent_permitid?$permit_recent_permitid:"<i>NA</i>");?>
                                        </td>
                                    </tr>
                                </table>
<?php
}
?>
</div>
                            <div class="col-md-7">
                                <table class="table">
                                    <tr>
                                        <th colspan="2">Supporting Documents</th>
                                    </tr>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Document Name</th>
                                        <!--<td>Type</td>-->
                                    </tr>

                                    <?php
if($permit_files){
									$count = 0;
foreach ($permit_files as $file) {
    $filename = explode("--", $file->uploadfiles_filename);
    ?>
                                        <tr>
<!--                                            <td>
                                                <?php echo ++$count; ?>
                                            </td>-->
                                            <td>
                                                <a href="<?php echo $this->config->item('client_url'); ?>/uploads/files/<?php echo $file->uploadfiles_filename; ?>" target="_blank">
                                                    <?php echo $filename[1]; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $file->uploadfiles_docname; ?>
                                            </td>
                                        </tr>
                                        <?php
}
}
?>
                                    <?php
if ($insurance_files) {

    foreach ($insurance_files as $file) {
        $filename = explode("--", $file->uploadfiles_filename);
        ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo $this->config->item('client_url'); ?>/uploads/files/<?php echo $file->uploadfiles_filename; ?>" target="_blank">
                                                    <?php echo $filename[1]; ?>
                                                </a>
                                            </td>
                                            <td>
                                                    Insurance Copy
                                            </td>
                                        </tr>
                                        <?php
}
}
?>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_history" aria-controls="tab_history" role="tab" data-toggle="tab">Enforcement History</a></li>
                                    <li role="presentation" ><a href="#tab_permits" aria-controls="tab_permits" role="tab" data-toggle="tab">Permits</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tab_history">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="" class="table mytable_en" style="width: 100% !important">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><?php echo 'Date Submit'; //$this->lang->line('user_username');   ?></th>
                                                            <th><?php echo 'Submit By'; //$this->lang->line('user_username');   ?></th>
                                                            <!-- <th><?php //echo 'Period of Suspension'; //$this->lang->line('user_email');   ?></th> -->
                                                            <th><?php echo 'Permit No'; //$this->lang->line('user_email');   ?></th>
                                                            <th><?php echo 'Remark'; //$this->lang->line('user_email');   ?></th>
                                                            <th><?php echo 'Company'; //$this->lang->line('user_email');   ?></th>
                                                            <th class="no-sort">Offence List</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $start = 0;
                                                    if (isset($history_list) && count($history_list) > 0) {

                                                        foreach ($history_list as $r) {
                                                            switch ($r->enforcements_main_ispermitsuspend) {
                                                                case '0':
                                                                    $permit_suspension_txt = 'No, Suspension not required.';
                                                                    break;
                                                                case '1':
                                                                    $permit_suspension_txt = 'Yes, Suspend Permit.';
                                                                    break;
                                                                default:
                                                                    $permit_suspension_txt = '';
                                                                    break;
                                                            }
                                                            $id = fixzy_encoder($r->enforcements_main_id);
                                                            $btn_download_uploaded_file = '';
                                                            if(!empty($r->enforcements_main_files) && file_exists('../resources/shared_file/'.$r->enforcements_main_files))
                                                            {
                                                                $btn_download_uploaded_file = '<a href="'.base_url('../resources/shared_file/'.$r->enforcements_main_files).'" target="_blank"><button type="button" class="btn btn-xs btn-default" data-toggle="tooltip" title="Download Uploaded Document" ><i class="fa fa-download"></i></button></a>';
                                                            }
                                                            ?>
                                                              <tr>
                                                                <td><?php echo ++$start; ?></td>
                                                                <td>
                                                                    <?php echo date('d-m-Y', strtotime($r->enforcements_main_created_at)); ?> /
                                                                    <?php echo date('h:i: A', strtotime($r->enforcements_main_created_at)); ?>
                                                                </td>
                                                                <td><?php echo $r->userlist_user_name; ?></td>
                                                                <!-- <td><?php //echo $r->enforcements_main_period_suspension; ?></td> -->
                                                                <td><?php echo $r->enforcements_main_adpadv_no; ?></td>
                                                                <td><?php echo $r->enforcements_main_remarks; ?></td>
                                                                <td><?php echo $r->company_name; ?></td>
                                                                <td style="text-align:center; white-space: nowrap;">
                                                                    <div class="btn-group" role="group" aria-label="...">
                                                                        <a href="<?=site_url('PdfOutput/enforcement_print/' . $id);?>" target="_blank">
                                                                        <button type="button" class="btn btn-xs btn-info" data-toggle="tooltip" title="Print"><i class="glyphicon glyphicon-print"></i></button></a>
                                                                        &nbsp;
                                                                        <button type="button" class="btn btn-xs btn-default btn_history_offence_list" data-toggle="tooltip" enc="<?=$r->enforcements_main_id;?>" title="View Offence List"><i class="fa fa-list"></i></button>
                                                                        &nbsp;
                                                                        <?=$btn_download_uploaded_file?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><?php echo 'Date Submit'; //$this->lang->line('user_username');   ?></th>
                                                            <th><?php echo 'Submit By'; //$this->lang->line('user_username');   ?></th>
                                                            <!-- <th><?php //echo 'Period of Suspension'; //$this->lang->line('user_email');   ?></th> -->
                                                            <th><?php echo 'Permit No'; //$this->lang->line('user_email');   ?></th>
                                                            <th><?php echo 'Remark'; //$this->lang->line('user_email');   ?></th>
                                                            <th><?php echo 'Company'; //$this->lang->line('user_email');   ?></th>
                                                            <th class="no-sort">Offence List</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="modal_history_offence_list">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h5>Offence List</h5>
                                                        <hr />

                                                        <span id="span_offence_list"></span>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->

                                        <script type="text/javascript">
                                        $(function(){
                                            $('#modal_history_offence_list').on('hide.bs.modal',function(){
                                                $('.tbl_offence_dt').dataTable().fnDestroy();
                                                $('#span_offence_list').html('');
                                            });

                                            $('.mytable_en').on('click','.btn_history_offence_list',function(){
                                                var enc = $(this).attr('enc');

                                                $('#modal_history_offence_list').modal('show');
                                                $('#span_offence_list').html('<p><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /></p>');

                                                $.ajax({
                                                    type    : "POST",
                                                    url     : "<?php echo site_url("Enforcement/get_offence_list_table_html"); ?>",
                                                    data    : "enc="+enc,
                                                    cache   : false,
                                                    // dataType: 'json',
                                                    success : function(data)
                                                    {
                                                        console.log(data);
                                                        $('#span_offence_list').html(data);
                                                        var tt = $('.tbl_offence_dt').DataTable();
                                                    },
                                                    complete : function()
                                                    {

                                                    }
                                                });
                                            });

                                            $(".mytable_en").DataTable({
                                                responsive: true,
                                                columnDefs:[
                                                    { targets: 'no-sort', orderable: false }
                                                ]
                                            });
                                        });
                                        </script>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="tab_permits">
                                        <div class="row">
                                            
                                            <!-- /.box-header -->
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table id="" class="table mytable_en" style="width: 100% !important">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th><?php echo 'Permit Number'; //$this->lang->line('user_username');   ?></th>
                                                                    <th><?php echo 'Application Date'; //$this->lang->line('user_email');   ?></th>
                                                                    <th><?php echo 'Expiry Date'; //$this->lang->line('user_username');   ?></th>
                                                                    <th><?php echo 'Status'; //$this->lang->line('user_email');   ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php 
                                                            $noCount = 1;
                                                            if(isset($permits_list) && count($permits_list) > 0)
                                                            foreach($permits_list as $pl)
                                                            {
                                                            ?>
                                                                <tr>
                                                                    <td><?=$noCount++?></td>
                                                                    <td><?=$pl->permit_issuance_serialno?></td>
                                                                    <td><?=!empty($pl->permit_issuance_date) ? datelocal($pl->permit_issuance_date) : 'None' ?></td>
                                                                    <td><?=!empty($pl->permit_issuance_expirydate) ? datelocal($pl->permit_issuance_expirydate) : 'None' ?></td>
                                                                    <td><?=ucfirst($pl->permit_officialstatus)?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th><?php echo 'Permit Number'; //$this->lang->line('user_username');   ?></th>
                                                                    <th><?php echo 'Application Date'; //$this->lang->line('user_email');   ?></th>
                                                                    <th><?php echo 'Expiry Date'; //$this->lang->line('user_username');   ?></th>
                                                                    <th><?php echo 'Status'; //$this->lang->line('user_email');   ?></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--                        <table class="table table-condensed table-responsive">



                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_dob'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_dob; ?>
                                </td>
                            </tr>



                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_designation'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_designation; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_department'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_department; ?>
                                </td>
                            </tr>



                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_address'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_address; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_officeno'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_officeno; ?>
                                </td>
                            </tr>



                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_jpjdrivinglicenseno'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_jpjdrivinglicenseno; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_jpjdrivingclass'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_jpjdrivingclass; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_jpjlicenseexpirydate'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_jpjlicenseexpirydate; ?>
                                </td>
                            </tr>



                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_blacklistedremark'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_blacklistedremark; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_permit_typeid'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_permit_typeid; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3">
                                    <?php echo $this->lang->line('driver_activity_statusid'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo $driver_activity_statusid; ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3">
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
                            <div class="col-md-6">
                                <table class="table table-condensed table-responsive">

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_groupid'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_groupid; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_typeid'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_typeid; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_condition'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_condition; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_bookingid'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_bookingid; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_picid'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_picid; ?>
                                        </td>
                                    </tr>

 <!--                                   <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_companyid'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_companyid; ?>
                                        </td>
                                    </tr>-->



                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_officialstatus'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_officialstatus; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_remark'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_remark; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_created_at'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo datelocal($permit_created_at); ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <!--
<div class="col-md-4">
                                <table class="table table-condensed table-responsive">

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_invoiceno'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_payment_invoiceno; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_trainingfee'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_payment_trainingfee; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_new'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_payment_new; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_renew_oneyear'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_payment_renew_oneyear; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_renew_prorated'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_payment_renew_prorated; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_sst'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_payment_sst; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_total'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo 'RM '.$permit_payment_total; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_invoiceno'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_payment_invoiceno; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_total'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo 'RM '.$permit_payment_total; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_processedby'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_payment_processedby; ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
-->
                            <div class="col-md-6">
                                <table class="table table-condensed table-responsive">

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_issuance_serialno'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_issuance_serialno; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_issuance_date'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo datelocal($permit_issuance_date); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_issuance_startdate'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo datelocal($permit_issuance_startdate); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_issuance_expirydate'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo datelocal($permit_issuance_expirydate); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_issuance_processedby'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_issuance_processedby; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_invoiceno'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_payment_invoiceno; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_total'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo 'RM '.$permit_payment_total; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3">
                                            <?php echo $this->lang->line('permit_payment_processedby'); ?>
                                        </th>
                                        <td class="col-md-9">
                                            <?php echo $permit_payment_processedby; ?>
                                        </td>
                                    </tr>


                                </table>
                            </div>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="inspectionresult">
                        <div class="row">
                            <div class="col-md-4">
                                <h3>Inspection Info</h3>
                                <h4>Authorized Technician/Inspectorate :</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Date: <b><?php echo datelocal($avppermit_inspection_date); ?></b> </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Inspector: <b><?php echo $avppermit_result_inspector_id; ?></b> </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Remarks: <b><?php echo $permit_inspection_remark; ?></b> </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Reference Files:  </p>
                                <table>

                                    <?php
if ($inspector_files) {
    $count = 0;
    foreach ($inspector_files as $file) {
        $filename = explode("--", $file->uploadfiles_filename);
        ?>
                                        <tr>
<!--                                            <td>
                                                <?php echo ++$count; ?>
                                            </td>-->
                                            <td>
                                                <a href="<?php echo $this->config->item('client_url'); ?>/uploads/files/<?php echo $file->uploadfiles_filename; ?>" target="_blank">
                                                    <?php echo $filename[1]; ?>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
}
}else{
?>
<tr>
   <td colspan="2"> - </td>
</tr>
<?php
}
?>
                                </table>
                                    </div>
                                </div>
<hr style="width: 100%; height: 1px; background-color: #EEEEEE; border: none">
<h4>Mechanical Engineer :</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Date: <b><?php echo datelocal($avppermit_managerverified_date); ?></b> </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Name: <b><?php echo $engineer_name; ?></b> </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Remarks: <b><?php echo $permit_inspectionmanager_remark; ?></b> </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8">
                                <h3>Inspection Result
                                    <?php
                                     if($avppermit_result == 'passed'){
                                     echo '<span style="color:green">PASS</span>';
                                     }elseif($avppermit_result == 'failed'){
    echo '<span style="color:red">FAILED</span>';
                                     }elseif($avppermit_result == 'managerfailed'){
    echo '<span style="color:red">Mechanical Engineer Unverified</span>';
                                     }elseif($avppermit_result == 'kiv'){
    echo '<span style="color:#C2C200">On Hold</span>';
                                     }elseif($avppermit_result == ''){
    echo '<span style="color:#C2C200">Pending</span>';
                                     }

?></h3>
<div class="row">
<div class="col-md-12">
<!--<h3>MTW Inspection:</h3>-->
<h4>General Requirement <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup></h4>
<div class="row">
<div class="col-md-6">
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">
                     <th>Item</th>
<th>Declared</th>
<th>Inspection Result</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($mtwchecklist_data){
                       $count = 0;
                     foreach ($mtwchecklist_data as $mtwchecklist)
                     {


                     if($mtwchecklist->mtwchecklist_group == 'g'){
                      ++$count;
                      if($count <= 18){
                         ?>
                  <tr>

                     <td><?php echo $mtwchecklist->mtwchecklist_name ?></td>


                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">

                                    <?php
                                        echo '<input type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_selfchecked_selected)?"checked":""). ' disabled>';
                                    ?>
                                    </div>
                                </td>
                                <td style="text-align:left; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        //echo '<input type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_selected)?"checked":""). ' disabled>';
                                    ?>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>"  value="y" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_y_selected)?"checked":"");?> disabled
                                            /> <span style="color: #00CC00">PASS</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_n_selected)?"checked":"");?> disabled
                                            /> <span style="color: #CC0000">FAIL</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n/a" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_na_selected)?"checked":"");?> disabled
                                            /> <span style="color: black">N/A</span>
                                    </div>
                                </td>
                  </tr>
                  <?php
                       }
                     } }
                     }
                     ?>
               </tbody>
            </table>
</div>
<div class="col-md-6">
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">
                     <th>Item</th>
<th>Declared</th>
<th>Inspection Result</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($mtwchecklist_data){
                       $count = 0;
                     foreach ($mtwchecklist_data as $mtwchecklist)
                     {


                     if($mtwchecklist->mtwchecklist_group == 'g'){
                      ++$count;
                      if($count > 18){
                         ?>
                  <tr>

                     <td><?php echo $mtwchecklist->mtwchecklist_name ?></td>


                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">

                                    <?php
                                        echo '<input type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_selfchecked_selected)?"checked":""). ' disabled>';
                                    ?>
                                    </div>
                                </td>
                                <td style="text-align:left; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        //echo '<input type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_selected)?"checked":""). ' disabled>';
                                    ?>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>"  value="y" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_y_selected)?"checked":"");?> disabled
                                            /> <span style="color: #00CC00">PASS</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_n_selected)?"checked":"");?> disabled
                                            /> <span style="color: #CC0000">FAIL</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n/a" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_na_selected)?"checked":"");?> disabled
                                            /> <span style="color: black">N/A</span>
                                    </div>
                                </td>
                  </tr>
                  <?php
                       }
                     } }
                     }
                     ?>
               </tbody>
            </table>
</div>
</div>

<div class="row">
    <div class="col-md-12">
                                <table class="table table-bordered" style="width: 100% !important">
                                    <tr style=" background-color: #C9D4E1">
                                       <th>&nbsp;</th>
                                       <th>Declared</th>
                                       <th>MTW inspected</th>
                                    </tr>
                                    <tr>
                                   <td>Smoke Condition (Diesel): </td>
                                   <td>
                                   <?php echo $avppermit_smokecondition;?>
                                    </td>
                                    <td><?php echo $avppermit_smokecondition_mtw;?></td>
                                    </tr>
                                    <tr>
                                   <th colspan="3" style=" background-color: #C9D4E1">Fire Extinguisher </th>
                                    </tr>
                                    <tr>
                                   <td>Serial No: </td>
                                   <td><?php echo $avppermit_fireext_serialno;?> </td>
                                   <td><?php echo $avppermit_fireext_serialno_mtw;?></td>
                                    </tr>
                                    <tr>
                                   <td>Expiry Date: </td>
                                   <td><?php echo datelocal($avppermit_fireext_expirydate);?> </td>
                                   <td><?php echo datelocal($avppermit_fireext_expirydate_mtw);?></td>
                                    </tr>

                                    <tr>
                                   <th colspan="3" style=" background-color: #C9D4E1">All Tyres </th>
                                    </tr>
                                    <tr>
                                   <td>Manufacturing Date: </td>
                                   <td><?php echo nl2br($avppermit_tyre_manufacturingdate);?> </td>
                                   <td><?php echo nl2br($avppermit_tyre_manufacturingdate_mtw);?></td>
                                    </tr>
                                </table>
    </div>
</div>

<div class="row">
<div class="col-md-6">
<h4>Additional Requirement</h4>
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">
                     <th>Item</th>
<th>Declared</th>
<th>Inspection Result</th>

                     <!--<th class="no-sort">&nbsp;</th>-->
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($mtwchecklist_data){

                     foreach ($mtwchecklist_data as $mtwchecklist)
                     {


                     if($mtwchecklist->mtwchecklist_group == 'a'){

                         ?>
                  <tr>

                     <td><?php echo $mtwchecklist->mtwchecklist_name ?></td>


                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">

                                    <?php
                                        echo '<input type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_selfchecked_selected)?"checked":""). ' disabled>';
                                    ?>
                                    </div>
                                </td>
                                <td style="text-align:left; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        //echo '<input type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_selected)?"checked":""). ' disabled>';
                                    ?>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>"  value="y" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_y_selected)?"checked":"");?> disabled
                                            /> <span style="color: #00CC00">PASS</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_n_selected)?"checked":"");?> disabled
                                            /> <span style="color: #CC0000">FAIL</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n/a" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_na_selected)?"checked":"");?> disabled
                                            /> <span style="color: black">N/A</span>
                                    </div>
                                </td>
                  </tr>
                  <?php

                     }
                      }
                     }
                     ?>
               </tbody>
            </table>
</div>
<div class="col-md-6">
<h4>Special Requirement</h4>
            <table class="table table-bordered" style="width: 100% !important">

               <thead>
                  <tr style=" background-color: #C9D4E1">
                     <th>Item</th>
<th>Declared</th>
<th>Inspection Result</th>

                     <!--<th class="no-sort">&nbsp;</th>-->
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($mtwchecklist_data){

                     foreach ($mtwchecklist_data as $mtwchecklist)
                     {


                     if($mtwchecklist->mtwchecklist_group == 's'){

                         ?>
                  <tr>

                     <td><?php echo $mtwchecklist->mtwchecklist_name ?></td>


                                <td style="text-align:center; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">

                                    <?php
                                        echo '<input type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_selfchecked_selected)?"checked":""). ' disabled>';
                                    ?>
                                    </div>
                                </td>
                                <td style="text-align:left; white-space: nowrap;">
                                    <div class="btn-group" role="group" aria-label="...">


                                    <?php
                                        //echo '<input type="checkbox" value="' .$mtwchecklist->mtwchecklist_id. '" ' .(in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_selected)?"checked":""). ' disabled>';
                                    ?>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>"  value="y" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_y_selected)?"checked":"");?> disabled
                                            /> <span style="color: #00CC00">PASS</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_n_selected)?"checked":"");?> disabled
                                            /> <span style="color: #CC0000">FAIL</span>
                                            <br>
                                            <input type="radio" name="mtwinspect_<?php echo $mtwchecklist->mtwchecklist_id;?>" value="n/a" <?php echo (in_array($mtwchecklist->mtwchecklist_id, $avp_mtwchecked_na_selected)?"checked":"");?> disabled
                                            /> <span style="color: black">N/A</span>
                                    </div>
                                </td>
                  </tr>
                  <?php

                     }
                      }
                     }
                     ?>
               </tbody>
            </table>
</div>
</div>



    </div>
    </div>
                            </div>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="history">
                        <table class="table" style="width: 100% !important">

                            <thead>
                                <tr>
                                    <!--<th>#</th>-->
                                    <!--                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_permitid'); ?>
                                    </th>-->
                                    <th>
                                        User
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_name'); ?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_desc'); ?>
                                    </th>
                                    <th>
                                        Detail Status
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Remark
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
<!--                                        <td>
                                            <?php echo ++$start; ?>
                                        </td>-->
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
                                            <?php echo (!empty($permittimelinedom->permit_timeline_remark)?$permittimelinedom->permit_timeline_remark:"-"); ?>
                                        </td>
                                        <td>
                                            <?php echo datetimelocal($permittimelinedom->permit_timeline_created_at); ?>
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
                        <form id="submitform" name="submitform" action="/admin/permitall/adp_submit/" method="POST">
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
<!--<?php
if($permit_officialstatus!='completed' and $permit_officialstatus!='PAID'){
?>
    <a href="/permitall/cancellation/<?php echo $permit_id;?>" class="btn btn-warning">Cancellation</a>
<?php
}elseif($permit_officialstatus=='completed'){
?>
    <a href="/permitall/termination/<?php echo $permit_id;?>" class="btn btn-info">Termination</a>
    <a href="/permitall/replacement/<?php echo $permit_id;?>" class="btn btn-success">Replacement</a>
<?php
}
?>-->
            <!--            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>-->
        </div>
    </div>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">PIC Detail</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">

                                <table class="table table-condensed table-responsive">
                                    <tr>
                                        <th>
                                            Name
                                        </th>
                                        <td>
                                            <a href="/admin/pic/read/<?php echo fixzy_encoder($pic_id);?>" title="PIC Detail"><?php echo $pic_fullname;?></a>
                                        </td>
                                        <th>
                                         Mobile Phone
                                        </th>
                                        <td>
                                         <?php echo $pic_handphone;?>
                                        </td>
                                        <th>
                                            Office Phone
                                        </th>
                                        <td>
                                            <?php echo $pic_phoneoffice;?>
                                        </td>
                                        <th>
                                         Email
                                        </th>
                                        <td>
                                         <?php echo $pic_email;?>
                                        </td>
                                    </tr>
                                        <?php
                                        if(!empty($permit_apply_remark)){
                                        ?>
                                    <tr>
                                     <th>Remark For Admin</th>

                                        <td colspan='7'>
                                         <?php echo $permit_apply_remark;?>
                                        </td>

                                    </tr>
                                        <?php
                                        }
                                        ?>
                                </table>
                        </div>
                        </div>
                        <div class="box-footer">

                        </div>
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
<script>
$(document).ready(function() {
// change op date
$("#change_opdate_button").click(function () {
 $.ajax({
 	type: "POST",
      //dataType: 'json',//jika result sbg string
 	data: {
 		change_opdate : $("#change_opdate").val(),
        current_opdate : $("#current_opdate").val(),
        permit_id : '<?php echo $permit_id;?>',
 	},
 	url: "<?php echo base_url() ?>permitall/change_opdate/avp",
 	success: function(data) {
      alert(data);
 	},
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + ': ' + errorThrown);
    }
    		});

});

// change avpcat
$("#change_avpcat_button").click(function () {
 $.ajax({
 	type: "POST",
      //dataType: 'json',//jika result sbg string
 	data: {
 		change_avpcat : $("#change_avpcat option:selected").val(),
        current_avpcat : $("#current_avpcat").val(),
        permit_id : '<?php echo $permit_id;?>',
        permit_officialstatus : '<?php echo $permit_officialstatus; ?>',
        permit_status : '<?php echo $permit_status; ?>',
 	},
 	url: "<?php echo base_url() ?>permitall/change_avpcat",
 	success: function(data) {
      alert(data);
 	},
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + ': ' + errorThrown);
    }
    		});

});
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox();
    });
</script>
