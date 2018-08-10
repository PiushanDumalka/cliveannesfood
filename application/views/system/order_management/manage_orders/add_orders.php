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

                                                </div>
                                                <div class="row">
<!--                                                    <div class="col-sm-12">
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
                                                    </div>-->
                                                    <div class="col-sm-12 col-md-6">

                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-12 form-group">  
                                                                <input type="text" id="search_product" name="search_product" class="form-control" placeholder="Search...">
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 products">
                                                                <?php
                                                                if ($get_products->num_rows() > 0) {
                                                                    foreach ($get_products->result() as $products) {
                                                                        ?>
                                                                        <?php
                                                                        //  var_dump($products->Id);
                                                                        echo form_open('order/add_to_cart');
                                                                         echo form_hidden('customerid');

                                                                        echo form_hidden('id', $products->Id);
                                                                        echo form_hidden('productname', $products->ProductName);

                                                                        echo form_hidden('price', $products->UnitPrice);
                                                                        ?>
                                                                        <div class="row all <?php echo $products->ProductName; ?>">
                                                                            <div class="col-md-3 col-sm-3 form-group">
                                                                                <span><?php echo $products->ProductCode; ?></span>
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-3 form-group ">
                                                                                <span><?php echo $products->ProductName; ?></span>
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-3 form-group ">
                                                                                <span><input class="form-control" name="qty" id="qty" type="number" min=0 value="" required/></span>
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-3 form-group ">
                                                                                <input type="submit"  class="btn btn-sm btn-success" value="Add to cart">
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                        echo form_close();
                                                                        ?>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-md-6">
                                                        <div id="text">
                                                            <?php
                                                            $cart_check = $this->cart->contents();

                                                            // If cart is empty, this will show below message.
                                                            if (empty($cart_check)) {
                                                                echo 'To add products to your shopping cart click on "Add to Cart" Button';
                                                            }
                                                            ?> 
                                                        </div>

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
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                    // Create form and send all values in "shopping/update_cart" function.
                                                                    echo form_open('order/update_cart');
                                                                    $grand_total = 0;
                                                                    echo form_hidden('customerid');
                                                                    foreach ($cart as $item):
                                                                        // echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                                                        // Will produce the following output.
                                                                        // <input type="hidden" name="cart[1][id]" value="1" />
                                                                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                                                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                                                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                                                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                                                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                                                        echo form_hidden('cart[' . $item['id'] . '][subtotal]', $item['subtotal']);
                                                                        ?>

                                                                        <tr>
                                                                            <td>
                                                                                <?php echo $item['name']; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
                                                                            </td>
                                                                            <td>
                                                                                Rs. <?php echo number_format($item['price'], 2); ?>
                                                                            </td>

                                                                            <?php $grand_total = $grand_total + $item['subtotal']; ?>
                                                                            <td>
                                                                                Rs. <?php echo number_format($item['subtotal'], 2) ?>
                                                                            </td>
                                                                            <td>

                                                                                <?php
                                                                                $path = base_url('assets/system/img/cart_cross.jpg');
                                                                                $path = "<img src='$path' width='25px' height='20px'>";
                                                                                echo anchor('order/remove_cart/' . $item['rowid'], $path);
                                                                                ?>
                                                                            </td>
                                                                        <?php endforeach; ?>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Order Total :Rs.<?php echo number_format($grand_total, 2); ?></b></td>

                                                                        <?php // "clear cart" button call javascript confirmation message  ?>
                                                                        <td colspan="5" align="right"><input  class ='btn btn-sm btn-danger' type="button" value="Clear Cart" onclick="clear_cart()">

                                                                            <?php //submit button.                     ?>
                                                                            <input class ='btn btn-sm btn-warning'  type="submit" value="Update Cart">
                                                                            <?php echo form_close(); ?>

                                                                            <!-- "Place order button" on click send "billing" controller -->
                                                                            <input class ='btn btn-sm btn-primary' type="button" value="Place Order" onclick="window.location = 'place_order_view'"></td>
                                                                    </tr>
                                                                </tbody>
                                                            <?php endif; ?>
                                                        </table>
                                                    </div>
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

                $('#customer').on('change', function () {
                    $('input#customerid').val(this.value);
                });
                $('#customer').select2();
                $('#products_table').DataTable();
                //  $('#view_table').DataTable();
                $('.alert').delay(3000).fadeOut('slow');
                $('[data-toggle="tooltip"]').tooltip();
                //on key press search 
                $("#search_product").keyup(function () {
                    var search = $(this).val();
                    $.ajax({
                        url: '<?php echo base_url("order/search"); ?>' + '/' + search,
                        type: 'get',
                        dataType: 'json',
                        success: function (data) {
                            $('.all').hide();
                            $(data).each(function (index, value) {
                                // alert(value[2]);
                                $('.' + value[2]).show();
                            });
                        },
                        error: function (data) {
                            $('.all').show();
                        }
                    });
                });
            });

            // To conform clear all data in cart.
            function clear_cart() {
                var result = confirm('Are you sure want to remove all products in cart?');
                if (result) {
                    window.location = "<?php echo base_url(); ?>order/remove_cart/all";
                } else {
                    return false; // cancel button
                }
            }
        </script>

    </body>
</html>