<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cliveannes Food</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.6 -->
        <link href="<?php echo base_url(); ?>assets/system/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/system/style/login_style.css" rel="stylesheet" type="text/css" /> 
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet" type="text/css">
        <link href="//fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css">
    </head>
    <body>
        <link rel="icon" type="image/icon" href="<?php echo base_url(); ?>assets/system/img/VTC-icon.png"/>
        <div class="container">

            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4"> 
                    <div class="login-section">
                        <div class="login">
                            <div class="row">
                                <img id="login-logo" src="<?php echo base_url(); ?>assets/system/img/logo.png" alt="logo">  <strong style="font-size: 14px; color: #fff;">            
                            </div> 
                            <?php
                            if ($msg) {
                                echo '<div class="alert alert-danger" align="center">' . $msg['msg'] . '</div>';
                            }
                            ?>
                            <div class="modal-content modal-info">
                                <div class="modal-header">				
                                    <h3>Login</h3>						
                                </div>
                                <div class="modal-body modal-spa">
                                    <div class="login-form">			
                                        <?php echo form_open('', ['id' => 'login-form']); ?>
                                        <input placeholder="Username" class="user" name="username" id="username" type="text" autofocus required="true">
                                        <input placeholder="Password" class="lock" name="password" id="password" type="password" required="true">
                                        <div class="signin-rit">
                                            <span class="checkbox1">
                                                <label class="checkbox"><input type="checkbox" name="checkbox" checked="">Remember me</label>
                                            </span>
                                            <a class="forgot play-icon popup-with-zoom-anim" href="#small-dialog3">Forgot Password?</a>
                                            <div class="clear"> </div>
                                        </div>
                                        <input type="submit" value="Login">
                                        <?php echo form_close(); ?>
                                        <p>Back To The <a href="<?php echo base_url(); ?>index"> Home Page</a></p>
                                    </div>								
                                </div>
                            </div>
                            <!-- //login -->
                            <!-- Forgot password -->
                            <div id="small-dialog3" class="mfp-hide">
                                <div class="modal-content modal-info">
                                    <div class="modal-header">				
                                        <h3>Get Password</h3>						
                                    </div>
                                    <div class="modal-body modal-spa">
                                        <div class="login-form">	
                                            <p class="get-pw">Enter your email address below and we'll send you an email with instructions.</p>
                                            <div id="step5-msg"></div>
                                            <form id="step5form" action="/forgot-password-post" method="post">
                                                <input type="text" class="user" name="email" placeholder="Email" required="">
                                                <input id="step5-post" type="submit" value="Submit">

                                            </form>	
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- //Forgot password -->
                            <div class="clear"></div>
                        </div> 
                    </div>  


                </div>
            </div>
        </div>
    </body>
</html>