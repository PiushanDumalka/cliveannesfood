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
                    <h1>Supplier Management</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li>Supplier Management</li>
                        <li>Manage Suppliers</li>
                        <li class = "active">View supplier <?php if ($get_supplier->num_rows() > 0) { ?> - <?php echo $get_supplier->row()->SupplierCode; ?><?php } ?></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-danger" id="supplier_view"  name="view_supplier" onclick="location.href = '<?php echo base_url(); ?>supplier/view_suppliers';"><i class="fa fa-list"></i> View</button> 
                                        <button type="button" class="btn btn-primary pull-right" id="supplier_view"  name="view_supplier" onclick="location.href = '<?php echo base_url(); ?>supplier/edit_supplier/<?php echo $get_supplier->row()->Id; ?>';"><i class="fa fa-edit"></i> Edit</button> 
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
                                                if ($get_supplier->num_rows() > 0) {
                                                    ?> 
                                                    <div class="form-group col-sm-8">
                                                        <div class="row">
                                                            <p style="text-transform: uppercase;"><b><?php echo $get_supplier->row()->SupplierName; ?></b></p><hr>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Address</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_supplier->row()->Address; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Contact </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"> <?php echo $get_supplier->row()->ContactNo; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Mobile No</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_supplier->row()->PhoneNo; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Email</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_supplier->row()->Email; ?></div> 
                                                        </div> 
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Status</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo (1 == $get_supplier->row()->Status) ? 'Active' : 'InActive' ?></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Description</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_supplier->row()->Description; ?></div> 
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>

                                                <p><b>&nbsp;</b></p><hr>
                                                <div class="form-group col-sm-4">

                                                    <?php if ($get_supplier_rawmaterial->num_rows() > 0) { ?>
                                                        <div class="form-group col-sm-9"><label>Raw Material Details</label></div>
                                                        <?php
                                                        foreach ($get_supplier_rawmaterial->result() as $raw) {
                                                            if ($raw->RawMaterialCategoryId == 1) {
                                                                ?>
                                                                <div class="form-group col-sm-9"><i class="fa fa-circle"> <?php echo $raw->RawmaterialName; ?></i></div>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <?php if ($get_supplier_packingmaterial->num_rows() > 0) { ?>
                                                        <div class="form-group col-sm-9"><label>Packing Material Details</label></div>
                                                        <?php
                                                        foreach ($get_supplier_packingmaterial->result() as $raw) {
                                                            ?>
                                                            <div class="form-group col-sm-9"><i class="fa fa-circle"> <?php echo $raw->RawmaterialName; ?></i></div>
                                                            <?php
                                                        }
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
                $('#suppliers_table').DataTable();
                $('#rawmaterialmanagement').addClass('active');
                $('#manage_suppliers').addClass('active');
            });

        </script>
    </body>
</html>