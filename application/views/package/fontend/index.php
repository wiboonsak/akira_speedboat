<!DOCTYPE html>
<!--[if IE 7 ]> <html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]> <html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>	AKIRA-SPEEDBOAT , BOOKING SPEEADBOAT, TRANSPORT, PACKAGE TOUR - LIPE - KOH LIPE, SATUN THAILAND</title>
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
		
		<!---modal-------->
 
		<style>
.clockdate-wrapper {
    /*background-color: #333;*/
    background-color:#7E0002;
    padding:0px;
    
    width:100%;
    text-align:center;
    border-radius:5px;
    margin:5 auto;
    margin-top:1%;
}
#clock{
   /* background-color:#930002;*/
	 background-color:#930002;
    font-family: sans-serif;
    font-size:25px;
    text-shadow:0px 0px 1px #fff;
    color:#fff;
}
#clock span {
    color:#DCDCDC;
    text-shadow:0px 0px 1px #333;
    font-size:20px;
    position:relative;
    top: 0px;
    left:-3px;
}
#date {
    letter-spacing:10px;
    font-size:14px;
    font-family:arial,sans-serif;
    color:#fff;
}	
		
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
                               <div class="row">
									<div class="col-md-8">
								  		 <h2>Where would you like to go?</h2>
								   </div>
								   <div class="col-md-4">
									   	 <div id="clockdate">
										  <div class="clockdate-wrapper">
											<div id="clock"></div>
											<div id="date"></div>
										  </div>
										</div>
								   </div>
								</div> 
								
								
                    
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
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-field field-date" style="width: 160px;">
                                            <input type="text" class="field-input calendar-input" placeholder="Depart Date" id="datedata" name="datedata" autocomplete="off">
                                        </div>
                                       <div class="form-field field-date" id="divReturnDate"  style="width: 160px;">
                                             <input type="text" class="field-input calendar-input" placeholder="Return Date" id="dateReturn" name="dateReturn"  autocomplete="off"  >
										   <!--  <hr id="hrid" color="#C0C0C0" style="z-index: 9000; margin-top: -18px;   height: 1px; display: none">-->
										   <div id="hrid" style="height: 3px; background-color: #c0c0c0; margin-top: -16px;  height: 3px; display: none"></div>
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
                                            <button type="button" class="awe-btn awe-btn-medium awe-search" onClick="getRoute()">Search</button>
                                        </div>
                                        <input type="hidden" id="spanRoute" name="spanRoute" value=""><!--onClick="CheckForm()" -->
                                        <input type="hidden" id="spanTo" name="spanTo" value="">
                                       
                                    </div>
									
                              
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
                            <h2 id="titleSection">Best prices for transfers. <span>Koh Lipe & more</span></h2>
                        </div>
                        <a id="btnAllPackage" href="<?php echo base_url('Welcome/package_list') ?>" title="" class="awe-btn awe-btn-5 awe-btn-lager arrow-right text-uppercase float-right">All Package Tours</a>
                    </div>
                </div>
                <!-- End Title -->
                <!-- Hot Sales Content -->
                <div class="container">
                    <div class="sales-cn">
						 <div id="preloader2" style="display: none" align="center">
							<div class="tb-cell">
								<div id="page-loading">
									<div></div>Checking Route
									<p>Loading</p>
								</div>
							</div>
						</div>
                        <div class="row" id="DataArea">
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
                <div style="height: 60px; width: 100%; margin-top: 10px;">             
                     <button type="button"  class="btn btn-primary" onClick="window.location.href='<?php echo base_url('Welcome/package_detail/' . $Data->id) ?>'"> <?php echo $txt;?>  </button>
				</div>  							
											
								<!--			
									<button type="button"  class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php //echo $txt;?>" > Price option    </button>-->
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
       <!-- <script type="text/javascript" src="<?php //echo base_url('html/js/library/SmoothScroll.js') ?>"></script>-->
        <!-- End Library JS -->
        <!-- Main Js -->
        <script type="text/javascript" src="<?php echo base_url('html/js/script.js') ?>"></script>
		<script src="https://www.paypalobjects.com/api/checkout.js"></script>
		 <!--modal -->
		
		
        <script type="text/javascript">
		 //---------------------------------
		function payPaypal(){
			$.post('<?php echo base_url('Travelcontroller/payByPaypal')?>' ,{ }, function(data){
				$('#paymentSpace').empty();
				$('#paymentSpace').html(data);
			})
		}	
		 //---------------------------------
		function payTransfer(){
			if(confirm('select transfer money payment ?')){
				$.post('<?php echo base_url('Travelcontroller/payBytransfer')?>', { },
					  function(data){
					  	  $('#titleSelectPay').empty();
						  $('#paymentSpace').empty();
						  $('#paymentSpace').html(data);
					
					     if ($(window).width() < 960) {
							$('html, body').animate({
								scrollTop: $("#totalPriceSpan").offset().top
							}, 1000);
						}
					  
				})
			}else{
				return false;
			}
		}
		 //---------------------------------
		function enableBooking(ischecked){
			//console.log(ischecked)
			if(ischecked==true){
				$('#btnBooknow').attr("disabled", false);
				$('#btnBooknow').addClass("awe-btn-1")
			}else{
				$('#btnBooknow').attr("disabled", true);
				$('#btnBooknow').removeClass("awe-btn-1")
			}
		}
		 //---------------------------------
		function booknow(){
			//var data = JSON.stringify( $('#confirmForm').serialize() );  
			var data =  $('#confirmForm').serialize();  
			//var cust_prefix = $('#cust_prefix option:selected').val(); 
			var custname = $('#cust_name').val(); 
			var custlastname = $('#cust_lastname').val(); 
			var Email = $('#cust_email').val(); 
			var cust_telephone_num = $('#cust_telephone_num').val(); 
			
			//if(cust_prefix=='0'){
			//	alert('please select title');
			//	return false;
			//}else 
				
			if(custname.trim()==''){
				alert('please input your name');
				return false;
			}else if(custlastname.trim()==''){
				alert('please input your last name');
				return false;
			}else if(Email.trim()==''){
				alert('please input your Email');
				return false;				
			
			}else if(!validateEmail(Email)) {
				alert('Email not valid');
				return false;	
					 
			}else if(cust_telephone_num.trim()==''){
				alert('please input your telephone number');
				return false;				
			}else if($('#chkbox').is(':checked')){ 
				
			}else{
				$.post('<?php echo base_url('Travelcontroller/addTravelBooking')?>',  { allData : data }, function(data){
					//console.log(data);
					if(data==1){
						//---------redirect to payment select-----
						showPayment();
					}else{
						//---------redirect to Error message------
						alert('error booking.');
					}
				})
			}
			
		}
		 //-------------------------------------
		 function showPayment(){
			 $.post('<?php echo base_url('Travelcontroller/paymentForm')?>',{ }, function(data){
				 $('#rightSpace').empty();
				 $('#rightSpace').html(data);
				 				 
			 })
		 }
		 //------------------------------------  
		function goConfirm(){
			//var cust_prefix = $('#cust_prefix option:selected').val(); 
			//var custname = $('#custname').val(); 
			//var custlastname = $('#custlastname').val(); 
			//var Email = $('#Email').val(); 
			///var phone = $('#phone').val(); 
			//var LineID = $('#LineID').val(); 
			var NAdult = $('#NAdult').val();
			var NChild = $('#NChild').val();
			
			var TimeIDGo = $('#TimeIDGo').val();
			var travelRound = $('#travelRound').val();
			var DTotalPrice = $('#DTotalPrice').val();
			var DAdultPrice = $('#DAdultPrice').val();
			var DChildPrice = $('#DChildPrice').val();
			
			if(travelRound=='return'){ 
				var TimeIDBack = $('#TimeIDBack').val();
				var RTotalPrice = $('#RTotalPrice').val();
				var RAdultPrice = $('#RAdultPrice').val();
				var RChildPrice = $('#RChildPrice').val();	
				var ReturnDepartTime = $('#ReturnDepartTime').text();	
				var backDate = $('#backDate').text();
			}else if(travelRound=='oneWay'){
				var TimeIDBack = 0;
				var RTotalPrice = 0;
				var RAdultPrice = 0;
				var RChildPrice = 0;
				var ReturnDepartTime ='';	
				var backDate = '';
			}
			
			 
			//------------get data summary-------------// departName returnName dateGo dateReturn ReturnDepartTime returnDate
			var departName= $('#departName').text()
			var DepartTime = $('#DepartTime').text();
			var DepartDuration = $('#DepartDuration').text();
			var DepartTotalAdult = $('#DepartTotalAdult').text();
			var DepartTotalChildren = $('#DepartTotalChildren').text();
			var DepartTotalPrice = $('#DepartTotalPrice').text();
			var dateGo = $('#dateGo').text();
					
			
			var returnName = $('#returnName').text();
			var ReturnDuration = $('#ReturnDuration').text();
			var ReturnTotalAdult = $('#ReturnTotalAdult').text();
			var ReturnTotalChildren = $('#ReturnTotalChildren').text();
			var ReturnTotalPrice = $('#ReturnTotalPrice').text();
			var AllTotalPrice = $('#AllTotalPrice').text();
			
			
			if(TimeIDGo==''){
				alert('please depart trip');
				return false;
			}else if((travelRound=='return')&&(TimeIDBack=='')){
				alert('please select return trip');
				return false;
			}else{
				$.post('<?php echo base_url('Travelcontroller/sumaryBooking')?>',{ NAdult : NAdult , NChild:NChild ,travelRound:travelRound, TimeIDGo:TimeIDGo, DTotalPrice:DTotalPrice, DAdultPrice:DAdultPrice, DChildPrice:DChildPrice , TimeIDBack:TimeIDBack,RTotalPrice:RTotalPrice, RAdultPrice:RAdultPrice,RChildPrice:RChildPrice ,  departName:departName , DepartTime:DepartTime, DepartDuration:DepartDuration,DepartTotalAdult:DepartTotalAdult,DepartTotalChildren:DepartTotalChildren,DepartTotalPrice:DepartTotalPrice, returnName:returnName , ReturnDuration:ReturnDuration , ReturnTotalAdult:ReturnTotalAdult , ReturnTotalChildren:ReturnTotalChildren,ReturnTotalPrice:ReturnTotalPrice,AllTotalPrice:AllTotalPrice , dateGo:dateGo, backDate:backDate ,ReturnDepartTime:ReturnDepartTime}, function(data){
					$('#DataArea').empty();
					$('#DataArea').html(data);
						if ($(window).width() < 960) {
							$('html, body').animate({
								scrollTop: $("#AllTotalPrice").offset().top
							}, 1000);
						}
					
				})
				
			}
			
			
			/*if(cust_prefix=='0'){
				alert('Please select Title');
				return false;
			}else if(custname.trim()==''){
				alert('Please input firstname');
				return false;
			}else if(custlastname.trim(custlastname)==''){
				alert('Please input lastname');
				return false;				
			}else if(Email.trim(Email)==''){
				alert('Please input Email');
				return false;
			} if(!validateEmail(Email)) {
				alert('Email not valid');
				return false;	
			}else if(phone.trim(phone)==''){
				alert('Please input Phone');
				return false;				
				
			}else{
				//console.log('dateReturn'+dateReturn);
				
				$.post('<?php //echo base_url('Travelcontroller/sumaryBooking')?>',{ custname:custname, custlastname :custlastname , Email:Email , phone:phone , NAdult : NAdult , NChild:NChild ,travelRound:travelRound, TimeIDGo:TimeIDGo, DTotalPrice:DTotalPrice, DAdultPrice:DAdultPrice, DChildPrice:DChildPrice , TimeIDBack:TimeIDBack,RTotalPrice:RTotalPrice, RAdultPrice:RAdultPrice,RChildPrice:RChildPrice , cust_prefix:cust_prefix , departName:departName , DepartTime:DepartTime, DepartDuration:DepartDuration,DepartTotalAdult:DepartTotalAdult,DepartTotalChildren:DepartTotalChildren,DepartTotalPrice:DepartTotalPrice, returnName:returnName , ReturnDuration:ReturnDuration , ReturnTotalAdult:ReturnTotalAdult , ReturnTotalChildren:ReturnTotalChildren,ReturnTotalPrice:ReturnTotalPrice,AllTotalPrice:AllTotalPrice , dateGo:dateGo, backDate:backDate ,ReturnDepartTime:ReturnDepartTime}, function(data){
					$('#DataArea').empty();
					$('#DataArea').html(data);
					 $('html, body').animate({
						 	scrollTop: $("#Children").offset().top
					 	}, 1000);
				})
			//}*/
			
			
			
			
		}
		 //------------------------------------  dateReturn ReturnDepartTime dreturnDate 
		function validateEmail($email) {
			  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			  return emailReg.test( $email );
		}
		 //------------------------------------  
		function doBooking(){
			var TimeIDGo = $('#TimeIDGo').val();
			var travelRound = $('#travelRound').val();
			var DTotalPrice = $('#DTotalPrice').val();
			var NAdult = $('#NAdult').val();
			var NChild = $('#NChild').val();
			var TimeIDBack = $('#TimeIDBack').val();
			var RTotalPrice = $('#RTotalPrice').val();
			var DAdultPrice = $('#DAdultPrice').val();
			var DChildPrice = $('#DChildPrice').val();
			var RAdultPrice = $('#RAdultPrice').val();
			var RChildPrice = $('#RChildPrice').val();
			
			//console.log('travelRound->'+travelRound)
			if(TimeIDGo==''){
				alert('please depart trip');
				return false;
			}else if((travelRound=='return')&&(TimeIDBack=='')){
				alert('please select return trip');
				return false;
			}else{
				$.post('<?php echo base_url('Travelcontroller/travelBookingForm')?>' , { TimeIDGo:TimeIDGo , TimeIDBack : TimeIDBack}
					  ,function(data){
					$('#routeList').empty();
					$('#routeList').html(data);
					
					if ($(window).width() < 960) {
					// console.log('>>'+$(window).width())
					 $('html, body').animate({
						 	scrollTop: $("#Children").offset().top
					 	}, 1000);
					}
					
				})
				
			}
			
		}			
		 //------------------------------------
		 function selectTimeTravel(timeTableID , DepartTime , DepartDuration , priceAdult , priceChild , way , ischecked ){
			   // console.log('ischecked:'+ischecked);
			   if(ischecked==false){
				   $('#radio-air-'+timeTableID).prop('checked', false);
				   clearAllValue(way)
			   }else{
				   $('.'+way).prop('checked', false);
				   $('#radio-air-'+timeTableID).prop('checked', true);
				   //-----calculate price-------------------//
				   var NChild  =  parseInt($('#NChild').val());
				   var NAdult  =  parseInt($('#NAdult').val());
				   var priceAdult = parseInt(priceAdult);
				   var priceChild = parseInt(priceChild);
				   
				   var totalPriceAdultValue = NAdult*priceAdult;
				   var totalPriceChildValue = NChild*priceChild;
				   var totalAll = totalPriceAdultValue+totalPriceChildValue;
				   
				   var totalPriceAdultTXT = totalPriceAdultValue.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
				   var totalPriceChildTXT = totalPriceChildValue.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
				   var totalAllTXT = totalAll.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
				  
				   //console.log('totalPriceAdultValue->'+totalPriceAdultValue+' totalPriceChildValue->'+totalPriceChildValue+' totalAll->'+totalAll+' totalAllTXT->'+totalAllTXT);   DChildPrice
				   
				   if(way=='DEPART'){
					   $('#DepartTotalAdult').text(totalPriceAdultTXT);
					   $('#DepartTotalChildren').text(totalPriceChildTXT);
					   $('#DepartTotalPrice').text(totalAllTXT);
					   $('#DTotalPrice').val(totalAll);
					   $('#TimeIDGo').val(timeTableID);
					   $('#DepartTime').text(' ,'+DepartTime);
					   $('#DAdultPrice').val(priceAdult);
					   $('#DChildPrice').val(priceChild);
					   $('#DepartDuration').text(DepartDuration);
					   
					   
					   
				   }else if(way=="RETURN"){
					   $('#ReturnTotalAdult').text(totalPriceAdultTXT);
					   $('#ReturnTotalChildren').text(totalPriceChildTXT);
					   $('#ReturnTotalPrice').text(totalAllTXT);
					   $('#RTotalPrice').val(totalAll);
					   $('#TimeIDBack').val(timeTableID); 
					   $('#RTotalPrice').val(totalAll); 
					   $('#ReturnDepartTime').text(' ,'+DepartTime)
					   $('#RAdultPrice').val(priceAdult);
					   $('#RChildPrice').val(priceChild); 
					   $('#ReturnDuration').text(DepartDuration);
					   if ($(window).width() < 960) { 
					    $('html, body').animate({
						 	scrollTop: $("#headSumary").offset().top
					 	}, 1000);
					   }
				   }
				   
				   //---------------------------------------// TimeIDGo
			   }
			 	 calculateSumTotal();
			 	 
		 }
		 //------------------------------------
		function calculateSumTotal(){
			 var DTotalPrice = parseInt($('#DTotalPrice').val());
			 var RTotalPrice = parseInt($('#RTotalPrice').val());
			
			 //console.log('calculateSumTotal-> DTotalPrice='+DTotalPrice+' RTotalPrice='+RTotalPrice)
			 if(DTotalPrice==''){ var DTotalPrice = 0; }
			 if(RTotalPrice==''){ var RTotalPrice = 0; }

			 var sumAll = (DTotalPrice+RTotalPrice).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");;
			 
			//console.log('result =>calculateSumTotal-> DTotalPrice='+DTotalPrice+' RTotalPrice='+RTotalPrice)
			 $('#AllTotalPrice').html('<span style="color:red">'+sumAll+'</span>');
			 
		}
		 //------------------------------------ 
		 function  clearAllValue(way){
			 if(way=='DEPART'){
				 $('#DepartTime').text('');
				 $('#DepartDuration').text('');
				 $('#DepartTotalAdult').text('');
				 $('#DepartTotalChildren').text('');
				 $('#DepartTotalPrice').text('');
				 $('#TimeIDGo').val('');
				 $('#DTotalPrice').val(0);
				 $('#DAdultPrice').val(0);
				 $('#DChildPrice').val(0);
			 }else if(way=="RETURN"){
				 $('#ReturnDepartTime').text('');
				 $('#ReturnDuration').text('');
				 $('#ReturnTotalAdult').text('');
				 $('#ReturnTotalChildren').text('');
				 $('#ReturnTotalPrice').text('');
				 $('#TimeIDBack').val('');
				 $('#RTotalPrice').val(0);
				 $('#RAdultPrice').val(0);
				 $('#RChildPrice').val(0);
				 
				 // ReturnDepartTime ReturnDuration ReturnTotalAdult ReturnTotalChildren TimeIDBack
			 }
		 }
		 //------------------------------------
		 function showInfo(RouteID, TimetableID , departTime , arriveTime , locationTo , partner_id){
			$('#myModalLabel').text(locationTo+' '+departTime+'-'+arriveTime);
			$('#myModal .modal-body').empty();
			
			
			//--------get modal detail--------------// 
			 var NChild  =  parseInt($('#NChild').val());
			 var NAdult  =  parseInt($('#NAdult').val());
			$.post('<?php echo base_url('Travelcontroller/timetable_detail')?>' , { RouteID : RouteID , TimetableID:TimetableID , partner_id:partner_id , NAdult:NAdult , NChild:NChild },function(data){
				$('#myModal .modal-body').html(data);
					//$('#modal_Large33').modal('show'); 
					$('#myModal').modal('show'); 
			})
			
		 }
			
		 //----------------------------------- routedata placedata DepartTotalAdult 
		 function getRoute(){

			  //-------  
		  var routedata = $('#routedata option:selected').val();
		  var routeName = $('#routedata option:selected').text();
          var placedata = $('#placedata option:selected').val();
		  var placeName = $('#placedata option:selected').text();			 
          var datedata = $('#datedata').val();
          var dateReturn = $('#dateReturn').val();	
		  var Adults = $('#Adults option:selected').val();
		  var Children = $('#Children option:selected').val();	  
	
		// console.log('Adults->'+Adults+' Children->'+Children+' datedata->'+datedata+' dateReturn->'+dateReturn+' routeName->'+routeName+' placeName->'+placeName)	  
		
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
			   
			 if($('#radio-5').is(':checked')){
			   var parts1 = datedata.split("/");
			   var date1 = new Date(parts1[1] + "/" + parts1[0] + "/" + parts1[2]);
			   
			   var parts2 = dateReturn.split("/");
			   var date2 = new Date(parts2[1] + "/" + parts2[0] + "/" + parts2[2]);
			 
				   if(date1 <= date2 )
					{
						console.log('1>'+1);
					}else {

						console.log('2>'+2);
						alert('Return date must be more than depart date.');
						$('#dateReturn').focus();
						return false;	
					}

				  var travelRound = "return";

			   }else if($('#radio-6').is(':checked')){
				    var parts1 = datedata.split("/");
			   		var date1 = new Date(parts1[1] + "/" + parts1[0] + "/" + parts1[2]);
			   
			   		//var parts2 = dateReturn.split("/");
			   		var dateReturn = '0';
				    var travelRound = "oneWay";
			   }  
			 	 //------clear area---------//
				 $('.title-wrap').empty();
				 $('.title-wrap').remove();
				 $('#DataArea').empty();
				 $('#btnAllPackage').hide();
			     //-------loading------------//preloader2
			      $('#preloader2').css('display','block');
				 //-------get route Data------// 
			    
			    // console.log('dateReturn->'+dateReturn)
				 $.post('<?php echo base_url('Travelcontroller/getroute')?>',{ idFrom : routedata , idTo : placedata , dateGo : datedata , dateReturn : dateReturn , Adults : Adults , Children : Children , travelRound:travelRound , routeName:routeName , placeName:placeName }, function(data){
					  $('#DataArea').html(data);
					  $('html, body').animate({
						 	scrollTop: $("#Children").offset().top
					 	}, 1000);
				 }) 
			   
        }  		 
				 
	 }
         
         //================================== 
	function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    var ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("date").innerHTML = date;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
         //================================== 
		  function 	changeSearchForm(tripType,ischecked){
			  
			  if(tripType=='roundTrip'){
				    $('#dateReturn').val('');
					$("#dateReturn").prop('disabled', false);
					$("#hrid").css("display","none")
			  }else if(tripType=='oneTrip'){ 
				    $('#dateReturn').val('');
				    //$('#dateReturn').hide();
				    $("#dateReturn").prop('disabled', true);
				    $("#dateReturn").css("cursor: not-allowed;");
				    $("#hrid").css("display","block")
			  }
		  }
			
		 // $("input").prop('disabled', true); $("input").prop('disabled', false);	

         //==================================
        function placedataupdate(changeValue) {
		//console.log('changeValue->'+changeValue)
		$('#placedata').focus();
        $.post('<?php echo base_url('Welcome/placedataupdate') ?>', {changeValue: changeValue},
         function (data) {
		 $('#formto').text("To:");
         $('#placedata').empty();
		 
         $('#placedata').html(data);});
}
          //-------------------------------------
		function setTopmenySelect(idMenu){
			$('.topmenu').removeClass('current-menu-parent');
			$('#'+idMenu).addClass('current-menu-parent');
		}
			setTopmenySelect('liindex');	
        //----------------------------------------------
			
			
			/*
			$("#dateReturn").datepicker({
						minDate: datedata,
						
					});
				 
			
			
			*/
        $(function () {
			$('[data-toggle="tooltip"]').tooltip();
			
			$('#datedata').change(function(){
				var departDate = $('#datedata').val();
				var dateReturn = $('#dateReturn').val();
				 /*if($('#radio-5').is(':checked')){
					 if(dateReturn==''){
						  $('#dateReturn').val(departDate);
					  }else if(dateReturn!=''){
				 	  		if ($.datepicker.parseDate('dd/mm/yy', departDate ) >  $.datepicker.parseDate('dd/mm/yy', dateReturn)) {
									var departDate = $('#datedata').val();
       								 $('#dateReturn').val(departDate);
					  		}	
					  }
				 }*/
					 $("input#dateReturn").datepicker('option', 'minDate', departDate);
				
				
			})
		
		});
			
			
			
$( document ).ready( function () {
	startTime();

} );
        </script>
        <!-- End Main Js -->
    </body>
</html>
