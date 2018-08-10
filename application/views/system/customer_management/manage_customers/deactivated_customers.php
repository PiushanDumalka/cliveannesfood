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
                        <li class="active">Deactived Customers</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-danger" id="customer_view"  name="view_customer" onclick="location.href = '<?php echo base_url(); ?>customer/view_customers';"><i class="fa fa-list"></i> View Active</button> 
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="row">
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
                                                <div class="row">
                                                    <table id="customers_table" class="table table-striped table-bordered table-hover table-active" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Full Name</th>
                                                                <th>Customer ID</th>
                                                                <th>NIC</th>
                                                                <th>Organization Name</th>                                                                
                                                                <th>Customer Type</th>
                                                                <th>Mobile No</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($get_customers->num_rows() > 0) {
                                                                foreach ($get_customers->result() as $customers) {
                                                                    ?>
                                                                    <tr onclick="location.href = '<?php echo base_url(); ?>customer/view_customer/<?php echo $customers->Id; ?>';">
                                                                        <td><span><?php echo $customers->FullName; ?></span></td>
                                                                        <td><?php echo $customers->CustomerId; ?></td>
                                                                        <td><?php echo $customers->NIC; ?></td>
                                                                        <td><?php echo $customers->OrganizationName; ?></td>
                                                                        <td><?php echo $customers->Title; ?></td>
                                                                        <!--<td><?php echo $customers->Address1 . ', ' . $customers->Address2 . ', ' . $customers->city . ', ' . $customers->district . ', ' . $customers->province; ?></td>-->
                                                                        <td><?php echo $customers->ContactNo; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
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
                $('.alert').delay(3000).fadeOut('slow');
                $('#customermanagement').addClass('active');
                $('#manage_customers').addClass('active');
            });
        </script>
    </body>
</html>