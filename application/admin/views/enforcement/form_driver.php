<style>
    /* Custom styling for History and Add Offence tabs */
    .nav-pills.nav-justified > li > a {
        background-color: #ecf0f5 !important;
        color: #666 !important;
        border: 1px solid #ddd !important;
        transition: all 0.3s ease;
    }
    
    .nav-pills.nav-justified > li.active > a,
    .nav-pills.nav-justified > li.active > a:hover,
    .nav-pills.nav-justified > li.active > a:focus,
    .nav-pills.nav-justified > li.active > a:active {
        background-color: #3c8dbc !important;
        color: #ffffff !important;
        border-color: #3c8dbc !important;
    }
    
    .nav-pills.nav-justified > li > a:hover {
        background-color: #d2d6de !important;
        color: #444 !important;
    }
</style>

<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li><a href="<?php echo site_url('Enforcement'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('service_charges'); ?> <?php echo $this->lang->line('list'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('form'); ?> <?php echo $button; ?></li>
    </ol>

    <form id="frm_add_main_offence" action="<?=site_url('Enforcement/create_driver_action')?>" method="POST">
    <div class="box  box-primary">
        <div class="box-header with-border">
            <i class="glyphicon glyphicon-edit"></i>

            <h3 class="box-title"><?php echo $this->lang->line('service_charges'); ?> <?php echo $button; ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="row">
                <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 ">
                                <div class="small-box text-center">
                                    <img src="<?=$driver_photo?>" width="70%" class="img-thumbnail" alt="Driver Photo">
                                </div>
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3><?=$merit_point_txt?></h3>
                                        <p>Merit Points</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-android-warning"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h4>Driver Information</h4>
                                <div class="col-md-7">
                                    <strong>Name</strong>
                                    <p class="text-muted">
                                        <?=$driver_det->driver_name?>
                                    </p>

                                    <strong>IC / Passport / Working Permit / Employment Pass</strong>
                                    <p class="text-muted">
                                        <?=$driver_det->driver_ic?>
                                    </p>

                                    <strong>Driving License Country</strong>
                                    <p class="text-muted">
                                        MALAYSIA
                                    </p>

                                    <strong>ADP Class</strong>
                                    <p class="text-muted">
                                        <?= $adp_class ?>
                                    </p>
                                    
                                    <strong>Company Name</strong>
                                    <p class="text-muted">
                                        <?= $driver_det->company_name ?>
                                    </p>

                                    <!-- <strong>ADP No</strong>
                                    <p class="text-muted">
                                        Bsss
                                    </p> -->
                                </div>

                                <div class="col-md-5">
                                    <strong>Contact Number</strong>
                                    <p class="text-muted">
                                        <?=$driver_det->driver_hpno?>
                                    </p>

                                    <strong>Email</strong>
                                    <p class="text-muted">
                                        <?=$driver_det->driver_email?>
                                    </p>

                                    <strong>ADP Number</strong>
                                    <p class="text-muted">
                                        <?= $adp_number ?>
                                    </p>

                                    <strong>ADP Expiry Date</strong>
                                    <p class="text-muted">
                                       <?= $adp_expiry ?>
                                        
                                    </p>
                                </div>
                                

                            </div>
                        </div>
                        <hr>

                        <div class="">
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#tab_history" data-toggle="pill">History</a></li>
                                <li><a href="#tab_addoffence" data-toggle="pill">Add Offence</a></li>
                            
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_history">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                          
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="mytable" class="table" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th><?php echo 'Date of Offence';//$this->lang->line('user_username'); ?></th>
                                                        <th><?php echo 'Submit By';//$this->lang->line('user_username'); ?></th>
                                                        <!-- <th><?php //echo 'Permit Suspension';//$this->lang->line('user_name'); ?></th> -->
                                                        <th><?php echo 'Period of Suspension';//$this->lang->line('user_email'); ?></th>
                                                        <th><?php echo 'ADP No';//$this->lang->line('user_email'); ?></th>
                                                        <!-- <th><?php //echo 'Remark';//$this->lang->line('user_email'); ?></th> -->
                                                        <th><?php echo 'Status';//$this->lang->line('user_email'); ?></th>
                                                        <th class="no-sort">Actions List</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $start = 0;
                                                    if ($history_list) {

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

                                                                switch ($r->enforcements_main_status) {
                                                                    case 'Open':
                                                                        $status_label_color = 'label label-warning';
                                                                        break;
                                                                    case 'Close':
                                                                        $status_label_color = 'label label-success';
                                                                        break;
                                                                    case 'Cancel':
                                                                        $status_label_color = 'label label-danger';
                                                                        break;
                                                                    default:
                                                                        $status_label_color = '';
                                                                        break;
                                                                }

                                                                $btn_download_uploaded_file = '';
                                                                if(!empty($r->enforcements_main_files) && file_exists('../resources/shared_file/'.$r->enforcements_main_files))
                                                                {
                                                                    $btn_download_uploaded_file = '<a href="'.base_url('../resources/shared_file/'.$r->enforcements_main_files).'" target="_blank"><button type="button" class="btn btn-xs btn-default" data-toggle="tooltip" title="Download Uploaded Document" ><i class="fa fa-download"></i></button></a>';
                                                                }
                                                          ?>
                                                          <tr>
                                                            <td><?php echo ++$start; ?></td>
                                                            <td>
                                                                <!--<?php echo date('d-m-Y',strtotime($r->enforcements_main_created_at)); ?> /
                                                                <?php echo date('h:i: A',strtotime($r->enforcements_main_created_at)); ?>-->
                                                                <?php echo date('d-m-Y',strtotime($r->offence_date)); ?> /
                                                                <?php echo date('h:i: A',strtotime($r->offence_time)); ?>
                                                                                                                              

                                                            </td>
                                                            <td><?php echo substr($r->userlist_user_name,0,20) ?>..</td>
                                                            <!-- <td><?php //echo $permit_suspension_txt; ?></td> -->
                                                            <td><?php 
                                                                $period = empty($r->enforcements_main_period_suspension) ? '0' : trim($r->enforcements_main_period_suspension, '. ');
                                                                // Only add "Days" if the value is numeric
                                                                echo is_numeric($period) ? $period . ' Days' : $period;
                                                            ?></td>
                                                            <td><?php echo $r->enforcements_main_adpadv_no; ?></td>
                                                            <!-- <td><?php echo $r->enforcements_main_remarks; ?></td> -->
                                                            <td>
                                                                <?php 
                                                                if($r->enforcements_main_status == 'Cancel')
                                                                {
                                                                ?>
                                                                    <!-- Commented out clickable cancel button - now displayed as tag/badge -->
                                                                    <!-- <a href="javascript:void(0);" class="btn_cancel_reason" enc="<?=$id?>" ><span class="<?=$status_label_color?>"><?php echo $r->enforcements_main_status; ?></span></a> -->
                                                                    <span class="<?=$status_label_color?>"><?php echo $r->enforcements_main_status; ?></span>
                                                                    <input type="hidden" id="cancel_date_text_<?=$id?>" value="<?=date('d-m-Y h:i A',strtotime($r->enforcements_main_cancel_date))?>" >
                                                                    <input type="hidden" id="cancel_by_text_<?=$id?>" value="<?=$r->cancel_user_name?>" >
                                                                    <input type="hidden" id="cancel_reason_text_<?=$id?>" value="<?=$r->enforcements_main_cancel_reason?>" >
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                    <span class="<?=$status_label_color?>"><?php echo $r->enforcements_main_status; ?></span> 
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                            <td width="15%" style="text-align:center; white-space: nowrap;">
                                                                <!-- <div class="btn-group" role="group" aria-label="..."> -->

                                                                    <?php 
                                                                    //if(in_array($r->enforcements_main_status,array('Open','Close')))
                                                                    if(in_array($r->enforcements_main_status,array('Open')))
                                                                    {
                                                                        $groupid = $this->session->userdata('groupid');
                                                                        if($groupid == 12){
                                                                    ?>
                                                                    <?=$btn_download_uploaded_file?>
                                                                    
                                                                    <button type="button" class="btn btn-xs bg-maroon btn_close_offence" enc="<?=$id?>" style="" data-toggle="tooltip" title="Close Offence Notice"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></button>
<!--                                                                    <button type="button" class="btn btn-xs bg-maroon btn_upload" enc="<?=$id?>" style="" data-toggle="tooltip" title="Upload Document"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></button>-->
                                                                    <?php 
                                                                    }
                                                                    }
                                                                    ?>
                                                                    <?php 
                                                                    // Print button available for all users (including superadmin)
                                                                    if(in_array($r->enforcements_main_status,array('Open','Close'))){
                                                                    ?>
                                                                    <a href="<?=site_url('PdfOutput/enforcement_print/' . $id)?>" target="_blank">
                                                                    <button type="button" class="btn btn-xs btn-info" title="Print" data-toggle="tooltip"><i class="glyphicon glyphicon-print"></i></button></a>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                    <button type="button" class="btn btn-xs btn-primary btn_offence_info" enc="<?=$id?>" data-toggle="tooltip" title="View Offence Information"><i class="fa fa-info-circle"></i></button>
                                                                    <input type="hidden" id="created_by_text_<?=$id?>" value="<?=!empty($r->userlist_user_name) ? $r->userlist_user_name : '-'?>" >
                                                                    <input type="hidden" id="created_email_text_<?=$id?>" value="<?=!empty($r->userlist_user_email) ? $r->userlist_user_email : '-'?>" >
                                                                    <input type="hidden" id="created_date_text_<?=$id?>" value="<?=!empty($r->enforcements_main_created_at) ? date('d-m-Y h:i A',strtotime($r->enforcements_main_created_at)) : '-'?>" >
                                                                    <input type="hidden" id="updated_by_text_<?=$id?>" value="<?=!empty($r->updated_user_name) ? $r->updated_user_name : '-'?>" >
                                                                    <input type="hidden" id="updated_email_text_<?=$id?>" value="<?=!empty($r->updated_user_email) ? $r->updated_user_email : '-'?>" >
                                                                    <input type="hidden" id="updated_date_text_<?=$id?>" value="<?=!empty($r->enforcements_main_updated_at) ? date('d-m-Y h:i A',strtotime($r->enforcements_main_updated_at)) : '-'?>" >
                                                                    <input type="hidden" id="cancel_by_text_info_<?=$id?>" value="<?=($r->enforcements_main_status == 'Cancel' && !empty($r->cancel_user_name)) ? $r->cancel_user_name : '-'?>" >
                                                                    <input type="hidden" id="cancel_email_text_info_<?=$id?>" value="<?=($r->enforcements_main_status == 'Cancel' && !empty($r->cancel_user_email)) ? $r->cancel_user_email : '-'?>" >
                                                                    <input type="hidden" id="cancel_date_text_info_<?=$id?>" value="<?=($r->enforcements_main_status == 'Cancel' && !empty($r->enforcements_main_cancel_date)) ? date('d-m-Y h:i A',strtotime($r->enforcements_main_cancel_date)) : '-'?>" >
                                                                    <input type="hidden" id="cancel_reason_text_info_<?=$id?>" value="<?=($r->enforcements_main_status == 'Cancel' && !empty($r->enforcements_main_cancel_reason)) ? $r->enforcements_main_cancel_reason : '-'?>" >
                                                                    <input type="hidden" id="close_by_text_<?=$id?>" value="<?=($r->enforcements_main_status == 'Close' && !empty($r->updated_user_name)) ? $r->updated_user_name : '-'?>" >
                                                                    <input type="hidden" id="close_email_text_<?=$id?>" value="<?=($r->enforcements_main_status == 'Close' && !empty($r->updated_user_email)) ? $r->updated_user_email : '-'?>" >
                                                                    <input type="hidden" id="close_date_text_<?=$id?>" value="<?=($r->enforcements_main_status == 'Close' && !empty($r->enforcements_main_updated_at)) ? date('d-m-Y h:i A',strtotime($r->enforcements_main_updated_at)) : '-'?>" >
                                                                    <input type="hidden" id="close_reason_text_info_<?=$id?>" value="<?=($r->enforcements_main_status == 'Close' && !empty($r->enforcements_main_cancel_reason)) ? $r->enforcements_main_cancel_reason : '-'?>" >
                                                                    <button type="button" class="btn btn-xs btn-default btn_history_offence_list" enc="<?=$r->enforcements_main_id?>" data-toggle="tooltip" title="View Offence List"><i class="fa fa-list"></i></button>
                                                                    <?php 
                                                                    if(in_array($r->enforcements_main_status,array('Open')))
                                                                    {
                                                                    ?>
                                                                    <button type="button" class="btn btn-xs btn-danger btn_cancel_offence" enc="<?=$id?>" data-toggle="tooltip" title="Cancel Offence Notice"><i class="fa fa-chain-broken"></i></button>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if ($permission->cp_create == true) {
                                                                        //echo anchor(site_url('Enforcement/create_driver/?i=' . $r->driver_id),'<button type="button" class="btn btn-default">New Offence</button>');
                                                                    }
                                                                    ?>
                                                                <!-- </div> -->
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="tab_addoffence">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Offence Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <button type="button" id="btn_add_offence" class="btn btn-sm btn-warning ">Add Offence</button>
                                            </h4>
                                            <span class="span_table_temp_offence_details">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Offence Type</th>
                                                        <th>Date / Time</th>
                                                        <th>Notes</th>
                                                        <th>Location</th>
                                                        <th class="text-center">Period</th>
                                                        <th class="text-center">Point</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                    </tr>
                                                </table>
                                            </span>
                                            <span class="span_table_temp_offence_loading"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <span >
                                                <h4>Action Taken</h4>
                                                <div class="form-group" style="display: none;">
                                                    <label>Requires Permit Suspension?</label>
                                                    <div class="radio">
                                                        <label><input type="radio" name="ispermitsuspend" value="1" checked>Yes, Suspend the permit</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="ispermitsuspend" value="0" >No, Suspension is not required</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="control-label">Location</label>
                                                    <input type="text" class="form-control" name="addOffence_location_real"  id="addOffence_location_real" placeholder="">
                                                </div>
                                            </span>

                                            <div class="form-group">
                                                <label>Period of Suspension</label>
                                                <input type="text" class="form-control" name="period_date_suspension" id="period_date_suspension" readonly="" value="0">
                                            </div>

                                            <div class="form-group">
                                                <label>Permit No</label>
                                                <input type="text" class="form-control" name="adpadv_no" id="adpadv_no" value="<?= $adp_number ?>">
                                                <?php /* ?>
                                                <select class="form-control" name="adpadv_no" id="adpadv_no">
                                                    <option value="None">None</option>
                                                    <?php 
                                                    foreach($adp_list as $radp)
                                                    {
                                                    ?>
                                                        <option value="<?=$radp->permit_issuance_serialno?>" ><?=$radp->permit_issuance_serialno?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <?php */ ?>
                                            </div>

                                            <!-- <hr>

                                            <h4>Original Form</h4>
                                            <div class="form-group">
                                                <label>Upload</label>
                                                <input type="file" class="form-control" name="file_upload" id="file_upload">
                                            </div> -->
                                        </div>
                                        <div class="col-md-6" style="display: none;">
                                            <h4>Your Action</h4>
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <textarea class="form-control" name="admin_action" id="admin_action" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-3">
                                            <input type="hidden" name="driverss" value="<?php echo (isset($ids) ? $ids : ""); ?>" />
                                            <button type="submit" class="btn btn-primary btn-block" name="btn_submit" value="Submit">Submit</button>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="<?php echo site_url('Enforcement'); ?>" class="btn btn-default btn-block"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    <div class="modal" id="modal_history_offence_list">
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

    <form class="form-horizontal" id="frm_offence_details" action="" method="POST">
    <div class="modal" id="modal_add_offence">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Default Modal</h4>
                </div> -->
                <div class="modal-body">
                    <h5>Offence Details</h5>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Offence Type</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="addOffence_type" id="addOffence_type" style="width: 100% !important;" >
                                <option value="" title="">-SELECT-</option>
                                <?php 
                                foreach($offend_list as $parent_arr)
                                {
                                ?>
                                    <optgroup label="<?=$parent_arr['type']?>">
                                        <?php 
                                        foreach($parent_arr['child'] as $roffence_type)
                                        {
                                            // Format suspension period display (use ADP for drivers, handle both numeric days and text-based periods)
                                            $period_display = '';
                                            if (isset($roffence_type->adp_suspension_text)) {
                                                // 2025 catalogue with ADP text
                                                $period_display = $roffence_type->adp_suspension_text;
                                            } elseif (isset($roffence_type->offendlist_period)) {
                                                // Legacy catalogue with numeric days
                                                $period_display = $roffence_type->offendlist_period;
                                                if (is_numeric($period_display)) {
                                                    $period_display = $period_display . ' Days';
                                                }
                                            }
                                            
                                            // Prepare data attributes for JavaScript
                                            $description = isset($roffence_type->offendlist_natureViolation) ? $roffence_type->offendlist_natureViolation : '';
                                            $severity = isset($roffence_type->offence_severity) ? $roffence_type->offence_severity : '';
                                            $penalty = isset($roffence_type->monetary_penalty) ? $roffence_type->monetary_penalty : '';
                                            $demerit = isset($roffence_type->offendlist_offenddemeritpoint) ? $roffence_type->offendlist_offenddemeritpoint : '';
                                        ?>
                                            <option value="<?=$roffence_type->offendlist_id?>" 
                                                    data-description="<?=htmlspecialchars($description)?>"
                                                    data-suspension="<?=htmlspecialchars($period_display)?>"
                                                    data-severity="<?=htmlspecialchars($severity)?>"
                                                    data-penalty="<?=htmlspecialchars($penalty)?>"
                                                    data-demerit="<?=htmlspecialchars($demerit)?>"><?=$roffence_type->offendlist_violationNo?> - <?=$roffence_type->offendlist_regNo?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                <?php
                                }
                                ?>
                            </select>
                            <div class="help-block" style="margin-top: 10px;">
                                <div class="span_description_offence" style="padding: 10px; background-color: #f5f5f5; border-left: 3px solid #3c8dbc; display: none;">
                                    <strong>Description:</strong> <span class="offence-desc"></span><br/>
                                    <strong>ADP Suspension:</strong> <span class="offence-suspension"></span><br/>
                                    <span class="offence-severity-row" style="display:none;"><strong>Severity:</strong> <span class="offence-severity"></span><br/></span>
                                    <span class="offence-penalty-row" style="display:none;"><strong>Penalty Amount:</strong> <span class="offence-penalty"></span><br/></span>
                                    <strong>Demerit Point:</strong> <span class="offence-demerit"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control dp_field" name="addOffence_date"  id="addOffence_date" placeholder="" required autocomplete="off">
                        </div>

                        <label for="" class="col-sm-2 control-label">Time</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control timepicker_input" name="addOffence_time"  id="addOffence_time" placeholder="" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label for="" class="col-sm-3 control-label">Location</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="addOffence_location"  id="addOffence_location" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Notes</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="addOffence_notes"  id="addOffence_notes"></textarea>
                        </div>
                    </div>
                    <span class="span_modal_add_offence_loading"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Offence</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    </form>

    <form method="POST" action="" id="frm_upload_document">
    <div class="modal" id="modal_upload_document">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Upload Document</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Document : </label>
              <input type="file" class="form-control" name="uploadfile[]" id="uploadfile" required="">
              <p class="help-block">Please upload the enforcement document.</p>
            </div>

            <input type="hidden" name="modal_en_ids" id="modal_en_ids" value="">
            <input type="hidden" name="filetype" id="filetype" value="files_sc">
            <input type="hidden" name="submit" value="submit">

            <span class="p_error_msg"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn_submit_ud">Submit</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    </form>

    <form method="POST" action="" id="frm_cancel_offence">
    <div class="modal" id="modal_cancel_offence">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Upload Document</h4>
          </div> -->
          <div class="modal-body">
            <div class="alert alert-danger">
                <strong><i class="fa fa-exclamation-triangle"></i></strong>&nbsp; Are you sure to cancel this offence notice? 
            </div>

            <div class="form-group">
                <label>Cancel By</label>
                <input type="text" class="form-control" name="cancel_name" id="cancel_name" value="<?=$this->session->name?>" readonly="">
            </div>

            <div class="form-group">
                <label>Reason</label>
                <textarea class="form-control" name="cancel_reason" id="cancel_reason" required=""></textarea>
                <p class="text-muted help-block">Please add reason for this cancelation.</p>
            </div>

            <span class="cancel_span_error"></span>

            <input type="hidden" name="modal_cancelen_ids" id="modal_cancelen_ids" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn_cancel_submit">Submit</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    </form>

    <div class="modal" id="modal_cancel_reason_view">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cancel Reason</h4>
          </div>
          <div class="modal-body">
            <dl>
                <dt>Cancel By</dt>
                <dd id="dd_cancel_by"></dd>
                <br />
                <dt>Cancel Date</dt>
                <dd id="dd_cancel_date"></dd>
                <br />
                <dt>Reason</dt>
                <dd id="dd_reason"></dd>
            </dl>
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
    
<!-- add on 13/10/2021 -->
<form method="POST" action="" id="frm_close_offence">
    <div class="modal" id="modal_close_offence">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Upload Document</h4>
          </div> -->
          <div class="modal-body">
            <div class="alert alert-danger">
                <strong><i class="fa fa-exclamation-triangle"></i></strong>&nbsp; Are you sure to close this offence notice? 
            </div>

            <div class="form-group">
                <label>Closed By</label>
                <input type="text" class="form-control" name="close_name" id="close_name" value="<?=$this->session->name?>" readonly="">
            </div>

            <div class="form-group">
                <label>Reason</label>
                <textarea class="form-control" name="close_reason" id="close_reason" required=""></textarea>
                <p class="text-muted help-block">Please add reason for this closure.</p>
            </div>

            <span class="close_span_error"></span>

            <input type="hidden" name="modal_closeen_ids" id="modal_closeen_ids" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn_close_submit">Submit</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    </form>

    <!-- Modal for Offence Workflow Information -->
    <div class="modal" id="modal_offence_info_view">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Offence Workflow Information</h4>
          </div>
          <div class="modal-body" style="padding: 20px; max-height: 70vh; overflow-y: auto;">
            <style>
              .info-section {
                border-left: 4px solid #3c8dbc;
                padding: 12px 15px;
                margin-bottom: 15px;
                background-color: #f9f9f9;
                border-radius: 4px;
                clear: both;
                width: 100%;
                display: block;
              }
              .info-section.cancel {
                border-left-color: #dd4b39;
              }
              .info-section.closed {
                border-left-color: #00a65a;
              }
              .info-section.update {
                border-left-color: #f39c12;
              }
              .info-label {
                font-weight: 600;
                color: #555;
                font-size: 12px;
                text-transform: uppercase;
                margin-bottom: 3px;
                letter-spacing: 0.5px;
              }
              .info-value {
                color: #333;
                font-size: 14px;
                margin-bottom: 8px;
                word-wrap: break-word;
              }
              .info-value.email {
                color: #777;
                font-size: 12px;
                margin-top: -5px;
                margin-bottom: 8px;
              }
              .info-value.email a {
                color: #3c8dbc;
                text-decoration: none;
              }
              .info-value.email a:hover {
                text-decoration: underline;
              }
              .info-value.reason {
                background-color: #fff;
                padding: 8px 10px;
                border-radius: 3px;
                border: 1px solid #e0e0e0;
                font-style: italic;
                color: #555;
              }
              .info-empty {
                color: #999;
                font-style: italic;
              }
            </style>
            
            <div class="info-section" id="section_created">
              <div class="info-label"><i class="fa fa-plus-circle"></i> Created</div>
              <div class="info-value" id="dd_info_created_by">-</div>
              <div class="info-value email" id="dd_info_created_email">-</div>
              <div class="info-label" style="margin-top: 10px;">Date</div>
              <div class="info-value" id="dd_info_created_date">-</div>
            </div>

            <div class="info-section update" id="section_updated" style="display: none;">
              <div class="info-label"><i class="fa fa-edit"></i> Updated</div>
              <div class="info-value" id="dd_info_updated_by">-</div>
              <div class="info-value email" id="dd_info_updated_email">-</div>
              <div class="info-label" style="margin-top: 10px;">Date</div>
              <div class="info-value" id="dd_info_updated_date">-</div>
            </div>

            <div class="info-section cancel" id="section_cancelled" style="display: none;">
              <div class="info-label"><i class="fa fa-ban"></i> Cancelled</div>
              <div class="info-value" id="dd_info_cancel_by">-</div>
              <div class="info-value email" id="dd_info_cancel_email">-</div>
              <div class="info-label" style="margin-top: 10px;">Date</div>
              <div class="info-value" id="dd_info_cancel_date">-</div>
              <div class="info-label" style="margin-top: 10px;">Reason</div>
              <div class="info-value reason" id="dd_info_cancel_reason">-</div>
            </div>

            <div class="info-section closed" id="section_closed" style="display: none;">
              <div class="info-label"><i class="fa fa-check-circle"></i> Closed</div>
              <div class="info-value" id="dd_info_close_by">-</div>
              <div class="info-value email" id="dd_info_close_email">-</div>
              <div class="info-label" style="margin-top: 10px;">Date</div>
              <div class="info-value" id="dd_info_close_date">-</div>
              <div class="info-label" style="margin-top: 10px;">Reason</div>
              <div class="info-value reason" id="dd_info_close_reason">-</div>
            </div>
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

    <div class="modal" id="modal_close_reason_view">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Close Reason</h4>
          </div>
          <div class="modal-body">
            <dl>
                <dt>Close By</dt>
                <dd id="dd_close_by"></dd>
                <br />
                <dt>Close Date</dt>
                <dd id="dd_close_date"></dd>
                <br />
                <dt>Reason</dt>
                <dd id="dd_reason"></dd>
            </dl>
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
    
    
    <?php echo form_open_multipart('upload/do_upload',['class' => 'upload-image']); ?>
        <div class="input-group" style="display:none;">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">Browse &hellip;
                    <input type="file" multiple = "multiple" class = "form-control" id="uploadimage" name="uploadfile[]">
                </span>
            </span>
            <input type="text" class="form-control" readonly><input type="submit" name = "submit" value="Upload" class = "btn btn-primary"/><input id="filetype" type="hidden" name="filetype" value="files">
        </div>
    </form>
    <script>
        jQuery(document).ready(function ($)
        {
            var options = {
                beforeSend: function () {
                // Replace this with your loading gif image
                $(".div_uploaded_status").html('<p><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /></p>');
            },
            success: function(data){
                var raw_res = data;
                var res = JSON.parse(data);
                var res_html = '';

                //store list
                $('#file_arr').val(raw_res);

                //display list
                $.each(res, function( index, value ) {
                    // alert( index + ": " + value.client_name );
                    var $noCount = index;
                    res_html += `- `+value.file_name+`<br />`;
                });
                $(".div_uploaded_status").html('');
                $(".div_uploaded_status").html(res_html);
                // console.log(res);  
            },
            complete: function (response) {
                // Output AJAX response to the div container
                // arr = response.responseText.split('*');
                // if (arr[1] == "success") {

                //     $("#distributor_profilephoto").val(arr[0]);

                //     $(".upload-image-messages").html('<p><img src = "<?php echo base_url(); ?>resources/shared_img/' + arr[0] + '" width="100" height="100" /></p>');
                // } else {
                //     $(".upload-image-messages").html('<p>' + arr[0] + '</p>');
                // }
            }
        };
        // Submit the form
        $(".upload-image").ajaxForm(options);
        return false;
        });
    </script>
<?php
if (isset($id)) {
    ?>
    <script>
        $(document).ready(function ()
        {
            var arr =['user_username'];

            $.each(arr, function (i, val)
            {
                $("#" + val).prop("disabled", true);
                $("#" + val).after("<input type='hidden' name='" + val + "' id='" + val + "' value='" + $("#" + val).val() + "'>");
            }
            );
        }
        );
    </script>
    <?php
}
?>

<script>
    // Handle tab color switching for History and Add Offence tabs
    $(document).ready(function() {
        // Tab click handler
        $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            // Remove active styling from all tabs
            $('.nav-pills li').removeClass('active');
            $('.nav-pills li a').css({
                'background-color': '#ecf0f5',
                'color': '#666'
            });
            
            // Add active styling to clicked tab
            $(e.target).parent('li').addClass('active');
            $(e.target).css({
                'background-color': '#3c8dbc',
                'color': '#ffffff'
            });
        });
        
        // Set initial active tab styling on page load
        $('.nav-pills li.active a').css({
            'background-color': '#3c8dbc',
            'color': '#ffffff'
        });
        $('.nav-pills li:not(.active) a').css({
            'background-color': '#ecf0f5',
            'color': '#666'
        });
    });
</script>

<script>
    function view_temp_table()
    {
        $('.span_table_temp_offence_details').html('');
        $('.span_table_temp_offence_loading').html('<p><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /></p>');
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url("Enforcement/view_temporary_offence_detail") ?>",
            data    : {p: 1, flow_type: 'driver'},
            cache   : false,
            success : function(data)
            {
                // console.log(data);
                $('.span_table_temp_offence_details').html(data);
            },
            complete : function()
            {
                $('.span_table_temp_offence_loading').html('');
            }
        }); 

        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url("Enforcement/get_highest_period") ?>",
            data    : {p: 1, flow_type: 'driver'},
            cache   : false,
            dataType: 'json',
            success : function(data)
            {
                // console.log(data);
                $('#period_date_suspension').val(data.period_text || data.res);
            },
            complete : function()
            {
                
            }
        });
    }
    $(document).ready(function ()
    {
        /*===========================
        =            mal js            =
        ===========================*/

        $('#mytable').on('click','.btn_cancel_reason',function(){
            var enc = $(this).attr('enc'),
                cancel_date_text = $('#cancel_date_text_'+enc).val(),
                cancel_by_text = $('#cancel_by_text_'+enc).val(),
                cancel_reason_text = $('#cancel_reason_text_'+enc).val();
          $('#dd_cancel_by').html(cancel_by_text);
          $('#dd_cancel_date').html(cancel_date_text);
          $('#dd_reason').html(cancel_reason_text);
          $('#modal_cancel_reason_view').modal('show');
        });

        $('#mytable').on('click','.btn_offence_info',function(){
            var enc = $(this).attr('enc'),
                created_by_text = $('#created_by_text_'+enc).val(),
                created_email_text = $('#created_email_text_'+enc).val(),
                created_date_text = $('#created_date_text_'+enc).val(),
                updated_by_text = $('#updated_by_text_'+enc).val(),
                updated_email_text = $('#updated_email_text_'+enc).val(),
                updated_date_text = $('#updated_date_text_'+enc).val(),
                cancel_by_text = $('#cancel_by_text_info_'+enc).val(),
                cancel_email_text = $('#cancel_email_text_info_'+enc).val(),
                cancel_date_text = $('#cancel_date_text_info_'+enc).val(),
                cancel_reason_text = $('#cancel_reason_text_info_'+enc).val(),
                close_by_text = $('#close_by_text_'+enc).val(),
                close_email_text = $('#close_email_text_'+enc).val(),
                close_date_text = $('#close_date_text_'+enc).val(),
                close_reason_text = $('#close_reason_text_info_'+enc).val();
            
            // Created section - always show
            $('#dd_info_created_by').html(created_by_text !== '-' ? created_by_text : '<span class="info-empty">No data</span>');
            $('#dd_info_created_email').html(created_email_text !== '-' ? '<a href="mailto:'+created_email_text+'">'+created_email_text+'</a>' : '<span class="info-empty">No email</span>');
            $('#dd_info_created_date').html(created_date_text !== '-' ? created_date_text : '<span class="info-empty">No date</span>');
            
            // Updated section - only show if there's actual update data different from created
            if((updated_by_text !== '-' || updated_date_text !== '-') && updated_date_text !== created_date_text){
                $('#section_updated').show();
                $('#dd_info_updated_by').html(updated_by_text !== '-' ? updated_by_text : '<span class="info-empty">No data</span>');
                $('#dd_info_updated_email').html(updated_email_text !== '-' ? '<a href="mailto:'+updated_email_text+'">'+updated_email_text+'</a>' : '<span class="info-empty">No email</span>');
                $('#dd_info_updated_date').html(updated_date_text !== '-' ? updated_date_text : '<span class="info-empty">No date</span>');
            } else {
                $('#section_updated').hide();
            }
            
            // Cancelled section - only show if cancelled
            if(cancel_by_text !== '-' || cancel_date_text !== '-'){
                $('#section_cancelled').show();
                $('#dd_info_cancel_by').html(cancel_by_text !== '-' ? cancel_by_text : '<span class="info-empty">Not cancelled</span>');
                $('#dd_info_cancel_email').html(cancel_email_text !== '-' ? '<a href="mailto:'+cancel_email_text+'">'+cancel_email_text+'</a>' : '<span class="info-empty">No email</span>');
                $('#dd_info_cancel_date').html(cancel_date_text !== '-' ? cancel_date_text : '<span class="info-empty">No date</span>');
                $('#dd_info_cancel_reason').html(cancel_reason_text !== '-' ? cancel_reason_text : '<span class="info-empty">No reason provided</span>');
            } else {
                $('#section_cancelled').hide();
            }
            
            // Closed section - only show if closed
            if(close_by_text !== '-' || close_date_text !== '-'){
                $('#section_closed').show();
                $('#dd_info_close_by').html(close_by_text !== '-' ? close_by_text : '<span class="info-empty">Not closed</span>');
                $('#dd_info_close_email').html(close_email_text !== '-' ? '<a href="mailto:'+close_email_text+'">'+close_email_text+'</a>' : '<span class="info-empty">No email</span>');
                $('#dd_info_close_date').html(close_date_text !== '-' ? close_date_text : '<span class="info-empty">No date</span>');
                $('#dd_info_close_reason').html(close_reason_text !== '-' ? close_reason_text : '<span class="info-empty">No reason provided</span>');
            } else {
                $('#section_closed').hide();
            }
            
            $('#modal_offence_info_view').modal('show');
        });

        $('#mytable').on('click','.btn_cancel_offence',function(){
            var enc = $(this).attr('enc');
            //alert(enc)
          $('#modal_cancelen_ids').val(enc);
          $('#modal_cancel_offence').modal('show');
        });

        $('#modal_cancel_offence').on('hide.bs.modal',function(){
          $('#modal_cancelen_ids').val('');
          $('#cancel_span_error').html('');
        });

        $('#frm_cancel_offence').on('submit',function(e){
            e.preventDefault();
            var enc = $('#modal_cancelen_ids').val();
            $('.cancel_span_error').html('<p class="well well-sm"><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /> Loading..</p>');
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url("Enforcement/cancel_offence_notice/") ?>"+enc,
                data    : $('#frm_cancel_offence').serialize(),
                cache   : false,
                dataType: 'json',
                success : function(data)
                {
                    console.log(data);
                    $('.cancel_span_error').html('<div class="alert alert-success"><h4><i class="icon fa fa-check"></i> Cancel notice Success!</h4>Reloading, please wait..</div><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" />');
                    //setInterval(function(){
                        location.href="<?=site_url('Enforcement/create_driver/?i='.$ids)?>";
                    //}, 1000);
                },
                complete : function()
                {
                    // $('#modal_cancel_offence').modal('hide');
                }
            }); 
        });
        
        
        $('#mytable').on('click','.btn_close_reason',function(){
            var enc = $(this).attr('enc'),
                close_date_text = $('#close_date_text_'+enc).val(),
                close_by_text = $('#close_by_text_'+enc).val(),
                close_reason_text = $('#close_reason_text_'+enc).val();
          $('#dd_close_by').html(close_by_text);
          $('#dd_close_date').html(close_date_text);
          $('#dd_reason').html(close_reason_text);
          $('#modal_close_reason_view').modal('show');
        });

        $('#mytable').on('click','.btn_close_offence',function(){
            var enc = $(this).attr('enc');
            //alert(enc)
          $('#modal_closeen_ids').val(enc);
          $('#modal_close_offence').modal('show');
        });

        $('#modal_close_offence').on('hide.bs.modal',function(){
          $('#modal_closeen_ids').val('');
          $('#close_span_error').html('');
        });

        $('#frm_close_offence').on('submit',function(e){
            e.preventDefault();
            var enc = $('#modal_closeen_ids').val();
            $('.close_span_error').html('<p class="well well-sm"><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /> Loading..</p>');
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url("Enforcement/close_offence_notice/") ?>"+enc,
                data    : $('#frm_close_offence').serialize(),
                cache   : false,
                dataType: 'json',
                success : function(data)
                {
                    console.log(data);
                    $('.close_span_error').html('<div class="alert alert-success"><h4><i class="icon fa fa-check"></i> Closure notice Success!</h4>Reloading, please wait..</div><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" />');
//                    setInterval(function(){
                        location.href="<?=site_url('Enforcement/create_driver/?i='.$ids)?>";
//                    }, 1000);
                },
                complete : function()
                {
                     $('#modal_cancel_offence').modal('hide');
                }
            }); 
        });
        

        $('#modal_upload_document').on('hide.bs.modal',function(){
          $('#modal_en_ids').val('');
        });

        $('#mytable').on('click','.btn_upload',function(){
          var enc = $(this).attr('enc');
          $('#modal_en_ids').val(enc);
          $('#modal_upload_document').modal('show');
          //$('#modal_close_offence').modal('show');
        });

        $("#frm_upload_document").submit(function(evt){  
            evt.preventDefault();
            var enc = $('#modal_en_ids').val();
            $('.btn_submit_ud').prop('disabled',true);
            $(".p_error_msg").html('<p class="well well-sm"><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /> Uploading..</p>');
            var formData = new FormData($(this)[0]);
            $.ajax({
               url: '<?=site_url('Upload/do_upload')?>',
               type: 'POST',
               data: formData,
               cache: false,
               contentType: false,
               enctype: 'multipart/form-data',
               processData: false,
               dataType: 'json',
               success: function (response) {
                 // console.log('res',response[0].file_name);
                 $(".p_error_msg").html('<p class="well well-sm"><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /> Finishing..</p>');
                 var urlString = "<?php echo site_url("Enforcement/change_status/") ?>"+enc;
                 $.ajax({
                     type    : "POST",
                     url     : urlString,
                     data    : {file_name: response[0].file_name},
                     cache   : false,
                     dataType: 'json',
                     success : function(data)
                     {
                         console.log(data);
                         if(data.res == 1)
                         {
                            $(".p_error_msg").html('<div class="alert alert-success"><h4><i class="icon fa fa-check"></i> Upload File Success!</h4>Reloading, please wait..</div><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" />');
                            setInterval(function(){
                                location.href="<?=site_url('Enforcement/create_driver/?i='.$ids)?>";
                            }, 1000);
                         }
                     },
                     complete : function()
                     {
                         
                     }
                 });  
               }
            });
            return false;
        });

        $('.timepicker_input').timepicker({
            minuteStep: 5,
            defaultTime: false
        });

        $('#modal_history_offence_list').on('hide.bs.modal',function(){
            $('.tbl_offence_dt').dataTable().fnDestroy();
            $('#span_offence_list').html('');
        });

        $('#mytable').on('click','.btn_history_offence_list',function(){
            var enc = $(this).attr('enc');

            $('#modal_history_offence_list').modal('show');
            $('#span_offence_list').html('<p><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /></p>');

            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url("Enforcement/get_offence_list_table_html") ?>",
                data    : "enc="+enc,
                cache   : false,
                //dataType: 'json',
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


        view_temp_table();
        $('.span_table_temp_offence_details').on('click','.remove_offence_details',function(){
            var enc = $(this).attr('enc'),
                here = $(this);

            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url("Enforcement/remove_temporary_offence_detail") ?>",
                data    : "enc="+enc,
                cache   : false,
                dataType: 'json',
                success : function(data)
                {
                    console.log(data);
                    here.parent().parent().remove();
                },
                complete : function()
                {
                    $('#frm_offence_details').trigger("reset");
                    $('#modal_add_offence').modal('hide');

                    $.ajax({
                        type    : "POST",
                        url     : "<?php echo site_url("Enforcement/get_highest_period") ?>",
                        data    : {p: 1, flow_type: 'driver'},
                        cache   : false,
                        dataType: 'json',
                        success : function(data)
                        {
                            // console.log(data);
                            $('#period_date_suspension').val(data.period_text || data.res);
                        },
                        complete : function()
                        {
                            
                        }
                    });
                }
            }); 
        });

        $('#frm_offence_details').on('submit',function(e){
            e.preventDefault();

            var $addOffence_type = $('#addOffence_type').val(),
                $addOffence_date = $('#addOffence_date').val(),
                $addOffence_time = $('#addOffence_time').val(),
                $addOffence_location = $('#addOffence_location').val(),
                $addOffence_notes = $('#addOffence_notes').val();

            if($addOffence_type == '')
            {
                alert('Please select offence type!');
                return false;
            }

            if($addOffence_date == '')
            {
                alert('Please select date!');
                return false;
            }

            if($addOffence_time == '')
            {
                alert('Please select time!');
                return false;
            }

            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url("Enforcement/add_temporary_offence_detail") ?>",
                data    : $('#frm_offence_details').serialize(),
                cache   : false,
                dataType: 'json',
                success : function(data)
                {
                    console.log(data);
                    view_temp_table();
                },
                beforeSend: function() {
                    $('.span_modal_add_offence_loading').html('<p><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /></p>');
                },
                complete : function()
                {
                    $('#frm_offence_details').trigger("reset");
                    $('#modal_add_offence').modal('hide');
                    $('.span_modal_add_offence_loading').html('');
                }
            }); 
        });

        $('#addOffence_type').on('change',function(){
            var selectedOption = $(this).find('option:selected');
            
            if (selectedOption.val()) {
                // Get data from attributes
                var description = selectedOption.data('description') || '';
                var suspension = selectedOption.data('suspension') || '';
                var severity = selectedOption.data('severity') || '';
                var penalty = selectedOption.data('penalty') || '';
                var demerit = selectedOption.data('demerit') || '';
                
                // Populate the display fields
                $('.offence-desc').text(description);
                $('.offence-suspension').text(suspension);
                $('.offence-demerit').text(demerit);
                
                // Show/hide severity row based on data
                if (severity) {
                    $('.offence-severity').text(severity);
                    $('.offence-severity-row').show();
                } else {
                    $('.offence-severity-row').hide();
                }
                
                // Show/hide penalty row based on data
                if (penalty) {
                    $('.offence-penalty').text(penalty);
                    $('.offence-penalty-row').show();
                } else {
                    $('.offence-penalty-row').hide();
                }
                
                // Show the info box
                $('.span_description_offence').show();
            } else {
                // Hide if no selection
                $('.span_description_offence').hide();
            }
        });
        
        $('#btn_add_offence').on('click',function(){
            // Clear time field when modal opens to prevent autofill
            $('#addOffence_time').val('');
            $('#modal_add_offence').modal('show');
        });

        $( ".dp_field" ).datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $('#ct_ids').on('change',function(){
            var ids = $(this).val();
            if(ids == "")
            {
                $('#span_ct_description').html('');
                return false;
            }
            var dataString = 'ct='+ids;
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url("ServiceCharges/get_charge_type_info") ?>",
                data    : dataString,
                cache   : false,
                dataType: 'json',
                success : function(data)
                {
                    console.log(data);
                    $('#span_ct_description').html(data.description);
                },
                complete : function()
                {
                    
                }
            });  
        });

        var tables = $("#mytable").DataTable({
            responsive: true,
            columnDefs:[
                { targets: 'no-sort', orderable: false }
            ]
            
        });

        $('#frm_add_main_offence').on('submit',function(){

            if($('.span_table_temp_offence_details').find('input[class="hidden_exist"]').length > 0) 
            {
                return true;
            }
            else
            {
                if(confirm('Are you sure to continue submit without offence detail?'))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        });


        // $('a[data-toggle="pill"]').on("shown.bs.tab", function (e) {
        //     var id = $(e.target).attr("href");
        //     localStorage.setItem('selectedTab', id)
        // });

        // var selectedTab = localStorage.getItem('selectedTab');
        // if (selectedTab != null) {
        //     $('a[data-toggle="pill"][href="' + selectedTab + '"]').tab('show');
        // }
        
        /*=====  End of mal js  ======*/
        

        $(".btn-remote-file").click(function ()
        {
            $('input[type=file]').trigger('click');
        }
        );

        $(document).on('change', '.btn-file :file', function ()
        {
            var input = $(this),
            numFiles = input.get(0).files? input.get(0).files.length: 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect',[numFiles, label]);
        }
        );

        $(document).ready(function ()
        {
            $('.btn-file :file').on('fileselect', function (event, numFiles, label)
            {

                var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1? numFiles + ' files selected': label;

                if (input.length) {
                  input.val(log);
                  $(".display_user_photo").val(log);
                  $(this).parents('.input-group').find(":submit").click();
              } else {
              //if( log ) alert(log);
          }

      }
      );
        }
        );

    }
    );
</script>
<script>
    function clear_form_elements(id) {
      jQuery("#testingDiv" + id).find(':input').each(function ()
      {
          switch (this.type) {
            case 'password':
            case 'text':
            case 'textarea':
            case 'file':
            case 'select-one':
            case 'select-multiple':
            jQuery(this).val('');
            break;
            case 'checkbox':
            case 'radio':
            this.checked = false;
        }
    }
    );
  }
  $(function ()
  {
    $(".clonedInput:first").before('<div id="add-buttons"><input class="btn btn-success" type="button" id="btnAdd" value="<?php echo $this->lang->line('add_more_child'); ?>"></div><hr style="width: 100%">');
    if ($('.clonedInput').length > 1) {
      $('.clonedInput').each(function ()
      {
          var pos = $(this).attr('id');
          pos = pos.replace('testingDiv', '');
          $(this).append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="<?php echo $this->lang->line('x'); ?>" position="' + pos + '"/>');
          $(this).append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="<?php echo $this->lang->line('clear'); ?>" position="' + pos + '"/><hr style="width: 100%">');
      }
      );

  } else {
      $(".clonedInput:first").append('<input type="button" id="btnDel" name="button" class="action-button btn btn-danger" value="<?php echo $this->lang->line('x'); ?>" position="1" disabled="disabled"/>');
      $(".clonedInput:first").append('<input type="button" id="btnClear" name="button" class="action-button btn btn-default" value="<?php echo $this->lang->line('clear'); ?>" position="1"/><hr style="width: 100%">');
  }

    //$('#btnAdd').click(function () {
        $('body').on('click', '#btnAdd', function ()
        {
        var num = $('.clonedInput').length, // how many "duplicatable" input fields we currently have
        newNum = new Number(num + 1), // the numeric ID of the new input field being added
        randomID = Math.floor((Math.random() * 1000) + 1),
        cleanelem = $(".clonedInput:last").find('select.select2').select2("destroy"),
        newElem = $(".clonedInput:last").clone(true, true).attr('id', 'testingDiv' + randomID).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
        newElem.find('.action-button').attr('position', randomID).prop("disabled", false);
        newElem.find('.datepicker').removeClass('hasDatepicker').attr('id', '').datepicker();
        newElem.find('.datetimepicker').removeClass('hasDatepicker').attr('id', '').datetimepicker();
        // insert the new element after the last "duplicatable" input field

        $(".clonedInput:last").after(newElem);

        $("select.select2").select2();
        clear_form_elements(randomID);

        // manipulate the name/id values of the input inside the new element
        // enable the "remove" button
        $('#btnDel').attr('disabled', false);

        // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
        if (newNum == 5)
          $('#btnAdd').attr('disabled', true).prop('value', "<?php echo $this->lang->line('reach_limit'); ?>");
  }
  );

        $('body').on('click', '#btnDel', function ()
        {
        //$('#btnDel').click(function () {
            var position = $(this).attr("position");
            var num = $('.clonedInput').length;
            $('#testingDiv' + position).slideUp('slow', function ()
            {
                $(this).remove();
            // if only one element remains, disable the "remove" button
            if (num - 1 === 1) {
              $('#btnDel:last').attr('disabled', true);
          }
            // enable the "add" button
            $('#btnAdd').attr('disabled', false).prop('value', "<?php echo $this->lang->line('add_to_form'); ?>");

        }
        );
        }
        );

        $('body').on('click', '#btnClear', function ()
        {
            var position = $(this).attr("position");
            clear_form_elements(position);
        }
        );

    }
    );
</script>

