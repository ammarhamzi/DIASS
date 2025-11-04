<script src="<?php echo base_url('../resources/shared_js/jquery/2.1.4/dist/jquery.min.js'); ?>" crossorigin="anonymous"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>" crossorigin="anonymous">

<!-- Optional theme -->
<!--<link rel="stylesheet" href="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/css/bootstrap-theme.min.css'); ?>" crossorigin="anonymous">-->

<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo base_url('../resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>" crossorigin="anonymous"></script>
<!-- display status message -->
<div class="container-fluid">
<p>
    <?php echo $this->session->flashdata('statusMsg'); ?>
</p>

<!-- file upload form -->
<form autocomplete="off" method="post" action="" enctype="multipart/form-data">
    <?php 
    if($processtype == 'adp_requireddoc')
    {
    ?>
    <!-- <div class="form-group">
        <label>Copy of IC/Passport *</label>
        <input class="form-control input-sm" type="file" name="files[]" />
        <input type="hidden" name="files_name[]" value="Copy of IC/Passport" />
    </div> -->
    <div class="form-group">
        <label>Driving License (JPJ/International) *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Driving License (JPJ/International)" />
    </div>
    <div class="form-group">
        <label>Airport Pass *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="KLIA/KLIA2 Airport Pass" />
    </div>
    <div class="form-group">
        <label>Supporting letter from employer * </label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Supporting letter from employer" />
    </div>
    <div class="form-group">
        <label>Special Equipment support documents</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Special Equipment support documents" />
    </div>
    <div class="form-group">
        <label>Working Permit (Foreigner)</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Working Permit (Foreigner)" />
    </div>
    <?php 
    }
    else if($processtype == 'evdp_requireddoc')
    {
    ?>
    <div class="form-group">
        <label>Copy of IC/Passport *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Copy of IC/Passport" />
    </div>
    <div class="form-group">
        <label>Driving License (JPJ/International) *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Driving License (JPJ/International)" />
    </div>
    <div class="form-group">
        <label>Airport Pass *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="KLIA/KLIA2 Airport Pass" />
    </div>
    <div class="form-group">
        <label>Supporting letter from employer * </label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Supporting letter from employer" />
    </div>
    <div class="form-group">
        <label>Special Equipment support documents</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Special Equipment support documents" />
    </div>
    <div class="form-group">
        <label>Working Permit (Foreigner)</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Working Permit (Foreigner)" />
    </div>
    <?php
    }
    else if($processtype == 'avp_requireddoc')
    {
    ?>
    <div class="form-group">
        <label>Letter of employer/owner * </label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Letter of employer/owner" />
    </div>
    <div class="form-group">
        <label>Letter of award/contract * </label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Letter of award/contract" />
    </div>
    <div class="form-group">
        <label>Registration card/proof of purchase *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Registration card/proof of purchase" />
    </div>
    <div class="form-group">
        <label>Previous Vehicle Service Sheet or PUSPAKOM Cert *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Previous Vehicle Service Sheet or PUSPAKOM Cert" />
    </div>
    <div class="form-group">
        <label>Perakuan kelayakan mesin angkat (PMA) *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Perakuan kelayakan mesin angkat (PMA)" />
    </div>
    <?php
    }
    else if($processtype == 'evp_requireddoc')
    {
    ?>
    <div class="form-group">
        <label>Letter of employer/owner * </label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Letter of employer/owner" />
    </div>
    <div class="form-group">
        <label>Registration card/proof of purchase *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Registration card/proof of purchase" />
    </div>
    <div class="form-group">
        <label>Previous Vehicle Service Sheet or PUSPAKOM Cert *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Previous Vehicle Service Sheet or PUSPAKOM Cert" />
    </div>
    <div class="form-group">
        <label>Perakuan kelayakan mesin angkat (PMA) *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Perakuan kelayakan mesin angkat (PMA)" />
    </div>
    <?php
    }
    else if($processtype == 'wip_requireddoc')
    {
    ?>
    <div class="form-group">
        <label>Letter of employer/owner * </label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Letter of employer/owner" />
    </div>
    <div class="form-group">
        <label>Letter of award/contract * </label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Letter of award/contract" />
    </div>
    <div class="form-group">
        <label>Registration card/proof of purchase *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Registration card/proof of purchase" />
    </div>
    <div class="form-group">
        <label>Previous Vehicle Service Sheet or PUSPAKOM Cert *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Previous Vehicle Service Sheet or PUSPAKOM Cert" />
    </div>
    <div class="form-group">
        <label>Perakuan kelayakan mesin angkat (PMA) *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Perakuan kelayakan mesin angkat (PMA)" />
    </div>
    <?php
    }
    else if($processtype == 'wipbriefing_requireddoc')
    {
    ?>
    <div class="form-group">
        <label>Letter of employer/owner * </label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Letter of employer/owner" />
    </div>
    <div class="form-group">
        <label>Registration card/proof of purchase *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Registration card/proof of purchase" />
    </div>
    <div class="form-group">
        <label>Previous Vehicle Service Sheet or PUSPAKOM Cert *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Previous Vehicle Service Sheet or PUSPAKOM Cert" />
    </div>
    <div class="form-group">
        <label>Perakuan kelayakan mesin angkat (PMA) *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Perakuan kelayakan mesin angkat (PMA)" />
    </div>
    <?php
    }
    else if($processtype == 'cs_requireddoc')
    {
    ?>
    <div class="form-group">
        <label>Letter of employer/owner * </label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Letter of employer/owner" />
    </div>
    <div class="form-group">
        <label>Registration card/proof of purchase *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Registration card/proof of purchase" />
    </div>
    <div class="form-group">
        <label>Previous Vehicle Service Sheet or PUSPAKOM Cert *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Previous Vehicle Service Sheet or PUSPAKOM Cert" />
    </div>
    <div class="form-group">
        <label>Perakuan kelayakan mesin angkat (PMA) *</label>
        <input class="form-control input-sm" type="file" name="files[]" accept="<?=_ACCEPT_FILE_TYPE?>" />
        <input type="hidden" name="files_name[]" value="Perakuan kelayakan mesin angkat (PMA)" />
    </div>
    <?php
    }
    else 
    {
    ?>
    <div class="form-group">
        <label>Choose files to upload.</label>
        <input class="form-control" type="file" name="files[]" multiple/>
    </div>
    <?php 
    }
    ?>
    <div class="form-group">
        <p class="help-block alert alert-warning">
            Allowed maximum file size for uploading is 3Mb<br />
            Allowed file types for uploading:<br />
            &nbsp;- Image files (*..jpg, *.jpeg & *.png)<br />
            &nbsp;- Document files (.pdf, *.ppt &.doc)<br />
        </p>
        <!-- <ol>
            <li><span style="font-size: small">Maximum file size is 1Mb</span></li>
            <li><span style="font-size: small">Supported file format: .pdf,.doc,.docx,.jpg,.jpeg,.png,.odt</span></li>
        </ol> -->
        <input type="submit" name="fileSubmit" value="UPLOAD" class="btn btn-primary" />
    </div>
</form>

<!-- display uploaded images -->
<?php
if(isset($show_image)){

if(!empty($files)){ foreach($files as $file){
$ids[] = $file['uploadfiles_id'];
?>
    <img src="<?php echo base_url('uploads/files/'.$file['uploadfiles_filename']); ?>" height="100" width="100">
    <?php
}}else{
$ids[] = '';
?>
        <p><img src="<?=base_url()?>/../resources/shared_img/DIASS-default-user-photo.png" width="100" height="100" alt=""></p>
        <?php
}
}else{
/*if(isset($deleteme)){
echo $deleteme.'<-------------------------deleteme';
}*/
?>
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($filelist)){
?>
            <table class="table">
                <tr>
                    <td>File Name</td>
                    <td>Document Name</td>
                    <!--<td>Type</td>-->
                    <td style="text-align:center">Delete</td>
                </tr>

                <?php

        if(!empty($files)){ foreach($files as $file){
          $filename = explode("--", $file['uploadfiles_filename']);
          $ids[] = $file['uploadfiles_id'];
         ?>
                    <tr>
                        <td>
                            <a href="<?php echo $this->config->item('base_url'); ?>/uploads/files/<?php echo $file['uploadfiles_filename']; ?>" target="_blank"><?php echo $filename[1]; ?></a>
                        </td>
                        <td>
                            <!--<?php echo $file['uploadfiles_filesize']; ?>KB-->
                            <?php 
                            if($processtype == 'adp_requireddoc')
                            {
                            ?>
                              <?php echo $file['uploadfiles_docname']; ?>
                            <?php 
                            }
                            else if($processtype == 'evdp_requireddoc')
                            {
                            ?>
                              <?php echo $file['uploadfiles_docname']; ?>
                            <?php 
                            }
                            else if($processtype == 'avp_requireddoc')
                            {
                            ?>
                              <?php echo $file['uploadfiles_docname']; ?>
                            <?php 
                            }
                            else if($processtype == 'evp_requireddoc')
                            {
                            ?>
                              <?php echo $file['uploadfiles_docname']; ?>
                            <?php 
                            }
                            else if($processtype == 'wip_requireddoc' || $processtype == 'wipbriefing_requireddoc' || $processtype == 'cs_requireddoc')
                            {
                            ?>
                              <?php echo $file['uploadfiles_docname']; ?>
                            <?php 
                            }
                            else 
                            {
                            ?>
                           <select id="<?php echo $file['uploadfiles_id'];?>" class="updatedme" readonly="">
                               <option value=''>-select-</option>
                               <?php
                               foreach ($filelist as $list){
                                ?>
                               <option value='<?php echo $list;?>' <?php echo ($file['uploadfiles_docname']==$list?"selected":"");?>><?php echo $list;?></option>
                                <?php
                               }
                               ?>
                            </select>
                            <?php 
                            }
                            ?>
                            <span style="color:green" id="<?php echo $file['uploadfiles_id'];?>_notice"></span>
                            </td>
                        <td style="text-align:center">
                            <!-- <a href="<?php //echo current_url();?>/<?php //echo $file['uploadfiles_id']; ?>"> X </a> -->
                            <a onclick="remove_file('<?php echo $file['uploadfiles_id']; ?>',this)" href="javascript:void(0);"> X </a>
                        </td>
                    </tr>
                    <?php } }else{
        $ids[] = '';
        ?>
                    <tr>
                        <td colspan="3">File(s) not found.....
                            <td>
                    </tr>
                    <?php }

         ?>
            </table>
<?php
                }else{
?>
            <table class="table">
                <tr>
                    <td>File Name</td>
                    <td style="text-align:center">Delete</td>
                </tr>

                <?php

        if(!empty($files)){ foreach($files as $file){
          $filename = explode("--", $file['uploadfiles_filename']);
          $ids[] = $file['uploadfiles_id'];
         ?>
                    <tr>
                        <td>
                            <a href="<?php echo $this->config->item('base_url'); ?>/uploads/files/<?php echo $file['uploadfiles_filename']; ?>" target="_blank"><?php echo $filename[1]; ?></a>
                        </td>
                        <td style="text-align:center">
                            <a href="<?php echo current_url();?>/<?php echo $file['uploadfiles_id']; ?>"> X </a>
                        </td>
                    </tr>
                    <?php } }else{
        $ids[] = '';
        ?>
                    <tr>
                        <td colspan="2">File(s) not found.....
                            <td>
                    </tr>
                    <?php }

         ?>
            </table>
<?php
                }
                ?>


            </div>

        </div>
        <?php
}

$json_ids = json_encode($ids);
?>
</div>
            <!--<div class="row">
    <ul class="gallery">
        <?php if(!empty($files)){ foreach($files as $file){ ?>
        <li class="item">
            <img src="<?php echo base_url('uploads/files/'.$file['uploadfiles_filename']); ?>" >
            <p>Uploaded On <?php echo date("j M Y",strtotime($file['uploadfiles_created_at'])); ?></p>
        </li>
        <?php } }else{ ?>
        <p>Image(s) not found.....</p>
        <?php } ?>
    </ul>
</div>-->
            <script>
              function remove_file(idd,ahref)
              {
                if(idd == '')
                {
                  return false;
                }
                $.ajax({
                  type: "POST",
                  dataType: 'json',
                  url: "<?php echo site_url() ?>uploadfiles/remove_file/"+idd,
                  success: function(data) {
                    $(ahref).parent().parent().remove();
                  },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus + ': ' + errorThrown);
                        $("#"+currentId+"_notice").html(textStatus);
                    }
                  });
              }
                $(document).ready(function() {


                    $(".updatedme").change(function () {
                    var currentId = $(this).attr('id');
                    var currentValue = $( "#"+currentId+" option:selected" ).val();
                      //alert(currentValue);
                     $.ajax({
                     	type: "POST",
                          dataType: '',//jika result sbg string
                     	data: {
                     		'id' : currentId,
                     		'updatethis' : currentValue
                     	},
                     	url: "<?php echo base_url() ?>uploadfiles/file_updatedocname/",
                     	success: function(data) {
                          $("#"+currentId+"_notice").html('update!');
                     	},
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus + ': ' + errorThrown);
                            $("#"+currentId+"_notice").html(textStatus);
                        }
                        		});
                    });

                    parent.getuploadfiles('<?php echo $processtype;?>', <?php echo $json_ids;?>);
                });
            </script>