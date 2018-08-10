<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Cliveannes Food</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <?php include("header-css.php"); ?>
        <?php include("header-js.php"); ?>
        <script>
            $(document).ready(function () {
                $('#province').select2();
                $('#district').select2();
                $('#city').select2();
            });
        </script>
        <style>
            .swal-button {
                padding: 7px 19px;
                border-radius: 2px;
                background-color: #E7A331;
                font-size: 12px;
                border: 1px solid #E7A331;
                text-shadow: 0px - 1px 0px rgba(0, 0, 0, 0.3);
            }
            .swal-button:active {
                padding: 7px 19px;
                border-radius: 2px;
                background-color: #E7A331;
                font-size: 12px;
                border: 1px solid #E7A331;
                text-shadow: 0px - 1px 0px rgba(0, 0, 0, 0.3);
            }
        </style>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class='preloader'><div class='loaded'>&nbsp;</div></div>
        <header id="home" class="navbar-fixed-top">
            <div class="header_top_menu clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-md-offset-3 col-sm-12 text-right">
                            <div class="call_us_text">
                                <a href=""><i class="fa fa-clock-o"></i> Order Foods 24/7</a>
                                <a href=""><i class="fa fa-phone"></i>038 2 237 480</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="head_top_social text-right">

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- End navbar-collapse-->

            <div class="main_menu_bg">
                <div class="container">
                    <div class="row">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand our_logo" href="#"><img src="<?php echo base_url(); ?>assets/website/images/logo.png" alt="" /></a>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                    <ul class="nav navbar-nav navbar-right">
                                        <li><a href="#slider">Home</a></li>
                                        <li><a href="#abouts">About</a></li>
                                        <li><a href="#ourproducts">Products</a></li>
                                        <li><a href="#features">Features</a></li>
                                        <li><a href="#">Our Clients </a></li>
                                        <li><a href="#footer_widget">Contact</a></li>
                                        <li><a href="#joinus" class="">Join Us</a></li>
                                        <li><a href="<?php echo base_url(); ?>login/login_control" ><i class="fa fa-lock"></i> Login</a></li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
            </div>
        </header> <!-- End Header Section -->

        <section id="slider" class="slider">
            <div class="slider_overlay">
                <div class="container">
                    <div class="row">
                        <div class="main_slider text-center">
                            <div class="col-md-12">
                                <div class="main_slider_content wow zoomIn" data-wow-duration="1s">
                                    <h1>Cliveannes Food</h1>
                                    <p>Keeping active and eating a healthy balanced diet will give you a Healthy Life and Hefty Asset </p>
                                    <button onclick="location.href = '<?php echo base_url(); ?>login/login_control'" class="btn-lg">Order here</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="abouts" class="abouts">
            <div class="container">
                <div class="row">
                    <div class="abouts_content">
                        <div class="col-md-6">
                            <div class="single_abouts_text text-center wow slideInLeft" data-wow-duration="1s">
                                <img src="<?php echo base_url(); ?>assets/website/images/ab.png" alt="" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="single_abouts_text wow slideInRight" data-wow-duration="1s">
                                <h4>About us</h4>
                                <h3>WE ARE TASTY</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's stan</p>

                                <p>dard dummy text ever since the 1500s,when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesettingdard dummy text ever since the 1500s,when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>

                                <a href="" class="btn btn-primary">click here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="ourproducts" class="portfolio">
            <div class="container">
                <div class="row">
                    <div class="container marketing">

                        <span class="head_title text-center">
                            <h4>Our</h4>
                            <h3>Products</h3>
                        </span>
                        <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="<?php echo base_url(); ?>assets/website/images/salate.png" alt="Generic placeholder image">
                                            <h4>Salates</h4>
                                            <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
                                        </div><!-- /.col-lg-4 -->
                                        <div class="col-lg-4">
                                            <img src="<?php echo base_url(); ?>assets/website/images/chicken.png" alt="Generic placeholder image">
                                            <h4>Meal</h4>
                                            <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
                                        </div><!-- /.col-lg-4 -->
                                        <div class="col-lg-4">
                                            <img src="<?php echo base_url(); ?>assets/website/images/drinks_lussy.png" alt="Generic placeholder image">
                                            <h4>Drink</h4>
                                            <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
                                        </div><!-- /.col-lg-4 -->
                                    </div><!-- /.row -->

                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="<?php echo base_url(); ?>assets/website/images/chicken_fry.png" alt="Generic placeholder image">
                                            <h4>Salates</h4>
                                            <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
                                        </div><!-- /.col-lg-4 -->
                                        <div class="col-lg-4">
                                            <img src="<?php echo base_url(); ?>assets/website/images/fish-and-chips.png" alt="Generic placeholder image">
                                            <h4>Meal</h4>
                                            <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
                                        </div><!-- /.col-lg-4 -->
                                        <div class="col-lg-4">
                                            <img src="<?php echo base_url(); ?>assets/website/images/drinks.png" alt="Generic placeholder image">
                                            <h4>Drink</h4>
                                            <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
                                        </div><!-- /.col-lg-4 -->
                                    </div><!-- /.row -->

                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img  src="<?php echo base_url(); ?>assets/website/images/salate.png" alt="Generic placeholder image">
                                            <h4>Salates</h4>
                                            <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
                                        </div><!-- /.col-lg-4 -->
                                        <div class="col-lg-4">
                                            <img  src="<?php echo base_url(); ?>assets/website/images/burger.png" alt="Generic placeholder image">
                                            <h4>Meal</h4>
                                            <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
                                        </div><!-- /.col-lg-4 -->
                                        <div class="col-lg-4">
                                            <img  src="<?php echo base_url(); ?>assets/website/images/drinks.png" alt="Generic placeholder image">
                                            <h4>Drink</h4>
                                            <p><a class="btn btn-default" href="#" role="button">Add to cart &raquo;</a></p>
                                        </div><!-- /.col-lg-4 -->
                                    </div><!-- /.row -->
                                </div>
                            </div>
                            <a class="left carousel-control" href="#myCarousel2" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a class="right carousel-control" href="#myCarousel2" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div><!-- /.carousel -->
                    </div>
                </div>
            </div>
        </section>

        <section id="joinus" class="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <span class="head_title text-center">
                            <h4>Join</h4>
                            <h3>Us</h3>
                        </span>
                        <div class="main_portfolio_content">
                            <div class="single_widget wow fadeIn animated" data-wow-duration="5s" style="visibility: visible; animation-duration: 5s; animation-name: fadeIn;">
                                <div class="single_widget_form text-left">
                                    <?php if ($this->session->flashdata('success')) { ?>
                                        <div class="alert alert-danger" id="alertrow">
                                            <p><?php echo $this->session->flashdata('success'); ?></p>
                                        </div>
                                    <?php } elseif ($this->session->flashdata('error')) {
                                        ?>
                                        <div class="alert alert-danger" id="alertrow">
                                            <p><?php echo $this->session->flashdata('error'); ?></p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <form action="<?php echo base_url("index/insert_customerdetails"); ?>"  method="POST" id="join_form">

                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-bottom: 27px;">
                                                <?php
                                                if ($get_customertype->num_rows() > 0) {
                                                    foreach ($get_customertype->result() as $customertype) {
                                                        ?>
                                                        <label class="checkbox-inline"><input type="checkbox" class="customer_type" id="customertype" name="customertype" data-toggle="tooltip" title="please click here if you are a <?php echo $customertype->Title; ?>!" value="<?php echo $customertype->Id; ?>"><?php echo $customertype->Title; ?></label>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="form-group">
                                                <!--data-toggle="tooltip" data-placement="top" title="Tooltip on top"-->
                                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" required="true" data-toggle="tooltip" title="Please enter your name">
                                                <span id="ownername_error" class="error text-danger" style="display:none;">Full name cannot be empty.</span>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nic" id="nic" placeholder="NIC" required="true" data-toggle="tooltip" title="Please enter your nic ">
                                                <span id="nic_error" class="error text-danger" style="display:none;">Please enter NIC Correctly.</span>
                                            </div>                                       

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="regname" id="regname" placeholder="Buissness Name" required="true" data-toggle="tooltip" title="Please enter your Buisness name">
                                                <span id="regname_error" class="error text-danger" style="display:none;">Buisness name cannot be empty.</span>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="regno"  id="regno" placeholder="Buissness No" required="true" data-toggle="tooltip" title="Please enter your Buisness registration no">
                                                <span id="regno_error" class="error text-danger" style="display:none;">Buisness Registered No cannot be empty.</span>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="true">
                                                <span id="email_error" class="error text-danger" style="display:none;">Please enter Email correctly .</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="address1"  id="address1" placeholder="Address 1" required="true">
                                                <span id="address1_error" class="error text-danger" style="display:none;">Address 1 cannot be empty.</span>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="address2" id="address2" placeholder="Address 2" required="true">
                                                <span id="address2_error" class="error text-danger" style="display:none;">Address 2 cannot be empty.</span>
                                            </div>

                                            <div class="form-group">
                                                <select class="form-control" name="province" id="province">
                                                    <option value="0">Please Select a Province</option>
                                                    <?php
                                                    if ($get_province->num_rows() > 0) {
                                                        foreach ($get_province->result() as $province) {
                                                            ?>
                                                            <option value="<?php echo $province->id; ?>"><?php echo $province->name_en; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <span id="province_error" class="error text-danger" style="display:none;">Please Select a Province.</span>
                                            </div>

                                            <div class="form-group">
                                                <select class="form-control" name="district" id="district" placeholder="district">
                                                    <option value="0">Please Select a District</option>
                                                    <?php
                                                    if ($get_district->num_rows() > 0) {
                                                        foreach ($get_district->result() as $district) {
                                                            ?>
                                                            <option value="<?php echo $district->id; ?>"><?php echo $district->name_en; ?></option> 
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <span id="district_error" class="error text-danger" style="display:none;">Please Select a District.</span>
                                            </div>

                                            <div class="form-group">
                                                <select class="form-control" name="city" id="city" placeholder="city">
                                                    <option value="0">Please Select a City</option>
                                                    <?php
                                                    if ($get_city->num_rows() > 0) {
                                                        foreach ($get_city->result() as $city) {
                                                            ?>
                                                            <option value="<?php echo $city->id; ?>"><?php echo $city->name_en; ?></option>                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <span id="city_error" class="error text-danger" style="display:none;">Please Select a City.</span>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="contact" id="contact" placeholder="Mobile No">
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <input type="submit" value="Submit" id="join_submit" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="featureproducts" class="portfolio">
            <div class="container">
                <div class="row">
                    <div class="portfolio_content text-center  wow fadeIn" data-wow-duration="5s">
                        <div class="col-md-12">
                            <div class="head_title text-center">
                                <h4>Feature</h4>
                                <h3>Products</h3>
                            </div>

                            <div class="main_portfolio_content">
                                <div class="col-md-3 col-sm-4 col-xs-6 single_portfolio_text">
                                    <img src="<?php echo base_url(); ?>assets/website/images/p1.png" alt="" />
                                    <div class="portfolio_images_overlay text-center">
                                        <h6>Italian Source Mushroom</h6>
                                        <p class="product_price">$12</p>
                                        <a href="" class="btn btn-primary">Click here</a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6 single_portfolio_text">
                                    <img src="<?php echo base_url(); ?>assets/website/images/p2.png" alt="" />
                                    <div class="portfolio_images_overlay text-center">
                                        <h6>Italian Source Mushroom</h6>
                                        <p class="product_price">$12</p>
                                        <a href="" class="btn btn-primary">Click here</a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6 single_portfolio_text">
                                    <img src="<?php echo base_url(); ?>assets/website/images/p3.png" alt="" />
                                    <div class="portfolio_images_overlay text-center">
                                        <h6>Italian Source Mushroom</h6>
                                        <p class="product_price">$12</p>
                                        <a href="" class="btn btn-primary">Click here</a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6 single_portfolio_text">
                                    <img src="<?php echo base_url(); ?>assets/website/images/p4.png" alt="" />
                                    <div class="portfolio_images_overlay text-center">
                                        <h6>Italian Source Mushroom</h6>
                                        <p class="product_price">$12</p>
                                        <a href="" class="btn btn-primary">Click here</a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6 single_portfolio_text">
                                    <img src="<?php echo base_url(); ?>assets/website/images/p5.png" alt="" />
                                    <div class="portfolio_images_overlay text-center">
                                        <h6>Italian Source Mushroom</h6>
                                        <p class="product_price">$12</p>
                                        <a href="" class="btn btn-primary">Click here</a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6 single_portfolio_text">
                                    <img src="<?php echo base_url(); ?>assets/website/images/p6.png" alt="" />
                                    <div class="portfolio_images_overlay text-center">
                                        <h6>Italian Source Mushroom</h6>
                                        <p class="product_price">$12</p>
                                        <a href="" class="btn btn-primary">Click here</a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6 single_portfolio_text">
                                    <img src="<?php echo base_url(); ?>assets/website/images/p7.png" alt="" />
                                    <div class="portfolio_images_overlay text-center">
                                        <h6>Italian Source Mushroom</h6>
                                        <p class="product_price">$12</p>
                                        <a href="" class="btn btn-primary">Click here</a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6 single_portfolio_text">
                                    <img src="<?php echo base_url(); ?>assets/website/images/p8.png" alt="" />
                                    <div class="portfolio_images_overlay text-center">
                                        <h6>Italian Source Mushroom</h6>
                                        <p class="product_price">$12</p>
                                        <a href="" class="btn btn-primary">Click here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="features">
            <div class="slider_overlay">
                <div class="container">
                    <div class="row">
                        <div class="main_features_content_area  wow fadeIn" data-wow-duration="3s">
                            <div class="col-md-12">
                                <div class="main_features_content text-left">
                                    <div class="col-md-6">
                                        <div class="single_features_text">
                                            <h4>Special Recipes</h4>
                                            <h3>Taste of Precious</h3>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's stan</p>
                                            <p>dard dummy text ever since the 1500s,when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesettingdard dummy text ever since the 1500s,when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>

                                            <a href="" class="btn btn-primary">click here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="ourPakeg" class="ourPakeg">
            <div class="container">
                <div class="main_pakeg_content">
                    <div class="row">
                        <div class="head_title text-center">
                            <h4>Amazing</h4>
                            <h3>Delicious</h3>
                        </div>

                        <div class="single_pakeg_one text-right wow rotateInDownRight">
                            <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4">
                                <div class="single_pakeg_text">
                                    <div class="pakeg_title">
                                        <h4>Drinks</h4>
                                    </div>

                                    <ul>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="single_pakeg_two text-left wow rotateInDownLeft">
                            <div class="col-md-6 col-sm-8">
                                <div class="single_pakeg_text">
                                    <div class="pakeg_title">
                                        <h4>Main course </h4>
                                    </div>

                                    <ul>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="single_pakeg_three text-left wow rotateInDownRight">
                            <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4">
                                <div class="single_pakeg_text">
                                    <div class="pakeg_title">
                                        <h4>Desserts</h4>
                                    </div>

                                    <ul>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                        <li> Tuna Roast Source........................................................$24.5 </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="footer_widget" class="footer_widget">
            <div class="container">
                <div class="row">
                    <div class="footer_widget_content text-center">
                        <div class="col-md-4">
                            <div class="single_widget wow fadeIn" data-wow-duration="2s">
                                <h3>Take it easy with location</h3>

                                <div class="single_widget_info">
                                    <p>Cliveannes Food,
                                        <span>#24 Wanduramulla Estate,</span>
                                        <span>Panadura</span>
                                        <span class="phone_email">phone: 038 2239644</span>
                                        <span>Email: cliveannes@gmail.com</span></p>
                                </div>

                                <div class="footer_socail_icon">
                                    <a href=""><i class="fa fa-facebook"></i></a>
                                    <a href=""><i class="fa fa-google-plus"></i></a>
                                    <a href=""><i class="fa fa-twitter"></i></a>
                                    <a href=""><i class="fa fa-linkedin"></i></a>
                                    <a href=""><i class="fa fa-pinterest-p"></i></a>
                                    <a href=""><i class="fa fa-youtube"></i></a>
                                    <a href=""><i class="fa fa-phone"></i></a>
                                    <a href=""><i class="fa fa-camera"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="single_widget wow fadeIn" data-wow-duration="4s">
                                <h3>Take it easy with your time</h3>

                                <div class="single_widget_info">
                                    <p><span class="date_day">Monday To Friday</span>
                                        <span>8:00am to 5:00pm</span>

                                        <span class="date_day">Saturday & Sunday</span>
                                        <span>9:00am to 3:00pm</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="single_widget wow fadeIn" data-wow-duration="5s">
                                <h3></h3>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15849.861828505927!2d79.92839591813717!3d6.7129110765260025!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7d28abfebd948024!2sCliveannes!5e0!3m2!1sen!2sus!4v1525891629282" width="300" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!--Footer-->
        <footer id="footer" class="footer">
            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="copyright wow zoomIn" data-wow-duration="3s">
                            <p>Made by <a href="">DeLp Software Solution</a>2018. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <div class="scrollup">
            <a href="#"><i class="fa fa-chevron-up"></i></a>
        </div>

    </body>

    <script>
        $(document).ready(function () {
            /**Form Validation**/
            $(document).on('click', "#join_submit", function (e) {
                e.preventDefault();
                if (!$(".customer_type").is(':checked')) {
                    swal("Please Select a Wholesaler or a Retailer or a Consumer");
                } else if ($('input#fullname').val() == '' || $('input#fullname').val().trim() == "") {
                    swal('Full Name can not be empty.');
                } else if (!(/^((19|20)\d{2}[^4,9]\d{6}[\d])$|^(\d{2}[^4,9]\d{6}[xvXV])$/i.test($('input#nic').val()))) {
                    swal('Please enter your NIC correctly');
                } else if ($('input#regname').val() == '' || $('input#regname').val().trim() == "") {
                    swal('Buisness Name can not be empty.');
                } else if (!(/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test($('#email').val()))) {
                    swal('Please enter your email correctly');
                } else if ($('input#address1').val() == '' || $('input#address1').val().trim() == "") {
                    swal('Address1 can not be empty.');
                } else if ($('input#address2').val() == '' || $('input#address2').val().trim() == "") {
                    swal('Address2 can not be empty.');
                } else if ($('#province').val() == 0) {
                    swal('Please selecct a Province.');
                } else if ($('#district').val() == 0) {
                    swal('Please selecct a District.');
                } else if ($('#city').val() == 0) {
                    swal('Please select a city.');
                } else if (!(/^[0-9\+]{1,}[0-9\-]{3,15}$/i.test($('input#contact').val()))) {
                    swal('Please enter your Mobile No correctly');
                } else {
                    $("#join_form").submit();
                }
            });

            /** single check box select*/
            $(".customer_category").change(function () {
                var checked = $(this).is(':checked');
                $(".customer_category").prop('checked', false);
                if (checked) {
                    $(this).prop('checked', true);
                }
            });

            $(".customer_type").change(function () {
                //  alert($(this).val());
                var checked = $(this).is(':checked');
                $(".customer_type").prop('checked', false);
                if (checked) {
                    $(this).prop('checked', true);
                }
            });

            /**province on change get district data*/
            $("#province").change(function () {
                var province = $("#province").val();
                $.ajax({
                    url: '<?php echo base_url("customer/get_district"); ?>' + '/' + province,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $('#district').html('');
                        $('#district').append('<option value="0">Please Select a District</option>');
                        $(data).each(function (index, value) {
                            console.log(value);
                            $('#district').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                        });
                    },
                    error: function (data) {
                    }
                });
            });
            /**district on change get city data*/
            $("#district").change(function () {
                var district = $("#district").val();
                $.ajax({
                    url: '<?php echo base_url("customer/get_city"); ?>' + '/' + district,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $('#city').html('');
                        $('#city').append('<option value="0">Please Select a city</option>');
                        $(data).each(function (index, value) {
                            console.log(value);
                            $('#city').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                        });
                    },
                    error: function (data) {
                    }
                });
            });
        });
    </script>
</html>
