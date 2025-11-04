<style type="text/css">
.titlecol {
    width: 20% !important;
}
</style>
<div class="container-fluid">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $this->lang->line('controllerpermission'); ?> <?php echo $this->lang->line('detail'); ?></h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">


                       <tr>
                    <th class="col-md-3 text-right titlecol"><?php echo $this->lang->line('cp_controller_id'); ?></th>
                    <td class="col-md-9"><?php echo $cp_controller_id; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right titlecol"><?php echo $this->lang->line('cp_usergroup'); ?></th>
                    <td class="col-md-9"><?php echo $cp_usergroup; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right titlecol"><?php echo $this->lang->line('showlist'); ?></th>
                    <td class="col-md-9"><?php echo $showlist; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right titlecol"><?php echo $this->lang->line('cp_create'); ?></th>
                    <td class="col-md-9"><?php echo $cp_create; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right titlecol"><?php echo $this->lang->line('cp_update'); ?></th>
                    <td class="col-md-9"><?php echo $cp_update; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right titlecol"><?php echo $this->lang->line('cp_delete'); ?></th>
                    <td class="col-md-9"><?php echo $cp_delete; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right titlecol"><?php echo $this->lang->line('cp_read'); ?></th>
                    <td class="col-md-9"><?php echo $cp_read; ?></td>
                           </tr>

                       <tr>
                    <th class="col-md-3 text-right titlecol"><?php echo $this->lang->line('printlist'); ?></th>
                    <td class="col-md-9"><?php echo $printlist; ?></td>
                           </tr>

            </table>

            <a href="javascript:parent.$.fancybox.close();" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></a>
        </div>
    </div>
</div>

