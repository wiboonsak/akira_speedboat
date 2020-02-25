<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>TRAVEL LIPE, BOOKING SPEEADBOAT, TRANSPORT, PACKAGE TOUR - MOONLIGHT LIPE - KOH LIPE, SATUN THAILAND</title>

    <!-- Font Google -->
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400%7COpen+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <!-- End Font Google -->
    <!-- Library CSS -->
    <link rel="stylesheet" href="<?php echo base_url('html/css/library/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('html/css/library/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('html/css/library/jquery-ui.min.css')?>">
        <link rel="stylesheet" href="<?php echo base_url('html/css/library/owl.carousel.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('html/css/library/jquery.mb.YTPlayer.min.css')?>">
    <!-- End Library CSS -->
    <link rel="stylesheet" href="<?php echo base_url('html/css/style.css')?>">
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="tb-cell">
            <div id="page-loading">
                <div></div>
                <p>Loading</p>
            </div>
        </div>
    </div>
    <!-- Wrap -->
    <div id="wrap">  
                  <?php 
                  $keygroup = $this->uri->segment(3);
  $packbookData =$this->Package_model->getbooking($keygroup);
    foreach ($packbookData->result() AS $Databook) {}?>
        <!-- Header -->
		<?php include("header.php"); ?>
        <!-- End Header -->

        <!--Banner-->
        <section class="sub-banner">
            <!--Background-->
            <div class="bg-parallax bg-1"></div>
            <!--End Background-->
            <!-- Logo -->
            <div class="logo-banner text-center">
                <a href="" title="">
                    <img src="<?php echo base_url('images/logo-banner.png')?>" alt="">
                </a>
            </div>
            <!-- Logo -->
        </section>
        <!--End Banner-->

        <!-- Main -->
        <div class="main">
            <div class="container">
                <div class="main-cn bg-white clearfix">
                    <div class="step">
                        <!-- Step -->
                        <ul class="payment-step text-center clearfix">
                            <li class="step-select">
                                <span>1</span>
                                <p>Choose Package Tour</p>
                            </li>
                            <li class="step-select">
                                <span>2</span>
                                <p>Your Booking &amp; Payment Details</p>
                            </li>
                            <li class="step-part">
                                <span>3</span>
                                <p>Booking Completed!</p>
                            </li>
                        </ul>
                        <!-- ENd Step -->
                    </div>
                    <!-- Payment Room -->
                    <div class="payment-room">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="payment-info">
                                   
                                    <h3><?php echo $Databook->package_name_en?></h3>
                                    <span class="star-room">
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                    </span>
                                    <ul>
                                        <li>
                                            <span>Departing:</span>
                                           <?php echo $this->Package_model->GetEngDateTime1($Databook->date_depart);?>
                                        </li>
                                        <li>
                                            <span>Adults:</span>
                                            <?php echo $Databook->customer_adult?>
                                        </li>
                                        <li>
                                            <span>Child:</span>
                                            <?php echo $Databook->customer_child?>
									    </li>
                                    </ul>  
                                     
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="payment-price">
 <?php 
  $packimgData =$this->Package_model->getpackageListall($Databook->package_id);
    foreach ($packimgData->result() AS $Dataimg) {}?>
                                    <figure>
                                        <img src="<?php echo base_url('uploadfile/') . $Dataimg->images_name ?>" alt="">
                                    </figure>
                                    <div class="total-trip">
                                       
                                        <span>
                                           BOOKING ID : <?php echo $Databook->transfer_keygroup?>
                                            <br>
                                            <?php echo number_format($Databook->total_price)?> THB<small>/ <?php echo $Databook->customer_adult?> persons</small>
                                        </span>
                                       
                                        <p>
                                            Trip Total: <ins><?php echo number_format($Databook->total_price)?> THB</ins>

                                           <i>Service charge 10% not included.</i>
                                        </p>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <!-- Payment Room -->

                    <div class="payment-form">
                        <div class="row form">
                            <div class="col-md-6">
                                <h2>Your Information</h2>
                                
                                <ul>
                                     <li>
                                          <span>First Name :</span>
                                           <?php echo $Databook->customer_name?>
                                     </li>
                                     <li>
                                         <span>Last Name :</span>
                                          <?php echo $Databook->customer_Lastname?>
                                     </li>
                                     <li>
                                         <span>Email :</span>
                                          <?php echo $Databook->customer_email?>
									 </li>
                               		 <li>
                                         <span>Phone number :</span>
                                          <?php echo $Databook->customer_telephone?>
									 </li>
                                </ul>  
                                    
                                <?php if($Databook->not_travel == 1){?>
                                <div class="radio-checkbox">
                                    <input type="checkbox" class="checkbox" id="accept" name="accept" checked disabled>
                                    <label for="accept">I am not travel. I am making this booking for someone else.</label>
                                </div>
                                <?php }?>
                            </div>
                            <div class="col-md-6">
                                <h2>Your Booking.</h2>
                                <p>You will receive a confirmation email directly after you’ve completed the booking process. If you do not receive it into your email inbox, please check your Spam/Junk folder as it may have been placed in there. You will receive all of your travel documents 5 working days prior to your departure at the latest. If your travel date is less than 5 days after your booking, you will receive your travel documents  directly after your booking. If these documents fail to reach you, please contact us as soon as possible.
                                <br><br>
                                In case you have selected partial payment option,  you will only get the complete booking confirmation after you have paid the full amount.
                                </p>
                            </div>
                        </div>

                        <div class="submit text-center">
                            <p>
                                By selecting to complete this booking I acknowledge that I have read and accept the <span>rules &amp; restrictions terms &amp; conditions</span> , and <span>privacy policy</span>.
                            </p>

<!--							<a href="<?php //echo base_url('Welcome/email_book_package/'.$Databook->transfer_keygroup)?>" target="_blank"><button class="awe-btn awe-btn-1 awe-btn-lager" >PRINT PACKAGE BOOKING</button></a>-->
                            <button class="awe-btn awe-btn-1 awe-btn-lager" onclick="sendmail('<?php echo $Databook->transfer_keygroup?>')" >PRINT PACKAGE BOOKING</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Main -->

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <!-- Logo -->
                    <div class="col-md-4">
                        <div class="logo-foter">
                            <a href="<?php echo base_url('Welcome/index')?>" title=""><img src="<?php echo base_url('images/logo-footer.png')?>" alt=""></a>
                        </div>
                    </div>
                    <!-- End Logo -->
                    <!-- Navigation Footer -->
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="ul-ft">
                            <ul>
                                <li><a href="<?php echo base_url('Welcome/about')?>" title="">About</a></li>
                                <li><a href="<?php echo base_url('Welcome/blog')?>" title="">Blog</a></li>
                                <li><a href="<?php echo base_url('Welcome/fqa')?>" title="">FQA</a></li>
                                <li><a href="<?php echo base_url('Welcome/careers')?>" title="">Carrers</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Navigation Footer -->
                    <!-- Navigation Footer -->
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="ul-ft">
                            <ul>
                                <li><a href="<?php echo base_url('Welcome/contact')?>" title="">Contact Us</a></li>
                                <li><a href="#" title="">Privacy Policy</a></li>
                                <li><a href="#" title="">Term of Service</a></li>
                                <li><a href="#" title="">Security</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Navigation Footer -->
                    <!-- Footer Currency, Language -->
                    <div class="col-sm-6 col-md-4">
                        <!-- Language -->
                        <div class="currency-lang-bottom dropdown-cn float-left">
                            <div class="dropdown-head">
                                <span class="angle-down"><i class="fa fa-angle-down"></i></span>
                            </div>
                            <div class="dropdown-body">
                                <ul>
                                    <li class="current"><a href="#" title="">English</a></li>
                                    <li><a href="#" title="">Bahasa Melayu</a></li>
                                    <li><a href="#" title="">Català</a></li>
                                    <li><a href="#" title="">Dansk</a></li>
                                    <li><a href="#" title="">Deutsch</a></li>
                                    <li><a href="#" title="">Francais</a></li>
                                    <li><a href="#" title="">Italiano</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Language -->
                        <!-- Currency -->
                        <div class="currency-lang-bottom dropdown-cn float-left">
                            <div class="dropdown-head">
                                <span class="angle-down"><i class="fa fa-angle-down"></i></span>
                            </div>
                            <div class="dropdown-body">
                                <ul>
                                    <li class="current"><a href="#" title="">US</a></li>
                                    <li><a href="#" title="">ARS</a></li>
                                    <li><a href="#" title="">ADU</a></li>
                                    <li><a href="#" title="">CAD</a></li>
                                    <li><a href="#" title="">CHF</a></li>
                                    <li><a href="#" title="">CNY</a></li>
                                    <li><a href="#" title="">CZK</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Currency -->
                        <!--CopyRight-->
                        <p class="copyright">
                            © 2009 – 2014 Bookyourtrip™ All rights reserved.
                        </p>
                        <!--CopyRight-->
                    </div>
                    <!-- End Footer Currency, Language -->
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    </div>
    
    <!-- Library JS -->
     <script type="text/javascript" src="<?php echo base_url('html/js/library/jquery-1.11.0.min.js')?>"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="<?php echo base_url('html/js/library/jquery-ui.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('html/js/library/bootstrap.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('html/js/library/owl.carousel.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('html/js/library/parallax.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('html/js/library/jquery.nicescroll.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('html/js/library/jquery.ui.touch-punch.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('html/js/library/jquery.mb.YTPlayer.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('html/js/library/SmoothScroll.js')?>"></script>
    <!-- End Library JS -->
    <!-- Main Js -->
    <script type="text/javascript" src="<?php echo base_url('html/js/script.js')?>"></script>
    <!-- End Main Js -->
    <script type="text/javascript">
                     //==================================
    function sendmail(keygroup) {
 
           $.post('<?php echo base_url('Welcome/send_mail')?>' , { keygroup : keygroup } , function(data){
							//console.log(data);
							if(data == 1){
									
									var url = '<?php echo base_url('Welcome/email_book_package/')?>'+keygroup;                 window.open(url) ;
                                                       window.location.href = "<?php echo base_url('Welcome/index') ?>";
							}
						});
        }
    
    
    </script>
</body>
</html>
