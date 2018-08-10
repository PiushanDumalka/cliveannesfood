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
                        <li class="active">View Users</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-primary" id="add_user"  name="add_user" onclick="location.href = '<?php echo base_url(); ?>user/add_user';"><i class="fa fa-user-plus"></i> New</button> 
                                        <button type="button" class="btn btn-link pull-right" id="deactivated_user"  name="deactivated_user" onclick="location.href = '<?php echo base_url(); ?>user/deactivated_users';" data-toggle="tooltip" title="Deactive Users"><i class="fa fa-trash-o"></i></button> 
                                        <button type="button" class="btn btn-default pull-right"  onclick="location.href = '<?php echo base_url(); ?>pdfs/save_pdf';"><i class="fa fa-print"></i>Print</button> 
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
                                                    <table id="users_table" class="table table-striped table-bordered table-hover table-active" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Full Name</th>
                                                                <th>NIC</th>
                                                                <th>User ID</th>
                                                                <th>EPF No</th>
                                                                <th>Organization Name</th>
                                                                <th>Designation</th>
                                                                <th>Mobile No</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($get_users->num_rows() > 0) {
                                                                foreach ($get_users->result() as $users) {
                                                                    ?>
                                                                    <tr onclick="location.href = '<?php echo base_url(); ?>user/view_user/<?php echo $users->Id; ?>';">
                                                                        <td><span><?php echo $users->FullName; ?></span></td>
                                                                        <td><?php echo $users->NIC; ?></td>
                                                                        <td><?php echo $users->UserId; ?></td>
                                                                        <td><?php echo $users->EpfNo; ?></td>
                                                                        <td><?php echo $users->OrganizationName; ?></td>
                                                                        <td><?php echo $users->Designation; ?></td>
                                                                        <td><?php echo $users->Contact; ?></td>
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
                $('#usermanagement').addClass('active');
                $('#manage_users').addClass('active');
                $('.alert').delay(3000).fadeOut('slow');
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </body>
</html>