<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('permitpendingreplacement');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('permitpendingreplacement');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('permitpendingreplacement');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('permitpendingreplacement');?>
                <?php echo $this->lang->line('detail');?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_groupid');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_groupid; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_typeid');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_typeid; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_condition');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_condition; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_bookingid');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_bookingid; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_picid');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_picid; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_companyid');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_companyid; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_issuance_serialno');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_issuance_serialno; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_issuance_date');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_issuance_date; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_issuance_startdate');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_issuance_startdate; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_issuance_expirydate');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_issuance_expirydate; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_issuance_processedby');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_issuance_processedby; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_payment_invoiceno');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_payment_invoiceno; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_payment_trainingfee');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_payment_trainingfee; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_payment_new');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_payment_new; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_payment_renew_oneyear');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_payment_renew_oneyear; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_payment_renew_prorated');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_payment_renew_prorated; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_payment_sst');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_payment_sst; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_payment_total');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_payment_total; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_payment_processedby');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_payment_processedby; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_status');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_status; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_officialstatus');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_officialstatus; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_remark');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_remark; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_timeline');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_timeline; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('permit_created_at');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $permit_created_at; ?>
                    </td>
                </tr>

            </table>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>