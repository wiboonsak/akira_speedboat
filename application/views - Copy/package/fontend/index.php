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
        <link rel="stylesheet" href="<?php echo base_url('html/css/library/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('html/css/library/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('html/css/library/jquery-ui.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('html/css/library/owl.carousel.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('html/css/library/jquery.mb.YTPlayer.min.css') ?>">
        <!-- End Library CSS -->
        <link rel="stylesheet" href="<?php echo base_url('html/css/style.css') ?>">
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
            <?php include('header.php'); ?>
            <!-- End Header -->


            <!--Banner-->
            <section class="banner">

                <!--Background
                <div class="bg-parallax bg-1"></div>-->
                <!--End Background-->

                <div class="container">

                    <div class="logo-banner text-center">
                        <a href="" title="">
                            <img src="<?php echo base_url('images/logo-header.png') ?>" alt="">
                        </a>
                    </div>

                    <!-- Banner Content -->
                    <div class="banner-cn">
                        <!-- Tabs Content -->
                        <div class="tab-content" style="">
                            <!-- Search Cruise-->
                            <div class="form-cn form-cruise tab-pane active in" id="form-cruise">
                                <h2>Where would you like to go?</h2>
                              
                                <form action="<?php echo base_url('Welcome/trip_list') ?>" method="post" enctype="multipart/form-data" onsubmit="return CheckForm()" name="frm1" id="frm1">
									 <ul class="form-radio">
                                     <li>
                                         <div class="radio-checkbox">
                                             <input type="radio" name="tripType" id="radio-5" class="radio" value="2" onClick="changeSearchForm('roundTrip', this.checked)" checked>
                                             <label for="radio-5">Return Trip</label>
                                         </div>
                                     </li>
                                     <li>
                                         <div class="radio-checkbox">
                                             <input type="radio" name="tripType" id="radio-6" class="radio" value="1" onClick="changeSearchForm('oneTrip', this.checked)">
                                             <label for="radio-6">One-Way</label>
                                         </div>
                                     </li>
                                 </ul> 
                                    <div class="form-search clearfix">
                                        <div class="form-field field-select field-lenght">
                                            <div class="select">
                                                <span id="formroute">From:</span>
                                                <select id="routedata" name="routedata"onchange="placedataupdate(this.value)">
                                                    <option value="">---Select---</option>
                                                    <?php
                                                    $routeData = $this->Package_model->getrouteList();
                                                    foreach ($routeData->result() as $routeData2) {
                                                        ?>
                                                        <option value="<?php echo $routeData2->begin_place_id ?>"><?php echo $routeData2->place_name_en ?> </option>
                                                       
<?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-field field-select field-lenght">
                                            <div class="select">
                                                <span id="formto">To:</span>
                                                <select id="placedata" name="placedata">
                                                    <option value="">---Select---</option>
                                                    <?php
                                                    $placeData = $this->Package_model->list_placeData();
                                                    foreach ($placeData->result() as $placeData2) {
                                                        ?>
                                                    <option value="<?php echo $placeData2->id ?>"><?php echo $placeData2->place_name_en ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-field field-date" style="width: 160px;">
                                            <input type="text" class="field-input calendar-input" placeholder="Depart Date" id="datedata" name="datedata" autocomplete="off">
                                        </div>
                                       <div class="form-field field-date" id="divReturnDate"  style="width: 160px;">
                                             <input type="text" class="field-input calendar-input" placeholder="Return Date" id="dateReturn" name="dateReturn"  autocomplete="off">
                                         </div>
										
                                        <div class="form-field field-select field-adult">
                                            <div class="select">
                                                <span>Adults</span>
                                                <select id="Adults" name="Adults">
                                                    <option value="0">Adults</option>
                                                    <?php for ($a = 1; $a <= 10; $a++) {
                                                        ?>													<option value="<?php echo $a ?>"><?php echo $a ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-field field-select field-children">
                                            <div class="select" >
                                                <span>Children</span>
                                                <select id="Children" name="Children">
                                                    <option value="0">Children</option>
                                                    <?php for ($a = 1; $a <= 10; $a++) { ?>													<option value="<?php echo $a ?>"><?php echo $a ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-submit">
                                            <button type="submit" class="awe-btn awe-btn-medium awe-search">Search</button>
                                        </div>
                                        <input type="hidden" id="spanRoute" name="spanRoute" value="">
                                        <input type="hidden" id="spanTo" name="spanTo" value="">
                                    </div>
									
                                </form>
                            </div>
                            <!-- End Search Cruise -->   
                        </div>
                        <!-- End Tabs Content -->

                    </div>
                    <!-- End Banner Content -->

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
                        <a href="<?php echo base_url('Welcome/package_list') ?>" title="" class="awe-btn awe-btn-5 awe-btn-lager arrow-right text-uppercase float-right">All Package Tours</a>
                    </div>
                </div>
                <!-- End Title -->
                <!-- Hot Sales Content -->
                <div class="container">
                    <div class="sales-cn">
                        <div class="row">
                            <!-- HostSales Item -->
                            <?php
                            $packageData = $this->Package_model->getpackageList();
                            foreach ($packageData->result() AS $Data) {
                                ?>	
                                <div class="col-xs-6 col-md-3">
                                    <div class="sales-item">
                                        <figure class="home-sales-img">
                                            <a href="<?php echo base_url('Welcome/package_detail/' . $Data->id) ?>" title="">
                                                <img width="293" height="190"src="<?php echo base_url('uploadfile/') . $Data->images_name ?>" alt="">
                                            </a>
                                            <figcaption>
                                                Book <span>Now</span>
                                            </figcaption>
                                        </figure>
                                        <div class="home-sales-text">
                                            <div class="home-sales-name-places">
                                                <div class="home-sales-name" style="width: 100%;height: 130px">
                                                    <a href="<?php echo base_url('Welcome/package_detail/' . $Data->id) ?>" title="" ><?php echo $Data->package_name_en ?></a>
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
                            <!-- End HostSales Item -->




                        </div>
                    </div>
                </div>
                <!-- End Hot Sales Content -->
            </section>
            <!-- End Sales -->




            <!-- Footer -->
<?php include('footer.php'); ?>
            <!-- End Footer -->

        </div>

        <!-- Library JS -->
        <script type="text/javascript" src="<?php echo base_url('html/js/library/jquery-1.11.0.min.js') ?>"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="<?php echo base_url('html/js/library/jquery-ui.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('html/js/library/bootstrap.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('html/js/library/owl.carousel.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('html/js/library/parallax.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('html/js/library/jquery.nicescroll.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('html/js/library/jquery.ui.touch-punch.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('html/js/library/jquery.mb.YTPlayer.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('html/js/library/SmoothScroll.js') ?>"></script>
        <!-- End Library JS -->
        <!-- Main Js -->
        <script type="text/javascript" src="<?php echo base_url('html/js/script.js') ?>"></script>
        <script type="text/javascript">
         //================================== changeSearchForm('roundTrip',ischecked)changeSearchForm('oneTrip')dateReturn
		  function 	changeSearchForm(tripType,ischecked){
			  
			  if(tripType=='roundTrip'){
				     $('#dateReturn').val('');
					$('#dateReturn').show();
			  }else if(tripType=='oneTrip'){ 
				    $('#dateReturn').val('');
				    $('#dateReturn').hide();
			  }
		  }
			
			
         //==================================
        function placedataupdate(changeValue) {
        $.post('<?php echo base_url('Welcome/placedataupdate') ?>', {changeValue: changeValue},
         function (data) {
         $('#placedata').empty();
         $('#placedata').html(data);});
}
          //-------------------------------------
		function setTopmenySelect(idMenu){
			$('.topmenu').removeClass('current-menu-parent');
			$('#'+idMenu).addClass('current-menu-parent');
		}
			setTopmenySelect('liindex');	
          //================================== $('#radio-5').is(':checked') $('#radio-6').is(':checked')
          function CheckForm() {
          var routedata = $('#routedata').val();
          var placedata = $('#placedata').val();
          var datedata = $('#datedata').val();
          var Adults = $('#Adults').val();
		  var dateReturn = $('#dateReturn').val();	  
			  
           if ((routedata == '')) {
             alert('Please Select Form .');
             return false;
           } else if ((placedata == '')) {
             alert('Please Select To .');
             return false;
		    } else if ((datedata == '')) {
             alert('Please Select Depart Date .');
             return false;
		   }else if($('#radio-5').is(':checked')&&(dateReturn=='')){ 
			  alert('Please Select Return Date .');
             return false;
           } else if ((Adults == '0')) {
             alert('Please Select Adults .');
             return false;
           }else{
               $('#spanRoute').val($('#formroute').text());
               $('#spanTo').val($('#formto').text());
               
               $('#frm1').submit();
          /*     var postData = new FormData($("#frm1")[0]);
        $.ajax({
            type: 'POST',
            url: '<?php //echo base_url('Welcome/trip_list') ?>',
            processData: false,
            contentType: false,
            data: postData,
            success: function (data, status) {
                if (status == 'success') {
                   
                } else {
                  
                }
            }
        });*/
        }}
        $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
        </script>
        <!-- End Main Js -->
    </body>
</html>
