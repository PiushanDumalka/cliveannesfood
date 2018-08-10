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
                        <li>Manage Privileges</li>
                        <li class="active">Add User Privileges</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-danger" id="user_view"  name="view_user" onclick="location.href = '<?php echo base_url(); ?>usertyperole/view_usertyperoles';"><i class="fa fa-list"></i> View</button> 
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
                                                <?php echo form_open_multipart('', ['id' => 'add_usertyperole_form']); ?>
                                                <div class="row">
                                                    <p><b>Assign Roles</b></p><hr>
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
                                                    <div class="form-group col-sm-8">
                                                        <label>User Roles</label><span style="color:Red;">*</span>
                                                        <select class="form-control" id="role" name="role[]" multiple="multiple" value="Please select Roles">
                                                            <?php
                                                            if ($get_userrole->num_rows() > 0) {
                                                                foreach ($get_userrole->result() as $role) {
                                                                    echo "<option value='$role->Id'>$role->RoleName</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <div id="role_error" class="alert alert-danger error" style="display:none;">Please select Roles.</div>
                                                    </div>
                                                </div>  
                                                <div class="row buttons">
                                                    <div class="col-sm-1">
                                                        <div class="form_sep">
                                                            <input class="btn btn-warning" id="add_usertyperole_submit" type="submit" name="add_usertyperole_submit" value="Submit" />    
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form_sep">
                                                            <button type="button" class="btn btn-danger" id="cancel_user"  name="cancel_user" onclick="location.href = '<?php echo base_url(); ?>usertyperole/view_usertyperoles';"><i class="fa fa-reply"></i> cancel</button> 
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

                $('#role').select2({
                    placeholder: "Please select Roles"
                });

                /**usertype on change get roles if have*/
                $("#usertype").change(function () {

                    $('#role').val('').change();//empty value
                    $("#role").attr("disabled", false);//disable false 
                    $("#add_usertyperole_submit").attr("disabled", false);
                    var usertype = $("#usertype").val();

                    //alert(usertype);
                    $.ajax({
                        url: '<?php echo base_url(); ?>usertyperole/assigned_usertyperoles' + '/' + usertype,
                        type: 'get',
                        dataType: 'json',
                        success: function (data) {
                            // $('#role').html('');
                            $(data).each(function (index, value) {
                                $("#role").select2("trigger", "select", {
                                    data: {id: value[1]}
                                });
                                //$('#role').val(value[1]).change();
                                //$("#role option[value=" + value[1] + "]").prop("selected", true);
                            });
                            $("#role").attr("disabled", true);
                            $("#add_usertyperole_submit").attr("disabled", true);
                        },
                        error: function (data) {
                        }
                    });
                });

                /**Form Validation**/
                $(document).on('click', "#add_usertyperole_submit", function (e) {
                    e.preventDefault();
                    $(".alert").hide();
                    if ($('#usertype').val() == 0) {
                        $("#usertype_error").show();
                        $("#usertype").focus();
                    } else if ($('#role').val() == 0) {
                        $("#role_error").show();
                        $("#role").focus();
                    } else {
                        $("#add_usertyperole_form").submit();
                    }
                });

                $('#usermanagement').addClass('active');
                $('#manage_privileges').addClass('active');

            });
        </script>
    </body>
</html>