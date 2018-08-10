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
                    <h1>Product Management</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li>Product Management</li>
                         <li>Manage Products</li>
                        <li class = "active">View Product <?php if ($get_product->num_rows() > 0) { ?> - <?php echo $get_product->row()->ProductCode; ?><?php } ?></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-danger" id="product_view"  name="view_product" onclick="location.href = '<?php echo base_url(); ?>product/view_products';"><i class="fa fa-list"></i> View</button> 
                                        <button type="button" class="btn btn-primary pull-right" id="product_view"  name="view_product" onclick="location.href = '<?php echo base_url(); ?>product/edit_product/<?php echo $get_product->row()->Id; ?>';"><i class="fa fa-edit"></i> Edit</button> 
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
                                            if ($get_product->num_rows() > 0) {
                                                ?>
                                                <div class="col-sm-5">
                                                    <div class="row">
                                                        <div class="row">
                                                            <p style="color:red;"><b>PRODUCT DETAILS:-</b></p></br>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-4">
                                                                <label class="req">Product Name</label>
                                                            </div> 
                                                            <div class="form-group col-sm-8"> <label><?php echo $get_product->row()->ProductName; ?></label></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-4">
                                                                <label class="req">Product Category </label>
                                                            </div> 
                                                            <div class="form-group col-sm-8"><?php echo $get_product->row()->CategoryName; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-4">
                                                                <label class="req">Expire Duration</label>
                                                            </div> 
                                                            <div class="form-group col-sm-8"><?php echo $get_product->row()->ExpPeriod; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-4">
                                                                <label class="req">Weight</label>
                                                            </div> 
                                                            <div class="form-group col-sm-8"><?php echo $get_product->row()->Weight; ?></div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="row">
                                                        <p style="color:red;"><b>PRICE DETAILS:-</b></p></br>
                                                        <div class="form-group col-sm-5">
                                                            <label class="req">Unit Price </label>
                                                        </div> 
                                                        <div class="form-group col-sm-7">Rs.<?php echo $get_product->row()->UnitPrice; ?></div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-5">
                                                            <label class="req">Wholesaler Price </label>
                                                        </div> 
                                                        <div class="form-group col-sm-7">Rs.<?php echo $get_product->row()->WholesalerPrice; ?></div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-5">
                                                            <label class="req">Retailer Price </label>
                                                        </div> 
                                                        <div class="form-group col-sm-7">Rs.<?php echo $get_product->row()->RetailerPrice; ?>
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-12">
                                                            <p style="font-size: 24px;"> <?php echo ($get_product->row()->Status == '1' ) ? "<b>In Stock</b>" : "<b>Out Of Stock</b>" ?></p>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group col-sm-12">

                                                        <?php if ($get_product->row()->PhotoName) { ?>
                                                            <img style="width:70%;" src="<?php echo base_url(); ?>uploads/products/<?php echo $get_product->row()->PhotoName; ?>"/></a>
                                                        <?php } else { ?>
                                                            <img style="width:70%;" src="<?php echo base_url(); ?>assets/system/img/no-product--img.png"/></a>
                                                        <?php } ?>
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
                $('#products_table').DataTable();
            });
        </script>
    </body>
</html>