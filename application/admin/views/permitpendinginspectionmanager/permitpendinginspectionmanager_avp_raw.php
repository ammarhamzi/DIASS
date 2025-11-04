<div class="container-fluid">
                            <div class="box box-primary">
                                                        <div class="box-header with-border">
                            <h3 class="box-title">Your Action : MTW Approval.</h3>
                            <div class="box-tools pull-right">
<!--                                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                            </div>
                        </div>
                        <form id="submitform" name="submitform" action="/admin/permitpendinginspectionmanager/avp_submit/" method="POST">
                                <div class="box-body">
<div class="form-group">
<label for="picremark">PIC Remark</label>
<div>
<?php echo ($permit_apply_remark?$permit_apply_remark:"<i>- No Remark -</i>");?>
</div>
</div>


<!--                                <div class="form-group">
                                    <label for="adminapproval">Status <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('adminapproval') ?></label>
<br>
                                    <input id="adminapproval" name="adminapproval" type="radio" value="y"><span style="color: #339900"> Inspection verified </span> <br>
                                    <input id="adminapproval" name="adminapproval" type="radio" value="n"> <span style="color: #FF0000">Inspection not verified</span>
                                </div>

                                <div class="form-group">
                                    <label for="remark">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark"></textarea>
                                </div>

                                <div class="form-group">

                                    <input id="agree" name="agree" type="checkbox" value="y"> I hereby confirm that the information provided herein is accurate, correct and complete and that the documents submitted along with this application form are genuine.  <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('agree') ?>
                                </div>

                                <input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary">-->

<div class="row">
    <div class="col-md-12">

<!--        <div class="form-group">
                <label for="activitydate">Inspection Date: </label>
                <input id="activitydate" name="activitydate" class="form-control datepicker" value="<?php echo $avppermit_inspection_date;?>">
        </div>-->

        <div class="form-group">
                <label for="inspectionresult">Inspection Result: </label>
<p><input id="adminapproval" name="adminapproval" type="radio" value="y"> I certify that this "Vehicle" <span style="color: #339900">COMPLY</span> with the requirement of Airport Standards Directive 506 during the time and date of the inspection.  <br>
<input id="adminapproval" name="adminapproval" type="radio" value="n"> I certify that for the reason (s) shown above this "Vehicle" <span style="color: #FF0000">DOES NOT COMPLY</span> with the requirement of Airport Standards Directive 506 during the time and date of the inspection.</p>
        </div>

        <div class="form-group">
                <label for="remark">Remark </label>
                <textarea class="form-control"  id="remark" name="remark"><?php echo $permit_inspectionmanager_remark;?></textarea>
        </div>

<input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary pull-right">
    </div>
</div>

                                <input type="hidden" name="approvaldate" id="approvaldate" readonly value="<?php echo date('Y-m-d H:i:s');?>">
                                <input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id; ?>">



                    </div>
                    </form>
                </div>
</div>
<script>
$(document).ready(function() {
$('html,body').animate({scrollTop: document.body.scrollHeight},"slow");
});
</script>