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
            <h3>Getting Started</h3>
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">About <strong>DIASS</strong></a></li>
              <li><a href="#tab_2" data-toggle="tab">System Requirements</a></li>
              <li><a href="#tab_3" data-toggle="tab">Knowledgebase & Support</a></li>


            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

                <p>DIASS is <strong>Digital Integrated Airside Services System</strong> - a A full web-based system for Airside Permit application & issuance. </p>
                <p>Below is the permit according to category</p>
                <img src="/resources/shared_img/getting-started/01.jpg" class="img-responsive pad" />



              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <p>Below is a list of the minimum Hardware and Software requirements to access DIASS.</p>

                    <h4>Operating System</h4>
                    <ol>
                        <li>Windows 7, Windows 8 or Windows 10</li>
                        <li>Mac OSX 10.8, 10.9, 10.10 or 10.11</li>
                    </ol>
                    <h4>Hardware</h4>
                    <ol>
                        <li>Processor (CPU) with 2 gigahertz (GHz) frequency or above</li>
                        <li>A minimum of 2 GB of RAM</li>
                        <li>Monitor Resolution 1024 X 768 or higher</li>
                        <li>A minimum of 20 GB of available space on the hard disk</li>
                        <li>Internet Connection Broadband (high-speed) Internet connection with a speed of 1 Mbps or higher</li>
                        <li>Keyboard and a Microsoft Mouse or some other compatible pointing deviceSound card</li>
                    </ol>
                    <h4>Browsers</h4>
                    <ol>
                        <li>Chrome* 36+</li>
                        <li>Edge* 20+</li>
                        <li>Mozilla Firefox 31+</li>
                        <li>Internet Explorer 11+ (Windows only)</li>
                        <li>Safari 6+ (MacOS only)</li>

                    </ol>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <h3>Knowledgebase</h3>
                <h4>Airside Driving Permit</h4>
                <ol>
                    <li><a href="/tutorial/adp_info" target="_blank">ADP Category</a></li>
                    <li><a href="/tutorial/adp_info" target="_blank">ADP Driving Class</a></li>
                </ol>
                <h4>Airside Vehicle Permit</h4>
                <ol>
                    <li><a href="/resources/tutorial/Guideline-for-vehicle-inspection.pdf" target="_blank">Inspection Guideline</a></li>
                </ol>
                <h4>Temporary Entry Permit</h4>
                <ol>
                    <li><a href="/tutorial/tep_info" target="_blank">New TEP Application</a></li>
                    <li><a href="/tutorial/escort_info" target="_blank">New Escorting Process</a></li>
                    <li><a href="/tutorial/speed_info" target="_blank">Speed Limit & Crossing Procedures</a></li>
                </ol>
                <h3>Support</h3>
                <h4>Phone & Email support</h4>
                <p>Need help? Please call +603 or email to <a href="mailto:diass@malaysiaairports.com.my">diass@malaysiaairports.com.my</a> for assistance.</p>
                <h4>User Manual</h4>
                <p>Before you start using DIASS, please download the user manual <a href="#">here</a>.</p>



              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>


        </div>
        <div class="col-md-6">

              <h3>Summary</h3>


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
                          <h3>NA</h3>

                          <p>Temporary Entry Permits</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text-o"></i>
                        </div>
                        <a href="#" class="small-box-footer">
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
        </div>

        <!-- /.col -->

        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-md-12">
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
          </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->


