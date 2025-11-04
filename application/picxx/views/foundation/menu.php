
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="<?php echo site_url(); ?>" class="navbar-brand" style="padding: 0px !important;"><img src="<?php echo base_url('resources/shared_img/logo.jpg'); ?>" width="180" alt=""></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling Menu Ayam-->
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
/*                                                echo $parent_id.'<------------------parent_id<br>';
                        echo $menu->menu_id.'<------------------menu->menu_id<br><br>';*/
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

                        if(strtolower($this->router->fetch_class()) == strtolower($menu->menu_controller)){
                         $parent_active = 'active';
                        }else{
                         $parent_active = '';
                        }
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
<!--                    <form autocomplete="off" class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                        </div>
                    </form>-->
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                            <li class="active"><a href="/Permit/apply" style="    background-color: #085B8C;">Apply Permit<span class="sr-only">(current)</span></a></li>
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
