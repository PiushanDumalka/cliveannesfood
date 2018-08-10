<?php
if (isset($this->session->userdata['username']) == FALSE && isset($this->session->userdata['roles']) == FALSE) {
    //$this->session->userdata['username'];
    // $this->session->userdata['roles'];
    redirect('login/login_control');
} else {
    ?>

    <?php
    // foreach ($this->session->userdata['roles'] as $row) {
    ?>
    <script>
        //$(document).ready(function () {
        //   $('#<?php //echo $row;                        ?>').show();
        //  });
    </script>
    <?php
    //  }
}
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul id="alllinks" class="sidebar-menu"  data-widget="tree">
            <li class="header" align="center">Cliveannes Food</li>
            <li id="treeviewdashboard" class="treeview">
                <a href="<?php echo base_url(); ?>dashboard">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
            </li>

            <li id="usermanagement" class="treeview">
                <a href="#"><i class="fa fa-dropbox"></i>
                    <span>User Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li id="manage_designation"><a href="<?php echo base_url(); ?>designation/add_designation"><i class="fa fa-circle-o"></i>Manage Designations</a></li>
                    <li id="manage_usertype"><a href="<?php echo base_url(); ?>usertype/add_usertype"><i class="fa fa-circle-o"></i>Manage Usertypes</a></li>
                    <li id="manage_users"><a href="<?php echo base_url(); ?>user/view_users"><i class="fa fa-circle-o"></i><span>Manage Users</span></a>
                    <li id="manage_roles"><a href="<?php echo base_url(); ?>usertyperole/view_usertyperoles"><i class="fa fa-circle-o"></i><span>Manage Roles</span></a>
                    <li id="manage_privileges"> <a href="<?php echo base_url(); ?>userprivileges/view_privileges"><i class="fa fa-circle-o"></i><span>Manage Privileges</span></a>
                </ul>
            </li>

            <li id="customermanagement" class="treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i>
                    <span>Customer Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right "></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li id="manage_customers"><a href="<?php echo base_url(); ?>customer/view_customers"><i class="fa fa-circle-o"></i><span>Manage Customers</span></a>
                    <li id="manage_orders"><a href="<?php echo base_url(); ?>customer/view_customers"><i class="fa fa-circle-o"></i><span>Manage Registrations</span></a>
                </ul>
            </li>
            <li id="ordermanagement" class="treeview">
                <a href="#"><i class="fa fa-user"></i>
                    <span>Order Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right "></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li id="manage_salesorder"><a href="<?php echo base_url(); ?>order/add_orders"><i class="fa fa-circle-o"></i><span>Manager Orders</span></a>
                    <li id="manage_payments"><a href="<?php echo base_url(); ?>customer/view_customers"><i class="fa fa-circle-o"></i><span>Manage Payments</span></a>
                    <li id="manage_returns"><a href="<?php echo base_url(); ?>customer/view_customers"><i class="fa fa-circle-o"></i><span>Manage Returns</span></a>
                </ul>
            </li>
            <li id="productmanagement" class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Product Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li id="manage_orders"><a href="<?php echo base_url(); ?>viewpages_controller/viewpages/addassignmentresult"><i class="fa fa-circle-o"></i>Manage Sales Orders</a></li>
                    <li id="manage_products"><a href="<?php echo base_url(); ?>product/view_products"><i class="fa fa-circle-o"></i>Manage Products</a></li>
                    <li id="manage_prices"><a href="<?php echo base_url(); ?>product/view_prices"><i class="fa fa-circle-o"></i>Manage Prices</a></li>
                    <li id="manage_recipe"><a href="<?php echo base_url(); ?>recipe/view_recipies"><i class="fa fa-circle-o"></i>Manage Recipe</a></li>
                </ul>
            </li>
            <li id="productstockmanagement" class="treeview">
                <a href="#"><i class="fa  fa-dropbox"></i>
                    <span>Product Stock Management</span>
                </a>
                <ul class="treeview-menu">
                    <li id="liweektimetable"><a href="<?php echo base_url(); ?>viewpages_controller/viewpages/weektimetable"><i class="fa fa-circle-o"></i>Manage Supplier Orders</a></li>
                    <li id="liweektimetable"><a href="<?php echo base_url(); ?>viewpages_controller/viewpages/weektimetable"><i class="fa fa-circle-o"></i>Manage Product Orders</a></li>
                    <li id="lisettimetable"><a href="<?php echo base_url(); ?>viewpages_controller/viewpages/settimetable"><i class="fa fa-circle-o"></i>Manage Rawmaterial</a></li>
                    <li id="liweektimetable"><a href="<?php echo base_url(); ?>viewpages_controller/viewpages/weektimetable"><i class="fa fa-circle-o"></i>Manage Suppliers</a></li>
                </ul>
            </li>
            <li id="rawmaterialmanagement" class="treeview">
                <a href="#"><i class="fa fa-dropbox"></i>
                    <span>RawMaterial Management</span>
                </a>
                <ul class="treeview-menu">
                    <li id="liweektimetable"><a href="<?php echo base_url(); ?>viewpages_controller/viewpages/weektimetable"><i class="fa fa-circle-o"></i>Manage Supplier Orders</a></li>
                    <li id="liweektimetable"><a href="<?php echo base_url(); ?>viewpages_controller/viewpages/weektimetable"><i class="fa fa-circle-o"></i>Manage Product Orders</a></li>
                    <li id="manage_rawmaterials"><a href="<?php echo base_url(); ?>rawmaterial/view_rawmaterials"><i class="fa fa-circle-o"></i>Manage Rawmaterial</a></li>
                    <li id="manage_suppliers"><a href="<?php echo base_url(); ?>supplier/view_suppliers"><i class="fa fa-circle-o"></i>Manage Suppliers</a></li>
                </ul>
            </li>
            <li id="rawstockmanagement" class="treeview">
                <a href="#"><i class="fa  fa-dropbox"></i>
                    <span>Raw Stock Management</span>
                </a>
                <ul class="treeview-menu">
                    <li id="liweektimetable"><a href="<?php echo base_url(); ?>viewpages_controller/viewpages/weektimetable"><i class="fa fa-circle-o"></i>Manage Supplier Orders</a></li>
                    <li id="liweektimetable"><a href="<?php echo base_url(); ?>viewpages_controller/viewpages/weektimetable"><i class="fa fa-circle-o"></i>Manage Product Orders</a></li>
                    <li id="lisettimetable"><a href="<?php echo base_url(); ?>viewpages_controller/viewpages/settimetable"><i class="fa fa-circle-o"></i>Manage Rawmaterial</a></li>
                    <li id="liweektimetable"><a href="<?php echo base_url(); ?>supplier/view_suppliers"><i class="fa fa-circle-o"></i><span>Manage Suppliers</span></a></li>
                </ul>
            </li>
            <li id="student-management" >
                <a href="<?php echo base_url(); ?>registration_controller">
                    <i class="fa fa-money"></i> <span>Expenses Management </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- sidebar -->
</aside>

