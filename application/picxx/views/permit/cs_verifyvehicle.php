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
        <div class="row">
                <div class="col-md-12 text-center">
                        <div id="message" style=" position: fixed;right: 25px;">
                                <?php echo $this->session->userdata('message') <> '' ? '<span class="alert alert-success" role="alert">'.$this->session->userdata('message').'</span>' : ''; ?>
                        </div>
                </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li><a href="#tab_1" class="disabled">Step 1</a></li>
                            <li class="active"><a href="#tab_2" data-toggle="tab">Step 2</a></li>
                            <li><a href="#tab_3" class="disabled">Step 3</a></li>
                            <li><a href="#tab_4" class="disabled">Step 4</a></li>
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-question"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_2">
                       <div class="row">
                    <div class="col-md-12">
                        <h3>Application : Commercial Supplier Vehicle Permit (CS)</h3>
                    </div>
                </div>
            <form autocomplete="off" id="step_two" name="step_two" action="/Permit/stepthree" method="POST">

                               <div class="box box-primary">


                            <div class="box-body">
                <div class="row">
                    <div class="col-md-12  form-group">
                        <b>Choose Vehicle :</b><br> If your vehicle is not listed below, please <a href="/Vehicle/create">create the vehicle</a><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <select class="select2 form-control" id="vehicle_id" name="vehicle_id">
       <option value="">-SELECT VEHICLE-</option>

   </select> <br><br>

                        <button class="btn btn-primary pull-right" id='verify' onclick="javascript:return false" style="display:none;">Verify</button>
                    </div>
                </div>
                <input id="permittype" type="hidden" name="permittype" value="cs">
                <input id="verify_status" type="hidden" name="verify_status" value="">
                <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">

                            </div>


                            <div class="box-footer">
                            <div class="row">
                                <div class="col-md-11" id="notification">

                                </div>
<!--                        <input id="to_step_tree" name="to_step_tree" type="submit" class="btn btn-primary" value="Next" style="display:none">-->
<button id="to_step_tree" name="to_step_tree" type="submit" class="btn btn-primary" value="Next"  style="display:none">Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>

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
            url: "<?php echo base_url() ?>Permit/verify/vehicle/10/" + $("#vehicle_id").val(),
            success: function(data) {
                $("#verify_status").val(data);
                /* all good */
                if (data == "1" || data == "8" || data == "9") {
                    $("#notification").html('<div class="alert alert-success" role="alert"> The vehicle is available</div>');

                    $("#to_step_tree").show();

                    /* in-active */
                } else if (data == "2") {
                    $("#notification").html('<div class="alert alert-warning" role="alert">The vehicle is not available [In-Active]. </div>');

                    $("#to_step_tree").hide();
                    /* suspended */
                } else if (data == "3") {
                    // $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available [Suspended]</div>');
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available [Suspended].</div>');

                    $("#to_step_tree").hide();
                } else if (data == "4") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available [Expired] </div>');

                    $("#to_step_tree").hide();
                } else if (data == "5") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available [permit application in progress]. </div>');

                    $("#to_step_tree").hide();
                } else if (data == "6") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available. [Active permit].</div>');

                    $("#to_step_tree").hide();
                } else if (data == "7") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available. [Expiring soon permit]</div>');

                    $("#to_step_tree").hide();
                } else if (data == "10") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available. [Terminated permit].</div>');

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
}elseif($condition == 'renew'){
?>
<script>
    $('body').on('click', '#verify', function() {
        console.log('verify');
        $.ajax({
            type: "POST",
            data: {},
            url: "<?php echo base_url() ?>Permit/verify/vehicle/10/" + $("#vehicle_id").val(),
            success: function(data) {
                $("#verify_status").val(data);
                /* all good */
                if (data == "1" || data == "8" || data == "9" || data == "4" || data == "7") {
                    $("#notification").html('<div class="alert alert-success" role="alert"> The vehicle is available</div>');

                    $("#to_step_tree").show();

                    /* in-active */
                } else if (data == "2") {
                    $("#notification").html('<div class="alert alert-warning" role="alert">The vehicle is not available [In-Active]. </div>');

                    $("#to_step_tree").hide();
                    /* suspended */
                } else if (data == "3") {
                    // $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available [Suspended]</div>');
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available [Suspended].</div>');

                    $("#to_step_tree").hide();
                } /*else if (data == "4") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available [Expired] </div>');

                    $("#to_step_tree").hide();
                }*/ else if (data == "5") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available [permit application in progress]. </div>');

                    $("#to_step_tree").hide();
                } else if (data == "6") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The renewal application can be made only within 30 days before the expiry date.</div>');

                    $("#to_step_tree").hide();
                }/* else if (data == "7") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available. [Expiring soon permit]</div>');

                    $("#to_step_tree").hide();
                }*/ else if (data == "10") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">The vehicle is not available. [Terminated permit].</div>');

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
            url: "<?php echo base_url() ?>Vehicle/companyvehicle/",
            success: function(data) {
                $("select.select2").append(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
        });

$('#vehicle_id').on("select2:selecting", function(e) {
    $("#verify").show();
    //$(this).find('option').get(0).remove();
    $("#vehicle_id option[value='']").remove();
    $("#notification").html('');
    $("#to_step_tree").hide();
});
    });
</script>
<script>
    function redirect(url) {
        $(location).attr('href', url);
    }
</script>