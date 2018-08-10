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
                    <h1>Order Management</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li>Order Management</li>
                        <li class="active">Manage Orders</li>
                        <li class="active">Place Order</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        Place Order
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
                                                <?php echo form_open('order/save_order'); ?>

                                                <div class="row">

                                                    <div class="col-sm-12 col-md-12">

                                                        <table id="view_table" class="table table-striped" style="width:100%">
                                                            <?php
                                                            // All values of cart store in "$cart".
                                                            if ($cart = $this->cart->contents()):
                                                                ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product Name</th>
                                                                        <th>Qty</th> 
                                                                        <th>Price</th> 
                                                                        <th>Sub Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                    // Create form and send all values in "shopping/update_cart" function.

                                                                    $grand_total = 0;
                                                                    echo form_hidden('customerid');
                                                                    foreach ($cart as $item):
                                                                        ?>

                                                                        <tr>
                                                                            <td>
                                                                                <?php echo $item['name']; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $item['qty']; ?>
                                                                            </td>
                                                                            <td>
                                                                                Rs. <?php echo number_format($item['price'], 2); ?>
                                                                            </td>

                                                                            <?php $grand_total = $grand_total + $item['subtotal']; ?>
                                                                            <td>
                                                                                Rs. <?php echo number_format($item['subtotal'], 2) ?>
                                                                            </td>
                                                                        <?php endforeach; ?>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Order Total :Rs.<?php echo number_format($grand_total, 2); ?></b></td>

                                                                        <?php // "clear cart" button call javascript confirmation message  ?>

                                                                        <?php //submit button.                     ?>


                                                                    </tr>
                                                                </tbody>
                                                            <?php endif; ?>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <select class="form-control" name="customer" id="customer" required="required">
                                                                <option value="">Select a customer</option>
                                                                <?php
                                                                if ($get_customers->num_rows() > 0) {
                                                                    foreach ($get_customers->result() as $customer) {
                                                                        ?>
                                                                        <option value="<?php echo $customer->Id; ?>" <?php echo ($customer->Id == $orderd_customer) ? 'selected="selected"' : '' ?>><?php echo $customer->FullName; ?> - <?php echo $customer->OrganizationName; ?> - <?php echo $customer->Address1; ?>, <?php echo $customer->Address2; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <p class="help-block text-danger"><?php echo form_error('customer'); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-link" onclick="window.location = 'add_orders'">Back</button>
                                                <input class ='btn btn-sm btn-primary'  type="submit" value="Submit">
                                                <?php echo form_close(); ?>
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

                $('#customer').on('change', function () {
                    $('input#customerid').val(this.value);
                });

                $('#customer').select2();
                $('#products_table').DataTable();
                //  $('#view_table').DataTable();
                $('.alert').delay(3000).fadeOut('slow');
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

    </body>
</html>