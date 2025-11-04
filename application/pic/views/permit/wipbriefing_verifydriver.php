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
                        <h3>Application : Work In Progress - Briefing only Permit (WIPBRIEFING)</h3>
                    </div>
                </div>
              <form autocomplete="off" id="step_two" name="step_two" action="/Permit/stepthree" method="POST">
                    <div class="box box-primary">


                            <div class="box-body">



                <div class="row">
                    <div class="col-md-12">
                        <b>Choose Driver :</b><br> If your driver is not listed below, please <a href="/Driver/create">create the driver</a><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <select class="select2 form-control" id="driver_id" name="driver_id">
       <option id="">-SELECT DRIVER-</option>

   </select><br><br>

                        <button class="btn btn-primary pull-right" id='verify' onclick="javascript:return false" style="display:none;">Verify</button>
                    </div>
                </div>
                <input id="permittype" type="hidden" name="permittype" value="wipbriefing">
                <input id="verify_status" type="hidden" name="verify_status" value="">



                            </div>


                            <div class="box-footer">
                <div class="row">
                    <div class="col-md-9" id="notification">

                    </div>
                    <div class="col-md-3 text-right">
                        <input id="to_step_tree" name="to_step_tree" type="submit" class="btn btn-primary" value="Next" style="display:none">
                        <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
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
    $(this).find('option').get(0).remove();
});
    });
    $('body').on('click', '#verify', function() {
        console.log('verify');
        $.ajax({
            type: "POST",
            data: {},
            url: "<?php echo base_url() ?>Driver/verify/" + $("#driver_id").val(),
            success: function(data) {
                $("#verify_status").val(data);
                /* all good */
                if (data == "1" || data == "8" || data == "9") {
                    $("#notification").html('<div class="alert alert-success" role="alert">Success! The drivers history looks good can proceed for the next step</div>');
                    $("#to_step_tree").show();
                    /* in-active */
                } else if (data == "2") {
                    $("#notification").html('<div class="alert alert-warning" role="alert">In-Active! The drivers history shown he is not active. Please update your driver record.</div>');
                    $("#to_step_tree").hide();
                    /* suspended */
                } else if (data == "3") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">Suspended! The drivers history found unpaid summon.</div>');
                    $("#to_step_tree").hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
        });
    });
</script>
<script>
    function redirect(url) {
        $(location).attr('href', url);
    }
</script>