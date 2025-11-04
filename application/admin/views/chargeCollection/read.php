
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li><a href="<?php echo site_url('user'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('user'); ?> <?php echo $this->lang->line('list'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('user'); ?> <?php echo $this->lang->line('detail'); ?></li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('user'); ?> <?php echo $this->lang->line('detail'); ?></h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">
               <tr>
                    <th class="col-md-3 text-right"><?php echo $this->lang->line('user_username'); ?></th>
                    <td class="col-md-9"><?php echo $user_username; ?></td>
               </tr>
               <tr>
                    <th class="col-md-3 text-right"><?php echo $this->lang->line('user_name'); ?></th>
                    <td class="col-md-9"><?php echo $user_name; ?></td>
               </tr>
               <tr>
                    <th class="col-md-3 text-right"><?php echo $this->lang->line('user_email'); ?></th>
                    <td class="col-md-9"><?php echo $user_email; ?></td>
               </tr>
                <tr>
                    <th class="col-md-3 text-right"><?php echo $this->lang->line('user_photo'); ?></th>
                    <td class="col-md-9"><p><img src = "<?php echo base_url(); ?>resources/shared_img/<?php echo ($user_photo? $user_photo : 'system/no-image.jpg');?>" width="100" height="100" /></p></td>
                </tr>

               <tr>
                    <th class="col-md-3 text-right"><?php echo $this->lang->line('user_groupid'); ?></th>
                    <td class="col-md-9"><?php echo $user_groupid; ?></td>
               </tr>
            </table>

            <a href="<?php echo site_url('user'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>

