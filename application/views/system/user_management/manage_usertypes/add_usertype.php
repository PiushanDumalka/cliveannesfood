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
                        <li>Manage User Type</li>
                        <li class="active">Add User Type</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <b>Add Type </b>
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
                                                    <?php echo form_open_multipart('', ['id' => 'add_usertype_form']); ?>
                                                    <div class="row">
                                                        <p><b>USERTYPE DETAILS:-</b></p><hr>
                                                        <div class="form-group col-sm-8"><span style="color:Red;">*</span>
                                                            <label class="req">Type </label>
                                                            <input class="form-control" name="usertype" id="usertype" type="text" maxlength="45" required/>
                                                            <div id="usertype_error" class="alert alert-danger error" style="display:none;">Type cannot be empty.</div>
                                                        </div> 
                                                    </div>

                                                    <div class="row buttons">
                                                        <div class="col-sm-2">
                                                            <div class="form_sep">
                                                                <input class="btn btn-warning" id="add_usertype_submit" type="submit" name="add_usertype_submit" value="Submit" />    
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form_sep">
                                                                <button type="button" class="btn btn-danger" id="cancel_usertype"  name="cancel_usertype" onclick="location.href = '<?php echo base_url(); ?>usertype/add_usertype';"><i class="fa fa-reply"></i> cancel</button> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo form_close(); ?> 
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <p><b>VIEW DETAILS:-</b></p><hr>
                                                        <table id="usertype_table" class="table table-striped table-bordered table-hover table-active" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Type</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ($get_usertypes->num_rows() > 0) {
                                                                    foreach ($get_usertypes->result() as $usertype) {
                                                                        ?>
                                                                        <tr onclick="location.href = '<?php echo base_url(); ?>usertype/edit_usertype/<?php echo $usertype->Id; ?>';">
                                                                            <td><span><?php echo $usertype->Id; ?></span></td>
                                                                            <td><?php echo $usertype->Type; ?></td>
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
                $('#usertype_table').DataTable();
                /**Form Validation**/
                $(document).on('click', "#add_usertype_submit", function (e) {

                    e.preventDefault();
                    $(".alert").hide();
                    if ($('input#usertype').val() == '' || $('input#usertype').val().trim() == "") {
                        $("#usertype_error").show();
                        $("#usertype").focus();
                    } else {
                        $("#add_usertype_form").submit();
                    }
                });
                $('#usermanagement').addClass('active');
                $('#manage_usertype').addClass('active');
            });
        </script>
    </body>
</html>