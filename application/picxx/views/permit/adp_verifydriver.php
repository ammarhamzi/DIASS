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
                                <h4><i class="icon fa fa-check"> Success!</i></h4>
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
                    <form autocomplete="off" id="step_two" name="step_two" action="/Permit/stepthree" method="POST"  onsubmit="return validateForm()">
                    <div class="box box-primary">


                            <div class="box-body">



<!--                            <div class="row">
                                <div class="col-md-12">
                                    <b>Choose Driver :</b><br> If your driver is not listed below, please <a href="/Driver/create">create the driver</a><br>
                                </div>
                            </div>-->
                            <div class='row'>

                                <div class="col-md-6 form-group">
 <b>Choose Driver :</b><br> If your driver is not listed below, please <a href="/Driver/create">create the driver</a><br>
                                    <select class="select2 form-control" id="driver_id" name="driver_id">
       <option value="">-SELECT DRIVER-</option>

   </select><br><br>

                                    <button class="btn btn-primary pull-right" id='verify' onclick="javascript:return false" style="display:none;">Verify</button>


<div class="row verifiedform" style="display:none">

 <div class="col-md-12">
     <b>ADP Category:<span class="text-danger" id="driverclass_error"></span></b><br>
<!--     <select id="driverclass" name="driverclass">
    <option value="">-SELECT CLASS-</option>
    <option value="A"> A </option>
    <option value="B1"> B1 </option>
    <option value="B2"> B2 </option>
    <option value="C"> C </option>
</select>-->
<table>
    <tr><td><p><input id="driverclass_a" name="driverclass" type="radio" value="A"> A </p></td><td><p style="    margin-left: 25px;">[<a class="fancybox" href="<?php echo base_url('../resources/shared_img/tutorial/adp-category-a.jpg');?>">view guide</a>]</p></td></tr>
    <tr><td><p><input id="driverclass_b1" name="driverclass" type="radio" value="B1"> B1  </p></td><td><p style="    margin-left: 25px;">[<a class="fancybox" href="<?php echo base_url('../resources/shared_img/tutorial/adp-category-B1.jpg');?>">view guide</a>]</p></td></tr>
    <tr><td><p><input id="driverclass_b2" name="driverclass" type="radio" value="B2"> B2  </p></td><td><p style="    margin-left: 25px;">[<a class="fancybox" href="<?php echo base_url('../resources/shared_img/tutorial/adp-category-B2.jpg');?>">view guide</a>]</p></td></tr>
    <tr><td><p><input id="driverclass_c" name="driverclass" type="radio" value="C"> C  </p></td><td><p style="    margin-left: 25px;">[<a class="fancybox" href="<?php echo base_url('../resources/shared_img/tutorial/adp-category-C.jpg');?>">view guide</a>]</p></td></tr>
</table>




 </div>
 <div class="col-md-12 cat_c_hide" style="display:none">
     <input id="healthdeclare" name="healthdeclare" type="checkbox" value="healthdeclare" checked onclick="this.checked=!this.checked;"> I hereby that the driver health is excellent.
 </div>
</div>
<br><br>
<div class="row verifiedform" style="display:none">

 <div class="col-md-12">
     <b>Vehicle Class:<span class="text-danger" id="vehicleclass_error"></span></b><br>
<!--     <select id="vehicleclass" name="vehicleclass">
    <option value="">-SELECT CLASS-</option>
    <option value="1"> 1 </option>
    <option value="2"> 2 </option>
    <option value="3"> 3 </option>
    <option value="4"> 4 </option>
    <option value="5"> 5 </option>
</select>-->
<!--<table class='table'>
    <tr>
        <td><input id="vehicleclass" name="vehicleclass[]" type="checkbox" value="1"> 1</td>
        <td><input id="vehicleclass" name="vehicleclass[]" type="checkbox" value="2"> 2</td>
        <td><input id="vehicleclass" name="vehicleclass[]" type="checkbox" value="3"> 3</td>
        <td><input id="vehicleclass" name="vehicleclass[]" type="checkbox" value="4"> 4</td>
        <td><input id="vehicleclass" name="vehicleclass[]" type="checkbox" value="5"> 5</td>
    </tr>
</table>-->








<table>
    <tr><td><p><input id="vehicleclass" name="vehicleclass[]" type="checkbox" value="1"> Class 1 (Light Vehicles)</p></td><td><p style="    margin-left: 25px;">[<a class="fancybox" href="<?php echo base_url('../resources/shared_img/tutorial/5-vehicle-class.jpg');?>">view guide</a>]</p></td></tr>
    <tr><td><p><input id="vehicleclass" name="vehicleclass[]" type="checkbox" value="2"> Class 2 (RAMP Equipment)</p></td><td><p style="    margin-left: 25px;">[<a class="fancybox" href="<?php echo base_url('../resources/shared_img/tutorial/5-vehicle-class.jpg');?>">view guide</a>]</p></td></tr>
    <tr><td><p><input id="vehicleclass" name="vehicleclass[]" type="checkbox" value="3"> Class 3 (ACFT Towing)</p></td><td><p style="    margin-left: 25px;">[<a class="fancybox" href="<?php echo base_url('../resources/shared_img/tutorial/5-vehicle-class.jpg');?>">view guide</a>]</p></td></tr>
    <tr><td><p><input id="vehicleclass" name="vehicleclass[]" type="checkbox" value="4"> Class 4 (Trucks-Heavy)</p></td><td><p style="    margin-left: 25px;">[<a class="fancybox" href="<?php echo base_url('../resources/shared_img/tutorial/5-vehicle-class.jpg');?>">view guide</a>]</p></td></tr>
    <tr><td><p><input id="vehicleclass" name="vehicleclass[]" type="checkbox" value="5"> Class 5 (Special Equipment)</p></td><td><p style="    margin-left: 25px;">[<a class="fancybox" href="<?php echo base_url('../resources/shared_img/tutorial/5-vehicle-class.jpg');?>">view guide</a>]</p></td></tr>
</table>
 </div>
</div>

                                </div>
                                <div class="col-md-6 form-group verifiedform" style="display:none">

<div>
<div class="form-group">
    <label for="courseinformation_notexist">Course Information: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('courseinformation_notexist') ?><span class="text-danger" id="courseinformation_notexist_error"></span></label>
<p><input type="radio" name="courseinformation_notexist" value="y"> <span style="color: #CC0000">The driver is required to attend course or exam at Airside Licensing Unit.</span> </p>
<p><input type="radio" name="courseinformation_notexist" value="n"> <span style="color: #009900">The driver has attended course conducted by employer.</span></p>
</div>
</div>
<div id='ifbriefdone' style="display:none">
 <b>Trainer & Courser Provider :</b><br> Fill out course information if the driver have been done the compulsory briefing/course.<br><br>
<!--                                    <h3>Trainer & Courser Provider</h3> -->
                                    <div class="row">
                                        <div class="col-md-4">Trainer Name: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('trainername') ?><span class="text-danger" id="trainername_error"></span></div>
                                        <div class="col-md-8">
                                            <input class=" form-control" type="text" id="trainername" name="trainername" >

                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-4">Training Date: <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('trainingdate') ?><span class="text-danger" id="trainingdate_error"></span></div>
                                        <div class="col-md-8"><input class=" form-control datepicker_local_currentyear" type="text" id="trainingdate" name="trainingdate"></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            Certification By Trainer <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('adp_trainercert') ?><span class="text-danger" id="adp_trainercert_error"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <iframe frameBorder="0" width="100%" height="250px" src="" id="iframe_course"></iframe>
                                        </div>
                                    </div>
<!--                                    <?php
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
                                        <?php } ?>-->
</div>


                                </div>

                            </div>

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
<!--                                    <input id="to_step_tree" name="to_step_tree" type="submit" class="btn btn-primary" value="Next" style="display:none"> -->
<button id="to_step_tree" name="to_step_tree" type="submit" class="btn btn-primary" value="Next"  style="display:none">Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
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
<?php
if($condition == 'new') {
?>
<script>
    $('body').on('click', '#verify', function() {
        console.log('verify');
        $.ajax({
            type: "POST",
            data: {},
            url: "<?php echo base_url() ?>Permit/verify/driver/1/" + $("#driver_id").val(),
            success: function(data) {
                $("#verify_status").val(data);
                /* all good */
                if (data == "1" || data == "8" || data == "9" || data == "10") {
                    $("#notification").html('<div class="alert alert-success" role="alert"> The driver is available</div>');
                    $(".verifiedform").show();
                    $("#to_step_tree").show();
                    $('#iframe_course').attr('src', '/Uploadfiles/adp_trainercert/'+$("#driver_id").val());
                    /* in-active */
                } else if (data == "2") {
                    $("#notification").html('<div class="alert alert-warning" role="alert">The driver is not available [In-Active]. </div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                    /* suspended */
                } else if (data == "3") {
                    // $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available [Suspended]</div>');
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available [Suspended].</div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                } else if (data == "4") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available [Expired] </div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                } else if (data == "5") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available [permit application in progress]. </div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                } else if (data == "-1") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available [Permit termination in progress]. </div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                }else if (data == "6") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available. [Active permit].</div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                } else if (data == "7") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available. [Expiring soon permit]</div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                } /*else if (data == "10") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available. [Terminated permit].</div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                } */
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
        });
    });
</script>
<?php
}elseif($condition == 'renew'){
?>
<script>
    $('body').on('click', '#verify', function() {
        console.log('verify');
        $.ajax({
            type: "POST",
            data: {},
            url: "<?php echo base_url() ?>Permit/verify/driver/1/" + $("#driver_id").val(),
            success: function(data) {
                $("#verify_status").val(data);
                /* all good */
                if (data == "1" || data == "8" || data == "9" || data == "4" || data == "7") {
                    $("#notification").html('<div class="alert alert-success" role="alert"> The driver is available</div>');
                    $(".verifiedform").show();
                    $("#to_step_tree").show();
                    $('#iframe_course').attr('src', '/Uploadfiles/adp_trainercert/'+$("#driver_id").val());
                    /* in-active */
                } else if (data == "2") {
                    $("#notification").html('<div class="alert alert-warning" role="alert">The driver is not available [In-Active]. </div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                    /* suspended */
                } else if (data == "3") {
                    // $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available [Suspended]</div>');
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available [Suspended].</div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                } else if (data == "4") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available [Expired] </div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                } else if (data == "5") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available [Permit application in progress]. </div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                } else if (data == "-1") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available [Permit termination in progress]. </div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                }else if (data == "6") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The renewal application can be made only within 30 days before the expiry date.</div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                }/* else if (data == "7") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available. [Expiring soon permit]</div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                }*/ else if (data == "10") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The driver is not available. [Terminated permit].</div>');
                    $(".verifiedform").hide();
                    $("#to_step_tree").hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
        });
    });
</script>
<?php
}
?>


<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            data: {},
            url: "<?php echo base_url() ?>Driver/companydriver/",
            success: function(data) {
                $("select.select2").append(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
        });

$('#driver_id').on("select2:selecting", function(e) {
    $("#verify").show();
    //$(this).find('option').get(0).remove();
    $("#driver_id option[value='']").remove();
    $("#notification").html('');
    $("#to_step_tree").hide();
    $(".verifiedform").hide();
});

$("input[name='driverclass']").change(function () {
   if($("input[name='driverclass']:checked").val()=='C'){
   $(".cat_c_hide").hide();
   }else{
   $(".cat_c_hide").show();
   }

});
    });
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
<script>
function validateForm(){

var status = 0;
if($("input[name='driverclass']:checked").val() == null) {
    $("#driverclass_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#driverclass_error").html('') ;
}

if($("input[name='vehicleclass[]']").is(':checked')== false) {
    $("#vehicleclass_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#vehicleclass_error").html('') ;
}

if($("input[name='courseinformation_notexist']:checked").val() == null) {
    $("#courseinformation_notexist_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#courseinformation_notexist_error").html('') ;
}

if($("input[name='courseinformation_notexist']:checked").val() == 'n') {

if($("#trainername").val() == "") {
    $("#trainername_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#trainername_error").html('') ;
}

if($("#trainingdate").val() == "") {
    $("#trainingdate_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#trainingdate_error").html('') ;
}

if($("#adp_trainercert").val() == "") {
    $("#adp_trainercert_error").html('<span class="alert_custom">Required</span>') ;
    status = 1;
}else{
$("#adp_trainercert_error").html('') ;
}
}else{
$("#trainername_error").html('') ;
$("#trainingdate_error").html('') ;
$("#adp_trainercert_error").html('') ;
}

if(status == 1){
/*$('html, body').animate({ scrollTop: 0 }, 'slow'); */
return false;
}

}
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox();
    });
</script>
<script>
$(document).ready(function() {
 $("input[name='courseinformation_notexist']").click(function () {
   if($("input[name='courseinformation_notexist']:checked").val() == 'n') {
      $("#ifbriefdone").show();
   }else{
      $("#ifbriefdone").hide();
   }

 });
});
</script>