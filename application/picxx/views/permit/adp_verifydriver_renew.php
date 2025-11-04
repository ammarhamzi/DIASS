<!-- \resources\gen_template\master\crud-newpage\views -->
<link rel="stylesheet" href="<?php echo base_url('resources/shared_js/select2/dist/css/select2.min.css'); ?>" crossorigin="anonymous" />
<script src="<?php echo base_url('resources/shared_js/select2/dist/js/select2.min.js'); ?>" crossorigin="anonymous"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Apply Permit (Step 2 of 4)
        <small>Follow the process below to apply for permit.</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            <?php echo $this->lang->line('applypermit');?> </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
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
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li><a href="javacript:return false;" class="disabled">Step 1</a></li>
                    <li class="active"><a href="javacript:return false;" data-toggle="tab">Step 2</a></li>
                    <li><a href="javacript:return false;" class="disabled">Step 3</a></li>
                    <li><a href="javacript:return false;" class="disabled">Step 4</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-question"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_2">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Application : Airside Driving Permit (ADP)</h3>
                                </div>
                            </div>
                    <form autocomplete="off" id="step_two" name="step_two" action="/Permit/stepthree" method="POST">
                    <div class="box box-primary">


                            <div class="box-body">



<!--                            <div class="row">
                                <div class="col-md-12">
                                    <b>Choose Driver :</b><br> If your driver is not listed below, please <a href="/Driver/create">create the driver</a><br>
                                </div>
                            </div>-->
                            <div class='row'>

                                <div class="col-md-6 form-group">

<table class="table">
    <tr>
        <td>Driver:</td>
        <td><?php echo $driver_name;?></td>
    </tr>
    <tr>
        <td>IC:</td>
        <td><?php echo $driver_ic;?></td>
    </tr>
    <tr>
        <td>Driver Class:</td>
        <td><?php echo $driverclass;?></td>
    </tr>
</table>



                                </div>
                                <div class="col-md-6 form-group verifiedform" style="display:none">
 <b>Trainer & Courser Provider :</b><br> Fill out course information if you have been done the compulsory briefing/course.<br>
<!--                                    <h3>Trainer & Courser Provider</h3> -->
                                    <div class="row">
                                        <div class="col-md-4">Trainer Name:</div>
                                        <div class="col-md-8">
                                            <input class=" form-control" type="text" id="trainername" name="trainername" >

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">Training Date:</div>
                                        <div class="col-md-8"><input class=" form-control datepicker" type="text" id="trainingdate" name="trainingdate"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            Certification By Trainer
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <iframe frameBorder="0" width="100%" height="250px" src="" id="iframe_course"></iframe>
                                        </div>
                                    </div>
                                    <?php
                    if($condition=='renew'){   ?>

                                        <h3>Detail of Recent ADP Permit</h3>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Permit Serial No :
                                                    <?php echo $serialno; ?>
                                                </p>
                                                <p>Expiry Date :
                                                    <?php echo $expirydate; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <?php
?>
                                    <input id="serialno" type="hidden" name="serialno" value="<?php echo $serialno;?>">
                                    <input id="expirydate" type="hidden" name="expirydate" value="<?php echo $expirydate;?>">
                                    <input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
<?php
                                        } ?>

                                </div>

                            </div>
                            <input id="driver_id" type="hidden" name="driver_id" value="">
                            <input id="driverclass" type="hidden" name="driverclass" value="">
                            <input id="permittype" type="hidden" name="permittype" value="adp">
                            <input id="verify_status" type="hidden" name="verify_status" value="">
                            <input id="adp_trainercert" type="hidden" name="adp_trainercert" value="">
                            <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">


                            </div>


                            <div class="box-footer">
                            <div class="row">
                                <div class="col-md-11" id="notification">

                                </div>
                                <div class="col-md-1 text-right">
                                    <input id="to_step_tree" name="to_step_tree" type="submit" class="btn btn-primary" value="Next" style="display:none">

                                </div>
                            </div>
                            </div>

                    </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function redirect(url) {
        $(location).attr('href', url);
    }
</script>
<script>
    function redirect(url) {
        $(location).attr('href', url);
    }

    function getuploadfiles(processtype, data) {
        //alert(data);
        if (processtype == 'adp_trainercert') {
            $("#adp_trainercert").val(data);
        }
    }
</script>