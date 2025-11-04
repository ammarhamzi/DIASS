<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="panel panel-info">
  <div class="panel-heading">
      <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('examadpmanagement');?> <?php echo $this->lang->line('detail');?></h4>
  </div>
  <div class="panel-body">
      <table class="table table-condensed table-responsive">

         
       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('exammanagement_date');?></th>
         <td class="col-md-9"><?php echo $exammanagement_date; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('exammanagement_category');?></th>
         <td class="col-md-9"><?php echo $exammanagement_category; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('exammanagement_location');?></th>
         <td class="col-md-9"><?php echo $exammanagement_location; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('exammanagement_slot');?></th>
         <td class="col-md-9"><?php echo $exammanagement_slot; ?></td>
       </tr>

       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('exammanagement_remark');?></th>
         <td class="col-md-9"><?php echo $exammanagement_remark; ?></td>
       </tr>

      </table>
      

   </div>
   </div>
