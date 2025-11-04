
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('config'); ?> </li>
    </ol>
    <div class="row">
        <div class="col-md-12 text-center">
            <div id="message" style=" position: fixed;right: 25px;">
                <?php
echo $this->session->userdata('message') != '' ? '<span class="alert alert-success" role="alert">' . $this->session->userdata('message') . '</span>'
: '';
?>
            </div>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('config'); ?> </h4>
        </div>
        <div class="panel-body">


            <form autocomplete="off" action="<?php echo $action; ?>" method="post">

                <div class="row">
                    <label class="col-md-3 text-right">
<?php echo $this->lang->line('admintitle_long'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('admintitle_long'); ?>
                    </label>
                    <div class="col-md-9">

                        <textarea name="admintitle_long" id="admintitle_long" placeholder="<?php echo $this->lang->line('admintitle_long'); ?>" style="width:100%;" maxlength="200" rows="5" class="richtexteditor"><?php echo $admintitle_long; ?></textarea>
                                 </div>
                </div>

                <div class="row">
                    <label class="col-md-3 text-right">
<?php echo $this->lang->line('admintitle_short'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('admintitle_short'); ?>
                    </label>
                    <div class="col-md-9">
                        <textarea name="admintitle_short" id="admintitle_short" placeholder="<?php echo $this->lang->line('admintitle_short'); ?>" style="width:100%;" maxlength="200" rows="5" class="richtexteditor"><?php echo $admintitle_short; ?></textarea>
                                 </div>
                </div>

                <div class="row">
                    <label class="col-md-3 text-right">
<?php echo $this->lang->line('copyright_notice'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('copyright_notice'); ?>
                    </label>
                    <div class="col-md-9">
                        <textarea name="copyright_notice" id="copyright_notice" placeholder="<?php echo $this->lang->line('copyright_notice'); ?>" style="width:100%;" maxlength="200" rows="5" class="richtexteditor"><?php echo $copyright_notice; ?></textarea>
                                 </div>
                </div>

                <div class="row">
                    <label class="col-md-3 text-right">
<?php echo $this->lang->line('version_info'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('version_info'); ?>
                    </label>
                    <div class="col-md-9">
                        <textarea name="version_info" id="version_info" placeholder="<?php echo $this->lang->line('version_info'); ?>" style="width:100%;" maxlength="200" rows="5" class="richtexteditor"><?php echo $version_info; ?></textarea>
                                 </div>
                </div>

                <div class="row">
                    <label class="col-md-3 text-right">
<?php echo $this->lang->line('authentication'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('authentication'); ?>
                    </label>
                    <div class="col-md-9">
                        <select class="form-control select2" name="authentication" id="authentication">


                            <option value="y" <?php echo ($authentication === "y"
    ? 'selected="selected"' : "");
?>>Yes</option>
                            <option value="n" <?php echo ($authentication === "n"
    ? 'selected="selected"' : "");
?>>No</option>
                        </select>
                                 </div>
                </div>
                <div class="row">
                    <label class="col-md-3 text-right">
<?php echo $this->lang->line('theme'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('theme'); ?>
                    </label>
                    <div class="col-md-9">
                        <select class="form-control select2" name="theme" id="theme">


                            <option value="basic" <?php echo ($theme === "basic"
    ? 'selected="selected"' : "");
?>>Basic Bootstrap</option>
                            <option value="adminlte" <?php echo ($theme === "adminlte"
    ? 'selected="selected"' : "");
?>>AdminLTE</option>
                            <option value="bscore" <?php echo ($theme === "bscore"
    ? 'selected="selected"' : "");
?> disabled>BS Admin BCore</option>
                        </select>
                                 </div>
                </div>
                <div class="row">
                    <label class="col-md-3 text-right">
                                    <?php echo $this->lang->line('language'); ?> <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('language'); ?>
                    </label>
                    <div class="col-md-9">
                        <select class="form-control select2" name="language" id="language">


                            <option value="english" <?php echo ($language === "english"
    ? 'selected="selected"' : "");
?>>English</option>
                            <option value="malay" <?php echo ($language === "malay"
    ? 'selected="selected"' : "");
?>>Malay</option>
                        </select>
                                 </div>
                </div>

                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?php echo $button; ?></button>

                    </div>
                </div>
            </form>
        </div></div></div>

<script>
$(document).ready(function ()
  {
    setTimeout(function ()
      {
        $('.alert').fadeOut(400);
      }, 4000
    );
  }
);
</script>
