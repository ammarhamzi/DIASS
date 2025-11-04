<div class="panel panel-info">
    <div class="panel-heading">
        <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('examanswerlist');?>
            <?php echo $this->lang->line('detail');?>
        </h4>
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-responsive">

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('examanswerlist_content');?>
                </th>
                <td class="col-md-9">
                    <?php echo $examanswerlist_content; ?>
                </td>
            </tr>

            <tr>
                <th class="col-md-3 text-right">
                    <?php echo $this->lang->line('examanswerlist_correctanswer');?>
                </th>
                <td class="col-md-9">
                    <?php echo $examanswerlist_correctanswer; ?>
                </td>
            </tr>

        </table>

    </div>
</div>