<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('exambanklist');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('exambanklist');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('exambanklist');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <!--Ajax Here-->
            <div id="master_detail"></div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('exambanklist');?>
                <?php echo $this->lang->line('detail');?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('exambanklist_examquestion_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $exambanklist_examquestion_id; ?>
                    </td>
                </tr>

            </table>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("exambank/read/$parent_id/raw") ?>',
            success: function(data) {
                //alert(data);
                $('#master_detail').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
        });
    });
</script>