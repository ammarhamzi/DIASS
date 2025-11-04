<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
<ol class="breadcrumb">
  <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
  <li><a href="<?php echo site_url('avpchecklist');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('avpchecklist');?> <?php echo $this->lang->line('list');?></a></li>
  <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('avpchecklist');?> <?php echo $this->lang->line('detail');?></li>
</ol>

<!--parentchildmenu-->

<div class="panel panel-info">
  <div class="panel-heading">
      <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('avpchecklist');?> <?php echo $this->lang->line('detail');?></h4>
  </div>
  <div class="panel-body">
      <table class="table table-condensed table-responsive">

         
       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('avpchecklist_group');?></th>
         <td class="col-md-9"><?php echo $avpchecklist_group; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('avpchecklist_name');?></th>
         <td class="col-md-9"><?php echo $avpchecklist_name; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('avpchecklist_desc');?></th>
         <td class="col-md-9"><?php echo $avpchecklist_desc; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('avpchecklist_required');?></th>
         <td class="col-md-9"><?php echo $avpchecklist_required; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('avpchecklist_checked');?></th>
         <td class="col-md-9"><?php echo $avpchecklist_checked; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('avpchecklist_mtwchecked');?></th>
         <td class="col-md-9"><?php echo $avpchecklist_mtwchecked; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('avpchecklist_permit_id');?></th>
         <td class="col-md-9"><?php echo $avpchecklist_permit_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('avpchecklist_mtwchecklist_id');?></th>
         <td class="col-md-9"><?php echo $avpchecklist_mtwchecklist_id; ?></td>
       </tr>

      </table>
      
<a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

<a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
   </div>
   </div>
   </div>
