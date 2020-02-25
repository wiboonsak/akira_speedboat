<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Package</title>
<style>
	body{
		margin: 15px 0px 0px;
		
	}
	tr td{
		font-family: tahoma, serif;
		font-size: 10pt;
		color: #56201D; 
	}
</style>
</head>
 <link href="<?php echo base_url('assets/css/icons.css')?>" rel="stylesheet" type="text/css" />
                <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css" />
                 <link href="<?php echo base_url('assets/plugins/datatables/buttons.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
<body>
    <?php 
                        $keygroub = $this->uri->segment(3);
  $getbooking_title = $this->Package_model->getbooking_title($keygroub);
                        foreach ($getbooking_title->result() AS $getbooking_title2) { }
                        $adultstravel = $getbooking_title2->adult_traveller;
                        $childtravel = $getbooking_title2->child_traveller;
                        $totalpeople = $adultstravel+$childtravel;
                        ?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
   
    <tr>
      <td height="70" colspan="2" bgcolor="#E7E7E7"><table width="90%"  border="0" cellspacing="2" align="center" cellpadding="0" bgcolor="#FFFFFF">
        <tbody>
          <tr>
            <td width="19%" height="25" align="right"><strong>CUSTOMER NAME  :</strong></td>
            <td height="25" colspan="5" align="left">&nbsp;&nbsp;<?php echo $getbooking_title2->cust_name?>&nbsp;<?php echo $getbooking_title2->cust_lastname?></td>
          </tr>
          <tr>
            <td height="25" align="right"><strong>TEL :</strong></td>
            <td width="19%" height="25" align="left">&nbsp;&nbsp;<?php echo $getbooking_title2->cust_telephone_num?></td>
            <td width="9%" height="25" align="left"><strong>EMAIL  :</strong></td>
            <td width="28%" height="25" align="left">&nbsp;&nbsp;<?php echo $getbooking_title2->cust_email?></td>
            <td width="10%" height="25" align="left"><strong>ID LINE :</strong></td>
            <td width="15%" height="25" align="left">&nbsp;&nbsp;<?php echo $getbooking_title2->cust_line?></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td height="197" colspan="2" bgcolor="#E7E7E7">
       <table width="90%" align="center" border="0" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF">
        <tbody>
          <tr>
            <td width="40%" height="25" align="right"><strong>BOOKING ID :</strong></td>
            <td width="62%" height="25" align="left"><?php echo $keygroub?></td>
          </tr>
           <?php $r='';
                                    $route_id = $getbooking_title2->route_id;
          $list_route = $this->transport_model->listRoute($r,$route_id);
          foreach ($list_route->result() AS $list_route2) {}?>      
          <?php $list_placebegin = $this->Package_model->list_placeData($list_route2->begin_place_id);
                        foreach ($list_placebegin->result() AS $list_placebegin2) {}?>
          <?php $list_placedes = $this->Package_model->list_placeData($list_route2->destination_place_id);
                        foreach ($list_placedes->result() AS $list_placedes2) {}
          ?>
          <tr>
            <td height="25" align="right"><strong>TRIP :</strong></td>
            <td height="25" align="left"><?php echo $list_placebegin2->place_name_en?>  to  <?php  echo $list_placedes2->place_name_en?></td>
          </tr>
          <tr>
               <?php $Routetype = $this->transport_model->get_routeType($route_id, $getbooking_title2->route_type_id, $r, 'yes', 'id');
foreach ($Routetype->result() as $Data){}
$dayofweek = date('l', strtotime($getbooking_title2->date_depart)); ?>
            <td width="40%" height="25" align="right"><strong>DEPARTING :</strong></td>
            <td height="25" align="left"><?php echo $dayofweek?>,  <?php echo $this->Package_model->GetEngDateTime2($getbooking_title2->date_depart);?></td>
          </tr>
          <tr>
                <?php   $times = $this->transport_model->get_timeDetail($r,$r,$r,$r,$getbooking_title2->time_id);	
						   //$numTime = $times->num_rows();
                                                   
						   //if($numTime >0){						   	
                                                                foreach($times->result() as $times2){}  
						   		$times1 = date('H:i', strtotime($times2->arrive_time.'+'.$Data->transfer_h_time.' hours'));	
						   		$times1 = date('H:i', strtotime($times1.'+'.$Data->transfer_m_time.' minutes'));?>
                                               <?php //}?>     
            <td width="40%" height="25" align="right"><strong>TIME :</strong></td>
            <td height="25" align="left"><?php echo $times2->arrive_time?> > <?php echo $times1?></td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>ADULT :</strong></td>
            <td height="25" align="left"> <?php echo $adultstravel?></td>
          </tr>
                <?php if($childtravel >0){?>
          <tr>
            <td width="40%" height="25" align="right"><strong>CHILDREN (3-10 YEARS) :</strong></td>
            <td height="25" align="left"> <?php echo $childtravel?></td>
          </tr>
          <?php }?>
          <tr>
            <td width="40%" height="25" align="right"><strong>PAYMENT TOTAL : </strong></td>
            <td height="25" align="left"><?php echo number_format($getbooking_title2->total_price)?> THB</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>STATUS : </strong></td>
            <td height="25" align="left"><?php if ($getbooking_title2->cf_status == 1){echo 'Pending';}else if($getbooking_title2->cf_status == 2){echo 'Confrim ';}else{echo 'Cancel';} ?></td>
          </tr>
          
          <tr>
            <td colspan="2">
            	<!------ Trip Detail ------->         
       			<div style="margin:0 auto; padding: 10px; background-color: #FFFFFF; width: 84%">            
				 <h2 class="title-detail" style="color: #2f79b1;">Trip Details:</h2>
				 <!-- Accordion -->
					  <div class="panel-group no-margin" id="accordion">
								  <!-- Accordion 1 -->
                                                                  <form method="POST" id="frm1" name="frm1">
								  <div class="panel">
									 <div id="collapseOne" class="panel-collapse collapse in" aria-labelledby="headingOne">
                                                                              <?php 
                                                  $checkDetail = $this->transport_model->checkDetail($getbooking_title2->time_id);
                                                    $a =0; 
                                                 $priceArray = explode("/",$getbooking_title2->adult_price);
                                                 $priceArray2 = explode("/",$getbooking_title2->child_price);
 foreach ($checkDetail->result() as $checkDetail2){?>
										 <div class="panel-body" style="padding-top: 10px;">                                                   
											<div class="" style="background-color: #f1f1f1; border: 1px solid #E5E5E5">
												<div class="row" style="padding: 20px 0px 20px 25px;">
													<div class="col-sm-10">
														<div class="item">
															<span></span>
															<div><strong><?php echo $checkDetail2->arrive_time?> <?php $checkroute = $this->Package_model->list_placeData($checkDetail2->begin_place_id);  foreach ($checkroute->result() as $checkroute2){} echo $checkroute2->place_name_en?></strong></div>														</div>
<?php $checktransport = $this->Package_model->list_transportData($checkDetail2->transport_id);foreach ($checktransport->result() as $checktransport2){} ?>														<div class="item">															<span></span>
															<div style="color:#2f79b1; padding-top: 20px;  font-size: 14pt"><strong><?php  echo $checktransport2->transport_name_en?></strong></div>
<?php $booking_textAdmin = $this->Package_model->list_booking_textAdmin($getbooking_title2->booking_id,$checkDetail2->transport_id);
$countbook = $booking_textAdmin->num_rows();
foreach ($booking_textAdmin->result() as $booking_textAdmin2){}

?>                                                                                                          
   <p style="display: flex;">                                   
    <span s><small><strong>Ticket number : </strong></small></span>&nbsp;&nbsp;
<input type="text" id="ticket" name="ticket[]" value="<?php if($countbook >0){echo $booking_textAdmin2->ticket_number;}?>" style="width: 85%;"></p>                                                                        
   <p style="display: flex;">                                   
    <span s><small><strong>Check-in Place : </strong></small></span>&nbsp;&nbsp;
<input type="text" id="Place" name="Place[]" value="<?php if($countbook >0){echo $booking_textAdmin2->note_ckeckin_en;}?>" style="width: 85%;"></p>                                                                        

<input type="hidden" id="transport_id" name="transport_id[]" value="<?php echo $checkDetail2->transport_id?>">		
<input type="hidden" id="TicketBook" name="TicketBook[]" value="<?php if($countbook >0){echo $booking_textAdmin2->id;}?>">		
<p>
																<small><strong>Note: </strong><?php echo $checkDetail2->note_checkin_en?><br></small>
															</p>
<?php $totalprice = ($adultstravel*$priceArray[$a])+($childtravel*$priceArray2[$a]);?>
                                                                                                            <p style="font-size: 10pt !important"><strong><?php echo $totalpeople?> Travellers = <?php echo number_format($totalprice)?> THB</strong> 			
																<ul style="font-size: 10pt; padding-bottom: 15px !important">
																	<li style="font-size: 10pt; font-weight: 100;"><?php echo $adultstravel?> Adults x <?php echo number_format($priceArray[$a])?> = <?php echo number_format($adultstravel*$priceArray[$a])?> THB</li>
  <?php if($childtravel >0){?>																	<li style="font-size: 10pt; font-weight: 100;"><?php echo $childtravel?> Children x <?php echo number_format($priceArray2[$a])?> = <?php echo number_format($childtravel*$priceArray2[$a])?> THB</li>
    <?php }?>
																</ul>
															</p>															
														</div>

														<div class="item-end">
															<span></span>
															<div><strong><?php echo $checkDetail2->depart_time?> <?php $checkroute3 = $this->Package_model->list_placeData($checkDetail2->destination_place_id); foreach ($checkroute3->result() as $checkroute4){}echo $checkroute4->place_name_en?></strong></div>																	
														</div>
													</div>														
												</div>                                                    
											 </div>
										 </div>
 <?php $a++;}?>
										 
									 </div>
									 <!-- End Accordion 1 -->                                          
								   </div>
                                                                      <input type="hidden" id="booking_id" name="booking_id" style="width: 85%" value="<?php echo $getbooking_title2->booking_id?>">	
                                                                  </form>
								   <!-- Accordion -->
								</div>
				 <!------ Trip Detail ------->
			   </div>
            </td>
          </tr>
        </tbody>
      </table>
      
       
      </td>
    </tr>
    
    <tr>
      <td bgcolor="#B8B8B8">&nbsp;</td>
      <td align="right" bgcolor="#B8B8B8">&nbsp;</td>
    </tr>
    <br>
    <tr>
      <td height="200" colspan="2" bgcolor="#E7E7E7" >
      <textarea style="margin: 0 5%;width: 90%;" rows="7" id="textareapdf"><?php echo $getbooking_title2->comment?></textarea>
      <br>
      <br>
      <div style="text-align: center">
          <button  align="center" type="button" class="btn btn-success "   onClick="confrim_data('<?php echo $keygroub ?>')">Confrim</button>
          <?php if($getbooking_title2->cf_status == 2){?>
      <button  align="center" type="button" class="btn btn-danger "  onClick="cancel_data('<?php echo $keygroub ?>')">Cancel</button>
       <?php }?>
      </div>
      </td>
    </tr>
  </tbody>
</table>
     <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script type="text/javascript">
    function confrim_data(keygroup) {
        var textareapdf = $('#textareapdf').val();
//        var ticket = $('#ticket').val();
//        var Place = $('#Place').val();
//        var booking_id = $('#booking_id').val();
//        var transport_id = $('#transport_id').val();
//                $.post('<?php //echo base_url('PackageCMS/confrim_data1') ?>', {keygroup: keygroup,textareapdf:textareapdf,ticket:ticket,Place:Place,booking_id:booking_id,transport_id:transport_id}, function (data) {
//                    if (data > 0) {
//                        alert("Confrim data successfully.");
//
//                        window.opener.location.href = "<?php //echo base_url('PackageCMS/bookingTransport_view') ?>";
//                        window.close();
//                    } else {
//                        alert("Can not be Confrim!");
//                    }
//                });

var postData = new FormData($("#frm1")[0]);	
		$.ajax({
		 type:'POST',
		 url:'<?php echo base_url('PackageCMS/insertnotecheckin')?>',
		 processData: false,
		 contentType: false,
		 data : postData,		 
		 success:function(data, status){
			console.log(data);
			
			if(status=='success'){
                            
                            
                            $.post('<?php echo base_url('PackageCMS/confrim_data1') ?>', {keygroup: keygroup,textareapdf:textareapdf}, function (data) {
                    if (data > 0) {
                        
                        alert("Confrim data successfully.");

                        window.opener.location.href = "<?php echo base_url('PackageCMS/bookingTransport_view') ?>";
                        window.close();
                    } else {
                        alert("Can not be Confrim!");
                    }
                });
                            
				
			}

		 }
	});
                }
        
      //----------------------------
      function cancel_data(keygroup) {
        var textareapdf = $('#textareapdf').val();
        if(textareapdf == ''){
              alert("Please enter comment!");
            
        }else{
            console.log('..............'+keygroup);
                $.post('<?php echo base_url('PackageCMS/cancel_data1') ?>', {keygroup: keygroup,textareapdf:textareapdf}, function (data) {
                    if (data > 0) {
                        alert("Cancel data successfully.");
                        window.opener.location.href = "<?php echo base_url('PackageCMS/bookingTransport_view') ?>";
                        window.close();
                    } else {
                        alert("Can not be Cancel!");
                    }
                });
                }
                }
        
    
    </script>
</body>
</html>
