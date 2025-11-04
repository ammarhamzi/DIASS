<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
<ol class="breadcrumb">
  <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
  <li><a href="<?php echo site_url('shinspermit');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('shinspermit');?> <?php echo $this->lang->line('list');?></a></li>
  <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('shinspermit');?> <?php echo $this->lang->line('detail');?></li>
</ol>

<!--parentchildmenu-->

<div class="panel panel-info">
  <div class="panel-heading">
      <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('shinspermit');?> <?php echo $this->lang->line('detail');?></h4>
  </div>
  <div class="panel-body">
      <table class="table table-condensed table-responsive">

         
       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_permit_id');?></th>
         <td class="col-md-9"><?php echo $shinspermit_permit_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_vehicle_id');?></th>
         <td class="col-md-9"><?php echo $shinspermit_vehicle_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_required_briefing');?></th>
         <td class="col-md-9"><?php echo $shinspermit_required_briefing; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_attendbriefing');?></th>
         <td class="col-md-9"><?php echo $shinspermit_attendbriefing; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_approved_to_inspect');?></th>
         <td class="col-md-9"><?php echo $shinspermit_approved_to_inspect; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_ownchecked_by');?></th>
         <td class="col-md-9"><?php echo $shinspermit_ownchecked_by; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_ownchecked_date');?></th>
         <td class="col-md-9"><?php echo $shinspermit_ownchecked_date; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_ownverified_by');?></th>
         <td class="col-md-9"><?php echo $shinspermit_ownverified_by; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_ownverified_date');?></th>
         <td class="col-md-9"><?php echo $shinspermit_ownverified_date; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_result');?></th>
         <td class="col-md-9"><?php echo $shinspermit_result; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_result_inspector_id');?></th>
         <td class="col-md-9"><?php echo $shinspermit_result_inspector_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_inspection_date');?></th>
         <td class="col-md-9"><?php echo $shinspermit_inspection_date; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_retest_result');?></th>
         <td class="col-md-9"><?php echo $shinspermit_retest_result; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_retest_result_inspector_id');?></th>
         <td class="col-md-9"><?php echo $shinspermit_retest_result_inspector_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_retest_inspection_date');?></th>
         <td class="col-md-9"><?php echo $shinspermit_retest_inspection_date; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_managerverified_id');?></th>
         <td class="col-md-9"><?php echo $shinspermit_managerverified_id; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_managerverified_date');?></th>
         <td class="col-md-9"><?php echo $shinspermit_managerverified_date; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_recent_shins_serialno');?></th>
         <td class="col-md-9"><?php echo $shinspermit_recent_shins_serialno; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_recent_shins_expirydate');?></th>
         <td class="col-md-9"><?php echo $shinspermit_recent_shins_expirydate; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_recent_shins_typecolor');?></th>
         <td class="col-md-9"><?php echo $shinspermit_recent_shins_typecolor; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_completed_docs');?></th>
         <td class="col-md-9"><?php echo $shinspermit_completed_docs; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_inspectionscheduled');?></th>
         <td class="col-md-9"><?php echo $shinspermit_inspectionscheduled; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('shinspermit_inspectionapproval');?></th>
         <td class="col-md-9"><?php echo $shinspermit_inspectionapproval; ?></td>
       </tr>

      </table>
      
<a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

<a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
   </div>
   </div>
   </div>
