<div class="panel panel-info">
    <div class="panel-heading">
        <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('examquestion');?>
            <?php echo $this->lang->line('detail');?>
        </h4>
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-responsive">

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('examquestion_content');?>
                </th>
                <td class="col-md-9">
                    <?php echo $examquestion_content; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('examquestion_compulsory');?>
                </th>
                <td class="col-md-9">
                    <?php echo $examquestion_compulsory; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('examquestion_examtopic_id');?>
                </th>
                <td class="col-md-9">
                    <?php echo $examquestion_examtopic_id; ?>
                </td>
            </tr>

            <!--       <tr>
         <th class="col-md-3 text-right"><?php echo $this->lang->line('examquestion_mark');?></th>
         <td class="col-md-9"><?php echo $examquestion_mark; ?></td>
       </tr>-->

        </table>

    </div>
</div>