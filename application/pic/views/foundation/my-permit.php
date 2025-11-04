<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Calendar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- fullCalendar -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="<?php echo base_url('../resources/shared_js/html5shiv/dist/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('../resources/shared_js/respond/dest/respond.min.js'); ?>"></script>
            <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
.navbar-brand{padding: 0px !important;}
</style>
</head>
<body class="skin-blue layout-top-nav">
<div class="wrapper">

<header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="http://diass.pic.karyastaging.com/index.php" class="navbar-brand"><img src="logo.jpg" width="180" /></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                      <li class=""><a href="http://diass.pic.karyastaging.com/index.php">Dashboard</a></li>
                      <li class="active"><a href="http://diass.pic.karyastaging.com/index.php/Permitall/index">Permits </a></li>
                      <li class=""><a href="http://diass.pic.karyastaging.com/index.php/Driver/index">Drivers/Operators </a></li>
                      <li class=""><a href="http://diass.pic.karyastaging.com/index.php/Vehicle/index">Vehicles </a></li>
                                                        
        

                    </ul>

                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                      <li class="bg-aqua "><a href="/Permit/apply"><i class="fa fa-plus"></i> Apply Permit<span class="sr-only">(current)</span></a></li>
                        <!-- Messages: style can be found in dropdown.less-->
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="http://diass.pic.karyastaging.com/resources/shared_img/mylove3.jpg" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">Mohd Hafizi</span>
                            </a>
                                                <ul class="dropdown-menu" style="width:100px !important;">
                                                        <li>
                                                                <a href="http://diass.pic.karyastaging.com/index.php/Password/"> Change Password</a>
                                                        </li>
                                                        <li>
                                                                <a href="http://diass.pic.karyastaging.com/index.php/Profile/"> Profile</a>
                                                        </li>
                                                        <li>
                                                                <a href="http://diass.pic.karyastaging.com/index.php/authentication/logout"> Logout</a>
                                                        </li>
                                                </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        My Permits
        <small>All permits for my company.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">My Permits</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-file-text-o"></i>

                  <h3 class="box-title">Filter</h3>
                  <div class="box-tools pull-right">

                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>

                  </div>
                </div>
                <!-- /.box-header -->
               
                  <div class="box-body">
                     <form autocomplete="off" class="form-horizontal">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-1 control-label"> Permit Type:</label>

                      <div class="col-sm-2">
                        <select class="form-control">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                      </div>
                      <label for="inputPassword3" class="col-sm-1 control-label"> Status:</label>

                      <div class="col-sm-2">
                        <select class="form-control">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                      </div>
                      <label for="inputEmail3" class="col-sm-1 control-label"> Date range:</label>

                      <div class="col-sm-3">
                        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                          <span>
                            <i class="fa fa-calendar"></i> Select Date Range
                          </span>
                          <i class="fa fa-caret-down"></i>
                        </button>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox">
                              Export to Excel
                            </label>
                          </div>

                        </div>
                      </div>
                    </div>

                     </form>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                  </div>
                  <!-- /.box-footer -->
               
                <!-- /.box-body -->
              </div>
          <div class="box  box-primary">
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
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Booking ID</th>
                  <th>Driver / Operator / Vehicle ID</th>
                  <th>Permit Type</th>
                  <th>Status</th>
                  <th>Application Date</th>
                  <th>Expiry Date</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">921014107865</a></td>
                  <td>Airside Driving Permit</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">921014107865</a></td>
                  <td>Airside Driving Permit</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">921014107865</a></td>
                  <td>Airside Driving Permit</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">921014107865</a></td>
                  <td>Airside Driving Permit</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">WXG4418</a></td>
                  <td>Airside Vehicle Permit</td>
                  <td><span class="label label-warning">Pending for payment</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">WXG4418</a></td>
                  <td>Airside Vehicle Permit</td>
                  <td><span class="label label-warning">Pending for payment</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">WXG4418</a></td>
                  <td>Airside Vehicle Permit</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">WXG4418</a></td>
                  <td>Airside Vehicle Permit</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">WXG4418</a></td>
                  <td>Airside Vehicle Permit</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">921014107865</a></td>
                  <td>Airside Vehicle Permit</td>
                  <td><span class="label label-warning">Pending for payment</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">921014107865</a></td>
                  <td>Airside Vehicle Permit</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">921014107865</a></td>
                  <td>Airside Driving Permit</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">921014107865</a></td>
                  <td>Airside Driving Permit</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>
                <tr>
                  <td><a href="">00045672</a></td>
                  <td><a href="">921014107865</a></td>
                  <td>Airside Driving Permit</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <td>10 Jan 2019</td><td>10 Jan 2020</td>
                  <td><button type="button" class="btn btn-primary btn-xs">Terminate</button> <button type="button" class="btn btn-primary btn-xs">Renew</button></td>
                </tr>

                </tbody>
                <tfoot>
                <tr>
                  <th>Booking ID</th>
                  <th>Driver / Operator / Vehicle ID</th>
                  <th>Permit Type</th>
                  <th>Status</th>
                  <th>Application Date</th>
                  <th>Expiry Date</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- /. box -->

        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
  })
</script>
</body>
</html>
