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
                    <h1>Manage Privilege</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li>User Management</li>
                        <li>Manage Privileges</li>
                        <li class="active">Edit Privilege</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-heading">
                                        <?php echo form_open_multipart('', ['id' => 'edit_userprivilege_form']); ?>
                                        <div class="row">
                                            <div class="form-group col-sm-4">
                                                <label for="reg_input_user">User</label><span style="color:Red;">*</span>
                                                <select class="form-control" name="user" id="user" required  disabled="true">
                                                    <?php
                                                    if ($get_users->num_rows() > 0) {
                                                        ?>
                                                        <option value="<?php echo $get_users->row()->Id ?>"> <?php echo $get_users->row()->FullName ?></option>;
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <div id="user_error" class="alert alert-danger error" style="display:none;">Please select a Usertype.</div>
                                            </div>
                                            <div class="form-group col-sm-7">
                                                <label>Privileges</label><span style="color:Red;">*</span>
                                                <select class="form-control" id="privilege" name="privilege[]" multiple="multiple" value="Please select Privileges">
                                                    <?php
                                                    if ($get_usersprivileges_notassigned->num_rows() > 0) {
                                                        foreach ($get_usersprivileges_notassigned->result() as $privilege) {
                                                            ?>
                                                            <option value='<?php echo $privilege->Id ?>'> <?php echo $privilege->Privilege ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div id="privilege_error" class="alert alert-danger error" style="display:none;">Please select Privilege.</div>
                                            </div>
                                        </div>  
                                        <div class="row buttons">
                                            <div class="col-sm-1">
                                                <div class="form_sep">
                                                    <input class="btn btn-warning" id="edit_userprivilege_submit" type="submit" name="edit_userprivilege_submit" value="Update" />    
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="form_sep">
                                                    <button type="button" class="btn btn-danger" id="cancel_user"  name="cancel_user" onclick="location.href = '<?php echo base_url(); ?>userprivileges/view_privileges';"><i class="fa fa-reply"></i> cancel</button> 
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?> 
                                    </div>
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
                                                    <table id="users_table" class="table table-striped table-bordered table-hover table-active" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>User Name</th>
                                                                <th>User Privileges</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($get_privileges->num_rows() > 0) {
                                                                foreach ($get_privileges->result() as $userprivileges) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><span><?php echo $userprivileges->FullName; ?></span></td>
                                                                        <td><?php echo $userprivileges->Privilege; ?></td>
                                                                        <td><button type="button" class="btn btn-link delete" id="<?php echo $userprivileges->UserId; ?>/<?php echo $userprivileges->PrivilegeId; ?>"><i class="fa fa-trash"></i> Delete</button></td>
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
                $('#users_table').DataTable();
                $('.alert').delay(3000).fadeOut('slow');

                $("#privilege").select2({
                    placeholder: "Select a Privileges",
                    allowClear: true
                });

                /**Form Validation**/
                $(document).on('click', "#edit_userprivilege_submit", function (e) {
                    e.preventDefault();
                    $(".alert").hide();
                    if ($('#user').val() == 0) {
                        $("#user_error").show();
                        $("#user").focus();
                    } else if ($('#privilege').val() == 0) {
                        $("#privilege_error").show();
                        $("#privilege").focus();
                    } else {
                        $("#edit_userprivilege_form").submit();
                    }
                });


                /**delete**/
                $(document).on('click', ".delete", function (e) {
                    var id = $(this).attr('id');
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                            .then((willDelete) => {
                                if (willDelete) {
                                    document.location.href = '<?php echo base_url(); ?>userprivileges/delete_userprivilege/' + id;
                                } else {
                                    swal("Not Deleted!");
                                }
                            });

                });

                $('#usermanagement').addClass('active');
                $('#manage_privileges').addClass('active');

            });


        </script>
    </body>
</html>