<?php
if (isset($this->session->userdata['username']) == FALSE) {
    redirect('login/login_control');
}
?>
<!DOCTYPE html>
<html>  
    <head>
        <meta charset="UTF-8">
        <title>Cliveannes Food</title>
        <?php $this->load->view("system/header-css"); ?>
        <?php $this->load->view("system/header-js"); ?>
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <div class="wrapper">   
            <?php $this->load->view("system/header"); ?>       
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view("system/leftmenu"); ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Customer Management</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li>Customer Management</li>
                        <li>Manage Customers</li>
                        <li class = "active">View Customer <?php if ($get_customer->num_rows() > 0) { ?> - <?php echo $get_customer->row()->CustomerId; ?><?php } ?></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-danger" id="customer_view"  name="view_customer" onclick="location.href = '<?php echo base_url(); ?>customer/view_customers';"><i class="fa fa-list"></i> View</button> 
                                        <button type="button" class="btn btn-primary pull-right" id="customer_view"  name="view_customer" onclick="location.href = '<?php echo base_url(); ?>customer/edit_customer/<?php echo $get_customer->row()->Id; ?>';"><i class="fa fa-edit"></i> Edit</button> 
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <?php if ($this->session->flashdata('success')) { ?>
                                            <div class="alert alert-success" id="success">
                                                <p><?php echo $this->session->flashdata('success'); ?></p>
                                            </div>
                                        <?php } elseif ($this->session->flashdata('error')) {
                                            ?>
                                            <div class="alert alert-danger" id="error">
                                                <p><?php echo $this->session->flashdata('error'); ?></p>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="panel-body">
                                            <div class="row">
                                                <?php
                                                if ($get_customer->num_rows() > 0) {
                                                    ?> <hr>
                                                    <div class="form-group col-sm-7">
                                                        <div class="row">
                                                            <p><b>PERSONAL DETAILS:-</b></p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Organization</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"> <label><?php echo $get_customer->row()->OrganizationName; ?></label></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Full Name </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_customer->row()->FullName; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">NIC</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_customer->row()->NIC; ?></div> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                        <div class="row">

                                                            <img style='width:50%;' src='<?php echo base_url(); ?><?php echo ($get_customer->row()->Status == '1' ) ? "assets/system/img/active.png" : "assets/system/img/deactive.png" ?>'/>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <hr><p><b>CONTACT DETAILS:-</b></p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Address </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_customer->row()->Address1; ?>, <?php echo $get_customer->row()->Address2; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">City </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"> <?php echo $get_customer->row()->city; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">District </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"> <?php echo $get_customer->row()->district; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Province </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"> <?php echo $get_customer->row()->province; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Mobile No</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_customer->row()->ContactNo; ?></div> 
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <hr><p><b>OFFICIAL DETAILS:-</b></p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Reg No </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_customer->row()->RegistrationNo; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Organization</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_customer->row()->OrganizationName; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Customer Type </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_customer->row()->Title; ?></div> 
                                                        </div>  
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Customer ID </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_customer->row()->CustomerId; ?></div> 
                                                        </div> 
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Email </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_customer->row()->Email; ?></div> 
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php $this->load->view("system/footer"); ?>
        </div><!-- ./wrapper -->
        <script>
            $(document).ready(function () {
                $('#customers_table').DataTable();
                $('#customermanagement').addClass('active');
                $('#manage_customers').addClass('active');
            });

        </script>
    </body>
</html>