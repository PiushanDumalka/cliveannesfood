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
                    <h1>Rawmaterial Management</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li>Rawmaterial Management</li>
                        <li>Manage Rawmaterials</li>
                        <li class="active">View Rawmaterials</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-primary" id="add_rawmaterial"  name="add_rawmaterial" onclick="location.href = '<?php echo base_url(); ?>rawmaterial/add_rawmaterial';"><i class="fa fa-plus"></i> Add New </button> 
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
                                                    <div class="col-sm-6">
                                                        <div class="row form-group text-center"> <b>Raw Material Details<br/></b></div>
                                                        <table id="rawmaterials_table" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Code</th>
                                                                    <th>Name</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ($get_rawmaterials->num_rows() > 0) {
                                                                    foreach ($get_rawmaterials->result() as $rawmaterials) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><span><?php echo $rawmaterials->RawMaterialCode; ?></span></td>
                                                                            <td><a class="btn btn-link" href="<?php echo base_url(); ?>rawmaterial/view_rawmaterial/<?php echo $rawmaterials->Id; ?>"><?php echo $rawmaterials->RawmaterialName; ?></a></td>
                                                                            <td><a href="<?php echo base_url(); ?>rawmaterial/edit_rawmaterial/<?php echo $rawmaterials->Id; ?>"><i class="fa fa-edit pull-right"></i></a></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row form-group text-center"><b>Packing Material Details</b></div>
                                                        <table id="packmaterials_table" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Code</th>
                                                                    <th>Name</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ($get_packmaterials->num_rows() > 0) {
                                                                    foreach ($get_packmaterials->result() as $packmaterials) {
                                                                        ?>
                                                                        <tr onclick="location.href = '<?php echo base_url(); ?>rawmaterial/view_rawmaterial/<?php echo $rawmaterials->Id; ?>';">
                                                                            <td><span><?php echo $packmaterials->RawMaterialCode; ?></span></td>
                                                                            <td><a class="btn btn-link" href="<?php echo base_url(); ?>rawmaterial/view_rawmaterial/<?php echo $packmaterials->Id; ?>"><?php echo $packmaterials->RawmaterialName; ?></a></td>
                                                                            <td><a href="<?php echo base_url(); ?>rawmaterial/edit_rawmaterial/<?php echo $packmaterials->Id; ?>"><i class="fa fa-edit pull-right"></i></a></td>
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
                $('#rawmaterials_table').DataTable();
                $('#packmaterials_table').DataTable();
                $('#rawmaterialmanagement').addClass('active');
                $('#manage_rawmaterials').addClass('active');
                $('.alert').delay(3000).fadeOut('slow');
                $('[data-toggle="tooltip"]').tooltip();
            });

        </script>

    </body>
</html>