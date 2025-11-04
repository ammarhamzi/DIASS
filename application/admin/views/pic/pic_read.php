<!-- \resources\gen_template\master\crud-newpage\views -->
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $this->lang->line('home');?></a></li>
        <li><a href="<?php echo site_url('pic');?>"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <?php echo $this->lang->line('pic');?> <?php echo $this->lang->line('list');?></a></li>
        <li class="active"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            PIC
            History
        </li>
    </ol>

    <!--parentchildmenu-->

                    <div class="box  box-primary">
                        <div class="box-header with-border">
                                    <i class="fa fa-file-text-o"></i>

                                    <h3 class="box-title">PIC History</h3>
                                    <div class="box-tools pull-right">

                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                        <!-- /.box-header -->
                        <div class="box-body">
            <table class="table table-condensed table-responsive">

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_company_id');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $pic_company_id; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_fullname');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $pic_fullname; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_ic');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $pic_ic; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_phoneoffice');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $pic_phoneoffice; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_handphone');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $pic_handphone; ?>
                    </td>
                </tr>

                <tr>
                    <th class="col-md-3 text-right">
                        <?php echo $this->lang->line('pic_email');?>
                    </th>
                    <td class="col-md-9">
                        <?php echo $pic_email; ?>
                    </td>
                </tr>

            </table>
            <div class="row">
              <div class="col-md-6" style="    max-height: 500px;
    overflow-y: scroll;">
           <table class="table table-bordered">
               <tr>
                   <th colspan="3" style="text-align:center; background-color: #8DC3E3;">Change Password History</th>
               </tr>
               <tr>
                   <th>#</th>
                   <th>Change By</th>
                   <th>Datetime</th>
               </tr>
               <?php
               if($changepassword_history){

               $count = 0;
               foreach ($changepassword_history as $history){
               $count++;

               ?>
               <tr>
                   <td><?php echo $count;?></td>
                   <td><?php echo $history->user_username. ($pic_email!=$history->user_username?"(Admin)":"")?></td>
                   <td><?php echo $history->changepassword_timedate;?></td>
               </tr>
<?php
               }
               }else{
?>
<tr>
 <td colspan="3" style="text-align:center">Still not change default password</td>
</tr>
<?php
               }
?>
           </table>
              </div>
              <div class="col-md-6" style="    max-height: 500px;
    overflow-y: scroll;">
           <table class="table table-bordered">
               <tr>
                   <th colspan="3" style="text-align:center; background-color: #8DC3E3;">Login History</th>
               </tr>
               <tr>
                   <th>#</th>
                   <th>IP</th>
                   <th>Datetime</th>
               </tr>
               <?php
               if($login_history){

               $count = 0;
               foreach ($login_history as $loghistory){
               $count++;

               ?>
               <tr>
                   <td><?php echo $count;?></td>
                   <td><?php echo $loghistory->login_ip;?></td>
                   <td><?php echo $loghistory->login_created_at;?></td>
               </tr>
<?php
               }
               }else{
?>
<tr>
 <td colspan="3" style="text-align:center">Still not change default password</td>
</tr>
<?php
               }
?>
           </table>
              </div>
            </div>

            <a href="javascript:history.go(-1)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back');?></a>

            <a href="javascript:return false;" class="btn btn-default" id="printthis"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
        </div>
    </div>
</div>