
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home'); ?></a></li>
        <li><a href="<?php echo site_url('refcountry'); ?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('refcountry'); ?> <?php echo $this->lang->line('list'); ?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('refcountry'); ?> <?php echo $this->lang->line('detail'); ?></li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('refcountry'); ?> <?php echo $this->lang->line('detail'); ?></h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">


                       <tr>
                    <th class="col-md-3 text-right"><?php echo $this->lang->line('ref_country_iso'); ?></th>
                    <td class="col-md-9"><?php echo $ref_country_iso; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right"><?php echo $this->lang->line('ref_country_name'); ?></th>
                    <td class="col-md-9"><?php echo $ref_country_name; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right"><?php echo $this->lang->line('ref_country_printable_name'); ?></th>
                    <td class="col-md-9"><?php echo $ref_country_printable_name; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right"><?php echo $this->lang->line('ref_country_iso3'); ?></th>
                    <td class="col-md-9"><?php echo $ref_country_iso3; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right"><?php echo $this->lang->line('ref_country_numcode'); ?></th>
                    <td class="col-md-9"><?php echo $ref_country_numcode; ?></td>
                           </tr>

            </table>

            <a href="<?php echo site_url('refcountry'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>

