<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('uploadfiles');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('uploadfiles');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            <?php echo $this->lang->line('uploadfiles');?>
            <?php echo $this->lang->line('detail');?>
        </li>
    </ol>

    <!--parentchildmenu-->

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                <?php echo $this->lang->line('uploadfiles');?>
                <?php echo $this->lang->line('detail');?>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('uploadfiles_filename');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $uploadfiles_filename; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('uploadfiles_filesize');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $uploadfiles_filesize; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('uploadfiles_ext');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $uploadfiles_ext; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('uploadfiles_type');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $uploadfiles_type; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('uploadfiles_company_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $uploadfiles_company_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('uploadfiles_permit_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $uploadfiles_permit_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('uploadfiles_driver_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $uploadfiles_driver_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('uploadfiles_vehicle_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $uploadfiles_vehicle_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('uploadfiles_fixedfacilities_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $uploadfiles_fixedfacilities_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('uploadfiles_processtype');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $uploadfiles_processtype; ?>
                    </td>
                </tr>

            </table>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>