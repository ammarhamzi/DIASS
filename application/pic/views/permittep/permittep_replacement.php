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
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
           Permit Replacement
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                Replacement Permit Request
            </h4>
        </div>
        <div class="panel-body">
            <div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <form autocomplete="off" id="submitform" name="submitform" action="/permitall/replacement_action/" method="POST">
                            <div class="row">


                                <table class="table">
                                    <tr>
                                        <td>Serial No: <b><?php echo $permit_issuance_serialno;?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Permit Type: <b><?php echo $permit_type_name_permit_typeid;?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Permit Condition: <b><?php echo $permit_condition_name_permit_condition;?></b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <h4>Please state your reason for replacement:<sup><span class="glyphicon glyphicon-star text-danger" aria-hidden="true"></span></sup> <?php echo form_error('remark') ?></h4>
                                        <textarea id="remark" name="remark" rows="7" cols="80"></textarea></td>
                                    </tr>
                                    <tr>
                                       <td>
                                        <h4>Upload suppported document(s)</h4>
                                        <iframe frameBorder="0" src="/Uploadfiles/permit_replacement/<?php echo fixzy_decoder($permit_id); ?>"></iframe>
                                       </td>
                                    </tr>

                                    <tr>
                                        <td><input id="agree" name="agree" type="checkbox" value="y"> I confirm that the information given in this form is true, complete and accurate.<?php echo form_error('agree') ?><br><input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary"></td>
                                    </tr>

                                </table>

                                <input type="hidden" name="permit_id" id="permit_id" value="<?php echo $permit_id; ?>">                            <input id="permit_replacement" type="hidden" name="permit_replacement" value="">

                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>

            <!--            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>-->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $("#mytable").DataTable({
            responsive: true,
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href") // activated tab
            if (target == '#history') {
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust()
                        .responsive.recalc();
                });
            }
        });
    });
</script>

<script>
    function redirect(url) {
        $(location).attr('href', url);
    }

    function getuploadfiles(processtype, data) {
        //alert(data);
        if (processtype == 'adp_requireddoc') {
            $("#adp_requireddoc").val(data);
        }
    }
</script>