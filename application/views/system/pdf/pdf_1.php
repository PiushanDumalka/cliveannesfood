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
        <link rel="stylesheet" href="<?php echo base_url();?>assets/pdf/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/pdf/css/bootstrap.min.css">
    </head>
    <body>
        <div class="table-responsive">
            <table class="table table-hover tablesorter pdf_border">
                <thead>
                    <tr class="pdf_border">
                        <th>Full Name</th>
                        <th>NIC</th>
                        <th>User ID</th>
                        <th>EPF No</th>
                        <th>Organization Name</th>
                        <th>Designation</th>
                        <th>Mobile No</th>
                    </tr>
                </thead>
                <a class="pull-right btn btn-warning btn-large" style="margin-right:40px" href="<?php echo site_url() ?>pdfs/save_pdf"><i class="fa fa-file-excel-o"></i> PDF Data</a>
                <tbody>
                    <?php
                    if ($get_users->num_rows() > 0) {
                        foreach ($get_users->result() as $users) {
                            ?>
                            <tr onclick="location.href = '<?php echo base_url(); ?>pdf/view_user/<?php echo $users->Id; ?>';">
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
    </body>
</html>