<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Heyya <strong><?php echo $this->session->userdata('name');?></strong>! Have a nice day.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <h3>Latest Permits</h3>



<!--              <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Some of your permits may expire soon. Renew now to avoid any inconvenience. <a href="/permitrenew/">Renew your permit</a>
              </div>-->

              <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-file-text-o"></i>
              <h3 class="box-title">Last 10 Permits Application</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">

                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Booking Id</th>
                    <th>Permit Type</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                <tbody>
                    <?php
$start = 0;
if ($permit_data) {

    foreach ($permit_data as $permit) {
        ?>
                        <tr>
<!--                            <td>
                                <?php echo ++$start; ?>
                            </td>-->
                            <td>
                                <?php echo $permit->permit_bookingid; ?>
                            </td>
                            <td>
                                <?php echo $permit->permit_type_desc; ?>
                            </td>
                            <td>
                                <?php
                                if ($permit->permit_officialstatus_name=='completed'){
                                     echo '<span class="label label-success">'.$permit->permit_officialstatus_name.'</span>';
                                }elseif($permit->permit_officialstatus_name=='inprogress'){
                                     echo '<span class="label label-primary">'. $permit->permit_officialstatus_name.'</span>';
                                }elseif($permit->permit_officialstatus_name=='pending'){
                                     echo '<span class="label label-warning">'. $permit->permit_officialstatus_name.'</span>';
                                }elseif($permit->permit_officialstatus_name=='failed'){
                                     echo '<span class="label label-danger">'. $permit->permit_officialstatus_name.'</span>';
                                }elseif($permit->permit_officialstatus_name=='pendingpayment'){
                                     echo '<span class="label label-warning">'. $permit->permit_officialstatus_name.'</span>';
                                }elseif($permit->permit_officialstatus_name=='rejected'){
                                     echo '<span class="label label-danger">'. $permit->permit_officialstatus_name.'</span>';
                                }elseif($permit->permit_officialstatus_name=='suspended'){
                                     echo '<span class="label label-danger">'. $permit->permit_officialstatus_name.'</span>';
                                }elseif($permit->permit_officialstatus_name=='canceled'){
                                      echo '<span class="label label-danger">'. $permit->permit_officialstatus_name.'</span>';
                                }elseif($permit->permit_officialstatus_name=='terminated'){
                                      echo '<span class="label label-danger">'. $permit->permit_officialstatus_name.'</span>';
                                }elseif($permit->permit_officialstatus_name=='expired'){
                                      echo '<span class="label label-danger">'. $permit->permit_officialstatus_name.'</span>';
                                }else{
                                      echo '<span class="label label-primary">'. $permit->permit_officialstatus_name.'</span>';
                                }

                                ?>
                            </td>
                            <td>
                                <?php
                              $thisdate = explode(" ", $permit->permit_created_at);
                                 echo datelocal($thisdate[0]); ?>
                            </td>

                            <td style="text-align:center; white-space: nowrap;">
                                <div class="btn-group" role="group" aria-label="...">

                                    <?php
$id = fixzy_encoder($permit->permit_id);
        if ($permission->cp_read == true) {
            echo anchor(site_url('permitall/' . strtolower($permit->permit_type_name_permit_typeid) . '/' . $id),
                '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>');
        }
/*        if ($permission->cp_update == true) {

            echo anchor(site_url('permit/update/' . $id),
                '<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>');
        }
        if ($permission->cp_delete == true) {

            echo anchor(site_url('permit/delete/' . $id),
                '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>',
                'onclick="javasciprt: return confirm(\'' . $this->lang->line('delete_alert') . '\')"');
        }*/
        ?>
                                </div>
                            </td>
                        </tr>
                        <?php
}
}
?>
                </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="/permit/apply" class="btn btn-sm btn-info btn-flat pull-left"><i class="fa fa-plus"></i> Apply Permit</a>
              <a href="/permitall/" class="btn btn-sm btn-default btn-flat pull-right"><i class="fa fa-bars"></i> View All Permits</a>
            </div>
            <!-- /.box-footer -->
          </div>


        </div>
        <div class="col-md-6">
          <h3>Welcome to DIASS</h3>
            <div class="callout callout-info">
                <p>DIASS is <strong>Digital Integrated Airside Services System</strong> - a full web-based system for Airside Permit application & issuance. <a href="/tutorial/" class="btn btn bg-primary btn-flat margin btn-xs"><i class="fa fa-arrow-circle-right"></i> Learn More</a></p>


          </div>
              <h3>Summary</h3>

          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-exclamation"></i>

                  <h3 class="box-title">Requires Your Action</h3>
                  <div class="box-tools pull-right">

                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>

                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3><?php echo $totalpermitexpiredsoon;?></h3>

                          <p>Expired Soon</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text-o"></i>
                        </div>
                        <a href="/permitrenew/" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
<!--                    <div class="col-md-4">
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3><?php echo $totalpermitpendingapproval;?></h3>

                          <p>Pending for Approval</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text-o"></i>
                        </div>
                        <a href="/permitpendingapproval/" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>-->
                    <div class="col-md-6">
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3><?php echo $totalpermitpendingpayment;?></h3>

                          <p>Pending for Payment</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text-o"></i>
                        </div>
                        <a href="/permitpendingpayment/" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.box-body -->
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-file-text-o"></i>

                  <h3 class="box-title">My Permits</h3>
                  <div class="box-tools pull-right">

                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>

                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3><?php echo $totalpermit;?></h3>

                          <p>Active Permits</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text-o"></i>
                        </div>
                        <a href="/Permitvalid/" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3><?php echo $totalpermittep;?></h3>

                          <p>Temporary Entry Permits</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text-o"></i>
                        </div>
                        <a href="/Permittep/" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Drivers</span>
                          <span class="info-box-number"><?php echo $totaldriver;?></span>
                           <a href="/Driver/" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                        </div>
                        <!-- /.info-box-content -->

                      </div>
                    </div>
<!--                    <div class="col-md-4">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Operators</span>
                          <span class="info-box-number">0</span>
                           <a href="#" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                        </div>


                      </div>
                    </div>-->
                    <div class="col-md-6">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-car"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Vehicles</span>
                          <span class="info-box-number"><?php echo $totalvehicle;?></span>
                           <a href="/Vehicle/" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                        </div>
                        <!-- /.info-box-content -->

                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
          </div>

        </div>

        <!-- /.col -->

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->


