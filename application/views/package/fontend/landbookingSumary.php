<!DOCTYPE html>
<!--[if IE 7 ]> <html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]> <html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>AKIRA-SPEEDBOAT , BOOKING SPEEADBOAT, TRANSPORT, PACKAGE TOUR - LIPE - KOH LIPE, SATUN THAILAND</title>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
        <div class=" bg-white total-trip clearfix" >
            <div class="row" style="padding-left:100px;padding-right: 100px">
<!-- Payment Room -->
                    <div class="payment-room">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="payment-info">
                                    <h2>LAND TRANSFER SERVICE</h2>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                            </div>
                        </div>
                    </div>
                    <!-- Payment Room -->
<?php 
                    $bookingid = $this->uri->segment(3);
                    $getlandbooking = $this->transport_model->getlandbooking($keygroup);
                    $numlandbook = $getlandbooking->num_rows();
                    foreach ($getlandbooking->result() AS $getlandbookings){}
                    $datedata = $this->transport_model->GetEngDate($getlandbookings->depart_date);

?>
                    <div class="payment-form">
                        <div class="row form">
						  <div class="col-md-6">
                                <h2>BOOKING SUMMARY | BOOKING NO. <?php echo $bookingid?></h2>
                                <h4>Depart Date : <?php echo $datedata?>  &nbsp;&nbsp;&nbsp;Adults x <?php echo $getlandbookings->adult?>  &nbsp;&nbsp;&nbsp;Children x <?php echo $getlandbookings->child?></h4>
                             
                                   <div class="row">
                                        <div class="form-search clearfix">
                                            <div class="col-md-12 td-airline" style="padding-top: 15px;" >
                                                <?php 
    $getlandbookdetail = $this->transport_model->getlandbookdetailgroupby($getlandbookings->id);
        $numlandbookdetail = $getlandbookdetail->num_rows();
        if($numlandbookdetail>0){
        foreach ($getlandbookdetail->result() AS $getlandbookdetail2){
        $landbookdetail_id = $getlandbookdetail2->id;
        $getlandtransfer = $this->transport_model->getlandtransfer($getlandbookdetail2->priceland_id);
        foreach ($getlandtransfer->result() AS $getlandtransfer2){}

        $timestartarray = explode(":",$getlandtransfer2->time_start);
			$h = $timestartarray[0];
			$m = $timestartarray[1];
			$timestart1 = $h.":".$m;
                        
            $timeendarray = explode(":",$getlandtransfer2->time_end);
			$h1 = $timeendarray[0];
			$m1 = $timeendarray[1];
			$timeend1 = $h1.":".$m1;
                        
                         $getVehicle = $this->transport_model->getVehicleinRoute($getlandtransfer2->landtransfer_id);
                         foreach ($getVehicle->result() AS $VehicleData){}
                         $x = $VehicleData->tranID.$h;
    ?>
												<table class="table" width="100%">
													<tr>
                                                                                                            <td colspan="2" style="background-color:#E1E1E1"><span ><?php echo $getlandtransfer2->route_name_en?> </span><span > | Depart Time:<?php echo $timestart1?> - <?php echo $timeend1?></span></td>
													</tr>
           <?php $getlandbookdetailgroupby = $this->transport_model->getlandbookdetailbytime($getlandbookings->id,$getlandbookdetail2->time_start,$getlandbookdetail2->time_end);
        foreach ($getlandbookdetailgroupby->result() AS $loadlandgroupby){
            $priceland = $this->transport_model->listprice($loadlandgroupby->transport_id,$loadlandgroupby->time_start,$loadlandgroupby->time_end);
        
        foreach ($priceland->result() AS $priceland2){}
        $listTransport = $this->Package_model->list_transferData($priceland2->transport_id);
        foreach ($listTransport->result() AS $listTransport2){}
            ?>                                                                                              <tr>
                   <td><span><?php echo $listTransport2->transport_name?></span> (<?php echo number_format($priceland2->price,2)?> x <?php echo $loadlandgroupby->transport_amount?>)</td><td align="right"><span ><?php echo number_format(intval($priceland2->price)*intval($loadlandgroupby->transport_amount),2)?></span></td>
               </tr>
               <input type="hidden" class="priceland" value="<?php echo intval($priceland2->price)*intval($loadlandgroupby->transport_amount)?>"/>
        <?php }?>
												</table>
        <?php } }?>
												<span id="totalPriceSpan"></span>
												<table class="table" width="100%">
													<tr  style="background-color:#E1E1E1">
														<td >TOTAL PRICE</td>
														<td  align="right" ><span id="1_sumprice" style="color: #a94442"></span></td>
                                                                                                        
													</tr>
													
												</table>
                                                                                                <a href="<?php echo base_url('Welcome/landtransfer/').$bookingid?>"><button class="btn btn-info">Back</button></a>
									</div>
                                                                                   
                                           
                                        </div>
                                    </div>
                            </div>
                             <div class="col-md-6" id="rightSpace">
								<form id="confirmForm" name="confirmForm" method="post">
                                <h2>Your Information</h2>
                                <div class="form-field">
                                    <input type="text" id="cust_name" name="cust_name" placeholder="First Name" class="field-input" value="">
                                </div>
                                <div class="form-field">
                                    <input type="text" id="cust_lastname" name="cust_lastname" placeholder="Last Name" class="field-input"  value="">
                                </div>
                                <div class="form-field">
                                    <input type="text" id="cust_email" name="cust_email" placeholder="Email" class="field-input" value="">
                                </div>
                               
                                <div class="form-field">
                                    <input type="text" id="cust_telephone_num" name="cust_telephone_num" placeholder="Phone number" class="field-input"  value="">
                                </div>
                                <div class="form-field">
                                    <input type="text" id="line_id" name="line_id" placeholder="Line ID" class="field-input"  value="">
                                </div>
<input type="hidden" id="sumprice" name="sumprice" value=""/>
<input type="hidden" id="bookingid" name="bookingid" value="<?php echo $bookingid?>"/>
<input type="hidden" id="landbookid" name="landbookid" value="<?php echo $getlandbookings->id?>"/>
                            </form>
							 <div class="radio-checkbox">
                                    <input type="checkbox" class="checkbox" id="accept" onChange="enableBooking(this.checked)">
                                    <label for="accept">I accept the Terms and Coditions.</label>
                             </div>
                                 <br>
                           			<button id="btnBooknow" class="awe-btn awe-btn-lager" onClick="booknow()" disabled>Book now</button>
						   </div>
                        </div>

                        <div class="submit text-center">
                          

                        </div>
						
                    </div>
		<!----------------->
						<div>&nbsp;</div>
       </div>

                    </div>
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
           $(document).ready(function () {
            calculate_totalPrice();
    });
         //-----------------------------------------
                       function calculate_totalPrice(){		
		   var className = '.priceland';	

		var totalPoints = 0;		
		$(className).each(function(){ 
 
			if($(this).val() ==''){
				
				var numPrice = 0;
				
			} else {
				
				var numPrice = $(this).val();				
				if(numPrice.indexOf(',') != -1){
					numPrice = numPrice.replace(",", "");
				}
				numPrice = parseInt(numPrice); 
				
				console.log('numPrice....'+numPrice);
				totalPoints += numPrice;		console.log('totalPoints....'+totalPoints);
			}
			//$('#'+fieldTotal).val(totalPoints);
		});		
		$('#1_sumprice').text(totalPoints.toLocaleString()+'.00 บาท');
		$('#sumprice').val(totalPoints);
	}
         //---------------------------------
		function booknow(){
			var custname = $('#cust_name').val(); 
			var custlastname = $('#cust_lastname').val(); 
			var Email = $('#cust_email').val(); 
			var cust_telephone_num = $('#cust_telephone_num').val(); 
			var line_id = $('#line_id').val(); 
			var sumprice = $('#sumprice').val(); 
			var landbookid = $('#landbookid').val(); 
			var bookingid = $('#bookingid').val(); 

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
				$.post('<?php echo base_url('Welcome/updatelandbook')?>',  { custname : custname,custlastname:custlastname,Email:Email,cust_telephone_num:cust_telephone_num,line_id:line_id,sumprice:sumprice,landbookid:landbookid }, function(data){
					if(data != 0){
                                          $.post('<?php echo base_url('Welcome/addpdf')?>',  {bookingid:bookingid }, function(data1){
                                              
					$.post('<?php echo base_url('Welcome/send_maillandbook')?>',  {bookingid:bookingid }, function(data2){
                                            if(data2!='0'){
                                                alert('Booking successful');
                                                window.open('<?php echo base_url('Welcome/booking_transport_voucher/')?>'+bookingid);
                                                setTimeout(function(){ window.location.href = "<?php echo base_url('Welcome/landtransfer')?>"; }, 2000);
                                            }else{
                                            alert('error booking.');
                                        }
                                            });
                                            
                                            });
					}else{
						alert('error booking.');
					}
				});
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
                 //------------------------------------  dateReturn ReturnDepartTime dreturnDate 
		function validateEmail($email) {
			  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			  return emailReg.test( $email );
		}
                //-------------------------------------
		function setTopmenySelect(idMenu){
			$('.topmenu').removeClass('current-menu-parent');
			$('#'+idMenu).addClass('current-menu-parent');
		}
			setTopmenySelect('liTimeTable');
    </script>
</body>
</html>
