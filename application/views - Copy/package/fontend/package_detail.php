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
        
        <!-- Header -->
        <?php include("header.php"); ?>
        <!-- End Header -->

                    <?php 
      $option2 = $this->Package_model->listpackage_option($currentID);
      $numoption2 = $option2->num_rows();
    $packageinclude1Data = $this->Package_model->Listpackageinclude($currentID);
    $numincluded1 = $packageinclude1Data->num_rows();
      ?>
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
        <div class="main main-dt">
            <div class="container">
                <div class="main-cn detail-page bg-white clearfix">
 <?php
    $packageData = $this->Package_model->list_packageData($currentID);
    foreach ($packageData->result() AS $Data) {}
    
?>
                    <!-- Breakcrumb -->
                    <section class="breakcrumb-sc">
                        <ul class="breadcrumb arrow">
                            <li><a href="<?php echo base_url('Welcom/index')?>"><i class="fa fa-home"></i></a></li>
                            <li><a href="<?php echo base_url('Welcom/package_list')?>" title="">Package Tours</a></li>
                            <li><?php echo $Data->package_name_en;?></li>
                        </ul>
                        <div class="support float-right">
                            <small>Got a question?</small> 081-123-4567
                        </div>
                    </section>
                    <!-- End Breakcrumb -->

                    <!-- Header Detail -->
                    <section class="head-detail">
                        <div class="head-dt-cn">
                            <div class="row">
                                <div class="col-sm-7">
                                    <h1><?php echo $Data->package_name_en?></h1>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <p class="price-book">
<!--                                        Price <span><?php //echo $Data->package_adult_price?></span>THB/person-->
                                        <a href="<?php echo base_url('Welcome/book_package/'.$Data->id)?>" title="" class="awe-btn awe-btn-1 awe-btn-lager">Book Now</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Header Detail -->

                    <!-- Detail Slide -->
                    <section class="detail-slider">
                        <!-- Lager Image -->
                        <div class="slide-room-lg">
                            <div id="slide-room-lg">
                                                         <?php 
    $packageimgData = $this->Package_model->loadImg($currentID);
    foreach ($packageimgData->result() AS $Dataimg) {
    
?>
                                <img src="<?php echo base_url('uploadfile/') . $Dataimg->images_name ?>" alt="">
    <?php }?>
                            </div>
                        </div>
                        <!-- End Lager Image -->
                        <!-- Thumnail Image -->
                        <div class="slide-room-sm">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div id="slide-room-sm">
                                                                   <?php 
    $packageimg1Data = $this->Package_model->loadImg($currentID);
    foreach ($packageimg1Data->result() AS $Dataimg) {
    
?>
                                <img src="<?php echo base_url('uploadfile/') . $Dataimg->images_name ?>" alt="">
    <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Thumnail Image -->
                    </section>
                    <!-- End Detail Slide -->

                    <!-- Tour Overview -->
                    <section class="tour-overview detail-cn" id="tour-overview">
                        <div class="row">
                            <div class="col-lg-3 detail-sidebar">
                                <div class="scroll-heading">
                                    <h2>Activities</h2>
                                    <hr class="hr">
                                    <a href="#tour-overview" title="">Activities</a>
                                    <?php if ($numincluded1 >0){?>
                                    <a href="#tour-necessary">Includes</a>
                                    <?php }?>
                                    <?php if($numoption2 >0){?>
                                    <a href="#price">Prices</a>
                                    <?php }?>
                                </div>
                            </div>

                            <!-- Tour Overview Content -->
                            <div class="col-lg-9 tour-overview-cn">

                                <!-- Description -->
                                <div class="tour-description">
                                    <h2 class="title-detail">
                                        Description
                                    </h2>
                                    <div class="tour-detail-text">
                                        <p><?php echo $Data->package_detail?></p>
                                    </div>
                                </div>
                                <!-- End Description -->                               
                            </div>
                            <!-- End Tour Overview Content -->

                        </div>
                    </section>
                    <!-- End Tour Overview -->
                
                  
                    <!-- Include -->
                    <section class="tour-necessary detail-cn" id="tour-necessary">
                        <div class="row">
                            <div class="col-lg-3 detail-sidebar">
                                <div class="scroll-heading">
                                    

<?php if($numincluded1>0){?>
                                    <h2>Includes</h2>
                                    <hr class="hr">
                                    <a href="#tour-overview" title="">Activities</a>
                                    <?php if ($numincluded1 >0){?>
                                    <a href="#tour-necessary">Includes</a>
                                    <?php }?>
                                    <?php if($numoption2 >0){?>
                                    <a href="#price">Prices</a>
                                    <?php }?>
    <?php }?>
                                </div>
                            </div>
                            <div class="col-lg-9 tour-necessary-cn">
                                <div class="tour-detail-text">
                                    <p>
                                        <ul>
                                                                                <?php 
    $packageincludeData = $this->Package_model->Listpackageinclude($currentID);
    foreach ($packageincludeData->result() AS $Datainclude) {
?>
<li><?php echo $Datainclude->include_name_en?></li>
										
    <?php }?>
</ul>
                                    </p>                                    
                                </div>

                            </div>
                        </div>
                    </section>
                    <!-- End include-->
                    <!-- price-->
                     <section class="tour-necessary detail-cn" id="price">
                        <div class="row">
                            <div class="col-lg-3 detail-sidebar">
                            </div>
                            <div class="col-lg-9 price-cn">
                                <br>
                                <br>
                                <br>
                                <div class="tour-detail-text">
                                    <p>
                                        <ul>
                                                                                <?php 
    $option1 = $this->Package_model->listpackage_option($currentID);
    foreach ($option1->result() AS $Dataoption) {
?>
<li><?php echo $Dataoption->price_option?>
<br><?php echo number_format($Dataoption->adult_price)?> THB
</li>
										
    <?php }?>
</ul>
                                    </p>                                    
                                </div>

                            </div>
                        </div>
                    </section>
                    <!-- End peice-->

  


                    <section class="detail-footer tour-detail-footer detail-cn">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9 detail-footer-cn text-right">
                                <p class="price-book">
                                    <?php if($numoption2 ==''){?>Price <span><?php //echo $Data->package_adult_price?></span>THB/person <?php }?>
                                    <a href="<?php echo base_url('Welcome/book_package/'.$Data->id)?>" title="" class="awe-btn awe-btn-1 awe-btn-lager">Book Now</a>
                                </p>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
        <!-- End Main -->

        <!-- Footer -->
        <footer>
        <?php include("footer.php"); ?>
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
</body>
</html>
