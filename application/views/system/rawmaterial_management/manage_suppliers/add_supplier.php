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
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa  fa-home"></i> Home</a></li>
                        <li>supplier Management</li>
                        <li>Manage Suppliers</li>
                        <li class="active">Add Supplier</li>
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
                                                <?php echo form_open('', ['id' => 'add_supplier_form']); ?>
                                                <div class="row">
                                                    <p><b>PERSONAL DETAILS:-</b></p><hr>
                                                    <div class="form-group col-sm-4"><span style="color:Red;">*</span>
                                                        <label class="req">Supplier Name </label>
                                                        <input class="form-control" name="suppliername" id="suppliername" type="text" maxlength="45" required/>
                                                        <div id="suppliername_error" class="alert alert-danger error" style="display:none;">Supplier Name cannot be empty.</div>
                                                        <?php echo form_error('suppliername'); ?>
                                                    </div> 
                                                    <div class="form-group col-sm-4">
                                                        <label>Address </label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="address" id="address" required />
                                                        <div id="address_error" class="alert alert-danger error" style="display:none;">Address cannot be empty.</div>
                                                        <?php echo form_error('address'); ?>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label>Contact No</label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="contact" id="contact" type="text" maxlength="14" required/>
                                                        <div id="contact_error" class="alert alert-danger error" style="display:none;">Please enter Contact No Correctly.</div>
                                                        <?php echo form_error('contact'); ?>
                                                    </div> 
                                                </div> 
                                                <div class="row">
                                                    <div class="form-group col-sm-4">
                                                        <label>Phone No</label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="phoneno" id="phoneno" required />
                                                        <div id="phoneno_error" class="alert alert-danger error" style="display:none;">Please enter Mobile No Correctly.</div>
                                                        <?php echo form_error('phoneno'); ?>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="reg_input_currency">Email</label><span style="color:Red;"></span>
                                                        <input class="form-control" name="email" id="email" type="text"/>
                                                        <div id="email_error" class="alert alert-danger error" style="display:none;">Please enter Email correctly.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="reg_input_currency">Description</label><span style="color:Red;"></span>
                                                        <textarea class="form-control" name="description" id="description" ></textarea>
                                                        <div id="description_error" class="alert alert-danger error" style="display:none;">Please enter Description correctly.</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p><b>MATERIALS DETAILS:-</b> <span style="color:Red;">*</span></p><hr>
                                                    <div class="form-group col-sm-6">
                                                        <label>Raw Materials</label>
                                                        <select class="form-control" id="raw" name="raw[]" multiple="multiple" value="Please select Raw Materials">
                                                            <?php
                                                            if ($get_rawmaterials->num_rows() > 0) {
                                                                foreach ($get_rawmaterials->result() as $raw) {
                                                                    echo "<option value='$raw->Id'>$raw->RawmaterialName</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label>Packing Materials</label>
                                                        <select class="form-control" id="pack" name="pack[]" multiple="multiple" value="Please select Raw Materials">
                                                            <?php
                                                            if ($get_packingmaterials->num_rows() > 0) {
                                                                foreach ($get_packingmaterials->result() as $pack) {
                                                                    echo "<option value='$pack->Id'>$pack->RawmaterialName</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div id="material_error" class="alert alert-danger error" style="display:none;">Please select Raw Materials / Packing Materials.</div>
                                                </div>
                                                <div class="row buttons">
                                                    <div class="col-md-1 col-sm-2">
                                                        <div class="form_sep">
                                                            <input class="btn btn-warning" id="add_supplier_submit" type="submit" name="add_supplier_submit" value="Submit" />    
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-2">
                                                        <div class="form_sep">
                                                            <button type="button" class="btn btn-danger" id="cancel_supplier"  name="cancel_supplier" onclick="location.href = '<?php echo base_url(); ?>supplier/view_suppliers';"><i class="fa fa-reply"></i> cancel</button> 
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
                //multiple select
                $('#raw').select2({
                    placeholder: "Please select Raw Materials"
                });
                $('#pack').select2({
                    placeholder: "Please select Raw Materials"
                });
                /**Form Validation**/
                $(document).on('click', "#add_supplier_submit", function (e) {

                    e.preventDefault();
                    $(".alert").hide();
                    if ($('input#suppliername').val() == '' || $('input#suppliername').val().trim() == "") {
                        $("#suppliername_error").show();
                        $("#suppliername").focus();
                    } else if ($('#address').val() == '' || $('#address').val().trim() == "") {
                        $("#address_error").show();
                        $("#address").focus();
                    } else if (!(/^[0-9\+]{1,}[0-9\-]{3,15}$/i.test($('input#contact').val()))) {
                        $("#contact_error").show();
                        $("#contact").focus();
                    } else if (!(/^[0-9\+]{1,}[0-9\-]{3,15}$/i.test($('input#phoneno').val()))) {
                        $("#phoneno_error").show();
                        $("#phoneno").focus();
                    } else if (!($('#email').val() == '' || $('#email').val().trim() == "") && !(/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test($('#email').val()))) {
                        $("#email_error").show();
                        $("#email").focus();
                    } else if (($('#raw').val() == '') && ($('#pack').val() == '')) {
                        $("#material_error").show();
                        $("#raw").focus();
                    } else {
                        $("#add_supplier_form").submit();
                    }
                });

                $('#rawmaterialmanagement').addClass('active');
                // $('#suppliermanagement').addClass('menu-open');
                $('#manage_suppliers').addClass('active');

            });
        </script>
    </body>
</html>