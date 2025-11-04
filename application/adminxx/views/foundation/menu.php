
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
<!--                            <li>
                                <a href="<?php echo site_url('Password/'); ?>" > Change Password</a>
                            </li>-->
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
            if (!empty($child[$menu->menu_id]) && $child[$menu->menu_id][0]
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
