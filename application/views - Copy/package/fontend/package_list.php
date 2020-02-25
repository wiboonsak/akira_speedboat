<!DOCTYPE html>
<!--[if IE 7 ]> <html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]> <html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>TRAVEL LIPE, BOOKING SPEEADBOAT, TRANSPORT, PACKAGE TOUR - MOONLIGHT LIPE - KOH LIPE, SATUN THAILAND</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
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
    <style>
#more {display: none;}
</style>
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

        
        <!--Banner-->
        <section class="banner">

            <!--Background-->
            <div class="bg-parallax bg-1"></div>
            <!--End Background-->

            <div class="container">

                <div class="logo-banner text-center">
                    <a href="<?php echo base_url('Welcome/index')?>" title="">
                        <img src="<?php echo base_url('images/logo-header.png')?>" alt="">
                    </a>
                </div>


            </div>

        </section>
        <!--End Banner-->

        <!-- Sales -->
        <section class="sales">
            <!-- Title -->
            <div class="title-wrap">
                <div class="container">
                    <div class="travel-title float-left">
                        <h2>Best prices for transfers. <span>Koh Lipe & more</span></h2>
                    </div>
                    <!--<a href="#" title="" class="awe-btn awe-btn-5 awe-btn-lager arrow-right text-uppercase float-right">All Package Tours</a>-->
                </div>
            </div>
            <!-- End Title -->
            <!-- Hot Sales Content -->
            <div class="container">
                <div class="sales-cn">
                    <div class="row">
                          <?php 
  $packageData =$this->Package_model->getpackageListall();
    foreach ($packageData->result() AS $Data) {?>
                       <!-- HostSales Item -->
                        <div class="col-xs-6 col-md-3">
                            <div class="sales-item">
                                <figure class="home-sales-img">
                                    <a href="<?php echo base_url('Welcome/package_detail/'.$Data->id)?>" title="">
                                        <img width="293" height="190"src="<?php echo base_url('uploadfile/') . $Data->images_name ?>" alt="">
                                    </a>
                                    <figcaption>
                                        Book <span>Now</span>
                                    </figcaption>
                                </figure>
                                <div class="home-sales-text">
                                    <div class="home-sales-name-places">
                                        <div class="home-sales-name" style="width: 100%;height: 130px">
                                            <a href="<?php echo base_url('Welcome/package_detail/'.$Data->id)?>" title="" ><?php echo $Data->package_name_en?></a>
                                        </div>
                                        <div class="home-sales-places">
                                            <a href="" title="">Koh Lipe</a>,
                                            <a href="" title="">Satun Thailand</a>
                                        </div>
                                    </div>
                                    <hr class="hr">
              <?php $txt =''; $txt2 ='';
  $packageoptionData = $this->Package_model->listpackage_option($Data->id);
  $numoption = $packageoptionData->num_rows();
  if ($numoption>0){
      foreach ($packageoptionData->result() AS $Dataoption) {
          
          if($numoption>1){  $txt2 = '<br>'; }
          
          if(($Dataoption->min_person ==1) && ($Dataoption->max_person ==1) && ($numoption ==1)){
              $txt = number_format($Dataoption->adult_price).' THB / 1 Person';
          } else {
          
          $txt = $txt.$Dataoption->min_person.' - '.$Dataoption->max_person.' Person '.number_format($Dataoption->adult_price).' THB'.$txt2;
          $txt2 ='';
          }
      }?>      
                                 <br>
                                 <button type="button"  class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo $txt;?>" > Price option    </button>
<?php /*foreach ($packageoptionData->result() AS $Dataoption) { ?><?php echo $Dataoption->min_person?> - <?php echo $Dataoption->max_person?> PERSON <?php echo $Dataoption->adult_price?> THB   <?php if($numoption>1){?><br><?php } }*/ ?> 
                                  
<?php } ?>
                                </div>
                            </div>
                        </div>
 <?php } ?>
                    </div>
                </div>
            </div>
            <!-- End Hot Sales Content -->
        </section>
        <!-- End Sales -->
        <!-- Footer -->
     	<?php include("footer.php"); ?>
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
    <script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
		
		
		//-------------------------------------
		function setTopmenySelect(idMenu){
			$('.topmenu').removeClass('current-menu-parent');
			$('#'+idMenu).addClass('current-menu-parent');
		}
			setTopmenySelect('liPackage');	
</script>
</body>
</html>
