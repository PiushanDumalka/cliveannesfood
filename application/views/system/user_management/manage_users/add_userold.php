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
                    <h1>User Management</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa  fa-home"></i> Home</a></li>
                        <li>User Management</li>
                        <li>Manage Users</li>
                        <li class="active">Add User</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-danger" id="user_view"  name="view_user" onclick="location.href = '<?php echo base_url(); ?>user/view_users';"><i class="fa fa-list"></i> View</button> 
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
                                                <?php echo form_open_multipart('', ['id' => 'add_user_form']); ?>
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
                                                    <div class="form-group col-sm-4">
                                                        <label>Gender</label><span style="color:Red;">*</span>
                                                        <select class="form-control" name="gender" id="gender" required>
                                                            <option value="0">Select Gender</option>
                                                            <option value="1">Male</option>
                                                            <option value="2">Female</option>
                                                        </select>
                                                        <div id="gender_error" class="alert alert-danger error" style="display:none;">Please select a Gender.</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p><b>CONTACT DETAILS:-</b></p><hr>
                                                    <div class="form-group col-sm-8">
                                                        <label>Address</label><span style="color:Red;">*</span>
                                                        <textarea class="form-control" name="address" id="address" required></textarea>
                                                        <div id="address_error" class="alert alert-danger error" style="display:none;">Address cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <div class="imageupload">
                                                            <label> Photo </label>
                                                            <div class="file-tab">
                                                                <label class="btn btn-primary btn-file">
                                                                    <span>Browse</span>
                                                                    <!-- The file is stored here. -->
                                                                    <input type="file" name="userphoto" id="userphoto">
                                                                </label>
                                                                <button type="button" class="btn btn-danger">Delete image</button>
                                                                <!-- The URL is stored here. -->
                                                                <input type="hidden" name="image-url">
                                                                <div class="error_photo_type" id="error_photo_type" style="display:none">Please upload a valid format</div>    
                                                                <div class="error_photo_size" id="error_photo_size" style="display:none">Please upload lower than 1MB</div> 
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4">
                                                        <label>Mobile No</label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="mobile" id="mobile" type="text" maxlength="14" required/>
                                                        <div id="mobile_error" class="alert alert-danger error" style="display:none;">Please enter Mobile No Correctly.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="reg_input_currency">Email</label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="email" id="email" type="text" required/>
                                                        <div id="email_error" class="alert alert-danger error" style="display:none;">Please enter Email correctly.</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p><b>OFFICIAL DETAILS:-</b></p><hr>
                                                    <div class="form-group col-sm-4">
                                                        <label class="req">EPF NO </label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="epfno" id="epfno" type="text" maxlength="20" required/>
                                                        <div id="epf_error" class="alert alert-danger error" style="display:none;">EPF No cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label class="req">Organization Name </label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="organizationname" id="organizationname" type="text" maxlength="20" required value="Cliveannes Food"/>
                                                        <div id="organizationname_error" class="alert alert-danger error" style="display:none;">Organization Name cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="reg_input_designation">Designation</label><span style="color:Red;">*</span>
                                                        <select class="form-control" name="designation" id="designation" required>
                                                            <option value="">Select Designation</option>
                                                            <?php
                                                            if ($get_designation->num_rows() > 0) {
                                                                foreach ($get_designation->result() as $designation) {
                                                                    echo "<option value='$designation->Id'>$designation->Designation</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <div id="designation_error" class="alert alert-danger error" style="display:none;">Please select a Designation.</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4">
                                                        <label for="reg_input_usertype">User Type</label><span style="color:Red;">*</span>
                                                        <select class="form-control" name="usertype" id="usertype" required>
                                                            <option value="">Select User Type</option>
                                                            <?php
                                                            if ($get_usertype->num_rows() > 0) {
                                                                foreach ($get_usertype->result() as $usertype) {
                                                                    echo "<option value='$usertype->Id'>$usertype->Type</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <div id="usertype_error" class="alert alert-danger error" style="display:none;">Please select a Usertype.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label class="req">Username </label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="username" id="username" type="text" maxlength="20" value="<?php echo 'EMP' . str_pad($get_userid, 6, '0', STR_PAD_LEFT); ?>" required readonly/>
                                                        <div id="username_error" class="alert alert-danger error" style="display:none;">Username cannot be empty.</div>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label class="req">Password </label><span style="color:Red;">*</span>
                                                        <input class="form-control" name="password" id="password" type="text" maxlength="20" required/>
                                                        <div id="password_error" class="alert alert-danger error" style="display:none;">Password cannot be empty.</div>
                                                    </div>

                                                </div>
                                                <div class="row buttons">
                                                    <div class="col-sm-1">
                                                        <div class="form_sep">
                                                            <input class="btn btn-warning" id="add_user_submit" type="submit" name="add_user_submit" value="Submit" />    
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form_sep">
                                                            <button type="button" class="btn btn-danger" id="cancel_user"  name="cancel_user" onclick="location.href = '<?php echo base_url(); ?>user/view_users';"><i class="fa fa-reply"></i> cancel</button> 
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
                $('#usermanagement').addClass('active');
                $('#manage_users').addClass('active');
                /**image upload**/
                $('.imageupload').imageupload({
                    maxWidth: 175,
                    maxHeight: 175,
                    maxFileSizeKb: 1024
                });

                /**email on change check availability
                 $("#email").change(function () {
                 $('.error').hide();
                 var id = "#email";
                 var value = $("#email").val();
                 var column = 'Email';
                 var error_id = '#email_error';
                 ajax_checkavailabilty(value, column, error_id, id);
                 $('#username').val($(this).val());
                 });*/

                /**email on change check availability*/
                $("#nic").change(function () {
                    $('#password').val($(this).val());//assign password 
                });

                function ajax_checkavailabilty(value, column, error_id, id) {
                    $.ajax({
                        url: '<?php echo base_url("index.php/user/check_availablity"); ?>' + '/' + encodeURIComponent(value) + '/' + column,
                        type: 'get',
                        dataType: 'json',
                        success: function (data) {
                            $(id).val('');
                            $(error_id).show();
                            $(error_id).html(value + ' is already registerd');
                        },
                        error: function (data) {
                        }
                    });
                }

                /**Form Validation**/
                $(document).on('click', "#add_user_submit", function (e) {

                    e.preventDefault();
                    $(".alert").hide();
                    if ($('input#fullname').val() == '' || $('input#fullname').val().trim() == "") {
                        $("#fullname_error").show();
                        $("#fullname").focus();
                    } else if (!(/^((19|20)\d{2}[^4,9]\d{6}[\d])$|^(\d{2}[^4,9]\d{6}[xvXV])$/i.test($('input#nic').val()))) {
                        $("#nic_error").show();
                        $("#nic").focus();
                    } else if ($('#gender').val() == 0) {
                        $("#gender_error").show();
                        $("#gender").focus();
                    } else if ($('#address').val() == '' || $('#address').val().trim() == "") {
                        $("#address_error").show();
                        $("#address").focus();
                    } else if (!(/^[0-9\+]{1,}[0-9\-]{3,15}$/i.test($('input#mobile').val()))) {
                        $("#mobile_error").show();
                        $("#mobile").focus();
                    } else if (!(/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test($('#email').val()))) {
                        $("#email_error").show();
                        $("#email").focus();
                    } else if ($('#epfno').val() == '' || $('#epfno').val().trim() == "") {
                        $("#epf_error").show();
                        $("#epfno").focus();
                    } else if ($('#organizationname').val() == '' || $('#organizationname').val().trim() == "") {
                        $("#organizationname_error").show();
                        $("#organizationname").focus();
                    } else if ($('#designation').val() == 0) {
                        $("#designation_error").show();
                        $("#designation").focus();
                    } else if ($('#usertype').val() == 0) {
                        $("#usertype_error").show();
                        $("#usertype").focus();
                    } else if ($('input#username').val() == '' || $('input#username').val().trim() == "") {
                        $("#username_error").show();
                        $("#username").focus();
                    } else if ($('input#password').val() == '' || $('input#password').val().trim() == "") {
                        $("#password_error").show();
                        $("#password").focus();
                    } else {
                        $("#add_user_form").submit();
                    }
                });

            });
        </script>
    </body>
</html>