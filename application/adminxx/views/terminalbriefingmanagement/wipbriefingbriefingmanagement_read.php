<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('wipbriefingmanagement');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('wipbriefingmanagement');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('wipbriefingmanagement');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('wipbriefingmanagement');?>
                <?php echo $this->lang->line('detail');?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('wipbriefingmanagement_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $wipbriefingmanagement_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('wipbriefingmanagement_slot');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $wipbriefingmanagement_slot; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('wipbriefingmanagement_slottaken');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $wipbriefingmanagement_slottaken; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('wipbriefingmanagement_location');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $wipbriefingmanagement_location; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('wipbriefingmanagement_officer_pic');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $wipbriefingmanagement_officer_pic; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('wipbriefingmanagement_remark');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $wipbriefingmanagement_remark; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('wipbriefingmanagement_created_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $wipbriefingmanagement_created_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('wipbriefingmanagement_updated_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $wipbriefingmanagement_updated_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('wipbriefingmanagement_deleted_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $wipbriefingmanagement_deleted_at; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('wipbriefingmanagement_lastchanged_by');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $wipbriefingmanagement_lastchanged_by; ?>
                    </td>
                </tr>

            </table>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>