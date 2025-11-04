<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('examtaker');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('examtaker');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('examtaker');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('examtaker');?>
                <?php echo $this->lang->line('detail');?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_driverid');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_driverid; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_exammanagement_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_exammanagement_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_exambank_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_exambank_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_examno');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_examno; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_startdatetime');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_startdatetime; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_enddatetime');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_enddatetime; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_exact_enddatetime');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_exact_enddatetime; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_totalmark');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_totalmark; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_pass');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_pass; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_remark');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_remark; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_created_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_created_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_updated_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_updated_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_deleted_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_deleted_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('examtaker_lastchanged_by');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $examtaker_lastchanged_by; ?>
                    </td>
                </tr>

            </table>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>