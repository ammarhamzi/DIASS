
<div class="container-fluid">
<ol class="breadcrumb">
  <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
  <li><a href="<?php echo site_url('taskchat'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('taskchat'); ?> <?php echo $this->lang->line('list'); ?></a></li>
  <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('taskchat'); ?> <?php echo $this->lang->line('detail'); ?></li>
</ol>
<div class="panel panel-info">
  <div class="panel-heading">
      <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('taskchat'); ?> <?php echo $this->lang->line('detail'); ?></h4>
  </div>
  <div class="panel-body">
      <table class="table table-condensed table-responsive">


       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('task_id'); ?></th>
         <td class="col-md-9"><?php echo $task_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('taskchat_memberid'); ?></th>
         <td class="col-md-9"><?php echo $taskchat_memberid; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('taskchat_content'); ?></th>
         <td class="col-md-9"><?php echo $taskchat_content; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('taskchat_date'); ?></th>
         <td class="col-md-9"><?php echo $taskchat_date; ?></td>
       </tr>

      </table>

<a href="<?php echo site_url('taskchat'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
   </div>
   </div>
   </div>

