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
                    <img src="<?php echo base_url('images/logo-header.png')?>" alt="">
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
                         <input type="hidden" id="currentid" class="field-input" value="<?php echo $currentID?>">
                                                  <?php 
  $packageData =$this->Package_model->getpackageimg($currentID);
    foreach ($packageData->result() AS $Data) {}?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="payment-info">
                                    <h3><?php echo $Data->package_name_en?></h3>
                                     
									<div class="form-cn form-cruise tab-pane active in" id="form-cruise" style="padding: 0px !important">
										<h4>Please Fill Form:</h4>
										<div class="form-search clearfix" style="border: none !important">

											<div class="form-field field-date">
                                                                                            <input type="text" class="field-input calendar-input" placeholder="Departing" id="Departing">
											</div>
											<div class="form-field field-select field-adult">
												<div class="select">
													<span>Adults</span>
													<select id="Adults" onChange="addAdults()">
														<option>Adults</option>
<?php for($a=1; $a<=10; $a++){
    
    ?>														<option value="<?php echo $a?>"><?php echo $a?></option>
<?php }?>													</select>
												</div>
											</div>
											<div class="form-field field-select field-children">
												<div class="select">
													<span>Children</span>
													<select id="Children" >
														<option>Children</option>
														<?php for($a=1; $a<=10; $a++){
   
    ?>														<option value="<?php echo $a?>"><?php echo $a?></option>
<?php }?>
													</select>
												</div>
											</div>
										</div>
									</div>
                                    <?php $txt=''; $maxper=''; $packageoptionData =$this->Package_model->listpackage_option($currentID);
                    $numpackageoption = $packageoptionData->num_rows();               
    foreach ($packageoptionData->result() AS $pricetion) {} 
    $minper = $pricetion->min_person;
    $maxper = $pricetion->max_person;
    ?>
                                    <?php if (($minper==1)&&($maxper==1)&&($numpackageoption ==1)){
                                    $txt = $pricetion->adult_price;
                                    $txt2 = '';
                                    }else if(($numpackageoption >0)&&($minper!=$maxper)){
                                    
                                    $txt2 = 'x';    
                                    }?>
                                       <input type="hidden" id="price"  class="field-input" value="<?php echo $txt?>">
                                       <input type="hidden" id="chprice"  class="field-input" value="<?php echo $txt2?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="payment-price">

                                    <figure>
                                         <img src="<?php echo base_url('uploadfile/') . $Data->images_name ?>" alt="">
                                    </figure>
                                    <div class="total-trip">
                                        <span id="pricetotal">
                                           
                                        </span>
                                       
                                        <p>
                                            Trip Total: <ins id="tripTotal"></ins>

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
                                    <input type="checkbox" class="checkbox" id="accept" name="accept" value="0"  onclick="changCH(this.checked)">
                                    <label for="accept">I accept the agreement.</label>
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
    <script type="text/javascript" >

//------------------------------------------
    function AddBooking() {
//        var checkReviewer = $('input.checkbox:checkbox:checked').length;  
//if(checkReviewer ==0){  }
        
        /* declare an checkbox array */
//	var chkArray = [];
//	
//	/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
//	$(".checkbox:checked").each(function() {
//		chkArray.push($(this).val());
//	});
//	
//	/* we join the array separated by the comma */
//	var selected;
//	selected = chkArray.join(',') ;
//	
	/* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */	
        var Departing = $('#Departing').val();
        var Adults = $('#Adults').val();
        var Children = $('#Children').val();
        var Name = $('#Name').val();
        var Last = $('#Last').val();
        var Email = $('#Email').val();
        var Line = $('#Line').val();
        var Phone = $('#Phone').val();
        var price = $('#price').val();
        var accept = $('#accept').val();
        var chprice = $('#chprice').val();
        //var currentID = $('#currentID').val();
        var currentID = '<?php echo $currentID;?>';
        if (Departing == '') {
            alert("Please enter Date");
        } else if (Adults == '') {
            alert("Please enter Adults");
    }else if (Name == '') {
        alert("Please enter First name");
            
    }else if (Last == '') {
         alert("Please enter Last name");
            
    }else if (Email == '') {
        alert("Please enter Email");
            
    }else if (Phone == '') {
        alert("Please enter Phone number");
    }else{
        
        if(chprice !='x'){
            price = Adults * price;
        }        
        console.log(Departing+'....' + Adults +'.....'+ Children+'.....' + Name+'....'+Last+'....'+Email+'....'+Line+'......'+Phone);
            $.post('<?php echo base_url('Welcome/AddBooking') ?>', {Departing: Departing, Adults: Adults, Children: Children, Name: Name, Last: Last, Email: Email,Line:Line,Phone:Phone,currentID:currentID,price:price,accept:accept}, function (data) {
                if (data !=0) {
//                    setTimeout(function () {
//                        window.location.href = "<?php //echo base_url('Welcome/book_package_comfirm/') ?>"+currentID;}, 2000);
 window.location.href = "<?php echo base_url('Welcome/book_package_comfirm/') ?>"+data;
                } else {
                 alert("Can not be add");
                }
            })
        }
    }
    
          //==================================
    function addAdults() {
    var totalprice;
     var Adults = $('#Adults').val();
     var price = $('#price').val();
     var chprice = $('#chprice').val();
     var currentID = '<?php echo $currentID;?>';
     if (chprice == 'x'){
             $.post('<?php echo base_url('Welcome/totaladult') ?>', { Adults: Adults,currentID:currentID},
            function (data) {
       totalprice = data; 
         $('#price').val(totalprice);
        totalprice = addCommas(totalprice);
        $('#pricetotal').html(totalprice+' THB<small>/ '+Adults+' persons</small>');
        $('#tripTotal').html(totalprice+' THB');
   }); 
     }else{
     totalprice = Adults * price;
     totalprice = addCommas(totalprice);
     $('#pricetotal').html(totalprice+' THB<small>/ '+Adults+' persons</small>');
     $('#tripTotal').html(totalprice+' THB');
     }
      
//     var totalprice = Adults * price;
//     totalprice = addCommas(totalprice);
//     $('#pricetotal').html(totalprice+' THB<small>/ '+Adults+' persons</small>');
//     $('#tripTotal').html(totalprice+' THB');
 }
 
 function addCommas(nStr)
 {
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
   x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
 }
 //---------------
//------------------------------------------
    function changCH(checked2) {
        if(checked2 == true){$('#accept').val('1');}
        else{$('#accept').val('0');}
    }
  //-------------------------------
		//-------------------------------------
		function setTopmenySelect(idMenu){
			$('.topmenu').removeClass('current-menu-parent');
			$('#'+idMenu).addClass('current-menu-parent');
		}
			setTopmenySelect('liPackage');	
    </script>
</body>
</html>
