<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li><a href="<?php echo site_url('ServiceCharges'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('service_charges'); ?> <?php echo $this->lang->line('list'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('form'); ?> <?php echo $button; ?></li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('service_charges'); ?> <?php echo $button; ?></h4>
        </div>
        <div class="panel-body">


            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo $action; ?>" method="post">

                        <?php if($this->session->userdata('message_show') != ''){ ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?=$this->session->userdata('message_show')?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row col-md-12">
                            <h6 class="pull-right"><?php echo $this->lang->line('legend'); ?> <span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span> <?php echo $this->lang->line('required_field'); ?></h6>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <h4>Detail of Charges</h4>
                                <div class="row">
                                    <label class="col-md-3 text-right">
                                        <?php echo 'Charge Types';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('ct_ids'); ?>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="ct_ids" id="ct_ids" required="">
                                            <option value="">-SELECT-</option>
                                            <?php
                                            foreach ($charges_types_list as $value) 
                                            {
                                                ?>
                                                <option value="<?php echo $value->ct_id; ?>" <?php echo (($value->ct_id == $ct_ids) ? 'selected="selected"' : "");?>><?php echo $value->name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <p class="help-block">Description : <span id="span_ct_description"></span></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-3 text-right">
                                        <?php echo 'Quantity';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('qty'); ?>
                                    </label>
                                    <div class="col-md-9"><input type="number" min="0" class="form-control" name="qty" id="qty" placeholder="<?php //echo 'Flight Number';//$this->lang->line('user_username'); ?>"value="<?php echo $qty; ?>" required="" />         
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-3 text-right">
                                        <?php echo 'Flight / Aircraft / Vehicle Number';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('flight_number'); ?>
                                    </label>
                                    <div class="col-md-9"><input type="text" class="form-control" name="flight_number" id="flight_number" placeholder="<?php echo 'Flight / Aircraft / Vehicle Number';//$this->lang->line('user_username'); ?>"value="<?php echo $flight_number; ?>" required="50" />         
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-3 text-right">
                                        <?php echo 'Reason';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('reason'); ?>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="reason" id="reason" required="" rows="4"><?php echo $reason; ?></textarea>      
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-3 text-right">
                                        <?php echo 'Notes';//$this->lang->line('user_username'); ?> 
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="notes" id="notes"  rows="4"><?php echo $notes; ?></textarea>      
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 text-right">
                                        <?php echo 'Payment Location';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('paymentLocation'); ?>
                                    </label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <label><input type="radio" name="paymentLocation" value="KLIA" <?=($paymentLocation == 'KLIA' || empty($paymentLocation)) ? 'checked=""' : '' ?>>KLIA</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="paymentLocation" value="KLIA2" <?=($paymentLocation == 'KLIA2') ? 'checked=""' : '' ?>>KLIA2</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 text-right">
                                        <?php echo 'Payment Method';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('paymentMethod'); ?>
                                    </label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <label><input type="radio" name="paymentMethod" value="1" <?=($paymentMethod == 1 || empty($paymentMethod)) ? 'checked=""' : '' ?>>Cash</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="paymentMethod" value="2" <?=($paymentMethod == 2) ? 'checked=""' : '' ?>>Cheque</label>
                                        </div>
                                        <div class="radio ">
                                            <label><input type="radio" name="paymentMethod" value="3" <?=($paymentMethod == 3) ? 'checked=""' : '' ?>>Credit Facilities</label>
                                        </div>
                                        <div class="radio ">
                                            <label><input type="radio" name="paymentMethod" value="4" <?=($paymentMethod == 4) ? 'checked=""' : '' ?>>Free of Charges</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <label class="col-md-3 text-right">
                                            <?php echo 'Payment Date';//$this->lang->line('user_username'); ?> 
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control dp_field" name="payment_date_field" id="payment_date_field" placeholder="<?php echo '';//$this->lang->line('user_username'); ?>"value="<?php echo $payment_date_field; ?>" />         
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-3 text-right">
                                            <?php echo 'Payment Time';//$this->lang->line('user_username'); ?> 
                                        </label>
                                        <div class="col-md-9">
                                            <input type="time" class="form-control" name="payment_time_field" id="payment_time_field" placeholder="<?php echo '';//$this->lang->line('user_username'); ?>"value="<?php echo $payment_time_field; ?>" />         
                                        </div>
                                    </div>

                                <span style="display: none;">
                                    <hr  />
                                    <h4>Original Form</h4>
                                    <div class="uploadrestrict">Only if the original signed form is required.</div>
                                    <div class="row">
                                        <label class="col-md-3 text-right">
                                            <?php echo 'Upload';//$this->lang->line('user_username'); ?> <?php echo form_error('uploads'); ?>
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-remote-file">Browse … </span>
                                                </span>
                                                <input type="text" multiple class="form-control display_user_photo" value="<?php echo (isset($uploads) ? $uploads : ""); ?>" readonly>
                                                <input type="hidden" name="file_arr" id="file_arr" value="">
                                            </div>    
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 text-right">
                                            <h6>New Uploaded File : </h6>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="well div_uploaded_status">No File Uploaded</div>
                                        </div>
                                    </div>

                                    <?php /* if(!empty($file_list_html)){ ?>
                                    <div class="row">
                                        <div class="col-md-3 text-right">
                                            <h6>File : </h6>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="well div_uploaded_status"><?=$file_list_html?></div>
                                        </div>
                                    </div>
                                    <?php } */ ?>
                                </span>
                                

                            </div>

                            <div class="col-md-5">
                                <h4>Requestor</h4>

                                <div class="row">
                                    <label class="col-md-4 text-right">
                                        <?php echo 'Company Name';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('req_company_name'); ?>
                                    </label>
                                    <div class="col-md-8"><input type="text" class="form-control" name="req_company_name" id="req_company_name" placeholder="<?php //echo 'Flight Number';//$this->lang->line('user_username'); ?>"value="<?php echo $req_company_name; ?>" maxlength="50" />         
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-4 text-right">
                                        <?php echo 'Name';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('requestor_txt'); ?>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="requestor_txt" id="requestor_txt" placeholder="<?php echo '';//$this->lang->line('user_username'); ?>"value="<?php echo $requestor_txt; ?>" maxlength="50" />       
                                            <?php /* ?>
                                            <select class="form-control select2" name="requestor_id" id="requestor_id">
                                                <option value="">-SELECT-</option>
                                                <?php
                                                foreach ($usergroup as $value) 
                                                {
                                                    ?>
                                                    <option value="<?php echo $value->usergroup_id; ?>" <?php echo (in_array($value->usergroup_id, $user_groupid) ? 'selected="selected"'
                                                    : "");?>><?php echo $value->usergroup_name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <?php */ ?>       
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 text-right">
                                            <?php echo 'Designation';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('designation_field'); ?>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="designation_field" id="designation_field" placeholder="<?php echo '';//$this->lang->line('user_username'); ?>"value="<?php echo $designation_field; ?>" />         
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 text-right">
                                            <?php echo 'Date';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('date_field'); ?>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control dp_field" name="date_field" id="date_field" placeholder="<?php echo '';//$this->lang->line('user_username'); ?>"value="<?php echo $date_field; ?>" />         
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 text-right">
                                            <?php echo 'Time';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('time_field'); ?>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="time" class="form-control" name="time_field" id="time_field" placeholder="<?php echo '';//$this->lang->line('user_username'); ?>"value="<?php echo $time_field; ?>" />         
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 text-right">
                                            <?php echo 'Phone No';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('req_phoneNo'); ?>
                                        </label>
                                        <div class="col-md-8"><input type="text" class="form-control" name="req_phoneNo" id="req_phoneNo" placeholder="<?php //echo 'Flight Number';//$this->lang->line('user_username'); ?>"value="<?php echo $req_phoneNo; ?>" maxlength="50" />         
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 text-right">
                                            <?php echo 'Email';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('req_email'); ?>
                                        </label>
                                        <div class="col-md-8"><input type="text" class="form-control" name="req_email" id="req_email" placeholder="<?php //echo 'Flight Number';//$this->lang->line('user_username'); ?>"value="<?php echo $req_email; ?>" maxlength="50" />         
                                        </div>
                                    </div>

                                    <div style="display: none;">
                                    <hr>
                                    <h4>Person in Charge</h4>

                                    <div class="row">
                                        <label class="col-md-4 text-right">
                                            <?php echo 'Name';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('pic_name'); ?>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="pic_name" id="pic_name" placeholder="<?php //echo 'Flight Number';//$this->lang->line('user_username'); ?>"value="<?php echo $pic_name; ?>" maxlength="50" />   
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 text-right">
                                            <?php echo 'Address';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup>  <?php echo form_error('pic_address'); ?>
                                        </label>
                                        <div class="col-md-8"><input type="text" class="form-control" name="pic_address" id="pic_address" placeholder="<?php //echo 'Flight Number';//$this->lang->line('user_username'); ?>"value="<?php echo $pic_address; ?>" maxlength="50" />         
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 text-right">
                                            <?php echo 'Phone No';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup>  <?php echo form_error('pic_phoneNo'); ?>
                                        </label>
                                        <div class="col-md-8"><input type="text" class="form-control" name="pic_phoneNo" id="pic_phoneNo" placeholder="<?php //echo 'Flight Number';//$this->lang->line('user_username'); ?>"value="<?php echo $pic_phoneNo; ?>" maxlength="50" />         
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 text-right">
                                            <?php echo 'Email';//$this->lang->line('user_username'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup>  <?php echo form_error('pic_email'); ?>
                                        </label>
                                        <div class="col-md-8"><input type="text" class="form-control" name="pic_email" id="pic_email" placeholder="<?php //echo 'Flight Number';//$this->lang->line('user_username'); ?>"value="<?php echo $pic_email; ?>" maxlength="50" />         
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <input type="hidden" name="sc_id" value="<?php echo (isset($id) ? $id : ""); ?>" />
                                    <button type="submit" class="btn btn-primary">  <!-- <span class="glyphicon glyphicon-save" aria-hidden="true"></span> -->
                                        &nbsp;&nbsp;&nbsp; <?php echo 'Submit';//$button; ?>&nbsp;&nbsp;&nbsp;
                                    </button>
                                    <a href="<?php echo site_url('ServiceCharges'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_open_multipart('upload/do_upload',['class' => 'upload-image']); ?>
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
    $(document).ready(function ()
    {
        /*===========================
        =            mal js            =
        ===========================*/

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
                url     : "<?php echo site_url("ServiceCharges/get_charge_type_info") ?>",
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

