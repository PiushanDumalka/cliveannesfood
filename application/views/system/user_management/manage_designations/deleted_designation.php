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
                        <li class="active">Manage Designation</li>
                        <li class="active">Deleted Designation</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <button type="button" class="btn btn-danger" id="view_designation"  name="view_designation" onclick="location.href = '<?php echo base_url(); ?>designation/add_designation';" data-toggle="tooltip" title="view Designation"><i class="fa fa-list"></i> View</button>  
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
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <p><b>VIEW DETAILS:-</b></p><hr>
                                                        <table id="designation_table" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Designation</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ($deleted_designations->num_rows() > 0) {
                                                                    foreach ($deleted_designations->result() as $designation) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><span><?php echo $designation->Id; ?></span></td>
                                                                            <td><?php echo $designation->Designation; ?></td>
                                                                            <td><button type="button" class="btn btn-link restore" id="<?php echo $designation->Id; ?>"> <i class="fa fa-undo"></i></button></td>

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
                $('#designation_table').DataTable();
                /**Form Validation**/
                $(document).on('click', "#add_designation_submit", function (e) {

                    e.preventDefault();
                    $(".alert").hide();
                    if ($('input#designation').val() == '' || $('input#designation').val().trim() == "") {
                        $("#designation_error").show();
                        $("#designation").focus();
                    } else {
                        $("#add_designation_form").submit();
                    }
                });
                /**Form Validation**/
                $(document).on('click', ".restore", function (e) {
                    var id = $(this).attr('id');
                    swal({
                        title: "Are you sure you want to recover this?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                            .then((willDelete) => {
                                if (willDelete) {
                                    document.location.href = '<?php echo base_url(); ?>designation/restore_designation/' + id;
                                } else {
                                    swal("Not Deleted!");
                                }
                            });

                });
                $('[data-toggle="tooltip"]').tooltip();
                $('#usermanagement').addClass('active');
                $('#manage_designation').addClass('active');

            });
        </script>
    </body>
</html>