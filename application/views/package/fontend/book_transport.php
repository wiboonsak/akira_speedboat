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
           <link href="<?php echo base_url('assets/plugins/sweet-alert/sweetalert2.min.css')?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('html/css/library/jquery-ui.min.css')?>">
        <link rel="stylesheet" href="<?php echo base_url('html/css/library/owl.carousel.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('html/css/library/jquery.mb.YTPlayer.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('html/css/style.css')?>">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
                                <p>Choose Departure Trip</p>
                            </li>
                            <li class="step-part">
                                <span>2</span>
                                <p>Your Booking &amp; Payment Details</p>
                            </li>
                            <li>
                                <span>3</span>
                                <p>Booking Completed!</p>
                            </li>
                        </ul>
                        <!-- ENd Step -->
                    </div>
                    <!-- Payment Room -->
                    <div class="payment-room">
                        <?php 
                        $keygroub = $this->uri->segment(3);
  $getbooking_title = $this->Package_model->getbooking_title($keygroub);
                        foreach ($getbooking_title->result() AS $getbooking_title2) { }
                        $adultstravel = $getbooking_title2->adult_traveller;
                        $childtravel = $getbooking_title2->child_traveller;
                        $totalpeople = $adultstravel+$childtravel;
                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="payment-info">
                                    <?php $r='';
                                    $route_id = $getbooking_title2->route_id;
          $list_route = $this->transport_model->listRoute($r,$route_id);
          foreach ($list_route->result() AS $list_route2) {}?>      
          <?php $list_placebegin = $this->Package_model->list_placeData($list_route2->begin_place_id);
                        foreach ($list_placebegin->result() AS $list_placebegin2) {}?>
          <?php $list_placedes = $this->Package_model->list_placeData($list_route2->destination_place_id);
                        foreach ($list_placedes->result() AS $list_placedes2) {}
          ?>
                                    <h3 style="font-size: 18px !important"><i class="fa fa-ship" aria-hidden="true"></i> <?php echo $list_placebegin2->place_name_en?> <i class="fa fa-arrow-right" aria-hidden="true"></i> <?php  echo $list_placedes2->place_name_en?></h3><br>
                                    
                           <?php 
                                  $x=''; $n=1; $txt_routeType =''; $times1='';
                        $routeType2 = $this->transport_model->get_routeType($route_id, $getbooking_title2->route_type_id, $r, $r, 'id');		
		foreach($routeType2->result() as $routeType3){ 
			
			if($n == 1){ $txt = ''; } else { $txt = ' + '; }
			
			$listTransport = $this->transport_model->listTransport($x,$routeType3->transport_id);
			foreach($listTransport->result() as $listTransport2){}			
			$txt_routeType = $txt_routeType.$txt.$listTransport2->transport_name_en;
		
		$n++;  }?>
		<p style="color: #2f79b1;"><strong> <?php echo $txt_routeType?></strong></p>                                    
                                    <span class="star-room">
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                        <i class="glyphicon glyphicon-star"></i>
                                    </span>
                                    <ul>
                                        <li>
                                            <?php $Routetype = $this->transport_model->get_routeType($route_id, $getbooking_title2->route_type_id, $r, 'yes', 'id');
foreach ($Routetype->result() as $Data){}
                                            $dayofweek = date('l', strtotime($getbooking_title2->date_depart)); ?>
                                            <span>Departing:</span>
                                            <?php echo $dayofweek?>,  <?php echo $this->Package_model->GetEngDateTime2($getbooking_title2->date_depart);?>
                                        </li>
                                      <?php   $times = $this->transport_model->get_timeDetail($r,$r,$r,$r,$getbooking_title2->time_id);	
						   //$numTime = $times->num_rows();
                                                   
						   //if($numTime >0){						   	
                                                                foreach($times->result() as $times2){}  
						   		$times1 = date('H:i', strtotime($times2->arrive_time.'+'.$Data->transfer_h_time.' hours'));	
						   		$times1 = date('H:i', strtotime($times1.'+'.$Data->transfer_m_time.' minutes'));?>
                                               <?php //}?>     
                                        <li>
                                            <span>Time:</span>
                                            <?php echo $times2->arrive_time?> > <?php echo $times1?>
                                        </li>
                                       
                                        <li>
                                            <span>Adults:</span>
                                            <?php echo $adultstravel?>
                                        </li>
                                        <li>
                                            <span>Child:</span>
                                            <?php echo $childtravel?>
									    </li>
                                    </ul>  
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="payment-price">

                                    <figure>
                                        <?php $r = '1';
    $listroute = $this->transport_model->listRoute($r,$list_route2->begin_place_id);
     foreach($listroute->result() as $listroute2){}?>
                                       <img src="<?php echo base_url('uploadfile/').$listroute2->route_image?>" class="img-responsive" style="padding: 20px 0px;" onclick="mapData('<?php echo $list_route2->begin_place_id?>')">
                                    </figure>
                                    <div class="total-trip">
                                        <span>
                                           BOOKING ID: <?php echo $keygroub?>
                                            <br>
                                            <?php echo number_format($getbooking_title2->total_price)?> THB<small>/ <?php echo $totalpeople?> Travellers</small>
                                        </span>
                                       
                                        <p>
                                            Trip Total: <ins> <?php echo number_format($getbooking_title2->total_price)?> THB</ins>

                                           <i>Service charge 10% not included.</i>
                                        </p>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <!-- Payment Room -->
                    
                    
                    <div class="tour-itinerary" style="padding: 0px 25px;">
                                    <h2 class="title-detail" style="color: #2f79b1;">Trip Details:</h2>
                                    <!-- Accordion -->
                                    <div class="panel-group no-margin" id="accordion">
<?php  /*$times1 = $this->transport_model->get_timeDetail($route_id,$Data->key_group,'1');	
						   $numTime1 = $times1->num_rows();
                                                   $c =1;
						   if($numTime1 >0){						   	
						   		foreach($times1->result() as $times3){  
						   		$times4 = date('H:i', strtotime($times2->arrive_time.'+'.$Data->transfer_h_time.' hours'));	
						   		$times4 = date('H:i', strtotime($times4.'+'.$Data->transfer_m_time.' minutes'));
                                                                 $c++; }}*/?> 
                                        <!-- Accordion 1 -->
                                        <div class="panel">
                                            <div class="panel-heading" id="heading<?php //echo $times3->id?>" style="background-color: #daefff;  padding: 0px 20px 0px 20px">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php //echo $times3->id?>">
														<i class="fa fa-circle" aria-hidden="true" style="color:#A4A4A4"></i> <?php echo $times2->arrive_time?> > <?php echo $times1?>
                                                        <span style="padding-left: 30px;"><i class="fa fa-clock-o" style="color:#A4A4A4"></i> <?php if($Data->transfer_h_time!=''){echo $Data->transfer_h_time = str_replace("0", "", $Data->transfer_h_time); } ?> h <?php echo $Data->transfer_m_time?> m</span>
                                                        <span style="padding-left: 30px;"><i class="fa fa-money" style="color:#A4A4A4"></i> <?php echo number_format($getbooking_title2->total_price)?> THB</span>
                                                        <span class="icon fa fa-angle-down"></span>
                                                    </a>
                                                </h4>                                              
                                            </div>
                                            
                                            <div id="collapse<?php //echo $times3->id?>" class="panel-collapse collapse in" aria-labelledby="heading<?php //echo $times3->id?>">
                                                 <?php //$checkDetail = $this->transport_model->checkDetail($times3->id, '1');
                                                  $checkDetail = $this->transport_model->checkDetail($getbooking_title2->time_id);
                                                  
                                                //$numchDetail = $checkDetail->num_rows();
                                               // if($numchDetail>0){
                                                    $a =0; 
                                                    
                                                 $priceArray = explode("/",$getbooking_title2->adult_price);
                                                 //$numPriceAdult = count($priceArray);
                                                 $priceArray2 = explode("/",$getbooking_title2->child_price);
                                                 //$numPriceChild = count($priceArray2);
                                                  
                                                    
                                                    
                                                    
 foreach ($checkDetail->result() as $checkDetail2){	
                               
                                                ?>
                                                <div class="panel-body">                                                   
                                                    <div class="" style="background-color: #f1f1f1; border: 1px solid #E5E5E5">
														<div class="row" style="padding: 20px 0px 20px 25px;">
															<div class="col-sm-10">
																<div class="item">
																	<span><i class="fa fa-map-marker"></i></span>
																	<div><strong><?php echo $checkDetail2->arrive_time?> <?php $checkroute = $this->Package_model->list_placeData($checkDetail2->begin_place_id);  foreach ($checkroute->result() as $checkroute2){} echo $checkroute2->place_name_en?></strong> </div>
																</div>
																<?php $checktransport = $this->Package_model->list_transportData($checkDetail2->transport_id);foreach ($checktransport->result() as $checktransport2){} ?>															<div class="item">
																	<span><i class="<?php echo $checktransport2->icon_class?>" aria-hidden="true"  style="color:#2f79b1;"></i></span>
                                                                                                                                        <div style="color:#2f79b1;"><strong><?php  echo $checktransport2->transport_name_en?></strong> &nbsp;&nbsp;<i class="fa fa-info-circle" style="font-size:20px"onclick="transportData('<?php echo $checkDetail2->transport_id?>')"></i></div>
																	<p>
																	   <small><strong>Note : </strong><?php echo $checkDetail2->note_checkin_en?><br>
</small>
</p>
<?php $totalprice = ($adultstravel*$priceArray[$a])+($childtravel*$priceArray2[$a]);?>
<p><button type="button" class="" data-toggle="collapse" data-target="#price1<?php echo $checkDetail2->id?>" style="font-size: 10pt !important"> <?php echo $totalpeople?> Travellers = <?php echo number_format($totalprice)?> THB <span style="float: right; padding-left: 15px;"> <i class="fa fa-chevron-down" aria-hidden="true"></i> </span></button>
																		<div id="price1<?php echo $checkDetail2->id?>" class="collapse">
																			<ul>
																				<li style="font-size: 10pt; font-weight: 100;"><?php echo $adultstravel?> Adults x <?php echo number_format($priceArray[$a])?> = <?php echo number_format($adultstravel*$priceArray[$a])?> THB </li>
																				<li style="font-size: 10pt; font-weight: 100;"><?php echo $childtravel?> Children x <?php echo number_format($priceArray2[$a])?> = <?php echo number_format($childtravel*$priceArray2[$a])?> THB</li>
																			</ul>
																		</div>
																	</p>
																</div>
																
																<div class="item-end">
																	<span><i class="fa fa-map-marker"></i></span>
																	<div><strong><?php echo $checkDetail2->depart_time?> <?php $checkroute3 = $this->Package_model->list_placeData($checkDetail2->destination_place_id); foreach ($checkroute3->result() as $checkroute4){}echo $checkroute4->place_name_en?></strong></div>																	
																</div>
															</div>														
													</div>                                                    
                                                </div>
                                            </div>
                                                 <?php $a++; }//}?> 
                                        </div>
                                        <!-- End Accordion 1 -->
                                              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>          
                                    </div>
                                    <!-- Accordion -->
                                   
                              </div>
                            
                             
                             
                    

                    <div class="payment-form">
                        <div class="row form">
                            <div class="col-md-6">
                                <h2>Your Information</h2>
                                <div class="form-field">
                                  <div class="form-field">
                                    <input type="text" placeholder="First Name" id="Name" class="field-input">
                                </div>
                                <div class="form-field">
                                    <input type="text" placeholder="Last Name" id="Last" class="field-input">
                                </div>
                                <div class="form-field">
                                    <input type="text" placeholder="Email" id="Email" class="field-input">
                                </div>
                                <div class="form-field">
                                    <input type="text" placeholder="ID Line" id="Line" class="field-input">
                                </div>
                                <div class="form-field">
                                    <input type="text" placeholder="Phone number" id="Phone" class="field-input">
                                </div>
                               
                                 <div class="radio-checkbox">
                                    <input type="checkbox" class="checkbox" id="accept" name="accept" value="0" onclick="changCH(this.checked)">
                                    <label for="accept">I am not travel. I am making this booking for someone else.</label>
                                </div>
                            </div>
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

						   <button class="awe-btn awe-btn-1 awe-btn-lager" onclick="AddBooking()" id="buttonClass">Book now</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Main -->

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
     <script src="<?php echo base_url('assets/plugins/sweet-alert/sweetalert2.min.js')?>"></script>
<script src="<?php echo base_url('assets/pages/jquery.sweet-alert.init.js')?>"></script>
    <!-- Main Js -->
    <script type="text/javascript" src="<?php echo base_url('html/js/script.js')?>"></script>
    <!-- End Main Js -->
        <script type="text/javascript" >

//------------------------------------------
    function AddBooking() {
        var Name = $('#Name').val();
        var Last = $('#Last').val();
        var Email = $('#Email').val();
        var Line = $('#Line').val();
        var Phone = $('#Phone').val();
          var accept = $('#accept').val();
        //var currentID = $('#currentID').val();
        var keygroub = '<?php echo $keygroub;?>';
     if (Name == '') {
        alert("Please enter First name");
            
    }else if (Last == '') {
         alert("Please enter Last name");
            
    }else if (Email == '') {
        alert("Please enter Email");
            
    }else if (Phone == '') {
        alert("Please enter Phone number");	
    }else{
            $.post('<?php echo base_url('Welcome/AddBookingTransport') ?>', { Name: Name, Last: Last, Email: Email,Line:Line,Phone:Phone,keygroub:keygroub,accept:accept}, function (data) {
                if (data !=0) {
 window.location.href = "<?php echo base_url('Welcome/book_transport_comfirm/') ?>"+data;
                } else {
                 alert("Can not be add");
                }
            })
        }
    }
            //==================================
        function transportData(transportID) {
        $.post('<?php echo base_url('Welcome/transportDetail') ?>', {transportID: transportID},
         function (data) {
         //$('#routemodal').empty();
         $('#exampleModal').empty();
         //$('#routemodal').html(data);
         $('#exampleModal').html(data);
         $('#exampleModal').modal('show');
          });
          }
                //==================================
        function mapData(routeID) {
        $.post('<?php echo base_url('Welcome/mapDetail') ?>', {routeID: routeID},
         function (data) {
         //$('#routemodal').empty();
         $('#exampleModal').empty();
         //$('#routemodal').html(data);
         $('#exampleModal').html(data);
         $('#exampleModal').modal('show');
          });
          }
          //------------------------------------------
    function changCH(checked2) {
        if(checked2 == true){$('#accept').val('1');}
        else{$('#accept').val('0');}
    }
    </script>
</body>
</html>
