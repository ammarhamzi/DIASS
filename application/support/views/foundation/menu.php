<?php
if ($theme == 'basic') {
    ?>

    <div class="container-fluid">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo $this->session->userdata('admintitle_long'); ?></a>
                </div>


                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li role="presentation"><a href="<?php echo site_url(); ?>">Home</a></li>


                        <?php
foreach ($parent as $menu) {
        ?>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $menu->menu_label; ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
foreach ($child[$menu->menu_id] as $submenu) {
            ?>
                                        <li>
                                            <a href="<?php echo site_url($submenu->menu_controller . '/' . $submenu->menu_method); ?>"><?php echo $submenu->menu_label; ?></a>
                                        </li>
                                        <?php
}
        ?>
                                </ul>
                            </li>
                            <?php
}
    ?>

                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('name'); ?> <img src="<?php echo base_url('../resources/shared_img/'); ?><?php echo $this->session->userdata('avatar'); ?>" width="30" height="30" alt="" class="img-circle"> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo site_url('Password/'); ?>" > Change Password</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('Profile/'); ?>" > Profile</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('authentication/logout'); ?>" > Logout</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>

            </div><!-- /.container-fluid -->
        </nav>
    </div>
    <?php
} elseif ($theme == 'adminlte') {

if($this->session->userdata('menutype')=="top-nav"){
?>
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="<?php echo site_url(); ?>" class="navbar-brand"><?php echo $this->session->userdata('admintitle_long'); ?></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
          <li><a href="<?php echo site_url(); ?>">Dashboard</a></li>
                          <?php
if ($parent) {
                foreach ($parent as $menu) {
// TODO: at controller, check isparent of controller...
                        if ($parent_id == $menu->menu_id) {
                                $parent_active = 'active';
                $active_small = '<span class="sr-only">(current)</span>';
                        } else {
                                $parent_active = '';
                $active_small = '';
                        }
                        ?>
                                                <?php
//bugme(count($child[$menu->menu_id]));
                        if (count($child[$menu->menu_id]) >= 1 && $child[$menu->menu_id][0]
                                != "") {
                                ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $menu->menu_label; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                                  <?php
foreach ($child[$menu->menu_id] as $submenu) {

                                        if (current_url() == site_url($submenu->menu_controller . '/' . $submenu->menu_method)) {
                                                $active = 'class="active"';
                                        } else {
                                                $active = '';
                                        }
                                        ?>
                <li><a href="<?php echo site_url($submenu->menu_controller . '/' . $submenu->menu_method); ?>"><?php echo $submenu->menu_label; ?></a></li>
                    <?php
                    }
                    ?>

                            </ul>
                        </li>
                                                        <?php
//if ada child
                        } else {
                                ?>
<li class="<?php echo $parent_active; ?>"><a href="<?php echo site_url($menu->menu_controller . '/' . $menu->menu_method); ?>"><?php echo $menu->menu_label; ?> <?php echo $active_small;?></a></li>
                                                        <?php
}
                        ?>

    <?php
}
}
    ?>

                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                        </div>
                    </form>
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="<?php echo base_url('../resources/shared_img/'); ?><?php echo $this->session->userdata('avatar'); ?>" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo $this->session->userdata('name'); ?></span>
                            </a>
                                                <ul class="dropdown-menu" style="width:100px !important;">
                                                        <li>
                                                                <a href="<?php echo site_url('Password/'); ?>" > Change Password</a>
                                                        </li>
                                                        <li>
                                                                <a href="<?php echo site_url('Profile/'); ?>" > Profile</a>
                                                        </li>
                                                        <li>
                                                                <a href="<?php echo site_url('authentication/logout'); ?>" > Logout</a>
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
<?php
}else{

    ?>
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo site_url(); ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><?php echo $this->session->userdata('admintitle_short'); ?></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?php echo $this->session->userdata('admintitle_long'); ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo base_url('../resources/shared_img/'); ?><?php echo $this->session->userdata('avatar'); ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $this->session->userdata('name'); ?></span>
                        </a>
                        <ul class="dropdown-menu" style="width:100px !important;">
                            <li>
                                <a href="<?php echo site_url('Password/'); ?>" > Change Password</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Profile/'); ?>" > Profile</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('authentication/logout'); ?>" > Logout</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url('../resources/shared_img/'); ?><?php echo $this->session->userdata('avatar'); ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $this->session->userdata('name'); ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <!--       <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="q" class="form-control" placeholder="Search...">
                          <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                          </span>
                    </div>
                  </form> -->
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <!--<li><a href="#"><i class="fa fa-home"></i> <span>Homepage</span></a></li>-->
                <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

                <?php
if ($parent) {
        foreach ($parent as $menu) {
// TODO: at controller, check isparent of controller...
            if ($parent_id == $menu->menu_id) {
                $parent_active = 'active';
            } else {
                $parent_active = '';
            }
            ?>
                        <?php
//bugme(count($child[$menu->menu_id]));
            if (count($child[$menu->menu_id]) >= 1 && $child[$menu->menu_id][0]
                != "") {
                if($menu->menu_label=="Exam Management"){
?>
<li class="header">ADMINISTRATIVE</li>
<?php
                }elseif($menu->menu_label=="My Approval"){
?>
<li class="header">PERMITS APPLICATION</li>
<?php
                }elseif($menu->menu_label=="Driving"){
?>
<li class="header">ACTIVE PERMITS</li>
<?php
                }
                ?>
                            <li class="treeview <?php echo $parent_active; ?>">
                                <a href="#">
                                    <i class="fa fa-pie-chart"></i>
                                    <span><?php echo $menu->menu_label; ?></span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
foreach ($child[$menu->menu_id] as $submenu) {

                    if (current_url() == site_url($submenu->menu_controller . '/' . $submenu->menu_method)) {
                        $active = 'class="active"';
                    } else {
                        $active = '';
                    }
                    ?>
                                        <li <?php echo $active; ?>><a href="<?php echo site_url($submenu->menu_controller . '/' . $submenu->menu_method); ?>"><i class="fa fa-circle-o"></i><?php echo $submenu->menu_label; ?></a></li>

                                        <?php
}
                ?>
                                </ul>
                            </li>
                            <?php
//if ada child
            } else {
                ?>
                            <li><a href="<?php echo site_url($menu->menu_controller . '/' . $menu->menu_method); ?>"><i class="fa fa-dashboard"></i> <span><?php echo $menu->menu_label; ?></span></a></li>
                            <?php
}
            ?>
                        <?php
}
    }
    ?>
    <!--        <li><a href="<?php echo site_url('fixzycrud/documentation'); ?>"><i class="fa fa-book"></i> <span>Documentation</span></a></li>-->
                <li><a href="<?php echo site_url('authentication/logout'); ?>"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <?php
    }
} elseif ($theme == 'bscore') {
    ?>

    <?php
}
?>
