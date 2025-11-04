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
        <li><a href="<?php echo site_url('permitall'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> My Permits</a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
           Permit Detail
        </li>
    </ol>

    <!--parentchildmenu-->

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
     </h3>
    </div>
    <hr style="width: 100%; height: 1px">
</div>
<div class="row">
    <div class="col-md-3"><p>Booking ID: <b><?php echo $permit_bookingid;?></b></p></div>
    <div class="col-md-3"><p>Briefing/Exam Date: <b><?php echo datelocal($adppermit_course_date);?></b></p></div>
    <div class="col-md-3"><p>Location: <b><?php echo ($adppermit_course_location?$adppermit_course_location:"KLIA");?></b></p></div>
    <div class="col-md-3"><p>Session: <b><?php echo ($adppermit_competencytest_session?$adppermit_competencytest_session:"All Day");?></b></p></div>
</div>
<br>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#driverinfo" aria-controls="driverinfo" role="tab" data-toggle="tab">Driver Information</a></li>
<?php
/*echo $permit_status.'<----------------';*/
if($permit_officialstatus=='completed' or $permit_officialstatus=='paid' or $permit_status=='permitterminationpending' or $permit_status=='permitreplacementpending'){
?>
                    <li role="presentation"><a href="#permitinfo" aria-controls="permitinfo" role="tab" data-toggle="tab">Permit Information</a></li>


<?php
}
?>

<?php
/*echo $permit_status.'<----------------';*/
if($permit_status=='approvalairsidepending' || $permit_status=='examfailed_1' || $permit_status=='examfailed'  || $permit_status=='applicationrejected' || $permit_officialstatus=='completed' || $permit_officialstatus=='paid' || $permit_status=='permitterminationpending' || $permit_status=='permitreplacementpending'){
?>

                    <li role="presentation"><a href="#competencytest" aria-controls="competencytest" role="tab" data-toggle="tab">Competency Test</a></li>
<?php
}
?>
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
                                            <?php echo datelocal($driver_licenseexpirydate); ?>
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
                                    <tr><td>N/A</td></tr>
                                </table><br>
                                <table class="table">
                                    <tr>
                                        <th colspan="2">Trainer & Course Provider</th>
                                    </tr>
                                    <tr>
                                        <th>Trainer Name:</th>
                                        <td>
                                            <?php echo ($adppermit_certbytrainer?$adppermit_certbytrainer:"<i>NA</i>");?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Training Date:</th>
                                        <td>
                                            <?php echo (datelocal($adppermit_certbytrainer_date)?datelocal($adppermit_certbytrainer_date):"<i>NA</i>");?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Documents:</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                                                           <table class="table">

                                    <?php
if($certdoc){
                                    $count = 0;
foreach ($certdoc as $file) {
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
}else{
echo '<i>NA</i>';
}
?>
                                </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-8">

<?php
if($permit_officialstatus == 'pending' || $permit_officialstatus == 'inprogress' || $permit_officialstatus == 'pendingpayment' || $permit_officialstatus == 'paid'){

?>
<table class="table">
    <tr>
        <th colspan="2">Supporting Documents</th>
    </tr>

</table>

<p>Documentary Requirement.</p>
<ul>
    <li>Copy of IC/Passport</li>
    <li>Driving License (JPJ/International)</li>
    <li>KLIA/KLIA2 Airport Pass</li>
    <li>Supporting letter from employer</li>
    <li>Special Equipment support documents</li>
    <li>Working Permit (Foreigner)</li>
</ul>
<iframe frameBorder="0" width="100%" height="250px" src="/Uploadfilespermitid/adp_requireddoc/<?php echo $driver_id;?>/<?php echo $raw_permit_id;?>"></iframe>
<?php
}else{
?>
                                <table class="table">
                                    <tr>
                                        <th colspan="2">Supporting Documents</th>
                                    </tr>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Document Name</th>

                                    </tr>
                                    <?php
if ($permit_files) {
    $count = 0;
    foreach ($permit_files as $file) {
        $filename = explode("--", $file->uploadfiles_filename);
        ?>
                                        <tr>

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
                                </table>
<?php
}
?>



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
                                    <?php echo datelocal($permit_created_at); ?>
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
                                    <?php echo datelocal($permit_issuance_date); ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_issuance_startdate'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo datelocal($permit_issuance_startdate); ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-md-3 text-right">
                                    <?php echo $this->lang->line('permit_issuance_expirydate'); ?>
                                </th>
                                <td class="col-md-9">
                                    <?php echo datelocal($permit_issuance_expirydate); ?>
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
                    <div role="tabpanel" class="tab-pane" id="competencytest">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Competency Test : <?php echo ($adppermit_exampass == 'y' ? '<span style="color:green">PASS</span>' : '<span style="color:red">FAILED</span>');?></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Course Date: <b><?php echo date('d-m-Y', strtotime($adppermit_course_date));?></b> </p>
                                        <p>Result: <b><?php echo (isset($examresult) && $examresult ? sprintf('%d/%d', $examresult->totalmark, $examresult->question_count) : '') ?></b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Competency Test Date:<b><?php echo date('d-m-Y', strtotime($adppermit_competencytest_date));?></b> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Test Result</h3>

                                <?php
                                $attemptsession = 0;
                                $attemptGroup = 0;
                                $attempt1 = [];
                                $attempt2 = [];

                                foreach ($competency as $value){
                                    $res_marked = ($value->examresult_result == $value->examresult_answer ? 'correct' : 'wrong');

                                    if($attemptsession == 0 || $attemptsession != $value->examresult_examsession_id) {                                       
                                        $attemptGroup++;
                                        $attemptsession = $value->examresult_examsession_id;                                        
                                    }

                                    if($attemptGroup == 1) {
                                         array_push($attempt1, $res_marked);
                                    }
                                    else {
                                         array_push($attempt2, $res_marked);
                                    }
                                }

                                if(count($attempt2)) {
                                    $attempt_str = '<div class="row"><div class="col-md-12"><h4>2nd Attempt</h4></div></div>';
                                    $i = 0;
                                    if(count($attempt2) == 20) {
                                        echo '<div class="row">';
                                        echo '<div class="col-md-6">';
                                        $column = 'col-md-12';
                                    }
                                    else {
                                        $column = 'col-md-6';
                                    }
                                    echo $attempt_str;                                    
                                    echo '<div class="row">';
                                    
                                    foreach ($attempt2 as $value){
                                        ++$i;
                                        $pic = base_url('../resources/shared_img/'.$value.'.png');
                                        $answer = sprintf('Question %d:<img src="%s" width="18" height="18" alt=""><br>', $i, $pic);
                                        if($i==1){
                                            echo '<div class="'.$column.'">';
                                            echo $answer;
                                        }elseif($i==20){
                                            echo $answer;
                                            echo '</div>';
                                            if(count($attempt2) > 20) {
                                                echo '<div class="'.$column.'">';
                                            }
                                        }elseif($i==40){
                                            echo $answer;
                                            echo '</div>';
                                        }else{
                                            echo $answer;
                                        }
                                    }
                                    echo '</div>';
                                    if(count($attempt2) == 20) {
                                        echo '</div>';
                                    }
                                }

                                if(count($attempt1)) {
                                    $style = (count($attempt2) == 40 ? 'padding-top:15px;' : '');
                                    $attempt_str =  '<div class="row" style="'.$style.'"><div class="col-md-12"><h4>1st Attempt</h4></div></div>';
                                    $i = 0;
                                    if(count($attempt1) == 20) {
                                        echo '<div class="col-md-6">';
                                        $column = 'col-md-12';
                                    }
                                    else {
                                        $column = 'col-md-6';
                                    }
                                    echo $attempt_str;                                    
                                    echo '<div class="row">';
                                    
                                    foreach ($attempt1 as $value){
                                        ++$i;
                                        $pic = base_url('../resources/shared_img/'.$value.'.png');
                                        $answer = sprintf('Question %d:<img src="%s" width="18" height="18" alt=""><br>', $i, $pic);
                                        if($i==1){
                                            echo '<div class="'.$column.'">';
                                            echo $answer;
                                        }elseif($i==20){
                                            echo $answer;
                                            echo '</div>';
                                            if(count($attempt1) > 20) {
                                                echo '<div class="'.$column.'">';
                                            }
                                        }elseif($i==40){
                                            echo $answer;
                                            echo '</div>';
                                        }else{
                                            echo $answer;
                                        }
                                    }
                                    echo '</div>';
                                    if(count($attempt1) == 20) {
                                        echo '</div></div>';
                                    }
                                }                              
                                ?>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="history">
                        <table class="table" style="width: 100% !important">

                            <thead>
                                <tr>

                                    <th>
                                        Name
                                    </th>

                                    <th>
                                        Action Description
                                    </th>
                                    <th>
                                        Remark
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('permit_timeline_created_at'); ?>
                                    </th>


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
                                            <?php echo $permittimelinedom->user_name_permit_timeline_userid; ?>
                                        </td>

                                        <td>
                                            <?php echo $permittimelinedom->permit_timeline_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $permittimelinedom->permit_timeline_remark; ?>
                                        </td>
                                        <td>
                                            <?php echo datetimelocal($permittimelinedom->permit_timeline_created_at); ?>
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
<!--                <br>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form autocomplete="off" id="submitform" name="submitform" action="/permitall/adp_submit/" method="POST">
                            <div class="row">
                                <h3>Your Action</h3>
                                <h4>Check submitted documents/Information in order to allow candidate to take the examination.</h4>
                                <table class="table">
                                    <tr>
                                        <td>Action Date</td>
                                        <td><input type="text" name="approvaldate" id="approvaldate" readonly value="<?php echo date('Y-m-d H:i:s');?>"></td>
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
                                        <td colspan="2"><input id="agree" name="agree" type="checkbox" value="y"> I hereby ....<input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary"></td>
                                    </tr>

                                </table>

                                <input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id; ?>">

                            </div>
                        </form>
                    </div>
                </div>-->

            </div> <br>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
<?php
if($permit_officialstatus!='completed' and $permit_officialstatus!='paid' and $permit_officialstatus!='rejected' and $permit_officialstatus!='canceled' and $permit_officialstatus!='terminated' and $permit_officialstatus!='expired' and $permit_status!='permitterminationpending' and $permit_status!='permitreplacementpending'){
?>
    <!-- <a href="/permitall/cancellation/<?php echo $permit_id;?>" class="btn btn-warning">Cancellation</a> -->
<?php
}elseif($permit_officialstatus=='completed'){
?>
    <!-- <a href="/permitall/termination/<?php echo $permit_id;?>" class="btn btn-info">Termination</a> -->
    <!-- <a href="/permitall/replacement/<?php echo $permit_id;?>" class="btn btn-success">Replacement</a> -->
<?php
}
?>
            <!--            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>-->
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