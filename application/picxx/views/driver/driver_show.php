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
        <li><a href="<?php echo site_url('driver'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo 'Driver'; //$this->lang->line('service_charges');   ?> <?php echo ''; //$this->lang->line('list');   ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo 'Driver View'; //$this->lang->line('form');   ?> <?php //echo $button; ;;?></li>
    </ol>

    <form autocomplete="off" id="frm_add_main_offence" action="<?=site_url('Enforcement/create_driver_action');?>" method="POST">
    <div class="box  box-primary">
        <div class="box-header with-border">
            <i class="fa fa-file-text-o"></i>

            <h3 class="box-title">Driver Information</h3>
            <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row">
                <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-3 ">
                                <div class="small-box text-center">
                                    <img src="<?=$driver_photo;?>" width="70%" class="img-thumbnail" alt="Driver Photo">
                                </div>
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3><?=$merit_point_txt;?></h3>
                                        <p>Merit Points</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-android-warning"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <!--<h4>Driver Information</h4> -->
                                <div class="col-md-7">
                                    <strong>Name</strong>
                                    <p class="text-muted">
                                        <?=$driver_det->driver_name;?>
                                    </p>

                                    <strong>IC / Passport / Working Permit / Employment Pass</strong>
                                    <p class="text-muted">
                                        <?=$driver_det->driver_ic;?>
                                    </p>

                                    <strong>Driving License Country</strong>
                                    <p class="text-muted">
                                        MALAYSIA
                                    </p>

                                    <strong>Driving License Class</strong>
                                    <p class="text-muted">
                                        <?=$driver_det->driver_drivingclass;?>
                                    </p>

                                    <strong>Supporting Document</strong>
                                    <p class="text-muted">
                                        <?php 
                                        if(isset($driver_file_list) && !empty($driver_file_list))
                                        {
                                        ?>
                                        <ul>
                                            <?php
                                            foreach($driver_file_list as $r_dfl)
                                            {
                                            ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>/uploads/files/<?php echo $r_dfl['uploadfiles_filename']; ?>" target="_blank">IC / Passport</a></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php 
                                        }
                                        else
                                        {
                                            echo '- None';
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="col-md-5">
                                    <strong>Contact Number</strong>
                                    <p class="text-muted">
                                        <?=$driver_det->driver_hpno;?>
                                    </p>

                                    <strong>Email</strong>
                                    <p class="text-muted">
                                        <?=$driver_det->driver_email;?>
                                    </p>

                                    <strong>Driving License Number</strong>
                                    <p class="text-muted">
                                        <?=$driver_det->driver_drivinglicenseno;?>
                                    </p>

                                    <strong>Driving License Expiry Date</strong>
                                    <p class="text-muted">
                                        <?=datelocal($driver_det->driver_licenseexpirydate);?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_history" aria-controls="tab_history" role="tab" data-toggle="tab">Enforcement History</a></li>
                                    <li role="presentation" ><a href="#tab_permits" aria-controls="tab_permits" role="tab" data-toggle="tab">Permits</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tab_history">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="mytable" class="table" style="width: 100% !important">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><?php echo 'Date Submit'; //$this->lang->line('user_username');   ?></th>
                                                            <th><?php echo 'Submit By'; //$this->lang->line('user_username');   ?></th>
                                                            <th><?php echo 'Period of Suspension'; //$this->lang->line('user_email');   ?></th>
                                                            <th><?php echo 'ADP No'; //$this->lang->line('user_email');   ?></th>
                                                            <th><?php echo 'Remark'; //$this->lang->line('user_email');   ?></th>
                                                            <th class="no-sort">Offence List</th>
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
            ?>
                                                              <tr>
                                                                <td><?php echo ++$start; ?></td>
                                                                <td>
                                                                    <?php echo date('d-m-Y', strtotime($r->enforcements_main_created_at)); ?> /
                                                                    <?php echo date('h:i: A', strtotime($r->enforcements_main_created_at)); ?>
                                                                </td>
                                                                <td><?php echo $r->userlist_user_name; ?></td>
                                                                <td><?php echo $r->enforcements_main_period_suspension; ?></td>
                                                                <td><?php echo $r->enforcements_main_adpadv_no; ?></td>
                                                                <td><?php echo $r->enforcements_main_remarks; ?></td>
                                                                <td style="text-align:center; white-space: nowrap;">
                                                                    <div class="btn-group" role="group" aria-label="...">
                                                                        <a href="<?=site_url('PdfOutput/enforcement_print/' . $id);?>" target="_blank">
                                                                        <button type="button" class="btn btn-xs btn-info" title="Print"><i class="glyphicon glyphicon-print"></i></button></a>
                                                                        <button type="button" class="btn btn-xs btn-default btn_history_offence_list" enc="<?=$r->enforcements_main_id;?>" title="View Offence List"><i class="fa fa-list"></i></button>
                                                                        <?php
    if ($permission->cp_create == true) {
                //echo anchor(site_url('Enforcement/create_driver/?i=' . $r->driver_id),'<button type="button" class="btn btn-default">New Offence</button>');
            }
            ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php
    }
    }
    ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><?php echo 'Date Submit'; //$this->lang->line('user_username');   ?></th>
                                                            <th><?php echo 'Submit By'; //$this->lang->line('user_username');   ?></th>
                                                            <th><?php echo 'Period of Suspension'; //$this->lang->line('user_email');   ?></th>
                                                            <th><?php echo 'ADP No'; //$this->lang->line('user_email');   ?></th>
                                                            <th><?php echo 'Remark'; //$this->lang->line('user_email');   ?></th>
                                                            <th class="no-sort">Offence List</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="tab_permits">
                                        <div class="row">
                                            
                                            <!-- /.box-header -->
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table id="mytable2" class="table" style="width: 100% !important">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th><?php echo 'Permit Number'; //$this->lang->line('user_username');   ?></th>
                                                                    <th><?php echo 'Application Date'; //$this->lang->line('user_email');   ?></th>
                                                                    <th><?php echo 'Expiry Date'; //$this->lang->line('user_username');   ?></th>
                                                                    <th><?php echo 'Status'; //$this->lang->line('user_email');   ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php 
                                                            $noCount = 1;
                                                            foreach($permits_list as $pl)
                                                            {
                                                            ?>
                                                                <tr>
                                                                    <td><?=$noCount++?></td>
                                                                    <td><?=$pl->permit_issuance_serialno?></td>
                                                                    <td><?=!empty($pl->permit_issuance_date) ? datelocal($pl->permit_issuance_date) : 'None' ?></td>
                                                                    <td><?=!empty($pl->permit_issuance_expirydate) ? datelocal($pl->permit_issuance_expirydate) : 'None' ?></td>
                                                                    <td><?=ucfirst($pl->permit_officialstatus)?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th><?php echo 'Permit Number'; //$this->lang->line('user_username');   ?></th>
                                                                    <th><?php echo 'Application Date'; //$this->lang->line('user_email');   ?></th>
                                                                    <th><?php echo 'Expiry Date'; //$this->lang->line('user_username');   ?></th>
                                                                    <th><?php echo 'Status'; //$this->lang->line('user_email');   ?></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
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
                </div>
            </div>
        </div>
    </div>
    </form>

    <div class="modal fade" id="modal_history_offence_list">
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

    <form autocomplete="off" class="form-horizontal" id="frm_offence_details" action="" method="POST">
    <div class="modal fade" id="modal_add_offence">
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
foreach ($offend_list as $parent_arr) {
    ?>
                                    <optgroup label="<?=$parent_arr['type'];?>">
                                        <?php
foreach ($parent_arr['child'] as $roffence_type) {
        ?>
                                            <option value="<?=$roffence_type->offendlist_id;?>" title="<?=$roffence_type->offendlist_natureViolation;?>"><?=$roffence_type->offendlist_violationNo;?> - <?=$roffence_type->offendlist_regNo;?></option>
                                        <?php
}
    ?>
                                    </optgroup>
                                <?php
}
?>
                            </select>
                            <p class="help-block">Description : <span class="span_description_offence"></span></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control dp_field" name="addOffence_date"  id="addOffence_date" placeholder="">
                        </div>

                        <label for="" class="col-sm-2 control-label" style="display: none">Time</label>
                        <div class="col-sm-3" style="display: none">
                            <input type="text" class="form-control" name="addOffence_time"  id="addOffence_time" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Summon No</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="addOffence_summon"  id="addOffence_summon" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
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

    <?php echo form_open_multipart('upload/do_upload', ['class' => 'upload-image']); ?>
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
    function view_temp_table()
    {
        $('.span_table_temp_offence_details').html('');
        $('.span_table_temp_offence_loading').html('<p><img src = "<?php echo base_url(); ?>../resources/shared_img/preloader.GIF" class = "loader" /></p>');
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url("Enforcement/view_temporary_offence_detail"); ?>",
            data    : "p=1",
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
    }
    $(document).ready(function ()
    {
        /*===========================
        =            mal js            =
        ===========================*/

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
                url     : "<?php echo site_url("Enforcement/get_offence_list_table_html"); ?>",
                data    : "enc="+enc,
                cache   : false,
                // dataType: 'json',
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
                url     : "<?php echo site_url("Enforcement/remove_temporary_offence_detail"); ?>",
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
                }
            });
        });

        $('#frm_offence_details').on('submit',function(e){
            e.preventDefault();

            var $addOffence_type = $('#addOffence_type').val(),
                $addOffence_date = $('#addOffence_date').val(),
                $addOffence_time = $('#addOffence_time').val(),
                $addOffence_summon = $('#addOffence_summon').val(),
                $addOffence_location = $('#addOffence_location').val(),
                $addOffence_notes = $('#addOffence_notes').val();

            if($addOffence_type == '')
            {
                alert('Please select offence type!');
                return false;
            }

            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url("Enforcement/add_temporary_offence_detail"); ?>",
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
            var txt = $("#addOffence_type").select2("data");//.find(":selected").data("txt");
            var show_txt = txt[0].title;//
            $('.span_description_offence').html(show_txt.replace(/[\t\n]+/g, ' '));
        });

        $('#btn_add_offence').on('click',function(){
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
                url     : "<?php echo site_url("ServiceCharges/get_charge_type_info"); ?>",
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

        var tables2 = $("#mytable2").DataTable({
            responsive: true,
            columnDefs:[
                { targets: 'no-sort', orderable: false }
            ]

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



