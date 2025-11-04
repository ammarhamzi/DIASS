<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li><a href="<?php echo site_url('driver'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> My Drivers</a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <?php echo $this->lang->line('form'); ?>
            <?php echo $button ?>
        </li>
    </ol>
    <div class="box  box-primary">
        <div class="box-header with-border">
            <i class="fa fa-file-text-o"></i>

            <h3 class="box-title"><?php echo $button; ?> Driver / Operator</h3>
            <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php
//print_r($driver_drivertype);
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div id="message">
                        <?php echo $this->session->userdata('message') <> '' ? '<span class="alert alert-warning" role="alert"><i class="icon fa fa-warning"></i>' . $this->session->userdata('message') . '</span>' : ''; ?>
                    </div>
                </div>
            </div>
            <div class="row col-md-12">
                <h5 class="pull-right">
                    <?php echo $this->lang->line('legend'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span>
                    <?php echo $this->lang->line('required_field'); ?>
                </h5>
            </div>

            <form autocomplete="off" action="<?php echo $action; ?>" method="post" onsubmit="return validateForm()">
                <div class="form-row">
                    <div class="col-md-4">


                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('driver_name'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_name') ?><span class="text-danger" id="driver_name_error"></span>
                            </label>
                            <input type="text" class="form-control" name="driver_name" id="driver_name" placeholder="<?php echo $this->lang->line('driver_name'); ?>" value="<?php echo $driver_name; ?>" maxlength="255" />

                        </div>

                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('driver_displayname'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_displayname') ?> <span class="text-danger" id="driver_displayname_error"></span>
                            </label>
                            <input type="text" class="form-control" name="driver_displayname" id="driver_displayname" placeholder="<?php echo $this->lang->line('driver_displayname'); ?>" value="<?php echo $driver_displayname; ?>" maxlength="15" />

                        </div>

                        <input type='hidden' name="driver_company_id" id="driver_company_id" value="<?php echo $this->session->userdata('companyid'); ?>" />
                        <input type='hidden' name="driver_activity_statusid" id="driver_activity_statusid" value="<?php echo (!empty($driver_activity_statusid) ? $driver_activity_statusid : '1'); ?>" />

                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('driver_dob'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_dob') ?><span class="text-danger" id="driver_dob_error"></span>
                            </label>
                            <input type="text" class="form-control datepicker_dob" name="driver_dob" id="driver_dob" placeholder="<?php echo $this->lang->line('driver_dob'); ?>" value="<?php echo ($driver_dob ? datelocal($driver_dob) : ''); ?>" autocomplete="off"/>
                        </div>

                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('driver_ic'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_ic') ?> <span class="text-danger" id="driver_ic_error"></span>
                            </label>
                            <input type="text" class="form-control isInteger" name="driver_ic" id="driver_ic" placeholder="<?php echo $this->lang->line('driver_ic'); ?>" value="<?php echo $driver_ic; ?>" maxlength="12" />
                        </div>

                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('driver_designation'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('driver_designation') ?><span class="text-danger" id="driver_designation_error"></span>
                            </label>
                            <input type="text" class="form-control" name="driver_designation" id="driver_designation" placeholder="<?php echo $this->lang->line('driver_designation'); ?>" value="<?php echo $driver_designation; ?>" maxlength="150" />
                        </div>

                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('driver_department'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('driver_department') ?> <span class="text-danger" id="driver_department_error"></span>
                            </label>
                            <input type="text" class="form-control" name="driver_department" id="driver_department" placeholder="<?php echo $this->lang->line('driver_department'); ?>" value="<?php echo $driver_department; ?>" maxlength="150" />
                        </div>

                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('driver_nationality_country_id'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_nationality_country_id') ?><span class="text-danger" id="driver_nationality_country_id_error"></span>
                            </label>

                            <select class="form-control select2" name="driver_nationality_country_id" id="driver_nationality_country_id">
                                <option value="">-SELECT-</option>
                                <?php
                                foreach ($ref_country as $value) {
                                    ?>
                                    <option value="<?php echo $value->ref_country_id; ?>" <?php echo ($value->ref_country_id == $driver_nationality_country_id ? 'selected="selected"' : ""); ?> <?php echo (empty($driver_nationality_country_id) && $value->ref_country_id == "151" ? "selected" : ""); ?> ><?php echo $value->ref_country_name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>
                                Home <?php echo $this->lang->line('driver_address'); ?><sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_address') ?><span class="text-danger" id="driver_address_error"></span>
                            </label>
                            <textarea class="form-control" name="driver_address" id="driver_address" placeholder="Home <?php echo $this->lang->line('driver_address'); ?>" rows="5" cols="50"><?php echo $driver_address; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">



                        <!--                        <div class="form-group">
                                                    <label>
                        <?php echo $this->lang->line('driver_officeno'); ?> <?php echo form_error('driver_officeno') ?>
                                  </label>
                                                    <input type="text" class="form-control" name="driver_officeno" id="driver_officeno" placeholder="<?php echo $this->lang->line('driver_officeno'); ?>" value="<?php echo $driver_officeno; ?>" maxlength="25" />
                                                    </div>-->

                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('driver_hpno'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('driver_hpno') ?><span class="text-danger" id="driver_hpno_error"></span>
                            </label>
                            <input type="text" class="form-control" name="driver_hpno" id="driver_hpno" placeholder="<?php echo $this->lang->line('driver_hpno'); ?>" value="<?php echo $driver_hpno; ?>" maxlength="25" />
                        </div>

                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('driver_email'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('driver_email') ?><span class="text-danger" id="driver_email_error"></span>
                            </label>
                            <input type="text" class="form-control" name="driver_email" id="driver_email" placeholder="<?php echo $this->lang->line('driver_email'); ?>" value="<?php echo $driver_email; ?>" maxlength="150" />
                        </div>

                        <!--                                                <div class="form-group">
                                                                                <label for="">
                                                Job Area <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_drivertype') ?>
                                            </label>
                        
                                                                                <select class="form-control select2" name="driver_drivertype" id="driver_drivertype">
                        <option value="">-SELECT-</option>
                        
                        <option value="Driver (for Airside Driving Permit)" <?php echo ($driver_drivertype == "Driver (for Airside Driving Permit)" ? "selected" : ""); ?>>Driver (for Airside Driving Permit)</option>
                        <option value="Driver (for Electrical Vehicle Driving Permit)" <?php echo ($driver_drivertype == "Driver (for Electrical Vehicle Driving Permit)" ? "selected" : ""); ?>>Driver (for Electrical Vehicle Driving Permit)</option>
                        <option value="Operator (for Fixed Facilities Permit)" <?php echo ($driver_drivertype == "Operator (for Fixed Facilities Permit)" ? "selected" : ""); ?>>Operator (for Fixed Facilities Permit)</option>
                        </select>
                        
                                                                        </div>-->

                        <div class="form-group">
                            <label>
                                <span class="licensetype">JPJ</span> <?php echo $this->lang->line('driver_drivinglicenseno'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('driver_drivinglicenseno') ?><span class="text-danger" id="driver_drivinglicenseno_error"></span>
                            </label>
                            <input type="text" class="form-control" name="driver_drivinglicenseno" id="driver_drivinglicenseno" placeholder="<?php echo $this->lang->line('driver_drivinglicenseno'); ?>" value="<?php echo $driver_drivinglicenseno; ?>" maxlength="50"
                                   />
                        </div>

                        <div class="form-group">
                            <label>
                                <span class="licensetype">JPJ</span> <?php echo $this->lang->line('driver_drivingclass'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('driver_drivingclass') ?><span class="text-danger" id="driver_drivingclass_error"></span>
                            </label>
                                              <!--<input type="text" class="form-control" name="driver_drivingclass" id="driver_drivingclass" placeholder="<?php echo $this->lang->line('driver_drivingclass'); ?>" value="<?php echo $driver_drivingclass; ?>" maxlength="50" />-->
                            <select class="form-control" name="driver_drivingclass" id="driver_drivingclass">
                                <option value="">-SELECT CLASS-</option>
                                <option value="A" <?php echo($driver_drivingclass == 'A' ? "selected" : "") ?>> A </option>
                                <option value="A1" <?php echo($driver_drivingclass == 'A1' ? "selected" : "") ?>> A1 </option>
                                <option value="B" <?php echo($driver_drivingclass == 'B' ? "selected" : "") ?>> B </option>
                                <option value="B1" <?php echo($driver_drivingclass == 'B1' ? "selected" : "") ?>> B1 </option>
                                <option value="B2" <?php echo($driver_drivingclass == 'B2' ? "selected" : "") ?>> B2 </option>
                                <option value="C" <?php echo($driver_drivingclass == 'C' ? "selected" : "") ?>> C </option>
                                <option value="D" <?php echo($driver_drivingclass == 'D' ? "selected" : "") ?>> D </option>
                                <option value="DA" <?php echo($driver_drivingclass == 'DA' ? "selected" : "") ?>> DA </option>
                                <option value="E" <?php echo($driver_drivingclass == 'E' ? "selected" : "") ?>> E </option>
                                <option value="E1" <?php echo($driver_drivingclass == 'E1' ? "selected" : "") ?>> E1 </option>
                                <option value="E2" <?php echo($driver_drivingclass == 'E2' ? "selected" : "") ?>> E2 </option>
                                <option value="F" <?php echo($driver_drivingclass == 'F' ? "selected" : "") ?>> F </option>
                                <option value="G" <?php echo($driver_drivingclass == 'G' ? "selected" : "") ?>> G </option>
                                <option value="H" <?php echo($driver_drivingclass == 'H' ? "selected" : "") ?>> H </option>
                                <option value="I" <?php echo($driver_drivingclass == 'I' ? "selected" : "") ?>> I </option>
                                <option value="M" <?php echo($driver_drivingclass == 'M' ? "selected" : "") ?>> M </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>
                                <span class="licensetype">JPJ</span> <?php echo $this->lang->line('driver_licenseexpirydate'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('driver_licenseexpirydate') ?><span class="text-danger" id="driver_licenseexpirydate_error"></span>
                            </label>
                            <input type="text" class="form-control datepicker_local" name="driver_licenseexpirydate" id="driver_licenseexpirydate" placeholder="<?php echo $this->lang->line('driver_licenseexpirydate'); ?>" value="<?php echo ($driver_licenseexpirydate ? datelocal($driver_licenseexpirydate) : ''); ?>"
                                   autocomplete="off"/>
                        </div>

                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('driver_blacklistedremark'); ?> <?php echo form_error('driver_blacklistedremark') ?><span class="text-danger" id="driver_blacklistedremark_error"></span>
                            </label>
                            <textarea class="form-control" name="driver_blacklistedremark" id="driver_blacklistedremark" placeholder="<?php echo $this->lang->line('driver_blacklistedremark'); ?>" rows="5" cols="50"><?php echo $driver_blacklistedremark; ?></textarea>
                        </div>

                        <div class="form-group">
                            <div class="alert alert-warning alert-dismissible">
                                <!--                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                <?php
                                //<!--                                Please take note that change the company for the vehicle is critical action. Please be extra careful when you do it.-->
                                if ($adppermitstatus == 'permitterminated' || $adppermitstatus == '') {
                                    $disabled = "disabled";
                                    if ($evdppermitstatus == 'permitterminated' || $evdppermitstatus == '') {
                                        echo "No active ADP and EVDP permit found. Change company selection enabled.";
                                        $disabled = "";
                                    } else if ($evdppermitstatus == 'completed' || $evdppermitstatus == 'paid') {
                                        echo "A " . evdppermitstatus . " permit found (" . $evdppermitno . "). Change company selection disabled.";
                                    } else {
                                        //$disabled = "disabled";
                                        echo "EVDP " . $evdppermitstatusdesc . ". Change company selection disabled.";
                                    }
//                                    else{
//                                        echo "No active ADP permit found. Change company selection enabled.";
//                                    }
                                } else if ($adppermitstatus == 'completed' || $adppermitstatus == 'paid') {
                                    $disabled = "disabled";
                                    echo "A " . $adppermitstatus . " permit found (" . $adppermitno . "). Change company selection disabled.";
                                } else {
                                    $disabled = "disabled";
                                    echo "ADP " . $adppermitstatusdesc . ". Change company selection disabled.";
                                }
                                //if($disabled != ""){
//                                if ($evdppermitstatus != 'permitterminated' && $evdppermitstatus != '' && $disabled == "disabled") {
////                                if ($evdppermitstatus == 'permitterminated' || $evdppermitstatus == '') {
////                                    $disabled = "";
////                                    echo "No active EVDP permit found. Change company selection enabled.";
////                                }
////                                else 
//                                    if ($evdppermitstatus == 'completed' || $evdppermitstatus == 'paid') {
//                                        $disabled = "A " . evdppermitstatus . " permit found (" . $evdppermitno . "). Change company selection disabled.";
//                                    } else {
//                                        //$disabled = "disabled";
//                                        echo "EVDP " . $evdppermitstatusdesc . ". Change company selection disabled.";
//                                    }
//                                }
                                ?>
                                <!--                                Please take note that change the company for the driver is critical action. Please be extra careful when you do it.-->
                            </div>
                            <label for="driver_company_id"><?php echo $this->lang->line('driver_company_id'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('driver_company_id') ?></label>
                                <?php
                                echo "<select class='form-control select2' name='driver_company_id_dummy' id='driver_company_id_dummy' $disabled>";
                                ?>
                    <!--        <select class="form-control select2" name="driver_company_id" id="driver_company_id">
                    <option value="">-SELECT-</option>-->
                            <?php
                            foreach ($company as $value) {
                                ?>
                                <option value="<?php echo $value->company_id; ?>" <?php echo ($value->company_id == trim($driver_company_id) ? 'selected="selected"' : ""); ?>><?php echo $value->company_name; ?></option>
    <?php
}
?>
                            </select>
                        </div>

                        <!--                        <div class="form-group">
                                                    <label>
                            <?php echo $this->lang->line('driver_permit_typeid'); ?> <?php echo form_error('driver_permit_typeid') ?>
                                  </label>
                                                    <input type="text" class="form-control isInteger" name="driver_permit_typeid" id="driver_permit_typeid" placeholder="<?php echo $this->lang->line('driver_permit_typeid'); ?>" value="<?php echo $driver_permit_typeid; ?>"
                                                            maxlength="11" />
                                                    </div>
                        
                                                <div class="form-group">
                                                    <label>
<?php echo $this->lang->line('driver_activity_statusid'); ?> <?php echo form_error('driver_activity_statusid') ?>
                                  </label>
                                                    <input type="text" class="form-control isInteger" name="driver_activity_statusid" id="driver_activity_statusid" placeholder="<?php echo $this->lang->line('driver_activity_statusid'); ?>" value="<?php echo $driver_activity_statusid; ?>"
                                                            maxlength="11" />
                                                    </div>
                        
                                                <div class="form-group">
                                                    <label>
<?php echo $this->lang->line('driver_application_date'); ?> <?php echo form_error('driver_application_date') ?>
                                  </label>
                                                    <input type="text" class="form-control datepicker" name="driver_application_date" id="driver_application_date" placeholder="<?php echo $this->lang->line('driver_application_date'); ?>" value="<?php echo $driver_application_date; ?>"
                                                        />
                                                    </div>-->
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>
Photo <!--<sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('driver_photo') ?><span class="text-danger" id="driver_photo_error"></span>-->
                            </label>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe frameBorder="0" class="embed-responsive-item" src="/Uploadfiles/driver_photo/<?php echo $driver_id; ?>"></iframe>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>
<?php echo $this->lang->line('driver_ic'); ?> <!--<sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('driver_info') ?> <span class="text-danger" id="driver_info_error"></span>-->
                            </label>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe frameBorder="0" class="embed-responsive-item" src="/Uploadfiles/driver_info/<?php echo $driver_id; ?>"></iframe>
                            </div>
                        </div>
                        <div><br><br><br><br>
                            <label>Previous Company History</label>
                            <table class="table table-bordered">
                                <tr style=" background-color: #ECF0F5">
                                    <th>Previous Company</th>
                                    <th>Changed By</th>
                                    <th>Date of Change</th>
                                </tr>
<?php
if ($companyhistory) {

    foreach ($companyhistory as $comp) {
        ?>
                                        <!--    <tr>
                                                    <td><?php echo $comp->company_name; ?></td>
                                                    <td><?php echo $comp->user_username; ?></td>
                                                    <td><?php echo $comp->vehiclecompanyhistory_created_at; ?></td>
                                                </tr>-->
                                        <tr>
                                            <td><?php echo $comp->company_name; ?></td>
                                            <td><?php echo $comp->user_username; ?></td>
                                            <td><?php echo $comp->vehiclecompanyhistory_created_at; ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3">no history found</td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </table>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input type="hidden" name="driver_id" value="<?php echo (isset($id) ? $id : " "); ?>" />                             <input id="driver_photo" type="hidden" name="driver_photo" value="">
                            <input id="driver_info" type="hidden" name="driver_info" value="">

                            <input type="hidden" name="driver_company_id_ori" id="driver_company_id_ori" value="<?php echo trim($driver_company_id); ?>">
                            <input type="hidden" name="driver_company_id" id="driver_company_id" value="<?php echo trim($driver_company_id); ?>">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save</button>
                            <a href="<?php echo site_url('driver') ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php
if (isset($id)) {
    ?>
    <script>
        $(document).ready(function () {
            var arr = ['driver_permit_typeid', 'driver_activity_statusid', 'driver_application_date'];
            $.each(arr, function (i, val) {
                $("#" + val).prop("disabled", true);
                $("#" + val).after("<input type='hidden' name='" + val + "' id='" + val + "' value='" + $("#" + val).val() + "'>");
            });
        });
    </script>
    <?php
}
?>
<script>
    $(document).ready(function () {
        $(".btn-remote-file").click(function () {
            $('input[type=file]').trigger('click');
        });
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });
        $(document).ready(function () {
            $('.btn-file :file').on('fileselect', function (event, numFiles, label) {
                var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;
                if (input.length) {
                    input.val(log);
                    $(this).parents('.input-group').find(":submit").click();
                } else {
                    //if( log ) alert(log);
                }
            });
        });
    });
</script>
<script>
    function clear_form_elements(id) {
        jQuery("#testingDiv" + id).find(':input').each(function () {
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
        });
    }

</script>
<script>
    $(document).ready(function () {
        $("#driver_nationality_country_id").change(function () {
            if ($("#driver_nationality_country_id").val() == 151) {
                $('.licensetype').text('JPJ');
            } else {
                $('.licensetype').text('International');
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
        if (processtype == 'driver_info') {
            $("#driver_info").val(data);
        }
        if (processtype == 'driver_photo') {
            $("#driver_photo").val(data);
        }
    }
</script>

<script>
    function validateForm() {
        var status = 0;
        if ($("#driver_name").val() == "") {
            $("#driver_name_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_name_error").html('');
        }
        if ($("#driver_displayname").val() == "") {
            $("#driver_displayname_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_displayname_error").html('');
        }
        if ($("#driver_dob").val() == "") {
            $("#driver_dob_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_dob_error").html('');
        }
        if ($("#driver_ic").val() == "") {
            $("#driver_ic_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_ic_error").html('');
        }
        /*if($("#driver_photo").val() == "") {
         $("#driver_photo_error").html('<span class="alert_custom">Required</span>') ;
         status = 1;
         }else{
         $("#driver_photo_error").html('') ;
         }*/
        if ($("#driver_designation").val() == "") {
            $("#driver_designation_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_designation_error").html('');
        }
        if ($("#driver_department").val() == "") {
            $("#driver_department_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {

            $("#driver_department_error").html('');
        }

        if ($("#driver_nationality_country_id").val() == "") {
            $("#driver_nationality_country_id_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_nationality_country_id_error").html('');
        }
        if ($("#driver_address").val() == "") {
            $("#driver_address_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_address_error").html('');
        }
        if ($("#driver_hpno").val() == "") {
            $("#driver_hpno_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_hpno_error").html('');
        }
        if ($("#driver_email").val() == "") {
            $("#driver_email_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_email_error").html('');
        }
        if ($("#driver_drivinglicenseno").val() == "") {
            $("#driver_drivinglicenseno_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_drivinglicenseno_error").html('');
        }
        if ($("#driver_drivingclass").val() == "") {
            $("#driver_drivingclass_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_drivingclass_error").html('');
        }


        if ($("#driver_licenseexpirydate").val() == "") {
            $("#driver_licenseexpirydate_error").html('<span class="alert_custom">Required</span>');
            status = 1;
        } else {
            $("#driver_licenseexpirydate_error").html('');
        }

        /*if($("#driver_info").val() == "") {
         $("#driver_info_error").html('<span class="alert_custom">Required</span>') ;
         status = 1;
         }else{
         $("#driver_info_error").html('') ;
         }*/

        if (status == 1) {
            $('html, body').animate({scrollTop: 0}, 'slow');
            return false;
        }

    }
</script>