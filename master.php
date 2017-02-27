<?php
$type = $this->session->userdata("type");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php if (isset($page_title)) echo $page_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
        <!-- bootstrap -->
        <link href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">      
        <link href="<?php echo base_url() ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

        <link href="<?php echo base_url() ?><?php echo base_url() ?>themes/css/bootstrappage.css" rel="stylesheet"/>

        <!-- global styles -->
        <link href="<?php echo base_url() ?>themes/css/flexslider.css" rel="stylesheet"/>
        <link href="<?php echo base_url() ?>themes/css/main.css" rel="stylesheet"/>

        <!-- scripts -->
        <script src="<?php echo base_url() ?>themes/js/jquery-1.7.2.min.js"></script>
        <script src="<?php echo base_url() ?>bootstrap/js/bootstrap.min.js"></script>				
        <script src="<?php echo base_url() ?>themes/js/superfish.js"></script>	
        <script src="<?php echo base_url() ?>themes/js/jquery.scrolltotop.js"></script>
        <!--[if lt IE 9]>			
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
              <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div
            style=" margin-left: 90%; margin-top: 10%;
             width: 200px; background-color: green;
             height: 80px; position: fixed ">
            <ul>
                <b style=" color: white">
                Total Amount:
                    <p>
                        <?php
                        $pdtid = $this->session->userdata("pdtid");
                        if ($pdtid != NULL) {
                            echo count($pdtid);
                        } else {
                            echo 0;
                        }
                        ?>
                    </p>
                </b>
                           
                         
                <button style=" color: #ffffff"><a href="<?php echo base_url() ?>cart/checkout">Checkout</a></button>
                        
            </ul>
                        
        </div>
        
        <div id="top-bar" class="container">
            <div class="row">


                <a style="padding: 20px" href="<?php echo base_url(); ?>" class="logo pull-left"><img src="<?php echo base_url() ?>themes/images/logo.png" class="site_logo" alt=""></a>

                <div class="span8">
                    <div class="account pull-right">
                        <ul class="user-menu">			
                            			
                            <?php
                            if ($type == NULL) {
                                ?>
                            <li><a href="<?php echo base_url() ?>login"><button class="btn-success">Login | Register</button></a></li>		
                                <?php
                            } else {
                                ?>
                                
                                <li><a href="<?php echo base_url() ?>logout"><button class="btn-warning">Logout</button></a></li>		
                            <?php } ?>
                            
                        </ul>
                    </div>
                   
                </div>
                
            </div>
           
        </div>
        
        <div id="wrapper" class="container">
            <section class="navbar main-menu">
                <div class="navbar-inner main-menu">				



                    <nav id="menu" class="pull-left">
                        <ul>
                            <?php
                            if ($type == 'a' || $type == "e") {
                                ?>
                                <li><a href="<?php echo base_url(); ?>product">Deshboard</a>					
                                    <ul>
                                        <li><a href="<?php echo base_url() ?>product-management/insert">Pruduct Entry</a></li>									
                                        <li><a href="<?php echo base_url() ?>product-management/view">New Entry</a></li>
                                        <li><a href="<?php echo base_url() ?>product-management/view">View</a></li>
                                        <li><a href="<?php echo base_url() ?>report">Report</a></li>
                                    </ul>
                                </li>				
                                <?php
                            }
                            ?>
                            <li><a href="<?php echo base_url() ?>./products.html">Vagetable</a>
                                <ul>									
                                    <li><a href="<?php echo base_url() ?>./products.html">Local</a></li>
                                    <li><a href="<?php echo base_url() ?>./products.html">Imported</a></li>
                                    <li><a href="<?php echo base_url() ?>./products.html">Seasonal</a></li>
                                </ul>
                            </li>			
                            <li><a href="<?php echo base_url() ?>./products.html">Fruits</a>
                                <ul>									
                                    <li><a href="<?php echo base_url() ?>./products.html">Local</a></li>
                                    <li><a href="<?php echo base_url() ?>./products.html">Imported</a></li>
                                    <li><a href="<?php echo base_url() ?>./products.html">Seasonal</a></li>
                                </ul>
                            </li>							
                            <li><a href="<?php echo base_url() ?>./products.html">Frozen</a>
                                <ul>
                                    <li><a href="<?php echo base_url() ?>./products.html">River</a></li>
                                    <li><a href="<?php echo base_url() ?>./products.html">Sea Fish</a></li>
                                    <li><a href="<?php echo base_url() ?>./products.html">Cultivate</a></li>
                                </ul>
                            
                            </li>
                            <li><a href="<?php echo base_url() ?>./products.html">Grocery</a></li>
                            <li><a href="<?php echo base_url() ?>./products.html">Home Appliance</a></li>
                        </ul>
                    </nav>


                    <div class="span4 pull-right" style="padding: 5px">
                        <form method="POST" class="search_form">
                            <input type="text" class="input-block-level search-query" Placeholder="Search yoru vegitable and grocery">
                        </form>
                    </div>
                </div>

            </section>

            <?php
            if (isset($content)) {
                echo $content;
            }
            ?>
            <section id="footer-bar">
                <div class="row">
                    <div class="span3">
                        <h4>Navigation</h4>
                        <ul class="nav">
                            <li><a href="./index.html">Homepage</a></li>  
                            <li><a href="./about.html">About Us</a></li>
                            <li><a href="./contact.html">Contac Us</a></li>
                            <li><a href="./cart.html">Your Cart</a></li>
                            <li><a href="./register.html">Login</a></li>							
                        </ul>					
                    </div>
                    <div class="span4">
                        <h4>My Account</h4>
                        <ul class="nav">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Order History</a></li>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Newsletter</a></li>
                        </ul>
                    </div>
                    <div class="span5">
                        <p class="logo"><img src="<?php echo base_url() ?>themes/images/logo.png" class="site_logo" alt=""></p>
                        <p> bazar.com is an online shop in Dhaka, 
                            Bangladesh. We believe time is valuable to our fellow Dhaka
                            residents, and that they should not have to waste hours
                            in traffic, brave bad weather and wait in line just to
                            buy basic necessities like eggs! This is why Bazar
                            delivers everything you need right at your door-step and
                            at no additional cost.</p>
                        <br/>
                        <span class="social_icons">
                            <a class="facebook" href="#">Facebook</a>
                            <a class="twitter" href="#">Twitter</a>
                            <a class="skype" href="#">Skype</a>
                            <a class="vimeo" href="#">Vimeo</a>
                        </span>
                    </div>					
                </div>	
            </section>
            <section id="copyright">
                <span>Copyrigh &copy;2016 Bazar Private Limited.</span>
            </section>
        </div>
        <script src="<?php echo base_url() ?>themes/js/common.js"></script>
        <script src="<?php echo base_url() ?>themes/js/jquery.flexslider-min.js"></script>
        <script type="text/javascript">
            $(function () {
                $(document).ready(function () {
                    $('.flexslider').flexslider({
                        animation: "fade",
                        slideshowSpeed: 4000,
                        animationSpeed: 600,
                        controlNav: false,
                        directionNav: true,
                        controlsContainer: ".flex-container" // the container that holds the flexslider
                    });
                });
            });
        </script>
       
    </body>
</html>