<div class="container-fluid">
                            <div class="box box-primary">
                                                        <div class="box-header with-border">
                            <h3 class="box-title">Your Action : Check submitted information & documents.</h3>
                            <div class="box-tools pull-right">
<!--                                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                            </div>
                        </div>
                        <form role="form" id="submitform" name="submitform" action="/admin/permitpendingdocscheckvehicle/sh_submit/" method="POST">
                                <div class="box-body">
<div class="form-group">
<label for="picremark">PIC Remark</label>
<div>
<?php echo ($permit_apply_remark?$permit_apply_remark:"<i>- No Remark -</i>");?>
</div>
</div>

<?php
 if($shpermit_needescort=='y'){
?>
                                <div class="form-group">
                                    <label for="escortname">Escort Name <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('escortname') ?></label>
                                    <input type="text" id="escortname" name="escortname" class="form-control" value="">
                                </div>
<?php
}
?>

                                <div class="form-group">
                                    <label for="remark">Briefing Date <span style="font-size: small">(Change it if necessary)</span></label>
                                    <input id="activitydate" name="activitydate" class="form-control datepicker_local_insurancedate" value="<?php echo datelocal($shpermit_course_date);?>">
                                </div>

                                <div class="form-group">
                                    <label for="adminapproval">Status <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('adminapproval') ?></label>
<br>
                                    <input id="adminapproval" name="adminapproval" type="radio" value="y"><span style="color: #339900">Approve, all mandatory information and documents are complete.</span> <br>
                                    <input id="adminapproval" name="adminapproval" type="radio" value="n"> <span style="color: #FF0000">Reject, some mandatory information and documents are not complete.</span>
                                </div>

                                <div class="form-group">
                                    <label for="remark">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark"></textarea>
                                </div>

                                <div class="form-group">
                                    <!-- <label for="agree">proclamation</label><br> -->
                                    <input id="agree" name="agree" type="checkbox" value="y"> I hereby certify that I have reviewed the information provided and checked the documents submitted along with this application.<sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('agree') ?>
                                </div>

                                <input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary">

<!--                                <table class="table">
                                    <tr>
                                        <td>Status <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('adminapproval') ?></td>
                                        <td><input id="adminapproval" name="adminapproval" type="radio" value="y"><span style="color: #339900"> All mandatory information & documents are complete </span> <br>
                                            <input id="adminapproval" name="adminapproval" type="radio" value="n"> <span style="color: #FF0000">Some of information or documents not complete</span></td>
                                    </tr>
                                    <tr>
                                        <td>Remark</td>
                                        <td><textarea id="remark" name="remark"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input id="agree" name="agree" type="checkbox" value="y"> I confirm that the information given in this form is true, complete and accurate.<?php echo form_error('agree') ?><br><input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary"></td>
                                    </tr>

                                </table>-->
                                <input type="hidden" name="approvaldate" id="approvaldate" readonly value="<?php echo date('Y-m-d H:i:s');?>">
                                <input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id; ?>">
<input type="hidden" name="permit_bookingid" id="permit_bookingid" value="<?php echo $permit_bookingid; ?>">

<input type="hidden" name="needescort" id="needescort" value="<?php echo $shpermit_needescort; ?>">
                    </div>
                    </form>
                </div>
</div>
<script>
$(document).ready(function() {
$('html,body').animate({scrollTop: document.body.scrollHeight},"slow");
});
</script>