<!-- \resources\gen_template\master\crud-newpage\views -->

<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
    <li><a href="<?php echo site_url('wipinspection');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('wipinspection');?> <?php echo $this->lang->line('list');?></a></li>
    <li class="active"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('wipinspection_form');?></li>
  </ol>
  <div class="panel panel-info">
    <div class="panel-heading">
      <h4><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <?php echo $this->lang->line('wipinspection');?></h4>
    </div>
    <div class="panel-body">      
      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo $action; ?>" method="post">
            <div class="row col-md-12">
              <h5><span>Registration Number:<span> <span><strong><?php echo $vehicle_reg_no; ?></strong></span></h5>
            </div>
            <div class="row" style="padding-left:15px;">
              <!-- <div class="col-md-8">
                <div class="row col-md-12"><strong>GENERAL REQUIREMENT</strong></div>
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-bordered table-condensed table-striped">
                      <thead>
                        <tr class="success">
                          <th>Description</th>
                          <th style="width:75px" class="text-center">Declared</th>
                          <th style="width:75px" class="text-center">MTW</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Body Insignia</td>
                          <td class="text-center"><input type="checkbox"></td>
                          <td class="text-center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                          <td>Safety First Sign</td>
                          <td class="text-center"><input type="checkbox"></td>
                          <td class="text-center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                          <td>Body Insignia</td>
                          <td class="text-center"><input type="checkbox"></td>
                          <td class="text-center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                          <td>Body Insignia</td>
                          <td class="text-center"><input type="checkbox"></td>
                          <td class="text-center"><input type="checkbox"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table table-bordered table-condensed table-striped">
                      <thead>
                        <tr class="success">
                          <th>Description</th>
                          <th style="width:75px" class="text-center">Declared</th>
                          <th style="width:75px" class="text-center">MTW</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Body Insignia</td>
                          <td class="text-center"><input type="checkbox"></td>
                          <td class="text-center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                          <td>Safety First Sign</td>
                          <td class="text-center"><input type="checkbox"></td>
                          <td class="text-center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                          <td>Body Insignia</td>
                          <td class="text-center"><input type="checkbox"></td>
                          <td class="text-center"><input type="checkbox"></td>
                        </tr>
                        <tr>
                          <td>Body Insignia</td>
                          <td class="text-center"><input type="checkbox"></td>
                          <td class="text-center"><input type="checkbox"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>                
              </div> -->
              <div class="col-md-4" style="padding:0px;">
                <div class="row col-md-12"><strong>GENERAL REQUIREMENT</strong><br><span>&nbsp;</span></div>
                <div class="row col-md-12">
                  <table class="table table-bordered table-condensed table-striped">
                    <thead>
                      <tr class="success">
                        <th>Description</th>
                        <th style="width:75px" class="text-center">Declared</th>
                        <th style="width:75px" class="text-center">MTW</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        for($i=0; $i<$maxrow; $i++) {
                          if(isset($general_requirement[$i])) {
                            $requirement = $general_requirement[$i];
                      ?>
                      <tr>
                        <td><?php echo $requirement->wipchecklist_name; ?></td>
                        <td class="text-center"><input data-chktype="chk" class="inspection" type="checkbox" value="<?php echo $requirement->wipchecklist_id ?>" id="<?php echo 'chk' . $requirement->wipchecklist_id ?>" <?php if($requirement->wipchecklist_checked=='y') echo 'checked' ?>></td>
                        <td class="text-center"><input data-chktype="chkmtw" class="inspection" type="checkbox" value="<?php echo $requirement->wipchecklist_id ?>" id="<?php echo 'chkmtw' . $requirement->wipchecklist_id ?>" <?php if($requirement->wipchecklist_mtwchecked=='y') echo 'checked' ?>></td>
                      </tr>
                      <?php
                          }
                          else 
                          {
                      ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                      </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-4" style="padding:0px;">
                <div class="row col-md-12">
                  <span><strong>ADDITIONAL REQUIREMENT</strong></span><br>
                  <span style="font-size:10px;">For Vehicle operating within 5m of an aircraft only<span>
                </div>
                <div class="row col-md-12">
                  <table class="table table-bordered table-condensed table-striped">
                    <thead>
                      <tr class="success">
                        <th>Description</th>
                        <th style="width:75px" class="text-center">Declared</th>
                        <th style="width:75px" class="text-center">MTW</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        for($i=0; $i<$maxrow; $i++) {
                          if(isset($additional_requirement[$i])) {
                            $requirement = $additional_requirement[$i];
                      ?>
                      <tr>
                        <td><?php echo $requirement->wipchecklist_name; ?></td>
                        <td class="text-center"><input data-chktype="chk" class="inspection" value="<?php echo $requirement->wipchecklist_id ?>" type="checkbox" id="<?php echo 'chk' . $requirement->wipchecklist_id ?>" <?php if($requirement->wipchecklist_checked=='y') echo 'checked' ?>></td>
                        <td class="text-center"><input data-chktype="chkmtw" class="inspection" value="<?php echo $requirement->wipchecklist_id ?>" type="checkbox" id="<?php echo 'chkmtw' . $requirement->wipchecklist_id ?>" <?php if($requirement->wipchecklist_mtwchecked=='y') echo 'checked' ?>></td>
                      </tr>
                      <?php
                          }
                          else 
                          {
                      ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                      </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-4" style="padding:0px;">
                <div class="row col-md-12"><strong>SPECIAL REQUIREMENT</strong><br><span>&nbsp;</span></div><br>
                <div class="row col-md-12">
                  <table class="table table-bordered table-condensed table-striped">
                    <thead>
                      <tr class="success">
                        <th>Description</th>
                        <th style="width:75px" class="text-center">Declared</th>
                        <th style="width:75px" class="text-center">MTW</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        for($i=0; $i<$maxrow; $i++) {
                          if(isset($special_requirement[$i])) {
                            $requirement = $special_requirement[$i];
                      ?>
                      <tr>
                        <td><?php echo $requirement->wipchecklist_name; ?></td>
                        <td class="text-center"><input data-chktype="chk" class="inspection" type="checkbox" value="<?php echo $requirement->wipchecklist_id ?>" id="<?php echo 'chk' . $requirement->wipchecklist_id ?>" <?php if($requirement->wipchecklist_checked=='y') echo 'checked' ?>></td>
                        <td class="text-center"><input data-chktype="chkmtw" class="inspection" type="checkbox" value="<?php echo $requirement->wipchecklist_id ?>" id="<?php echo 'chkmtw' . $requirement->wipchecklist_id ?>" <?php if($requirement->wipchecklist_mtwchecked=='y') echo 'checked' ?>></td>
                      </tr>
                      <?php
                          }
                          else 
                          {
                      ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                      </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <?php if($button_submit) { ?>
            <div class="row form-group">
              <div class="col-md-4">
                <input id="chkcomply" name="chkcomply" type="checkbox" <?php if($inspectionapproval=='y') { echo 'checked'; } ?>> 
                <label style="font-weight:400;" for="chkcomply"><?php echo sprintf('I certify that this vehicle (%s) <strong>COMPLY</strong>', $vehicle_reg_no) ?></label>                
              </div>
              <div class="col-md-8">
                <input id="chkcomplyx" name="chkcomplyx" type="checkbox" <?php if($inspectionapproval=='n') { echo 'checked'; } ?>> 
                <label style="font-weight:400;" for="chkcomplyx"><?php echo sprintf('I certify that this vehicle (%s) <strong>DO NOT COMPLY</strong>', $vehicle_reg_no) ?></label>
              </div>
            </div>
            <div class="row col-md-12">
              <div class="form-group col-md-6" style="padding-left:0px;">
                <label for="remark">Remarks</label>
                <textarea class="form-control rounded-0" id="remark" name="remark" rows="3"><?php echo $inspection_remark; ?></textarea>
              </div>
            </div>
            <div class="row col-md-4">
              <button type="submit" id="btnSubmit" class="btn btn-primary"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Submit</button>
              <input type="hidden" id="inspection_result" name="inspection_result">
              <input type="hidden" id="permit_id" name="permit_id" value="<?php echo $permit_id ?>">
              <input type="hidden" id="wippermit_id" name="wippermit_id" value="<?php echo $wippermit_id ?>">
              <input type="hidden" id="inspection_comply" name="inspection_comply">              
            </div>
            <?php }else{ ?>  
            <div class="row form-group">
              <div class="col-md-4">
                <div class="row col-md-12">
                  <span><strong>INSPECTOR</strong></span>
                </div>
                <div class="row col-md-12"> 
                  <?php echo sprintf('Inspected by %s on %s', $inspector, date('d M Y', strtotime($inspection_date))) ?>
                </div>    
                <div class="row col-md-12"> 
                  <?php 
                    if($inspection_remark != '') { echo 'Remark: '.$inspection_remark;}
                  ?>
                </div>             
              </div>
            </div>
            <?php } ?>         
          </form>
        </div>
      </div>
      </div>
  </div>
</div>

<?php 
  $allcheckboxs = json_encode($all_requirement);
?>
<script>
// My javascript
$(document).ready(function() {
    allcheckboxs = <?php echo $allcheckboxs; ?>;
    
    $(".inspection").click(function () {
      allcheckboxs[$(this).val()][ $(this).data('chktype') ] = $(this).prop("checked");
    });

    $('#chkcomply').click(function() {
      if($(this).prop("checked")) {
        $('#chkcomplyx').prop('checked', !$(this).prop("checked"));
        $('#inspection_comply').val('y');
      }
      else {
        $('#inspection_comply').val('');
      }
    });

    $('#chkcomplyx').click(function() {
      if($(this).prop("checked")) {
        $('#chkcomply').prop('checked', !$(this).prop("checked"));
        $('#inspection_comply').val('n');
      }
      else {
        $('#inspection_comply').val('');
      }
        
    });

    $('#btnSubmit').click(function() {
      if(validate()) {
        $('#inspection_result').val(JSON.stringify(allcheckboxs));
        return true;
      }
      else {
        return false;
      }      
    });

    function validate() {
      if($('#chkcomplyx').prop('checked') == false && $('#chkcomply').prop('checked') == false) {
        alert('Please select comply or not comply.');
        return false;
      }
      else {
        return true;
      }      
    }
    
});
</script>