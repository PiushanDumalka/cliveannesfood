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
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa  fa-home"></i> Home</a></li>
                        <li>Product Management</li>
                        <li>Manage Product</li>
                        <li class="active">Add Product</li>
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
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p><b>PRODUCT DETAILS:-</b></p><hr>
                                                </div>
                                                <?php echo form_open_multipart('', ['id' => 'add_product_form']); ?>
                                                <div class="col-md-9">
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
                                                        <div class="form-group col-sm-6"><span style="color:Red;">*</span>
                                                            <label class="req">Product Name </label>
                                                            <input class="form-control" name="productname" id="productname" type="text" maxlength="65" required/>
                                                            <div id="productname_error" class="alert alert-danger error" style="display:none;">Productname cannot be empty.</div>
                                                        </div>                
                                                        <div class="form-group col-sm-6">
                                                            <label>Product Category</label><span style="color:Red;">*</span>
                                                            <select class="form-control" name="productcategory" id="productcategory">
                                                                <option value="0">Please Select a Product Category</option>
                                                                <?php
                                                                if ($get_productcategory->num_rows() > 0) {
                                                                    foreach ($get_productcategory->result() as $productcategory) {
                                                                        ?>
                                                                        <option value="<?php echo $productcategory->Id; ?>"><?php echo $productcategory->CategoryName; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>                                                    
                                                            <div id="productcategory_error" class="alert alert-danger error" style="display:none;">Product Category cannot be empty.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label for="reg_input_designation">Weight</label><span style="color:Red;">*</span>
                                                            <select class="form-control" name="weight" id="weight" required>
                                                                <option value="">Select Weight</option>
                                                                <?php
                                                                if ($get_weight->num_rows() > 0) {
                                                                    foreach ($get_weight->result() as $weight) {
                                                                        echo "<option value='$weight->Id'>$weight->Weight$weight->Unit</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <div id="weight_error" class="alert alert-danger error" style="display:none;">Please select a weight.</div>
                                                        </div>
                                                        <div class="form-group col-sm-6"><span style="color:Red;">*</span>
                                                            <label class="req">Expire Duration </label>
                                                            <input class="form-control" name="expireduration" id="expireduration" type="text" maxlength="65" required/>
                                                            <div id="expireduration_error" class="alert alert-danger error" style="display:none;">Expire Duration cannot be empty.</div>
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label for="reg_input_designation">Availability</label><span style="color:Red;">*</span>
                                                            <select class="form-control" name="availability" id="availability" required disabled="true">
                                                                <option value='1'>Active</option>;
                                                                <option value='0'>Inactive</option>;
                                                            </select>
                                                            <div id="producttype_error" class="alert alert-danger error" style="display:none;">Please select a Product Category.</div>
                                                        </div> 
                                                        <div class="form-group col-sm-6">
                                                            <label class="req">Remarks</label>
                                                            <input class="form-control" name="remark" id="remark" type="text" maxlength="65" required/>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <div class="avatar-upload">
                                                                <div class="avatar-edit">
                                                                    <input type='file' id="productphoto" name="productphoto" accept=".png, .jpg, .jpeg" />
                                                                    <label for="productphoto"></label>
                                                                </div>
                                                                <div class="avatar-preview">
                                                                    <div id="imagePreview" style="background-image: url(<?php echo base_url(); ?>assets/system/img/product-img.png);"></div>
                                                                </div>
                                                            </div>
                                                            <div class="alert alert-danger" id="error_photo_type" style="display:none">Please upload a valid format</div>    
                                                            <div class="alert alert-danger" id="error_photo_size" style="display:none">Please upload lower than 1MB</div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        <div class="col-md-12">
                                                            <br/> <p><b>PRICE DETAILS:-</b></p><hr>
                                                        </div>
                                                        <div class="form-group col-sm-4">
                                                            <label class="req">Unit Price (Rs.)</label>
                                                            <input class="form-control" name="unitprice" id="unitprice" type="text" maxlength="10" required/>
                                                            <div id="unitprice_error" class="alert alert-danger error" style="display:none;">Please Enter Currency</div>
                                                        </div> 

                                                        <div class="form-group col-sm-4">
                                                            <label class="req">Wholesaler Price (Rs.)</label>
                                                            <input class="form-control" name="wholesalerprice" id="wholesalerprice" type="text" maxlength="10" required/>
                                                            <div id="wholesalerprice_error" class="alert alert-danger error" style="display:none;">Please Enter Currency</div>
                                                        </div> 

                                                        <div class="form-group col-sm-4">
                                                            <label class="req">Retailer Price (Rs.)</label>
                                                            <input class="form-control" name="retailerprice" id="retailerprice" type="text" maxlength="10" required/>
                                                            <div id="retailerprice_error" class="alert alert-danger error" style="display:none;">Please Enter Currency</div>
                                                        </div> 
                                                        <!--                                                        <div class="form-group col-sm-3">
                                                                                                                    <label class="req">Consumer Price (Rs.)</label>
                                                                                                                    <input class="form-control" name="consumerprice" id="consumerprice" type="text" maxlength="10" required/>
                                                                                                                    <div id="consumerprice_error" class="alert alert-danger error" style="display:none;">Please Enter Currency</div>
                                                                                                                </div> -->
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 buttons">
                                                        <div class="col-md-1 col-sm-2">
                                                            <div class="form_sep">
                                                                <input class="btn btn-warning" id="add_product_submit" type="submit" name="add_product_submit" value="Submit" />    
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-sm-2">
                                                            <div class="form_sep">
                                                                <button type="button" class="btn btn-danger" id="cancel_product"  name="cancel_product" onclick="location.href = '<?php echo base_url(); ?>product/view_products';"><i class="fa fa-reply"></i> cancel</button> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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

                /**image upload**/
                $("#productphoto").change(function () {
                    $("#error_photo_type").hide();
                    $("#error_photo_size").hide();
                    readURL(this);
                });

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var fileExtension = ['jpeg', 'jpg', 'png'];
                        if ($.inArray($(input).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                            $("#error_photo_type").show();
                            $("#productphoto").val("");
                        } else if (input.files[0].size < 1024000 || input.files[0].fileSize < 1024000) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                                $('#imagePreview').hide();
                                $('#imagePreview').fadeIn(650);
                            }
                            reader.readAsDataURL(input.files[0]);
                        } else {
                            $('#imagePreview').css('background-image', 'url(<?php echo base_url(); ?>assets/system/img/product-img.png)');
                            $("#error_photo_size").show();
                            $("#productphoto").val("");
                        }
                    }

                }
                /**Form Validation**/
                $(document).on('click', "#add_product_submit", function (e) {

                    e.preventDefault();
                    $(".alert").hide();
                    if ($('input#productname').val() == '' || $('input#productname').val().trim() == "") {
                        $("#productname_error").show();
                        $("#productname").focus();
                    } else if ($('#productcategory').val() == 0) {
                        $("#productcategory_error").show();
                        $("#productcategory").focus();
                    } else if ($('#weight').val() == 0) {
                        $("#weight_error").show();
                        $("#weight").focus();
                    } else if ($('input#expireduration').val() == '' || $('input#expireduration').val().trim() == "") {
                        $("#expireduration_error").show();
                        $("#expireduration").focus();
                    } else if (!(/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:[\.,]\d+)?$/.test($('input#unitprice').val())) || $('input#unitprice').val() == '' || $('input#unitprice').val().trim() == "") {
                        $("#unitprice_error").show();
                        $("#unitprice").focus();
                    } else if (!(/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:[\.,]\d+)?$/.test($('input#wholesalerprice').val())) || $('input#wholesalerprice').val() == '' || $('input#wholesalerprice').val().trim() == "") {
                        $("#wholesalerprice_error").show();
                        $("#wholesalerprice").focus();
                    } else if (!(/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:[\.,]\d+)?$/.test($('input#retailerprice').val())) || $('#retailerprice').val() == '' || $('#retailerprice').val().trim() == "") {
                        $("#retailerprice_error").show();
                        $("#retailerprice").focus();
                    } else {
                        $("#add_product_form").submit();
                    }
                });

                $('#productmanagement').addClass('active');
                $('#manage_products').addClass('active');

            });
        </script>
    </body>
</html>