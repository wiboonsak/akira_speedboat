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

                <!--Background
                <div class="bg-parallax bg-1"></div>-->
                <!--End Background-->
<?php $keygroup = $this->uri->segment(3);
 $arrayidx = array();
 $numcharterbookdetail = 0;
 $numcharterbook = 0;
 $numgetdetailbyid = 0 ;
                    $getcharterbooking = $this->transport_model->getcharterbooking($keygroup);
                    $numcharterbook = $getcharterbooking->num_rows();
                    foreach ($getcharterbooking->result() AS $getcharterbookings){}
                    if($numcharterbook>0){
                        $datearray = explode("-",$getcharterbookings->depart_date);
			$d = $datearray[2];
			$m = $datearray[1];
			$y = $datearray[0];
			$datedata = $d."/".$m."/".$y;
                        $getcharterbookdetail = $this->transport_model->getcharterbookdetail($getcharterbookings->id);
                        $numcharterbookdetail = $getcharterbookdetail->num_rows();
        if($numcharterbookdetail>0){
        foreach ($getcharterbookdetail->result() AS $getcharterbookdetail2){
        $charterbookdetail_id = $getcharterbookdetail2->id;
         $RouteDatahead = $this->transport_model->loadcharter('1',$getcharterbookdetail2->charter_id);
        foreach ($RouteDatahead->result() AS $RouteDatahead2){}
         $idx = $RouteDatahead2->boat_sizeid.$getcharterbookdetail2->charter_id;
         array_push($arrayidx,$idx);
        }
        
        }else{
                        $idx = '';
                    }
                    }else{
                        $idx = '';
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
                                                                            <h2 style="text-align:center">CHARTER SPEED BOAT</h2><br>
								   </div>
								 
								 
                                    <div class="form-search clearfix col-md-12">
                                        <div class="form-field field-date col-md-6" >
                                            <input type="text" class="field-input calendar-input1" placeholder="Depart Date" id="datedata" name="datedata" autocomplete="off" value="<?php if(($numcharterbook>0)&&($getcharterbookings->depart_date!='0000-00-00')){echo $datedata;}?>">
                                        </div>
                                       
                                        <div class="form-field field-select field-adult col-md-3">
                                            <div class="select">
                                                <span><?php if(($numcharterbook>0)&&($getcharterbookings->adult!=0)){echo $getcharterbookings->adult;}else{echo 'Adults';}?></span>
                                                <select id="Adults" name="Adults" >
                                                    <option value="0">Adults</option>
                                                    <?php for ($a = 1; $a <= 10; $a++) {
                                                        ?>													<option value="<?php echo $a ?>" <?php if(($numcharterbook>0)&&($getcharterbookings->adult == $a)){echo 'selected';}?>><?php echo $a ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-field field-select field-children col-md-3">
                                            <div class="select" >
                                                <span><?php if(($numcharterbook>0)&&($getcharterbookings->adult!=0)){echo $getcharterbookings->child;}else{echo 'Children';}?></span>
                                                <select id="Children" name="Children" >
                                                    <option value="0">Children</option>
                                                    <?php for ($a = 1; $a <= 10; $a++) { ?>													<option value="<?php echo $a ?>" <?php if(($numcharterbook>0)&&($getcharterbookings->child == $a)){echo 'selected';}?>><?php echo $a ?></option>
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
         
                    <div class="col-md-9">
                    <?php foreach ($listcharter->result() AS $RouteData){}?>
                   <input type="hidden" id="partner_id" name="partner_id" value="<?php echo $RouteData->partner_id?>">
                    <div class="col-md-12 xx<?php echo $RouteData->id?>">
                    
                    <div class="flight-list-cn">
                                    <div class="responsive-table ">
          
				
					<table class="table flight-table table-radio">
						<thead>
							<?php $getpricecharter = $this->transport_model->loadcharter('1');
								  $numpricecharter = $getpricecharter->num_rows();
							       //--------set price array-------//
								  foreach($getpricecharter->result() AS $priceArray){
									  $price[$priceArray->boat_sizeid][$priceArray->boattrip_id][$priceArray->id]=$priceArray->price;
									  
									  //echo 'price['.$priceArray->boat_sizeid.']['.$priceArray->boattrip_id.']['.$priceArray->id.']'."<br>";
								  }
																	  
							     $getVehicle = $this->transport_model->getboatinRoute();    //tranID , b.transport_name_en
							?>
							<tr>
								<?php if($numpricecharter !=0){?>
<!--                                                    <th style="padding-left: 10px;">Select</th>-->
								<th class="text-center">แพ็คเกจ</th>
								<?php 
								foreach ($getVehicle->result() AS $VehicleData){?>
									<th class="text-center"><?php echo $VehicleData->boat_size?></th>
								<?php }?>
								<?php }?>
							</tr>
						  </thead>
						  <tbody>
							<?php  
                                                        $getchartergrop = $this->transport_model->getchartergrop();
                                                         foreach ($getchartergrop->result() AS $Data){
                                                            ?> 
						  <tr>
                                                      <td style="text-align:center"><?php echo $Data->boat_trip?></td>
						     
							  <?php 
								foreach ($getVehicle->result() AS $VehicleData){
                                                                    
               $getcharterbyboatsize = $this->transport_model->getcharterbyboatsize($VehicleData->boat_sizeid,$Data->boattrip_id);
               foreach ($getcharterbyboatsize->result() AS $getcharterbyboatsizes){}
        if($numcharterbook>0){
            $getdetailcharterbyid = $this->transport_model->getdetailcharterbyid($getcharterbookings->id,$getcharterbyboatsizes->id);
            
            $numgetdetailbyid = $getdetailcharterbyid->num_rows();
            foreach ($getdetailcharterbyid->result() AS $getdetailcharterbyid2){}
            }                                                            
                                                                    ?>
                                                         <td style="text-align:center">
									<?php   if(isset($price[$VehicleData->boat_sizeid][$Data->boattrip_id][$getcharterbyboatsizes->id])){?>
                                                             <?php if($keygroup !=''){?>
                                                             <input type="checkbox" id="check<?php echo $VehicleData->boat_sizeid.$getcharterbyboatsizes->id?>" <?php if(in_array($VehicleData->boat_sizeid.$getcharterbyboatsizes->id,$arrayidx)){echo 'checked';}?> onclick="addtran(this.checked,'<?php echo $VehicleData->boat_sizeid?>','<?php echo $VehicleData->boat_sizeid.$getcharterbyboatsizes->id?>','<?php echo $getcharterbyboatsizes->id?>')"/> <?php }else{?>
                                                           <input type="checkbox" id="check<?php echo $VehicleData->boat_sizeid.$getcharterbyboatsizes->id?>" <?php if(in_array($VehicleData->boat_sizeid.$getcharterbyboatsizes->id,$arrayidx)){echo 'checked';}?> onclick="addtranfirst(this.checked,'<?php echo $VehicleData->boat_sizeid?>','<?php echo $VehicleData->boat_sizeid.$getcharterbyboatsizes->id?>','<?php echo $getcharterbyboatsizes->id?>')"/>   
                                                             <?php }?>
                                                             &nbsp;&nbsp;	<?php	echo  number_format($price[$VehicleData->boat_sizeid][$Data->boattrip_id][$getcharterbyboatsizes->id],2); ?> x 
                                                             <select id="Adults<?php echo $VehicleData->boat_sizeid.$getcharterbyboatsizes->id?>" <?php if($keygroup==''){echo 'disabled';}?>  name="Adults" onchange="setnumber(this.value,'<?php echo $VehicleData->boat_sizeid?>','<?php echo $VehicleData->boat_sizeid.$getcharterbyboatsizes->id?>','<?php echo $getcharterbyboatsizes->id?>')">
                                                    <?php for ($a = 1; $a <= 10; $a++) {
                                                        ?>													<option value="<?php echo $a ?>" <?php if(($numgetdetailbyid>0)&&($numcharterbook>0)&&($getdetailcharterbyid2->transport_amount == $a)&&(in_array($VehicleData->boat_sizeid.$getcharterbyboatsizes->id,$arrayidx))){echo 'selected';}?>><?php echo $a ?></option>
<?php } ?>
                                                </select>
								<?php 			}else{
											echo "-";
										}
									?>
<!--									<br>[<?php //echo $Data->boat_sizeid?>][<?php //echo $VehicleData->boattrip_id?>][<?php //echo $getcharterbyboatsizes->id?>]-->
                                                                </td>
								<?php }?>  
						 </tr>
							<?php }?>  
					  </tbody>
				</table>

                                    </div>
                                </div>
                                </div>
              
                        <input type="hidden" id="charterbook_id" value="<?php if($numcharterbook>0){echo $getcharterbookings->id;}?>"/>
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
		
		
                //----------------------------------
   function  loaddetail() {
       var charterbook_id = $('#charterbook_id').val();
        $.post('<?php echo base_url('Welcome/loadcherterdetail') ?>', {charterbook_id:charterbook_id}, function (data) {
            $('#showdata').html(data);
            calculate_totalPrice();
        });
    }
                //---------------------------------
                function addtranfirst(ch1,boattrip_id,x,charterid){
                    var partner_id = $('#partner_id').val();
                    var charterbook_id = $('#charterbook_id').val();
                    var keygroup = $('#keygroup').val();
                    var datedata = $('#datedata').val();
                    var Adults = $('#Adults'+x).val();
                    var Adultspepreple = $('#Adults').val();
                    var Children = $('#Children').val();
                    var charterbookdetail_id = $('#charterbookdetail_id'+x).val();
                    if(ch1==true){
                    $.post('<?php echo base_url('Welcome/addcharterbook') ?>', {charterid:charterid,charterbook_id:charterbook_id,keygroup:keygroup,partner_id:partner_id,Adults:Adults,datedata:datedata,Adultspepreple:Adultspepreple,Children:Children}, function (data1) {
                        if(data1!=''){
                            var dataarray = data1.split(',');
                            $('#charterbook_id').val(dataarray[1]);
                            $('#keygroup').val(dataarray[0]);
                    $.post('<?php echo base_url('Welcome/loadcherterdetail') ?>', {x:x,charterid:charterid,charterbook_id:dataarray[1],charterbookdetail_id:dataarray[2]}, function (data) {
                         $('#showdata').append(data);
                        calculate_totalPrice();
                        setTimeout(function () {
                            window.location.href = "<?php echo base_url('Welcome/charter_boat/') ?>"+dataarray[0] ;
                        });
                        });
                }
                 });
                    }else{
                    return false;
                    }
                }
                //---------------------------------
                function addtran(ch1,boattrip_id,x,charterid){
                        var partner_id = $('#partner_id').val();
                    var charterbook_id = $('#charterbook_id').val();
                    var keygroup = $('#keygroup').val();
                    var Adults = $('#Adults'+x).val();
                    var charterbookdetail_id = $('#charterbookdetail_id'+x).val();
                    if(ch1==true){
                    $.post('<?php echo base_url('Welcome/addcharterbook') ?>', {charterid:charterid,charterbook_id:charterbook_id,keygroup:keygroup,partner_id:partner_id,Adults:Adults}, function (data1) {
                        if(data1!=''){
                            var dataarray = data1.split(',');
                            $('#charterbook_id').val(dataarray[1]);
                            $('#keygroup').val(dataarray[0]);
                    $.post('<?php echo base_url('Welcome/loadcherterdetail') ?>', {x:x,charterid:charterid,charterbook_id:dataarray[1],charterbookdetail_id:dataarray[2]}, function (data) {
                         $('#showdata').empty();
                         $('#showdata').append(data);
                        calculate_totalPrice();
                        
                        });
                }
                 });
                    }else{
                    
                        deletecharterbookdetail(charterbook_id,charterbookdetail_id);
                        $('#Adults'+x).val('1');
                    }
        
                }
                 //-----------------------------------
                  function deletecharterbookdetail(charterbook_id,chartbookdetail_id){
               $.post('<?php echo base_url('Welcome/deletecharterbookdetail') ?>', {charterbook_id:charterbook_id,chartbookdetail_id:chartbookdetail_id}, function (data) {
                       if(data==1){
                    $.post('<?php echo base_url('Welcome/loadcherterdetail') ?>', {charterbook_id:charterbook_id}, function (data) {
                        $('#showdata').empty();
                        $('#showdata').html(data);
                        calculate_totalPrice();
                        });
                    }
               });
               }
                //-----------------------------------
               function deletecharterbookdetailbyid(charterbook_id,charterbookdetail_id,iddetail){
               $.post('<?php echo base_url('Welcome/deletecharterbookdetailbyid') ?>', {charterbook_id:charterbook_id,charterbookdetail_id:charterbookdetail_id,iddetail:iddetail}, function (data) {
                   if(data==1){
                    $.post('<?php echo base_url('Welcome/loadcherterdetail') ?>', {charterbook_id:charterbook_id}, function (data) {
                        $('#showdata').empty();
                        $('#showdata').html(data);
                        calculate_totalPrice();
                        });
                    }
               });
               }
                //----------------------------------
                function deleteselect(x,charterbook_id,charterbookdetail_id,n){
                var iddetail = $('#iddetail'+n).val();
                var xx = $('#xx'+n).val();
                
                    deletecharterbookdetailbyid(charterbook_id,charterbookdetail_id,iddetail);
                    var idarray = xx.split("||");
                     for(var i=0;i<(idarray).length;i++){
                         $('#check'+idarray[i]).prop("checked", false);
                          $('#Adults'+idarray[i]).val('1');
                     }
                     calculate_totalPrice();
//                    
//                    calculate_totalPrice();
                    
                }
                //-----------------------------------------
                       function calculate_totalPrice(){		
		   var className = '.pricecharter';	

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
          //------------------------------------
                function setnumber(ch1,boat_sizeid,x,charterid){
                    var partner_id = $('#partner_id').val();
                    var charterbook_id = $('#charterbook_id').val();
                    var keygroup = $('#keygroup').val();
                    var checkbox = document.getElementById("check"+x);
                    if(checkbox.checked == true){
                        $.post('<?php echo base_url('Welcome/updatecharter') ?>', {charterid:charterid,charterbook_id:charterbook_id,keygroup:keygroup,partner_id:partner_id,Adults:ch1}, function (data1) {
                        if(data1!=''){
                            var dataarray = data1.split(',');
                            $('#charterbook_id').val(dataarray[1]);
                            $('#keygroup').val(dataarray[0]);
                    $.post('<?php echo base_url('Welcome/loadcherterdetail') ?>', {x:x,charterid:charterid,charterbook_id:dataarray[1],charterbookdetail_id:dataarray[2]}, function (data) {
                        $('#showdata').empty();
                        $('#showdata').html(data);
                        calculate_totalPrice();
                        //$('#check'+x).prop("checked", true);
                        });
                }
                 }); 
                    }else{
                       $.post('<?php echo base_url('Welcome/addcharterbook') ?>', {charterid:charterid,charterbook_id:charterbook_id,keygroup:keygroup,partner_id:partner_id,Adults:ch1}, function (data1) {
                        if(data1!=''){
                            var dataarray = data1.split(',');
                            $('#charterbook_id').val(dataarray[1]);
                            $('#keygroup').val(dataarray[0]);
                    $.post('<?php echo base_url('Welcome/loadcherterdetail') ?>', {x:x,charterid:charterid,charterbook_id:dataarray[1],charterbookdetail_id:dataarray[2]}, function (data) {
                         $('#showdata').empty();
                         $('#showdata').append(data);
                        calculate_totalPrice();
                        $('#check'+x).prop("checked", true);
                        });
                }
                 });
                 }  
                }
          //----------------------------------
   function  goConfirm() {
        var keygroup = $('#keygroup').val();
       var datedata = $('#datedata').val();
       var Adults = $('#Adults').val();
       var Children = $('#Children').val();
       var charterbook_id = $('#charterbook_id').val();
       if(datedata==''){
           alert('Please select Depart date !');
       }else if(Adults == 0){
           alert('Please select Adults !');
//       }else if(Children == 0){
//           alert('Please select Children !');
       }else{
       $.post('<?php echo base_url('Welcome/updatedaycharter') ?>', {charterbook_id:charterbook_id,datedata:datedata,Adults:Adults,Children:Children}, function (data1) {
                        if(data1!=0){
        window.location.href = "<?php echo base_url('Welcome/CharterbookingSumary/') ?>"+keygroup ;
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
