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
                    <h1>Customer Management</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa  fa-home"></i> Home</a></li>
                        <li>Customer Management</li>
                        <li>Manage Customers</li>
                        <li class="active">Add Customer</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-danger" id="customer_view"  name="view_customer" onclick="location.href = '<?php echo base_url(); ?>customer/view_customers';"><i class="fa fa-list"></i> View</button> 
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
                                                <?php echo form_open('', ['id' => 'add_customer_form']); ?>
                                                <div class="row">
                                                    <p><b>PERSONAL DETAILS:-</b></p><hr>
                                                    <div class="form-group col-sm-4"><span style="color:Red;">*</span>
                                                        <label class="req">Full Name </label>
                                                        <input class="form-control" name="fullname" id="fullname" type="text" maxlength="45" required/>
                                                        <div id="fullname_error" class="alert alert-danger error" style="display:none;">Fullname cannot be empty.</div>
                                                    </div>                
                                                    <div class="form-group col-sm-4">
                                                        <label>NIC No.</label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="nic" id="nic" type="text" maxlength="16" required/>
                                                        <div id="nic_error" class="alert alert-danger error" style="display:none;">Please enter NIC correctly.</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p><b>CONTACT DETAILS:-</b></p><hr>
                                                    <div class="form-group col-sm-4">
                                                        <label>Address (Bulding No)</label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="address1" id="address1" required />
                                                        <div id="address1_error" class="alert alert-danger error" style="display:none;">Address (Bulding No) cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label>Address (Root,village)</label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="address2" id="address2" required />
                                                        <div id="address2_error" class="alert alert-danger error" style="display:none;">Address(Root,village) cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label>Province</label><span style="color:Red;">*</span>
                                                        <select class="form-control" name="province" id="province">
                                                            <option value="0">Please Select a Province</option>
                                                            <?php
                                                            if ($get_province->num_rows() > 0) {
                                                                foreach ($get_province->result() as $province) {
                                                                    ?>
                                                                    <option value="<?php echo $province->id; ?>"><?php echo $province->name_en; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>                                                    
                                                        <div id="province_error" class="alert alert-danger error" style="display:none;">Province cannot be empty.</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4">
                                                        <label>District</label><span style="color:Red;">*</span>
                                                        <select class="form-control" name="district" id="district" placeholder="district">
                                                            <option value="0">Please Select a District</option>
                                                            <?php
                                                            if ($get_district->num_rows() > 0) {
                                                                foreach ($get_district->result() as $district) {
                                                                    ?>
                                                                    <option value="<?php echo $district->id; ?>"><?php echo $district->name_en; ?></option> 
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>                                                       
                                                        <div id="district_error" class="alert alert-danger error" style="display:none;">District cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label>City</label><span style="color:Red;">*</span>
                                                        <select class="form-control" name="city" id="city" placeholder="city">
                                                            <option value="0">Please Select a City</option>
                                                            <?php
                                                            if ($get_city->num_rows() > 0) {
                                                                foreach ($get_city->result() as $city) {
                                                                    ?>
                                                                    <option value="<?php echo $city->id; ?>"><?php echo $city->name_en; ?></option>                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>                                                        <div id="city_error" class="alert alert-danger error" style="display:none;">City cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label>Contact No</label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="contact" id="contact" type="text" maxlength="14" required/>
                                                        <div id="contact_error" class="alert alert-danger error" style="display:none;">Please enter Contact No Correctly.</div>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <p><b>OFFICIAL DETAILS:-</b></p><hr>

                                                    <div class="form-group col-sm-4">
                                                        <label for="reg_input_designation">Customer Type</label><span style="color:Red;">*</span>
                                                        <select class="form-control" name="customertype" id="customertype" required>
                                                            <option value="">Select Type</option>
                                                            <?php
                                                            if ($get_customertype->num_rows() > 0) {
                                                                foreach ($get_customertype->result() as $customertype) {
                                                                    echo "<option value='$customertype->Id'>$customertype->Title</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <div id="customertype_error" class="alert alert-danger error" style="display:none;">Please select a Customer Type.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label class="req">Reg NO </label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="regno" id="regno" type="text" maxlength="20"  placeholder="Registration No" value='Not Reg' required/>
                                                        <div id="regno_error" class="alert alert-danger error" style="display:none;">Reg No cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label class="req">Organization Name </label><span style="color:Red;">*</span>
                                                        <input type="text" class="form-control" name="regname" id="regname" placeholder="Buissness Name" required="true" data-toggle="tooltip" title="Please enter your Buisness name">
                                                        <div id="regname_error" class="alert alert-danger error" style="display:none;">Organization Name cannot be empty.</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4">
                                                        <label for="reg_input_currency">Email</label><span style="color:Red;"></span>
                                                        <input class="form-control" name="email" id="email" type="text"/>
                                                        <div id="email_error" class="alert alert-danger error" style="display:none;">Please enter Email correctly.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label class="req">username </label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="username" id="username" type="text" maxlength="20" value="<?php echo 'CS' . str_pad($get_customerid, 6, '0', STR_PAD_LEFT); ?>" required readonly/>
                                                        <div id="customername_error" class="alert alert-danger error" style="display:none;">userrname cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                        <label class="req">Password </label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="password" id="password" type="text" maxlength="20" required/>
                                                        <div id="password_error" class="alert alert-danger error" style="display:none;">Password cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                        <label class="req">Confirm </label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="confirm" type="password" id="confirm" maxlength="20" required/>
                                                        <div id="confirm_error" class="alert alert-danger error" style="display:none;">Confirmed Wrong.</div>
                                                    </div>
                                                </div>
                                                <div class="row buttons">
                                                    <div class="col-md-1 col-sm-2">
                                                        <div class="form_sep">
                                                            <input class="btn btn-warning" id="add_customer_submit" type="submit" name="add_customer_submit" value="Submit" />    
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-sm-2">
                                                        <div class="form_sep">
                                                            <button type="button" class="btn btn-danger" id="cancel_customer"  name="cancel_customer" onclick="location.href = '<?php echo base_url(); ?>customer/view_customers';"><i class="fa fa-reply"></i> cancel</button> 
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
                $('.imageupload').imageupload({
                    maxWidth: 175,
                    maxHeight: 175,
                    maxFileSizeKb: 1024
                });

                /**nic on change password*/
                $("#nic").change(function () {
                    $('#password').val($(this).val());//assign password 
                     $('#confirm').val($(this).val());
                });
                /**province on change get district data*/
                $("#province").change(function () {
                    var province = $("#province").val();
                    $.ajax({
                        url: '<?php echo base_url("customer/get_district"); ?>' + '/' + province,
                        type: 'get',
                        dataType: 'json',
                        success: function (data) {
                            $('#district').html('');
                            $('#district').append('<option value="0">Please Select a District</option>');
                            $(data).each(function (index, value) {
                                console.log(value);
                                $('#district').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                            });
                        },
                        error: function (data) {
                        }
                    });
                });
                /**district on change get city data*/
                $("#district").change(function () {
                    var district = $("#district").val();
                    $.ajax({
                        url: '<?php echo base_url("customer/get_city"); ?>' + '/' + district,
                        type: 'get',
                        dataType: 'json',
                        success: function (data) {
                            $('#city').html('');
                            $('#city').append('<option value="0">Please Select a city</option>');
                            $(data).each(function (index, value) {
                                console.log(value);
                                $('#city').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                            });
                        },
                        error: function (data) {
                        }
                    });
                });
                /**Form Validation**/
                $(document).on('click', "#add_customer_submit", function (e) {

                    e.preventDefault();
                    $(".alert").hide();
                    if ($('input#fullname').val() == '' || $('input#fullname').val().trim() == "") {
                        $("#fullname_error").show();
                        $("#fullname").focus();
                    } else if (!(/^((19|20)\d{2}[^4,9]\d{6}[\d])$|^(\d{2}[^4,9]\d{6}[xvXV])$/i.test($('input#nic').val()))) {
                        $("#nic_error").show();
                        $("#nic").focus();
                    } else if ($('#address1').val() == '' || $('#address1').val().trim() == "") {
                        $("#address1_error").show();
                        $("#address1").focus();
                    } else if ($('#address2').val() == '' || $('#address2').val().trim() == "") {
                        $("#address2_error").show();
                        $("#address2").focus();
                    } else if ($('#province').val() == 0) {
                        $("#province_error").show();
                        $("#province").focus();
                    } else if ($('#district').val() == 0) {
                        $("#district_error").show();
                        $("#district").focus();
                    } else if ($('#city').val() == 0) {
                        $("#city_error").show();
                        $("#city").focus();
                    } else if (!(/^[0-9\+]{1,}[0-9\-]{3,15}$/i.test($('input#contact').val()))) {
                        $("#contact_error").show();
                        $("#contact").focus();
                    } else if ($('#customertype').val() == 0) {
                        $("#customertype_error").show();
                        $("#customertype").focus();
                    } else if ($('#regno').val() == '' || $('#regno').val().trim() == "") {
                        $("#regno_error").show();
                        $("#regno").focus();
                    } else if ($('#regname').val() == '' || $('#regname').val().trim() == "") {
                        $("#regname_error").show();
                        $("#regname").focus();
                    } else if (!($('input#email').val() == '' || $('input#email').val().trim() == "" ) && !(/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test($('#email').val()))) {
                        $("#email_error").show();
                        $("#email").focus();
                    } else if ($('input#username').val() == '' || $('input#username').val().trim() == "") {
                        $("#username_error").show();
                        $("#username").focus();
                    } else if ($('input#password').val() == '' || $('input#password').val().trim() == "") {
                        $("#password_error").show();
                        $("#password").focus();
                    } else if ($('input#confirm').val() == '' || $('input#confirm').val().trim() == "") {
                        $("#confirm_error").show();
                        $("#confirm").focus();
                    } else if ($('input#confirm').val() != $('input#password').val()) {
                        $("#confirm_error").show();
                        $("#confirm").focus();
                    } else {
                        $("#add_customer_form").submit();
                    }
                });
                $('#province').select2();
                $('#district').select2();
                $('#city').select2();
                $('#customermanagement').addClass('active');
               // $('#customermanagement').addClass('menu-open');
                $('#manage_customers').addClass('active');

            });
        </script>
    </body>
</html>