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
      	<?php include("header.php"); ?>
        <!-- End Header -->
<section class="banner">

                <!--Background
                <div class="bg-parallax bg-1"></div>-->
                <!--End Background-->
<?php 
$keygroup = $this->uri->segment(3);
                    $getlandbooking = $this->transport_model->getlandbooking($keygroup);
                    $numlandbook = $getlandbooking->num_rows();
                    foreach ($getlandbooking->result() AS $getlandbookings){}
                    if($numlandbook>0){
                    $datearray = explode("-",$getlandbookings->depart_date);
			$d = $datearray[2];
			$m = $datearray[1];
			$y = $datearray[0];
			$datedata = $d."/".$m."/".$y;
                    }
?>
                <div class="container" style="padding:0px !important;">

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
									<div class="col-md-12">
                                                                            <h2 style="text-align:center">LAND TRANSFER SERVICE</h2><br>
								   </div>
								 
								 
                                    <div class="form-search clearfix col-md-12">
                                        <div class="form-field field-date col-md-6" >
                                            <input type="text" class="field-input calendar-input1" placeholder="Depart Date" id="datedata" name="datedata" autocomplete="off" value="<?php if(($numlandbook>0)&&($getlandbookings->depart_date!='0000-00-00')){echo $datedata;}?>">
                                        </div>
                                       
                                        <div class="form-field field-select field-adult col-md-3">
                                            <div class="select">
                                                <span><?php if(($numlandbook>0)&&($getlandbookings->adult!=0)){echo $getlandbookings->adult;}else{echo 'Adults';}?></span>
                                                <select id="Adults" name="Adults" >
                                                    <option value="0">Adults</option>
                                                    <?php for ($a = 1; $a <= 10; $a++) {
                                                        ?>													<option value="<?php echo $a ?>" <?php if(($numlandbook>0)&&($getlandbookings->adult == $a)){echo 'selected';}?>><?php echo $a ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-field field-select field-children col-md-3">
                                            <div class="select" >
                                                <span><?php if(($numlandbook>0)&&($getlandbookings->adult!=0)){echo $getlandbookings->child;}else{echo 'Children';}?></span>
                                                <select id="Children" name="Children" >
                                                    <option value="0">Children</option>
                                                    <?php for ($a = 1; $a <= 10; $a++) { ?>													<option value="<?php echo $a ?>" <?php if(($numlandbook>0)&&($getlandbookings->child == $a)){echo 'selected';}?>><?php echo $a ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
				</div>					
                              
                            </div>
                            <!-- End Search Cruise -->   
                        </div>
                        <!-- End Tabs Content -->

                    </div>
                    <!-- End Banner Content -->

                </div>

            </section>
        
        <!--Banner-->
        
        <!--End Banner-->
        
        <!-- Sales -->
        <section class="sales">
            <!-- Title -->
           
            <div class="container" style="background-color: white;">
                    
                    <!--<a href="#" title="" class="awe-btn awe-btn-5 awe-btn-lager arrow-right text-uppercase float-right">All Package Tours</a>-->
                    <div class="col-md-3">
                        <div class="sidebar-cn">

                                <!-- Search Result -->
                                <div class="search-result">
                                    <p id="headSumary">BOOKING SUMMARY</p>
                                </div>
                                <!-- End Search Result -->
                                <!-- Search Form Sidebar -->
                                <div class="">
                                  
                                    <div class="row">
                                        <div class="form-search clearfix">
                                            <div class="col-md-12 td-airline" style="padding-top: 15px;" id="showdata">
                                        
                                            </div>
                                            <div class="col-md-12 td-airline" style="padding-top: 15px;">
                                        
                                           
                                            <table class="table" width="100%">
					<tr  style="background-color:#E1E1E1">
					<td >TOTAL PRICE</td>
					<td  align="right" ><span id="1_sumprice"></span></td>
					</tr>
					<tr>
					<td colspan="2" align="center">
					<button id="conBtn" type="button" class="btn btn-success btn-sm" onClick="goConfirm()">CONTINUE</button>
					</td>
					</tr>
					</table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Search Form Sidebar -->
                                <!-- Narrow your results -->
    

                            </div>
                    </div>
                    <?php 
                    if($numlandbook>0){
                        $arrayidx = array();
                        $getlandbookdetail = $this->transport_model->getlandbookdetail($getlandbookings->id);
                        $numlandbookdetail = $getlandbookdetail->num_rows();
        if($numlandbookdetail>0){
        foreach ($getlandbookdetail->result() AS $getlandbookdetail2){
        $landbookdetail_id = $getlandbookdetail2->id;
        
        $timestartarray1 = explode(":",$getlandbookdetail2->time_start);
			$hh = $timestartarray1[0];
        $idx = $getlandbookdetail2->transport_id.$hh.$getlandbookdetail2->landtransfer_id;
        array_push($arrayidx,$idx);
       
        }
        }else{
                        $idx = '';
                    }
                    }else{
                        $idx = '';
                    }
                    ?>
                    <div class="col-md-9">
                        <section class="breakcrumb-sc text-red">
                                <ul class="breadcrumb ">
                                     <?php foreach ($listLand->result() AS $RouteDatahend){?>
                                    <li><a href="#" onclick="scrollxx('xx<?php echo $RouteDatahend->id?>')" style="color:red"><i class="fa fa-map-marker "></i> <?php echo $RouteDatahend->route_name_en?></a></li>
                                     <?php }?>
                                </ul>
                            </section>
                    <?php foreach ($listLand->result() AS $RouteData){?>
                   
                    <div class="col-md-12 xx<?php echo $RouteData->id?>">
                    <div class="flight-list-head"> 
      
                                    <h3><?php echo $RouteData->route_name_en?></h3>
                                    <input type="hidden" id="partner_id" name="partner_id" value="<?php echo $RouteData->partner_id?>">
                                </div>
                    <div class="flight-list-cn">
                                    <div class="responsive-table ">
          
				
					<table class="table flight-table table-radio">
						<thead>
							<?php $getpriceland = $this->transport_model->getpriceland($RouteData->id);
								  $numpriceland = $getpriceland->num_rows();
							       //--------set price array-------//
								  foreach($getpriceland->result() AS $priceArray){
									  $price[$priceArray->landtransfer_id][$priceArray->transport_id][$priceArray->time]=$priceArray->price;
									  
//									  echo 'price['.$priceArray->landtransfer_id.']['.$priceArray->transport_id.']['.$priceArray->time.']=>'.$price[$priceArray->landtransfer_id][$priceArray->transport_id][$priceArray->time]."<br>";
								  }
																	  
							     $getVehicle = $this->transport_model->getVehicleinRoute($RouteData->id);    //tranID , b.transport_name_en
							?>
							<tr>
								<?php if($numpriceland !=0){?>
<!--                                                    <th style="padding-left: 10px;">Select</th>-->
								<th class="text-center">Time</th>
								<?php 
								foreach ($getVehicle->result() AS $VehicleData){?>
									<th class="text-center"><?php echo $VehicleData->transport_name?></th>
								<?php }?>
								<?php }?>
							</tr>
						  </thead>
						  <tbody>
							<?php  
                                                        $gettime = $this->transport_model->gettime($RouteData->id);
                                                        foreach($gettime->result() AS $gettimearray){ 
            $timestartarray = explode(":",$gettimearray->time_start);
			$h = $timestartarray[0];
			$m = $timestartarray[1];
			$timestart = $h.":".$m;
                        
            $timeendarray = explode(":",$gettimearray->time_end);
			$h1 = $timeendarray[0];
			$m1 = $timeendarray[1];
			$timeend = $h1.":".$m1;
                                                            ?> 
						  <tr>
                                                      <td style="text-align:center"><?php echo $timestart." - ".$timeend?></td>
						     
		<?php 
								foreach ($getVehicle->result() AS $VehicleData){
            $pricelandtran = $this->transport_model->pricelandtran($RouteData->id,$VehicleData->tranID,$timestart,$timeend);     
            $numpricelandtran = $pricelandtran->num_rows();
            
            foreach ($pricelandtran->result() AS $pricelandtran2){}
            $numgetdetailbyid = 0;
            if($numlandbook>0){
            $getdetailbyid = $this->transport_model->getdetailbyid($getlandbookings->id,$pricelandtran2->id);
            
            $numgetdetailbyid = $getdetailbyid->num_rows();
            foreach ($getdetailbyid->result() AS $getdetailbyid2){}
            }
                                                                    ?>
                                                         <td style="text-align:center">
									<?php   if(isset($price[$RouteData->id][$VehicleData->tranID][$gettimearray->time])){?>
                                                             <?php if($keygroup !=''){?>
                                                             <input type="checkbox" id="check<?php echo $VehicleData->tranID.$h.$RouteData->id?>" <?php if(in_array($VehicleData->tranID.$h.$RouteData->id,$arrayidx)){echo 'checked';}?> onclick="addtran(this.checked,'<?php echo $VehicleData->tranID?>','<?php echo $gettimearray->time_start?>','<?php echo $gettimearray->time_end?>','<?php echo $VehicleData->tranID.$h.$RouteData->id?>','<?php echo $RouteData->id?>')"/> <?php }else{?>
                                                           <input type="checkbox" id="check<?php echo $VehicleData->tranID.$h.$RouteData->id?>"  onclick="addtranfirst(this.checked,'<?php echo $VehicleData->tranID?>','<?php echo $gettimearray->time_start?>','<?php echo $gettimearray->time_end?>','<?php echo $VehicleData->tranID.$h.$RouteData->id?>','<?php echo $RouteData->id?>')"/>   
                                                             <?php }?>
                                                             &nbsp;&nbsp;	<?php	echo  number_format($price[$RouteData->id][$VehicleData->tranID][$gettimearray->time],2); ?> x
                                                             
                                               
                                                             <select id="Adults<?php echo $VehicleData->tranID.$h.$RouteData->id?>" <?php if($keygroup==''){echo 'disabled';}?>  name="Adults" onchange="setnumber(this.value,'<?php echo $VehicleData->tranID?>','<?php echo $gettimearray->time_start?>','<?php echo $gettimearray->time_end?>','<?php echo $VehicleData->tranID.$h.$RouteData->id?>','<?php echo $RouteData->id?>')">
                                                    <?php for ($a = 1; $a <= 10; $a++) {
                                                        ?>													<option value="<?php echo $a ?>" <?php if(($numgetdetailbyid>0)&&($numlandbook>0)&&($getdetailbyid2->transport_amount == $a)&&(in_array($VehicleData->tranID.$h.$RouteData->id,$arrayidx))){echo 'selected';}?>><?php echo $a ?></option>
<?php } ?>
                                                </select>
                                            
								<?php 			}else{
											echo "-";
										}
									?>
<!--									<br>[<?php //echo $RouteData->id?>][<?php //echo $VehicleData->tranID?>][<?php //echo $gettimearray->time?>]-->
                                                                </td>
								<?php }?>  
						 </tr>
							<?php }?>  
                                                 <?php if($numpriceland==0){ ?>
								<tr>
								   <td colspan="6">
									   <h3 align="center" style="color: red"><i class="fas fa-info-circle" ></i> No Data </h3>
								   </td>
								</tr>
							 <?php }?>
					  </tbody>
				</table>

                                    </div>
                                </div>
                                </div>
                    <?php }?>
                        <input type="hidden" id="landbook_id" value="<?php if($numlandbook>0){echo $getlandbookings->id;}?>"/>
                        <input type="hidden" id="keygroup" value="<?php echo $keygroup?>"/>
                       
                </div>
            </div>
            <!-- End Title -->
            <!-- Hot Sales Content -->
            
            <!-- End Hot Sales Content -->
        </section>
        <!-- End Sales -->
        <!-- Footer -->
     	<?php include("footer2.php"); ?>
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
                 $('.calendar-input1').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            minDate:1,
            dateFormat: 'dd/mm/yy',
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wen', 'Thu', 'Fri', 'Sta']
        });
                var keygroup = $('#keygroup').val();
                if(keygroup !=''){
	loaddetail();
    }
    });
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
		
		function scrollxx(iddiv){
                    $('html, body').animate({
    scrollTop: $("div."+iddiv).offset().top
  }, 1000);
                }
                //----------------------------------
   function  loaddetail() {
       var landbook_id = $('#landbook_id').val();
        $.post('<?php echo base_url('Welcome/loaddetaillast') ?>', {landbook_id:landbook_id}, function (data) {
            $('#showdata').html(data);
            calculate_totalPrice();
        });
    }
                //---------------------------------
                function addtranfirst(ch1,tranid,timestart,timeend,x,landid){
                    var partner_id = $('#partner_id').val();
                    var landbook_id = $('#landbook_id').val();
                    var keygroup = $('#keygroup').val();
                    var Adults = $('#Adults'+x).val();
                    var datedata = $('#datedata').val();
                    var Adultspepreple = $('#Adults').val();
                    var Children = $('#Children').val();
                    if(ch1==true){
                    $.post('<?php echo base_url('Welcome/addtran') ?>', {tranid:tranid,timestart:timestart,timeend:timeend,landbook_id:landbook_id,keygroup:keygroup,partner_id:partner_id,Adults:Adults,datedata:datedata,Adultspepreple:Adultspepreple,Children:Children}, function (data1) {
                        if(data1!=''){
                            var dataarray = data1.split(',');
                            $('#landbook_id').val(dataarray[1]);
                            $('#keygroup').val(dataarray[0]);
                    $.post('<?php echo base_url('Welcome/loaddetaillast') ?>', {tranid:tranid,timestart:timestart,timeend:timeend,x:x,landid:landid,landbook_id:dataarray[1],landbookdetail_id:dataarray[2],Adults:Adults}, function (data) {
                         $('#showdata').append(data);
                        calculate_totalPrice();
                        setTimeout(function () {
                            window.location.href = "<?php echo base_url('Welcome/landtransfer/') ?>"+dataarray[0] ;
                        });
                        });
                }
                 });
                    }else{
                    return false;
                    }
                }
                //---------------------------------
                function addtran(ch1,tranid,timestart,timeend,x,landid){
                    var partner_id = $('#partner_id').val();
                    var landbook_id = $('#landbook_id').val();
                    var keygroup = $('#keygroup').val();
                    var Adults = $('#Adults'+x).val();
                    var landbookdetail_id = $('#landbookdetail_id'+x).val();
                    if(ch1==true){
                    $.post('<?php echo base_url('Welcome/addtran') ?>', {tranid:tranid,timestart:timestart,timeend:timeend,landbook_id:landbook_id,keygroup:keygroup,partner_id:partner_id,Adults:Adults}, function (data1) {
                        if(data1!=''){
                            var dataarray = data1.split(',');
                            $('#landbook_id').val(dataarray[1]);
                            $('#keygroup').val(dataarray[0]);
                    $.post('<?php echo base_url('Welcome/loaddetaillast') ?>', {tranid:tranid,timestart:timestart,timeend:timeend,x:x,landid:landid,landbook_id:dataarray[1],landbookdetail_id:dataarray[2],Adults:Adults}, function (data) {
                        $('#showdata').empty();
                        $('#showdata').html(data);
                        calculate_totalPrice();
                        });
                }
                 });
                    }else{
                    
                        deletelandbookdetail(landbook_id,landbookdetail_id);
                        $('#Adults'+x).val('1');
                    }
        
                }
                //-----------------------------------
               function deletelandbookdetail(landbook_id,landbookdetail_id){
               $.post('<?php echo base_url('Welcome/deletelandbookdetail') ?>', {landbook_id:landbook_id,landbookdetail_id:landbookdetail_id}, function (data) {
                   if(data==1){
                    $.post('<?php echo base_url('Welcome/loaddetaillast') ?>', {landbook_id:landbook_id}, function (data) {
                        $('#showdata').empty();
                        $('#showdata').html(data);
                        calculate_totalPrice();
                        });
                    }
               });
               }
                //-----------------------------------
               function deletelandbookdetailbyid(landbook_id,landbookdetail_id,iddetail){
               $.post('<?php echo base_url('Welcome/deletelandbookdetailbyid') ?>', {landbook_id:landbook_id,landbookdetail_id:landbookdetail_id,iddetail:iddetail}, function (data) {
                   if(data==1){
                    $.post('<?php echo base_url('Welcome/loaddetaillast') ?>', {landbook_id:landbook_id}, function (data) {
                        $('#showdata').empty();
                        $('#showdata').html(data);
                        calculate_totalPrice();
                        });
                    }
               });
               }
                //----------------------------------
                function deleteselect(x,landbook_id,landbookdetail_id,n){
                var iddetail = $('#iddetail'+n).val();
                var xx = $('#xx'+n).val();
                
                    deletelandbookdetailbyid(landbook_id,landbookdetail_id,iddetail);
                    var idarray = xx.split("||");
                     for(var i=0;i<(idarray).length;i++){
                         $('#check'+idarray[i]).prop("checked", false);
                          $('#Adults'+idarray[i]).val('1');
                     }
                     calculate_totalPrice();
//                    
//                    calculate_totalPrice();
                    
                }
                //------------------------------------
                function setnumber(ch1,tranid,timestart,timeend,x,landid){
                    var partner_id = $('#partner_id').val();
                    var landbook_id = $('#landbook_id').val();
                    var keygroup = $('#keygroup').val();
                    var checkbox = document.getElementById("check"+x);
                    if(checkbox.checked == true){
                        $.post('<?php echo base_url('Welcome/updatetran') ?>', {tranid:tranid,timestart:timestart,timeend:timeend,landbook_id:landbook_id,keygroup:keygroup,partner_id:partner_id,Adults:ch1}, function (data1) {
                        if(data1!=''){
                            var dataarray = data1.split(',');
                            $('#landbook_id').val(dataarray[1]);
                            $('#keygroup').val(dataarray[0]);
                    $.post('<?php echo base_url('Welcome/loaddetaillast') ?>', {tranid:tranid,timestart:timestart,timeend:timeend,x:x,landid:landid,landbook_id:dataarray[1],landbookdetail_id:dataarray[2]}, function (data) {
                        $('#showdata').empty();
                        $('#showdata').html(data);
                        calculate_totalPrice();
                        //$('#check'+x).prop("checked", true);
                        });
                }
                 }); 
                    }else{
                    $.post('<?php echo base_url('Welcome/addtran') ?>', {tranid:tranid,timestart:timestart,timeend:timeend,landbook_id:landbook_id,keygroup:keygroup,partner_id:partner_id,Adults:ch1}, function (data1) {
                        if(data1!=''){
                            var dataarray = data1.split(',');
                            $('#landbook_id').val(dataarray[1]);
                            $('#keygroup').val(dataarray[0]);
                    $.post('<?php echo base_url('Welcome/loaddetaillast') ?>', {tranid:tranid,timestart:timestart,timeend:timeend,x:x,landid:landid,landbook_id:dataarray[1],landbookdetail_id:dataarray[2]}, function (data) {
                        $('#showdata').empty();
                        $('#showdata').html(data);
                        calculate_totalPrice();
                        $('#check'+x).prop("checked", true);
                        });
                }
                 });
                 }  
                }
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
		$('#1_sumprice').text(totalPoints.toLocaleString()+'.00');
	}
          //----------------------------------
   function  goConfirm() {
       var keygroup = $('#keygroup').val();
       var datedata = $('#datedata').val();
       var Adults = $('#Adults').val();
       var Children = $('#Children').val();
       var landbook_id = $('#landbook_id').val();
       if(datedata==''){
           alert('Please select Depart date !');
       }else if(Adults == 0){
           alert('Please select Adults !');
//       }else if(Children == 0){
//           alert('Please select Children !');
       }else{
       $.post('<?php echo base_url('Welcome/updateday') ?>', {landbook_id:landbook_id,datedata:datedata,Adults:Adults,Children:Children}, function (data1) {
                        if(data1!=0){
        window.location.href = "<?php echo base_url('Welcome/LandbookingSumary/') ?>"+keygroup ;
        }
                 }); 
    }
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
