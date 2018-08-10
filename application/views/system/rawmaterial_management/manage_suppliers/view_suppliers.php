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
                    <h1>supplier Management</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li>Supplier Management</li>
                        <li>Manage Suppliers</li>
                        <li class="active">View Suppliers</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-primary" id="add_supplier"  name="add_supplier" onclick="location.href = '<?php echo base_url(); ?>supplier/add_supplier';"><i class="fa fa-user-plus"></i> New </button> 
                                        <button type="button" class="btn btn-link pull-right" id="deactivated_supplier"  name="deactivated_supplier" onclick="location.href = '<?php echo base_url(); ?>supplier/deactivated_suppliers';" data-toggle="tooltip" title="Deactive suppliers"><i class="fa fa-trash"></i> </button> 
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
                                                    <table id="suppliers_table" class="table table-striped table-bordered table-hover table-active" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Supplier Name</th>
                                                                <th>supplier Code</th>
                                                                <th>Address</th>                                                                
                                                                <th>Contact No</th>
                                                                <th>Mobile No</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($get_suppliers->num_rows() > 0) {
                                                                foreach ($get_suppliers->result() as $suppliers) {
                                                                    ?>
                                                                    <tr onclick="location.href = '<?php echo base_url(); ?>supplier/view_supplier/<?php echo $suppliers->Id; ?>';">
                                                                        <td><span><?php echo $suppliers->SupplierName; ?></span></td>
                                                                        <td><?php echo $suppliers->SupplierCode; ?></td>
                                                                        <td><?php echo $suppliers->Address; ?></td>
                                                                        <td><?php echo $suppliers->ContactNo; ?></td>
                                                                        <td><?php echo $suppliers->PhoneNo; ?></td>
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
                $('#rawmaterialmanagement').addClass('active');
                $('#manage_suppliers').addClass('active');
                $('#suppliers_table').DataTable();
                $('.alert').delay(3000).fadeOut('slow');
                $('[data-toggle="tooltip"]').tooltip();
            });

        </script>

    </body>
</html>