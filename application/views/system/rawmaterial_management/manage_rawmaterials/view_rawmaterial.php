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
                    <h1>Rawmaterial Management</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li>Rawmaterial Management</li>
                        <li>Manage Rawmaterials</li>
                        <li class = "active">View Rawmaterial <?php if ($get_rawmaterial->num_rows() > 0) { ?> - <?php echo $get_rawmaterial->row()->RawMaterialCode; ?><?php } ?></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-danger" id="rawmaterial_view"  name="view_rawmaterial" onclick="location.href = '<?php echo base_url(); ?>rawmaterial/view_rawmaterials';"><i class="fa fa-list"></i> View</button> 
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
                                            <?php
                                            if ($get_rawmaterial->num_rows() > 0) {
                                                ?>
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="row">
                                                            <p><b>RAWMATERIAL DETAILS:-</b></p></br>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-4">
                                                                <label class="req">Raw Material Name</label>
                                                            </div> 
                                                            <div class="form-group col-sm-8"><?php echo $get_rawmaterial->row()->RawmaterialName; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-4">
                                                                <label class="req">Raw Material Category </label>
                                                            </div> 
                                                            <div class="form-group col-sm-8"><?php echo (1 == $get_rawmaterial->row()->RawMaterialCategoryId) ? 'Raw Material' : 'Packing Material' ?></div> 
                                                        </div>

                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            if ($get_rawmaterial_supplier->num_rows() > 0) {
                                                ?>
                                                <div class="col-sm-4">
                                                    <div class="row">
                                                        <div class="row">
                                                            <p><b>Suppliers Name:-</b></p></br>
                                                        </div>
                                                        <div class="row">
                                                            <?php
                                                            foreach ($get_rawmaterial_supplier->result() as $suppliers) {
                                                                ?>
                                                            <div class="form-group col-sm-8"><a href = '<?php echo base_url(); ?>supplier/view_supplier/<?php echo $suppliers->Id; ?>'><?php echo $suppliers->SupplierName; ?></a></div> 
                                                            <?php } ?>
                                                        </div>
                                                    </div>
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
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php $this->load->view("system/footer"); ?>
        </div><!-- ./wrapper -->
        <script>
            $(document).ready(function () {
                $('#rawmaterials_table').DataTable();
            });
        </script>
    </body>
</html>