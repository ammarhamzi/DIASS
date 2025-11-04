<!-- \resources\gen_template\master\crud-newpage\views -->
<link rel="stylesheet" href="<?php echo base_url('resources/shared_js/select2/dist/css/select2.min.css'); ?>" crossorigin="anonymous" />
<script src="<?php echo base_url('resources/shared_js/select2/dist/js/select2.min.js'); ?>" crossorigin="anonymous"></script>
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            <?php echo $this->lang->line('applypermit');?> </li>
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
    <div class="panel panel-info">
        <div class="panel-heading">
            <!--            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                <?php echo $this->lang->line('applypermit');?>
            </h4>-->
            <div class="row">
                <div class="col-md-3">Step 1</div>
                <div class="col-md-3"><span class="step_active">Step 2</span><br>Choose driver for the permit. Not listed here? <a href="" class="btn btn-primary>">Create</a></div>
                <div class="col-md-3">Step 3</div>
                <div class="col-md-3">Step 4</div>
            </div>
        </div>
        <div class="panel-body">

            <form autocomplete="off" id="step_two" name="step_two" action="/Permit/stepthree" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <p><b>Application :</b> Electrical Vehicle Driving Permit (EVDP)</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <b>Choose Driver :</b><br> If your driver is not listed below, please <a href="/Driver/create">create the driver</a><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <select class="select2" id="driver_id" name="driver_id">
       <option id="">-SELECT DRIVER-</option>

   </select>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary" id='verify' onclick="javascript:return false">Verify</button>
                    </div>
                </div>
                <input id="permittype" type="hidden" name="permittype" value="evdp">
                <input id="verify_status" type="hidden" name="verify_status" value="">

                <div class="row">
                    <div class="col-md-9" id="notification">

                    </div>
                    <div class="col-md-3 text-right">
                        <input id="to_step_tree" name="to_step_tree" type="submit" class="btn btn-primary" value="Next">
                        <input id="condition" type="hidden" name="condition" value="<?php echo $condition;?>">
<input id="recent_permitid" type="hidden" name="recent_permitid" value="<?php echo $recent_permitid;?>">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            data: {},
            url: "<?php echo base_url() ?>Driver/companydriver",
            success: function(data) {
                $("select.select2").append(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
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
                if (data == "1") {
                    $("#notification").html('<div class="alert alert-success" role="alert">Success! The drivers history looks good can proceed for the next step</div>');
                    /* in-active */
                } else if (data == "2") {
                    $("#notification").html('<div class="alert alert-warning" role="alert">In-Active! The drivers history shown he is not active. Please update your driver record.</div>');
                    /* suspended */
                } else if (data == "3") {
                    $("#notification").html('<div class="alert alert-danger" role="alert">Suspended! The drivers history found unpaid summon.</div>');
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