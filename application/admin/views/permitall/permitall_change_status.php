<!-- \resources\gen_template\master\crud-newpage\views -->
<style type="text/css">
    .nav-tabs {
        padding-left: 15px;
        margin-bottom: 0;
        border: none;
    }

    .tab-content {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 15px;
    }
</style>
<div class="container-fluid">

    <!--parentchildmenu-->

                    <div class="box  box-primary">
                        <div class="box-header with-border">
                                    <i class="fa fa-file-text-o"></i>

                                    <h3 class="box-title">Reject Application</h3>
                                    <div class="box-tools pull-right">

                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                        <!-- /.box-header -->
                        <div class="box-body">
            <div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="submitform" name="submitform" action="/admin/permitall/changetoreject_action/" method="POST">
                            <div class="row">


                                <table class="table">
                                    <tr>
                                        <td>Current Status: <b><?php echo $permit_officialstatus;?></b></td>
                                    </tr>
                                    <tr>
                                        <td>New Status: <b>rejected</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <h4>Please state your reason for rejection:<sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('remark') ?></h4>
                                        <textarea id="remark" name="remark" rows="7" cols="80" placeholder='Absent for exam/inspection/etc'></textarea></td>
                                    </tr>


                                    <tr>
                                        <td><input id="agree" name="agree" type="checkbox" value="y"> I confirm that the information given in this form is true, complete and accurate.<?php echo form_error('agree') ?><br><input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary"></td>
                                    </tr>

                                </table>

                                <input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id; ?>">

                            </div>
                        </form>
                    </div>
                </div>

            </div>

<!--            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a> -->

            <!--            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>-->
        </div>
    </div>
</div>
