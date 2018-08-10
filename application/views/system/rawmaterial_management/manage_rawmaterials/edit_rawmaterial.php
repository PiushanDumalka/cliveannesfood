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
                        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa  fa-home"></i> Home</a></li>
                        <li>Rawmaterial Management</li>
                        <li>Manage Rawmaterial</li>
                        <li class="active">Edit Rawmaterial</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> 
                                        <button type="button" class="btn btn-danger" id="rawmaterial_view"  name="view_rawmaterial" onclick="location.href = '<?php echo base_url(); ?>rawmaterial/view_rawmaterials';"><i class="fa fa-list"></i> View</button> 
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p><b>RAW MATERIAL DETAILS:-</b></p><hr>
                                                </div>
                                                <?php echo form_open_multipart('', ['id' => 'edit_rawmaterial_form']); ?>
                                                <div class="col-md-9">
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

                                                        <div class="form-group col-sm-6"><span style="color:Red;">*</span>
                                                            <label class="req">Rawmaterial Name </label>
                                                            <input class="form-control" name="rawmaterialname" id="rawmaterialname" type="text" maxlength="65" value="<?php echo $get_rawmaterial->row()->RawmaterialName; ?>" required/>
                                                            <div id="rawmaterialname_error" class="alert alert-danger error" style="display:none;">Rawmaterialname cannot be empty.</div>
                                                        </div>                
                                                        <div class="form-group col-sm-6">
                                                            <label>Rawmaterial Category</label><span style="color:Red;">*</span>
                                                            <select class="form-control" name="rawmaterialcategory" id="rawmaterialcategory">
                                                                <option value="0">Please Select a Rawmaterial Category</option>
                                                                <option value='1'  <?php echo (1 == $get_rawmaterial->row()->RawMaterialCategoryId) ? 'selected="selected"' : '' ?>>Raw Material</option>;
                                                                <option value='2' <?php echo (2 == $get_rawmaterial->row()->RawMaterialCategoryId) ? 'selected="selected"' : '' ?>>Packing Material</option>;
                                                            </select>                                                    
                                                            <div id="rawmaterialcategory_error" class="alert alert-danger error" style="display:none;">Rawmaterial Category cannot be empty.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 buttons">
                                                        <div class="col-md-1 col-sm-2">
                                                            <div class="form_sep">
                                                                <input class="btn btn-warning" id="edit_rawmaterial_submit" type="submit" name="edit_rawmaterial_submit" value="Update" />    
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-sm-2">
                                                            <div class="form_sep">
                                                                <button type="button" class="btn btn-danger" id="cancel_rawmaterial"  name="cancel_rawmaterial" onclick="location.href = '<?php echo base_url(); ?>rawmaterial/view_rawmaterials';"><i class="fa fa-reply"></i> cancel</button> 
                                                            </div>
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

                /**Form Validation**/
                $(document).on('click', "#edit_rawmaterial_submit", function (e) {

                    e.preventDefault();
                    $(".alert").hide();
                    if ($('input#rawmaterialname').val() == '' || $('input#rawmaterialname').val().trim() == "") {
                        $("#rawmaterialname_error").show();
                        $("#rawmaterialname").focus();
                    } else if ($('#rawmaterialcategory').val() == 0) {
                        $("#rawmaterialcategory_error").show();
                        $("#rawmaterialcategory").focus();
                    } else {
                        $("#edit_rawmaterial_form").submit();
                    }
                });

                $('#rawmaterialmanagement').addClass('active');
                $('#manage_rawmaterials').addClass('active');

            });
        </script>
    </body>
</html>