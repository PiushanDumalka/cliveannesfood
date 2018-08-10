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
                        <li>Manage Prices</li>
                        <li class = "active">Add Price <?php if ($get_product->num_rows() > 0) { ?> - <?php echo $get_product->row()->ProductCode; ?><?php } ?></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-danger" id="product_view"  name="view_product" onclick="location.href = '<?php echo base_url(); ?>product/view_prices';"><i class="fa fa-list"></i> View</button> 
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-12 form-group ">
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
                                                        <div class="form-group col-sm-8"><?php echo $get_product->row()->Weight . $get_product->row()->Unit; ?></div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-12">
                                                            <p style="font-size: 24px;"> <?php echo ($get_product->row()->Status == '1' ) ? "<b>Active</b>" : "<b>Inactive</b>" ?></p>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <?php echo form_open_multipart('', ['id' => 'add_price_form']); ?>
                                                <div class="row">
                                                    <p style="color:red;"><b>PRICE DETAILS:-</b></p></br>
                                                    <div class="form-group col-sm-6">
                                                        <label class="req">Unit Price (Rs.)</label>
                                                    </div> 
                                                    <div class="form-group col-sm-6">
                                                        <input class="form-control" name="unitprice" id="unitprice" type="text" maxlength="10" value="<?php echo $get_product->row()->UnitPrice; ?>" required/>
                                                    </div> 
                                                    <div class="form-group col-sm-12">
                                                        <div id="unitprice_error" class="alert alert-danger error" style="display:none;">Please Enter Currency</div>
                                                    </div> 
                                                </div> 
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label class="req">Wholesaler Price (Rs.)</label>
                                                    </div> 
                                                    <div class="form-group col-sm-6">
                                                        <input class="form-control" name="wholesalerprice" id="wholesalerprice" type="text" maxlength="10" value="<?php echo $get_product->row()->WholesalerPrice; ?>" required/>
                                                    </div> 
                                                    <div class="form-group col-sm-12">
                                                        <div id="wholesalerprice_error" class="alert alert-danger error" style="display:none;">Please Enter Currency</div>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label class="req">Retailer Price (Rs.)</label>
                                                    </div> 
                                                    <div class="form-group col-sm-6">
                                                        <input class="form-control" name="retailerprice" id="retailerprice" type="text" maxlength="10" value="<?php echo $get_product->row()->RetailerPrice; ?>" required/>
                                                    </div> 
                                                    <div class="form-group col-sm-12">
                                                        <div id="retailerprice_error" class="alert alert-danger error" style="display:none;">Please Enter Currency</div>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="form_sep">
                                                            <input class="btn btn-warning" id="add_price_submit" type="submit" name="add_price_submit" value="Update" />    
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="form_sep">
                                                            <button type="button" class="btn btn-danger" id="cancel_product"  name="cancel_price" onclick="location.href = '<?php echo base_url(); ?>product/view_prices/<?php echo $get_product->row()->Id; ?>';"><i class="fa fa-reply"></i> cancel</button> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo form_close(); ?> 
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group col-sm-12">

                                                    <?php if ($get_product->row()->PhotoName) { ?>
                                                        <img style="width:70%;" src="<?php echo base_url(); ?>uploads/products/<?php echo $get_product->row()->PhotoName; ?>"/></a>
                                                    <?php } else { ?>
                                                        <img style="width:70%;" src="<?php echo base_url(); ?>assets/system/img/no-product-img.jpg"/></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <div id="accordion">
                                            <div class="card">
                                                <div class="card-header" id="pricechangehistory">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            click here for view price changed history
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="pricechangehistory" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <table id="prices_table" class="table table-striped table-bordered table-hover table-active" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>DateTime</th>
                                                                    <th>Unit Price</th>
                                                                    <th>Wholesaler Price</th>
                                                                    <th>Retailer Price</th>
                                                                    <th>Consumer Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ($get_prices->num_rows() > 0) {
                                                                    foreach ($get_prices->result() as $prices) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $prices->DateTime; ?></td>
                                                                            <td><?php echo $prices->UnitPrice; ?></td>
                                                                            <td><?php echo $prices->WholesalerPrice; ?></td>
                                                                            <td><?php echo $prices->RetailerPrice; ?></td>
                                                                            <td><?php echo $prices->ConsumerPrice; ?></td>
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
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php $this->load->view("system/footer"); ?>
        </div><!-- ./wrapper -->
        <script>
            $(document).ready(function () {
                $('#prices_table').DataTable();
                $('#productmanagement').addClass('active');
                $('#manage_prices').addClass('active');
                $(document).on('click', "#add_price_submit", function (e) {

                    e.preventDefault();
                    $(".alert").hide();
                    if (!(/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:[\.,]\d+)?$/.test($('input#unitprice').val())) || $('input#unitprice').val() == '' || $('input#unitprice').val().trim() == "") {
                        $("#unitprice_error").show();
                        $("#unitprice").focus();
                    } else if (!(/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:[\.,]\d+)?$/.test($('input#wholesalerprice').val())) || $('input#wholesalerprice').val() == '' || $('input#wholesalerprice').val().trim() == "") {
                        $("#wholesalerprice_error").show();
                        $("#wholesalerprice").focus();
                    } else if (!(/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:[\.,]\d+)?$/.test($('input#retailerprice').val())) || $('#retailerprice').val() == '' || $('#retailerprice').val().trim() == "") {
                        $("#retailerprice_error").show();
                        $("#retailerprice").focus();
                    } else {
                        $("#add_price_form").submit();
                    }
                });

            });
        </script>
    </body>
</html>