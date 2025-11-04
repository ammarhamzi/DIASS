<div class="container-fluid">
                            <div class="box box-primary">
                                                        <div class="box-header with-border">
                            <h3 class="box-title">Your Action : Final verification before permit release.</h3>
                            <div class="box-tools pull-right">
<!--                                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                            </div>
                        </div>
                        <form id="submitform" name="submitform" action="/admin/permitpendingapproval/sh_submit/" method="POST">
                                <div class="box-body">
<div class="form-group">
<label for="picremark">PIC Remark</label>
<div>
<?php echo ($permit_apply_remark?$permit_apply_remark:"<i>- No Remark -</i>");?>
</div>
</div>


                                <div class="form-group">
                                    <label for="adminapproval">Status <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('adminapproval') ?></label>
<br>
                                    <input id="adminapproval" name="adminapproval" type="radio" value="y"><span style="color: #339900"> All mandatory requirement are completed </span> <br>
                                    <input id="adminapproval" name="adminapproval" type="radio" value="n"> <span style="color: #FF0000">Some of requirements are not completed</span>
                                </div>

                                <div class="form-group">
                                    <label for="remark">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark"></textarea>
                                </div>

                                <div class="form-group">
                                    <!-- <label for="agree">proclamation</label><br> -->
                                    <input id="agree" name="agree" type="checkbox" value="y"> I hereby confirm that the information provided herein is accurate, correct and complete and that the documents submitted along with this application form are genuine.  <sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup><?php echo form_error('agree') ?>
                                </div>

                                <input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary">

                                <input type="hidden" name="approvaldate" id="approvaldate" readonly value="<?php echo date('Y-m-d H:i:s');?>">
                                <input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id; ?>">
<input type="hidden" name="permit_bookingid" id="permit_bookingid" value="<?php echo $permit_bookingid; ?>">


                    </div>
                    </form>
                </div>
</div>
<script>
$(document).ready(function() {
$('html,body').animate({scrollTop: document.body.scrollHeight},"slow");
});
</script>