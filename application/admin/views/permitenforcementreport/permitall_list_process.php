<!-- \resources\gen_template\master\crud-newpage\views -->
<style type="text/css">
    tfoot {
        display: table-header-group;
    }

    select {
        width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    select option {
        white-space: nowrap;
        width: 100%; border-bottom: 1px #ccc solid;
        /* This doesn't work. */
    }

    /*#horizontal_scroll {
    max-width: 1200px;
    overflow-x: scroll;
    overflow-y: auto;
    transform:rotateX(180deg);
}

#horizontal_scroll table {
    transform:rotateX(180deg);
}*/
</style>
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li>Enforcement Report Generator</li>
        <!--<li class="active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Application Date
        </li>-->
    </ol>

    <!--parentchildmenu-->

    <?php
if (!empty($this->session->userdata('message'))) {
    ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            <?php echo $this->session->userdata('message'); ?>
        </div>
        <?php
}
?>
        <!--    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                <?php echo $this->lang->line('permitall'); ?>
                <?php echo $this->lang->line('list'); ?>
            </h4>
        </div>
        <div class="panel-body">-->
        <div class="box  box-primary">
            <div class="box-header with-border">
                <i class="fa fa-file-text-o"></i>

                <h3 class="box-title">Enforcement Report Generator</h3>
                <div class="box-tools pull-right">

                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form id="locationform" name="locationform" action="" method="POST" autocomplete="off">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="applicationdate">Offence Date <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup></label>
                                        <input type="text" name="appdate_from" class="form-control datepicker_local" placeholder="Date From" value="<?php echo $this->input->post('appdate_from'); ?>" required>
                                        <input type="text" name="appdate_to" class="form-control datepicker_local" placeholder="Date To" value="<?php echo $this->input->post('appdate_to'); ?>" required>
                                    </div>

                                    

                                    

                                    
                                    
                                   <div class="form-group">
                                        <label for="offencestatus">Offence Status</label>
                                        <select name="offencestatus" class="form-control">
<option value="">All</option>
<option value="Open" <?php echo ($this->input->post('offencestatus') == "Open" ? "selected" : ""); ?>>Open</option>
<option value="Cancel" <?php echo ($this->input->post('offencestatus') == "Cancel" ? "selected" : ""); ?>>Cancel</option>
<option value="Close" <?php echo ($this->input->post('offencestatus') == "Close" ? "selected" : ""); ?>>Close</option>
        </select>
                                    </div>



                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="companyname">Company Name</label>
                                        <select name="companyname" class="form-control">
<option value="">All</option>
<?php
foreach ($company as $com) {
    ?>
<option value="<?php echo $com->company_name; ?>" <?php echo ($this->input->post('companyname') == $com->company_name ? "selected" : ""); ?>><?php echo $com->company_name; ?></option>
<?php
}
?>
        </select>
                                    </div>
<!--                                    <div class="form-group">
                                        <label for="permitgroup">Permit Group</label>
                                        <select name="permitgroup" class="form-control">
<option value="">All</option>
<?php
foreach ($permit_group as $permitgroup) {
    ?>
<option value="<?php echo $permitgroup->permit_group_name; ?>" <?php echo ($this->input->post('permitgroup') == $permitgroup->permit_group_name ? "selected" : ""); ?>><?php echo $permitgroup->permit_group_name; ?></option>
<?php
}
?>
        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="permitcondition">Permit Condition</label>
                                        <select name="permitcondition" class="form-control">
<option value="">All</option>
<?php
foreach ($permit_condition as $permitcondition) {
    ?>
<option value="<?php echo $permitcondition->permit_condition_name; ?>" <?php echo ($this->input->post('permitcondition') == $permitcondition->permit_condition_name ? "selected" : ""); ?>><?php echo $permitcondition->permit_condition_name; ?></option>
<?php
}
?>
        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="officialstatus">Status</label>
                                        <select name="officialstatus" class="form-control">
<option value="">All</option>
<?php
foreach ($permit_officialstatus as $permitofficialstatus) {
    ?>
<option value="<?php echo $permitofficialstatus->permit_officialstatus_name; ?>" <?php echo ($this->input->post('officialstatus') == $permitofficialstatus->permit_officialstatus_name ? "selected" : ""); ?>><?php echo $permitofficialstatus->permit_officialstatus_name; ?></option>
<?php
}
?>
        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="permitstartdate">permit Start Date</label>
                                        <input type="text" name="permitstartdate" class="form-control datepicker_local" placeholder="Date" value="<?php echo $this->input->post('permitstartdate'); ?>">
                                    </div>-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="location">Type</label><br>
<!--                                        <span><input id="all" name="location" type="radio" value="" <?php echo (empty($this->input->post('location')) || $this->input->post('location') == "all" ? "checked" : ""); ?>> ALL </span>-->
                                        <span style=" margin-left:25px;"><input id="icno" name="location" type="radio" value="icno" <?php echo (empty($this->input->post('location')) || $this->input->post('location') == "icno" ? "checked" : ""); ?>> IC No </span>
                                        <span style=" margin-left:25px;"><input id="regno" name="location" type="radio" value="regno" <?php echo ($this->input->post('location') == "regno" ? "checked" : ""); ?>> Vehicle Registration </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="drivervehicle">IC No / Vehicle Registration<sup><span class="glyphicon text-danger" aria-hidden="true"></span></sup></label>
                                        <input type="text" name="drivervehicle" class="form-control" placeholder="IC No / Vehicle Registration" value="<?php echo $this->input->post('drivervehicle'); ?>">
                                    </div>
<!--                                    <div class="form-group">
                                        <label for="vehiclegroup">Vehicle Group</label>
                                        <select name="vehiclegroup" class="form-control">
<option value="">All</option>
<?php
foreach ($vehiclegroup as $vgroup) {
    ?>
<option value="<?php echo $vgroup->vehiclegroup_name; ?>" <?php echo ($this->input->post('vehiclegroup') == $vgroup->vehiclegroup_name ? "selected" : ""); ?>><?php echo $vgroup->vehiclegroup_name; ?></option>
<?php
}
?>
        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="enginecapacity">Engine Capacity</label>
                                        <select name="enginecapacity" class="form-control">
<option value="">All</option>
<?php
foreach ($enginecapacity as $ecapacity) {
    ?>
<option value="<?php echo $ecapacity->enginecapacity_name; ?>" <?php echo (htmlspecialchars($this->input->post('enginecapacity')) == $ecapacity->enginecapacity_name ? "selected" : ""); ?>><?php echo $ecapacity->enginecapacity_name; ?></option>
<?php
}
?>
        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="nationality">Nationality</label>
                                        <select name="nationality" class="form-control">
<option value="">All</option>
<option value="Malaysia" <?php echo ($this->input->post('nationality') == "Malaysia" ? "selected" : ""); ?>>Malaysia</option>
<option value="non" <?php echo ($this->input->post('nationality') <> "Malaysia" && $this->input->post('nationality') <> ""? "selected" : ""); ?>>Foreigner</option>
        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="permitexpirydate">permit expiry Date</label>
                                        <input type="text" name="permitexpirydate" class="form-control datepicker_local" placeholder="Date" value="<?php echo $this->input->post('permitexpirydate'); ?>">
                                    </div>-->
                                </div>

                                <div class="col-md-12">
                                    <input id="filter" name="filter" type="submit" value="Search" class="btn btn-primary pull-right">
                                </div>
                            </div>

                            <!--<input type="submit" name="submit" id="submit" value="submit">-->

                        </div>
                    </div>
                </form>
                <?php
if($this->input->post("appdate_from") && $this->input->post("appdate_to")){
 ?>
                <div id="horizontal_scroll">
                    <table id="mytable" class="table table-bordered table-hover" style="width: 100% !important">

                        <thead>
                            <tr>
                                <th class="no-sort">#</th>
                                <th>Offence Date</th>
                                <th>Offence Time</th>
                                <th>Offence Status</th>
                                <th>Offence Status Close/Cancel Date Time</th>
                                <th><?php echo ($this->input->post('location') == "icno" ? "Name" : "Vehicle Registration"); ?></th>
                                <th><?php echo ($this->input->post('location') == "icno" ? "IC No" : "Vehicle Type"); ?></th>
                                <th>Company Name</th>
                                <th>Suspended Period</th>
                                <th>Demerit Point</th>
                               <th>Offence Type</th>
                                <!-- <th>
                                    Total Detention
                                </th>
                                
                                <th>
                                    Statistic
                                </th>-->
                                
                                <!--<th class="no-sort">&nbsp;</th>-->
                            </tr>
                        </thead>
                    </table>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
</div>
<?php
if($this->input->post("appdate_from") && $this->input->post("appdate_to")){
 ?>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut(400);
        }, 4000);

        var table = $("#mytable").DataTable({
            //"order": [],
            "lengthMenu": [
                [10, 25, 50, 100000],
                [10, 25, 50, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url(); ?>permitenforcementreport/get_json/",
                "type": "GET",
                "data": {
                    "permit_location": '<?php echo $this->input->post("location"); ?>',
            "offence_status": '<?php echo $this->input->post("offencestatus"); ?>',
                    "company_name": '<?php echo $this->input->post("companyname"); ?>',
                    "driver_ic": '<?php echo $this->input->post("drivervehicle"); ?>',
                    "permit_type_desc":'<?php echo $this->input->post("permittype");?>',
                    "permit_group_name": '<?php echo $this->input->post("permitgroup");?>',
                    "permit_condition_name":'<?php echo $this->input->post("permitcondition");?>',
                    "permit_officialstatus_name":'<?php echo $this->input->post("officialstatus");?>',
                    "vehiclegroup_name": '<?php echo $this->input->post("vehiclegroup");?>',
                    "enginecapacity_name":'<?php echo $this->input->post("enginecapacity");?>',
                    "ref_country_printable_name":'<?php echo $this->input->post("nationality");?>',
                    "permit_issuance_startdate":'<?php echo $this->input->post("permitstartdate");?>',
                    "permit_issuance_expirydate":'<?php echo $this->input->post("permitexpirydate");?>',
                    "permit_created_at_from":'<?php echo $this->input->post("appdate_from");?>',
                    "permit_created_at_to":'<?php echo $this->input->post("appdate_to");?>',
                }
/*                        "data":function(data) {
                            data.permit_location = '<?php echo $this->input->post("location"); ?>';
                            data.company_name = '<?php echo $this->input->post("companyname"); ?>';
                        }*/
            },
            responsive: true,
            "scrollX": true,
            "scrollCollapse": true,
            "paging":         false,
            "scrollY":        "600px",
            "info":     false,
            dom: 'lrBtip',
            buttons: [
                <?php
if ($permission->printlist == true) {
    ?> {
                    extend: 'collection',
                    text: '<span class="glyphicon glyphicon-export" aria-hidden="true"></span> <?php echo $this->lang->line("export"); ?>',
                    buttons: [{
                            extend: 'excelHtml5',
                            title: '<?php echo $this->lang->line("data_export"); ?>',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                            }
                        },
/*                        {
                            extend: 'pdfHtml5',
                            title: '<?php echo $this->lang->line("data_export"); ?>',
                            message: '<?php echo $this->lang->line("any_message"); ?>',
                            download: 'open',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            title: '<?php echo $this->lang->line("data_export"); ?>',
                            exportOptions: {
                                columns: ':visible'
                            }
                        }*/
                    ]
                },
                <?php }?> {
                    extend: 'colvis',
                    columns: ':not(:last-child)',
                    postfixButtons: ['colvisRestore']
                }
            ],
            /*            columnDefs: [
                            {
                                targets: 'no-sort',
                                orderable: false
                            },
                            {
                                "targets": [0,1,2,3,10,11,12,13,14,15],
                                "visible": false,
                                "searchable": false
                            }]*/
        });
    });
</script>
 <?php
}
?>

<script>
    function redirect(url) {
        $(location).attr('href', url);
    }
</script>
<script>
    $(document).ready(function() {
        /*$("input[name='location']").click(function () {

        $('#locationform').submit();
        });*/
    });
</script>