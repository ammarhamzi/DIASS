
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li><a href="<?php echo site_url('servicecharges'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('user'); ?> <?php echo $this->lang->line('list'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('user'); ?> <?php echo $this->lang->line('detail'); ?></li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('user'); ?> <?php echo $this->lang->line('detail'); ?></h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed">
                <tr>
                    <th width="25%" class=" text-right">&nbsp;</th>
                    <td width="75%" class=""><h4>Detail of Charges</h4></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Status';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $status_txt; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Charge Types';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $charges_types_name; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Quantity';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $qty; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Flight / Aircraft Number';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $flight_number; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Reason';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $reason; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Notes';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $notes; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Payment Method';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $payment_method_txt; ?></td>
                </tr>

                <tr>
                    <th class=" text-right">&nbsp;</th>
                    <td class=""><h4>Requestor</h4></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Company Name';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $req_company_name; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Name';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $requestor_txt; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Designation';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $designation_field; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Date';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $date_field; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Time';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $time_field; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Phone No';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $req_phoneNo; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Email';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $req_email; ?></td>
                </tr>
                <tr>
                    <th class=" text-right"><?php echo 'Uploaded Document';//$this->lang->line('user_username'); ?></th>
                    <td class=""><?php echo $file_list_html; ?></td>
                </tr>
            </table>

            <a href="<?php echo site_url('servicecharges'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>

