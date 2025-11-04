<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
<ol class="breadcrumb">
  <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
  <li><a href="<?php echo site_url('evppermit');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('evppermit');?> <?php echo $this->lang->line('list');?></a></li>
  <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('evppermit');?> <?php echo $this->lang->line('detail');?></li>
</ol>

<!--parentchildmenu-->

<div class="panel panel-info">
  <div class="panel-heading">
      <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('evppermit');?> <?php echo $this->lang->line('detail');?></h4>
  </div>
  <div class="panel-body">
      <table class="table table-condensed table-responsive">

         
       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_permit_id');?></th>
         <td class="col-md-9"><?php echo $evppermit_permit_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_vehicle_id');?></th>
         <td class="col-md-9"><?php echo $evppermit_vehicle_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_required_briefing');?></th>
         <td class="col-md-9"><?php echo $evppermit_required_briefing; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_attendbriefing');?></th>
         <td class="col-md-9"><?php echo $evppermit_attendbriefing; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_approved_to_inspect');?></th>
         <td class="col-md-9"><?php echo $evppermit_approved_to_inspect; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_ownerauthorization');?></th>
         <td class="col-md-9"><?php echo $evppermit_ownerauthorization; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_ownerauthorization_date');?></th>
         <td class="col-md-9"><?php echo $evppermit_ownerauthorization_date; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_result');?></th>
         <td class="col-md-9"><?php echo $evppermit_result; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_result_inspector_id');?></th>
         <td class="col-md-9"><?php echo $evppermit_result_inspector_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_inspection_date');?></th>
         <td class="col-md-9"><?php echo $evppermit_inspection_date; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_managerverified_id');?></th>
         <td class="col-md-9"><?php echo $evppermit_managerverified_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_managerverified_date');?></th>
         <td class="col-md-9"><?php echo $evppermit_managerverified_date; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_recent_evp_serialno');?></th>
         <td class="col-md-9"><?php echo $evppermit_recent_evp_serialno; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_recent_evp_expirydate');?></th>
         <td class="col-md-9"><?php echo $evppermit_recent_evp_expirydate; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_completed_docs');?></th>
         <td class="col-md-9"><?php echo $evppermit_completed_docs; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('avppermit_inspectionscheduled');?></th>
         <td class="col-md-9"><?php echo $avppermit_inspectionscheduled; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('avppermit_inspectionapproval');?></th>
         <td class="col-md-9"><?php echo $avppermit_inspectionapproval; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('evppermit_lastchanged_by');?></th>
         <td class="col-md-9"><?php echo $evppermit_lastchanged_by; ?></td>
       </tr>

      </table>
      
<a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

<a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
   </div>
   </div>
   </div>
