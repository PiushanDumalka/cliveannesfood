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
                        <li class="active">Manage Prices</li>
                        <li class="active">View Prices</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        Manage Prices
<!--                                        <button type="button" class="btn btn-primary" id="add_product"  name="add_product" onclick="location.href = '<?php echo base_url(); ?>product/add_product';"><i class="fa fa-user-plus"></i> New </button> 
                                        <button type="button" class="btn btn-danger pull-right" id="out_product"  name="out_product" onclick="location.href = '<?php echo base_url(); ?>product/outofstock_products';" data-toggle="tooltip" title="Out of stock products"><i class="fa fa-user-times"></i> </button> -->
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
                                                    <table id="products_table" class="table table-striped table-bordered table-hover table-active" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Code</th>
                                                                <th>Name</th>
                                                                <th>Category</th>                                                                
                                                                <th>Weight</th>
                                                                <th>Unit Price</th>
                                                                <th>Wholesaler Price</th>
                                                                <th>Retailer Price</th>
<!--                                                                <th></th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($get_products->num_rows() > 0) {
                                                                foreach ($get_products->result() as $products) {
                                                                    ?>
                                                                    <tr onclick="location.href = '<?php echo base_url(); ?>product/add_prices/<?php echo $products->Id; ?>';">
                                                                        <td><span><?php echo $products->ProductCode; ?></span></td>
                                                                        <td><?php echo $products->ProductName; ?></td>
                                                                        <td><?php echo $products->CategoryName; ?></td>
                                                                        <td><?php echo $products->Weight; ?> <?php echo $products->Unit; ?></td>
                                                                        <td><?php echo $products->UnitPrice; ?></td>
                                                                        <td><?php echo $products->WholesalerPrice; ?></td>
                                                                        <td><?php echo $products->RetailerPrice; ?></td>
<!--                                                                        <td><i class="fa fa-eye"></i></td>-->
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
                $('#products_table').DataTable();
                $('#productmanagement').addClass('active');
                $('#manage_prices').addClass('active');
                $('.alert').delay(3000).fadeOut('slow');
                $('[data-toggle="tooltip"]').tooltip();
            });

        </script>

    </body>
</html>