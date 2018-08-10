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
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li>User Management</li>
                        <li>Manage Users</li>
                        <li class = "active">View User <?php if ($get_user->num_rows() > 0) { ?> - <?php echo $get_user->row()->UserId; ?><?php } ?></li>
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
                                        <button type="button" class="btn btn-primary pull-right" id="user_view"  name="view_user" onclick="location.href = '<?php echo base_url(); ?>user/edit_user/<?php echo $get_user->row()->Id; ?>';"><i class="fa fa-edit"></i> Edit</button> 
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-12">
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
                                    <div class="col-sm-12">
                                        <div class="panel-body">
                                            <div class="row">
                                                <?php
                                                if ($get_user->num_rows() > 0) {
                                                    ?>
                                                    <div class="form-group col-sm-3">
                                                        <?php if ($get_user->row()->PhotoName) { ?>
                                                            <img class="img-fluid img-thumbnail" style="width:40%;" src="<?php echo base_url(); ?>uploads/users/<?php echo $get_user->row()->PhotoName; ?>"/></a>
                                                        <?php } else { ?>
                                                            <img class="img-fluid img-thumbnail" style="width:50%;" src="<?php echo base_url(); ?>assets/system/img/no-user-img.png"/></a>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-group col-sm-7">
                                                        <div class="row">
                                                            <hr> <p><b>PERSONAL DETAILS:-</b></p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Full Name </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_user->row()->FullName; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">NIC</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_user->row()->NIC; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Gender </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo ($get_user->row()->Gender == '1' ) ? "Male" : "Female" ?></div> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                        <div class="row">
                                                            <hr>&nbsp;
                                                            <img style='width:90%;' src='<?php echo base_url(); ?><?php echo ($get_user->row()->Status == '1' ) ? "assets/system/img/active.png" : "assets/system/img/deactive.png" ?>'/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <hr><p><b>CONTACT DETAILS:-</b></p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Address </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_user->row()->Address; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Mobile No</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_user->row()->Contact; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Email </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_user->row()->Email; ?></div> 
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <hr><p><b>OFFICIAL DETAILS:-</b></p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">EPF No </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_user->row()->EpfNo; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Organization</label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_user->row()->OrganizationName; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">Designation </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_user->row()->Designation; ?></div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">User Type </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_user->row()->Type; ?></div> 
                                                        </div>  
                                                        <div class="row">
                                                            <div class="form-group col-sm-3">
                                                                <label class="req">User ID </label>
                                                            </div> 
                                                            <div class="form-group col-sm-9"><?php echo $get_user->row()->Username; ?></div> 
                                                        </div>   
                                                        <?php
                                                    }
                                                    ?>
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
                $('#usermanagement').addClass('active');
                $('#manage_users').addClass('active');
            });
        </script>
    </body>
</html>