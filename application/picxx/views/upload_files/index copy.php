<script src="<?php echo base_url('resources/shared_js/jquery/2.1.4/dist/jquery.min.js'); ?>" crossorigin="anonymous"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/bootstrap/css/bootstrap.min.css'); ?>" crossorigin="anonymous">

<!-- Optional theme -->
<!--<link rel="stylesheet" href="<?php echo base_url('resources/themes/AdminLTE/bootstrap/css/bootstrap-theme.min.css'); ?>" crossorigin="anonymous">-->

<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo base_url('resources/themes/AdminLTE/bootstrap/js/bootstrap.min.js'); ?>" crossorigin="anonymous"></script>
<!-- display status message -->
<div class="container-fluid">
<p>
    <?php echo $this->session->flashdata('statusMsg'); ?>
</p>

<!-- file upload form -->
<form autocomplete="off" method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label>Choose Files</label>
        <input class="form-control" type="file" name="files[]" multiple/>
    </div>

    <div class="form-group">
        <label>Choose Files</label>
        <input class="form-control" type="file" name="files[]" multiple/>
    </div>
    <div class="form-group">
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
        <p><img src="/resources/shared_img/DIASS-default-user-photo.png" width="100" height="100" alt=""></p>
        <?php
}
}else{
/*if(isset($deleteme)){
echo $deleteme.'<-------------------------deleteme';
}*/
?>
        <div class="row">
            <div class="col-md-2">
                <?php
                if(isset($filelist)){
?>
            <table class="table">
                <tr>
                    <td>File Name</td>
                    <td>Document Name</td>
                    <!--<td>Type</td>-->
                    <td>Delete</td>
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
                           <select id="<?php echo $file['uploadfiles_id'];?>" class="updatedme">
                               <option value=''>-select-</option>
                               <?php
                               foreach ($filelist as $list){
                                ?>
                               <option value='<?php echo $list;?>' <?php echo ($file['uploadfiles_docname']==$list?"selected":"");?>><?php echo $list;?></option>
                                <?php
                               }
                               ?>
                           </select><span style="color:green" id="<?php echo $file['uploadfiles_id'];?>_notice"></span>
                            </td>
                        <td style="text-align:center">
                            <a href="<?php echo current_url();?>/<?php echo $file['uploadfiles_id']; ?>"> X </a>
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
                    <td>Delete</td>
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
                        <td colspan="3">File(s) not found.....
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