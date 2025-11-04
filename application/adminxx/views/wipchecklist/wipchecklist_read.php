<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
<ol class="breadcrumb">
  <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
  <li><a href="<?php echo site_url('wipchecklist');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('wipchecklist');?> <?php echo $this->lang->line('list');?></a></li>
  <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('wipchecklist');?> <?php echo $this->lang->line('detail');?></li>
</ol>

<!--parentchildmenu-->

<div class="panel panel-info">
  <div class="panel-heading">
      <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('wipchecklist');?> <?php echo $this->lang->line('detail');?></h4>
  </div>
  <div class="panel-body">
      <table class="table table-condensed table-responsive">

         
       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('wipchecklist_group');?></th>
         <td class="col-md-9"><?php echo $wipchecklist_group; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('wipchecklist_name');?></th>
         <td class="col-md-9"><?php echo $wipchecklist_name; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('wipchecklist_desc');?></th>
         <td class="col-md-9"><?php echo $wipchecklist_desc; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('wipchecklist_required');?></th>
         <td class="col-md-9"><?php echo $wipchecklist_required; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('wipchecklist_checked');?></th>
         <td class="col-md-9"><?php echo $wipchecklist_checked; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('wipchecklist_mtwchecked');?></th>
         <td class="col-md-9"><?php echo $wipchecklist_mtwchecked; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('wipchecklist_permit_id');?></th>
         <td class="col-md-9"><?php echo $wipchecklist_permit_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('wipchecklist_mtwchecklist_id');?></th>
         <td class="col-md-9"><?php echo $wipchecklist_mtwchecklist_id; ?></td>
       </tr>

      </table>
      
<a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

<a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
   </div>
   </div>
   </div>
