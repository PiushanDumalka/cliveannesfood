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
                        <li class="active">Add Designation</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <b>Add Designation </b>
                                        <button type="button" class="btn btn-link pull-right" id="deleted_designation"  name="deleted_designation" onclick="location.href = '<?php echo base_url(); ?>designation/deleted_designation';" data-toggle="tooltip" title="Deleted Designation"><i class="fa fa-trash"></i></button> 
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
                                                    <?php echo form_open_multipart('', ['id' => 'add_designation_form']); ?>
                                                    <div class="row">
                                                        <p><b>DESIGNATION DETAILS:-</b></p><hr>
                                                        <div class="form-group col-sm-8"><span style="color:Red;">*</span>
                                                            <label class="req">Designation </label>
                                                            <input class="form-control" name="designation" id="designation" type="text" maxlength="45" required/>
                                                            <div id="designation_error" class="alert alert-danger error" style="display:none;">Designation cannot be empty.</div>
                                                        </div> 
                                                    </div>

                                                    <div class="row buttons">
                                                        <div class="col-sm-2">
                                                            <div class="form_sep">
                                                                <input class="btn btn-warning" id="add_designation_submit" type="submit" name="add_designation_submit" value="Submit" />    
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form_sep">
                                                                <button type="button" class="btn btn-danger" id="cancel_designation"  name="cancel_designation" onclick="location.href = '<?php echo base_url(); ?>designation/add_designation';"><i class="fa fa-reply"></i> cancel</button> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo form_close(); ?> 
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
                                                                if ($get_designations->num_rows() > 0) {
                                                                    foreach ($get_designations->result() as $designation) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><span><?php echo $designation->Id; ?></span></td>
                                                                            <td><?php echo $designation->Designation; ?></td>
                                                                            <td><button type="button" class="btn btn-link" onclick="location.href = '<?php echo base_url(); ?>designation/edit_designation/<?php echo $designation->Id; ?>';"> <i class="fa fa-edit"></i></button><button type="button" class="btn btn-link delete" id="<?php echo $designation->Id; ?>"> <i class="fa fa-trash"></i></button></td>

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
                                    document.location.href = '<?php echo base_url(); ?>designation/delete_designation/' + id;
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