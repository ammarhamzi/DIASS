<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Apply Permit (Step 1 of 4)
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
                    <li class="active"><a href="javacript:return false;" data-toggle="tab">Step 1</a></li>
                    <li><a href="javacript:return false;" class="disabled">Step 2</a></li>
                    <li><a href="javacript:return false;" class="disabled">Step 3</a></li>
                    <li><a href="javacript:return false;" class="disabled">Step 4</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-question"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                        <form autocomplete="off" id="step_one" name="step_one" action="/Permit/steptwo" method="post" onsubmit="return validateForm()">

<div class="row">
    <div class="col-md-6">
                                                        <div class="form-group">
                                                                <label>Select Permit</label>
<!--                                                                <select class="form-control select2" style="width: 100%;" id="permittype" name="permittype">
                                        <option selected="selected" value="adp">Airside Driving Permit (ADP)</option>
                                        <option value="evdp">Electrical Vehicle Driving Permit (EVDP)</option>
                                        <option value="avp">Airside Vehicle Permit (AVP)</option>
                                        <option value="evp">Electrical Vehicle Permit (EVP)</option>
                                        <option value="pbb">Fixed Facilities - Passenger Boarding Bridge (PBB)</option>
                                        <option value="vdgs">Fixed Facilities - Visual Docking Guidance System (VDGS)</option>
                                        <option value="pca" disabled>Fixed Facilities - Preconditioned Air Unit (PCA)</option>
                                        <option value="gpu" disabled>Fixed Facilities - Ground Power Unit (GPU)</option>
                                        <option value="wip">Temporary Entry Permit (TEP) - Work In Progress (Runway, Taxiway, Apron)</option>
                                        <option value="wipbriefing">Temporary Entry Permit (TEP) - Work In Progress (Others Areas)</option>
                                        <option value="cs">Temporary Entry Permit (TEP) - Commercial Supplier</option>
                                        <option value="sh">Temporary Entry Permit (TEP) - Stakeholder (Inspection not required)</option>
                                        <option value="shins">Temporary Entry Permit (TEP) - Stakeholder (Inspection required)</option>
                                    </select>-->
                                                                <select class="form-control select2" style="width: 100%;" id="permittype" name="permittype">
                                        <option selected="selected" value="adp">Airside Driving Permit (ADP)</option>
                                        <option value="evdp">Electrical Vehicle Driving Permit (EVDP)</option>
                                        <option value="avp">Airside Vehicle Permit (AVP)</option>
                                        <option value="evp">Electrical Vehicle Permit (EVP)</option>
                                        <option value="pbb">Fixed Facilities - Passenger Boarding Bridge (PBB)</option>
                                        <option value="vdgs">Fixed Facilities - Visual Docking Guidance System (VDGS)</option>
<!--                                        <option value="pca">Fixed Facilities - Preconditioned Air Unit (PCA)</option>
                                        <option value="gpu">Fixed Facilities - Ground Power Unit (GPU)</option>-->
<!--                                        <option value="wip">Temporary Entry Permit (TEP) - Work In Progress (Runway & Taxiway)</option>
                                        <option value="wipbriefing">Temporary Entry Permit (TEP) - Work In Progress (Other Areas)</option>
                                        <option value="cs">Temporary Entry Permit (TEP) - Commercial Supplier & Others</option>
                                        <option value="sh">Temporary Entry Permit (TEP) - Stakeholder</option>-->

                                    </select>

                                                        </div>
    </div>

<div class="col-md-6">
                                                        <div class="form-group" id="not_tep">
                                                                <label>Application Type</label>
<!--                                                                <select class="form-control" style="width: 100%;" id="condition" name="condition">
                                        <option value="new">New</option>
                                        <option value="renew">Renewal</option>

                                    </select>-->

<div class="radio">
    <label style="margin-right: 35px;"><input type="radio" name="condition" id="new" value="new"  style="height:15px; width:15px;">New</label>
    <label style="margin-right: 35px;"><input type="radio" name="condition" id="renew" value="renew" style="height:15px; width:15px;    margin-right: 35px;" checked>Renewal</label>
                                    <span id="previous_permit">Previous Permit Serial No <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('recent_permitid') ?><span class="text-danger" id="recent_permitid_error"></span>: <input id="recent_permitid" type="text" name="recent_permitid" value="" placeholder="eg:ADP000123"></span>
</div>
<!--<div class="radio">
    <label><input type="radio" name="condition" id="condition" value="renew" style="height:15px; width:15px;">Renewal</label>
</div>-->
                                                        </div>
</div>
</div>



                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button id="to_step_two" name="to_step_two" type="submit" class="btn btn-primary" value="Next">Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>

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
function validateForm(){

var permittype = $("#permittype").val();
var needConditionList = ["adp", "evdp", "avp", "evp", "pbb", "vdgs", "pca", "gpu"];


if( needConditionList.indexOf(permittype) > -1 ) {
    //console.log("success");

            var status = 0;
            var radioValue = $("input[name='condition']:checked").val();

            if(radioValue=='renew'){

            if($("#recent_permitid").val() == "") {
                $("#recent_permitid_error").html('<span class="alert_custom">Required</span>') ;
                status = 1;
            }


            if(status == 1){
            $('html, body').animate({ scrollTop: 0 }, 'slow');
            return false;
            }

            }
}




}
</script>
<script>
$(document).ready(function() {

$("input[name='condition']").click(function () {

var radioValue = $("input[name='condition']:checked").val();

if(radioValue=='renew'){
$("#previous_permit").show();
}else{
$("#previous_permit").hide();
}
});

$("#permittype").change(function () {

var permittype = $("#permittype").val();
var needConditionList = ["adp", "evdp", "avp", "evp", "pbb", "vdgs", "pca", "gpu"];


if( needConditionList.indexOf(permittype) > -1 ) {
  //console.log("success");
  $("#not_tep").show();
$("#renew").prop("checked", true);
}else{
$("#new").prop("checked", true);
$("#not_tep").hide();
}

});

});
</script>