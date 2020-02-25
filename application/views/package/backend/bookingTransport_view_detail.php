<?php foreach($checkinData->result() AS $Data){}

      if($Data->booking_status=='1'){
		  $txtbookStatus='<span class="text-primary">ยืนยันสั่งจอง</span>';
	  }else if($Data->booking_status=='2'){
		   $txtbookStatus='<span class="text-success">ประวัติสั่งจอง</span>';
	  }else if($Data->booking_status=='3'){
		   $txtbookStatus='<span class="text-danger">ยกเลิกสั่งจอง</span>';
	   }else if($Data->booking_status=='4'){
		   $txtbookStatus='<span class="text-danger">รายการลบคำสั่งจอง</span>';
	  }

 // totalDepartPrice totalReturnPrice
?>
<style>
@media print {
    body * {
        visibility:hidden;
    }
	
	
  </style>
<input type="hidden" name="DataId" id="DataID" value="<?php echo $DataID?>">
<input type="hidden" name="bookingID" id="bookingID" value="<?php echo $Data->booking_no?>">
<div class="card" style="margin-top: -20px;">
   
    <div class="card-body" style="height: 100%">
		 
		<div id="printThis" >
            
			<div class="row">
			   <div class="col-md-5">
					<span>
                          <img src="<?php echo base_url('images/logo-header.png') ?>" alt="" width="90%" style="text-align:center" >
           			</span>
				
				</div>
			   <div class="col-md-7" style="vertical-align:middle; padding-top: 20PX;">
				<!--	<h5 class="card-title">รายละเอียดลูกค้า</h5>-->
		
		    <div class="row">
				<div class="col-4" style="text-align: right">ชื่อลูกค้า : </div>
				<div class="col-8"><?php echo $Data->cust_name." ".$Data->cust_lastname?></div>
		     </div>	
			 <div class="row">
				<div class="col-4"  style="text-align: right">โทรศัพท์ :</div>
				<div class="col-8"> <a href="tel:<?php echo $Data->cust_telephone_num ?>">
												<?php echo $Data->cust_telephone_num ?>
												</a>		
				</div>
		    </div>	
		    <div class="row">
				<div class="col-4"  style="text-align: right">Email : </div>
				<div class="col-8"><?php echo $Data->cust_email?></div>
		    </div>	
		   <div class="row">
				<div class="col-4"  style="text-align: right">ID LINE : </div>
				<div class="col-8"><?php echo $Data->line_id?></div>
		    </div>	
				
				</div>
			
			</div>
			
			
			
		  

		<hr>
		
		<h5 class="card-title">ข้อมูลหมายเลขการจอง : <span class="text-danger"><?php echo $Data->booking_no; ?></span>&nbsp;วันที่จอง : <?php echo $Data->date_booking?>&nbsp;<small class="text-primary">(<?php if($Data->travelRound=='return'){ echo "ไป-กลับ";}else if($Data->travelRound=='oneWay'){ echo "เทียวเดียว";}?>)</small></h5>
		
		
			<div class="row">
				
				<div class="col-md-6">
					
					<table class="table" width="100%">
						<tr>
							<td colspan="2" style="background-color:#E1E1E1; ">DEPART : <span class="text-danger"><?php echo $Data->departName?></span></td>
						</tr>
						<tr>
							<td >TIME :</td>
							<td align="right">	
						    <span style="color:red;font-size: 12px;" ><?php echo $Data->dateGo?> </span>
							<span ><?php echo $Data->DepartTime?></span></td>
						</tr>

						<tr>
						  <td>Duration:</td>
						  <td align="right"> <?php echo $Data->DepartDuration?></td>
						</tr>
						<tr>
							<td>Adult x <?php echo $Data->NAdult?></td>
							<td align="right"><?php echo $Data->DepartTotalAdult?></td> 
						</tr>
						<tr>
							<td>Children x <?php echo $Data->NChild?></td>
							<td align="right"><?php echo $Data->DepartTotalChildren?></td>
						</tr>
						<tr>
							<td>Total depart :</td>
							<td align="right">
							<?php echo  number_format($Data->totalDepartPrice,2)?>

							</td>
						</tr> 
					</table>
					
					
				</div>
				
				
				<div class="col-md-6">
					<table class="table" width="100%">
													<tr>
														<td colspan="2" style="background-color:#E1E1E1">RETURN : <span class="text-danger"><?php echo $Data->returnName?></span></td>
													</tr>
													<tr>
														<td >Time:	</td>													
														<td align="right">
												         <span style="color:red;font-size: 12px;" ><?php echo $Data->backDate?> </span>
														<span id="DepartTime"><?php echo $Data->ReturnDepartTime?>
														
														
														</td>
													</tr> 
													<tr>
													  <td>Duration:</td>
													  <td align="right"><?php echo $Data->ReturnDuration?></td>
													</tr>
													<tr>
														<td>Adult x <?php echo $Data->NAdult?></td>
														<td align="right"><?php echo $Data->ReturnTotalAdult?></td> 
													</tr>
													<tr>
														<td>Children x <?php echo $Data->NChild?></td>
														<td align="right"><?php echo $Data->ReturnTotalChildren?>
														</td>
													</tr>
													<tr>
														<td>Total return :</td>
														<td align="right">
															 <?php echo number_format($Data->totalReturnPrice,2)?>
														</td>
													</tr>
												</table>
				
				</div>
			
			</div>
		  <div class="col-12 bg-danger text-white" style="padding: 10px; text-align: right" >
		     Total Price : <?php echo number_format(($Data->totalDepartPrice+$Data->totalReturnPrice),2);?>
			
		  </div>
		  </div>
		  
		  <hr>
		
		<h5 class="card-title">ข้อมูลการชำระเงิน : </h5>
		 	<div class="row">
				<div class="col-4"  style="text-align: right">การชำระเงิน : </div>
				<div class="col-8">
					<?php if($Data->payment_status=='1'){ echo "<span id='payment_status'>ชำระเงินเรียบร้อย</span>";}else if($Data->payment_status=='0'){ echo "<span id='payment_status' class='text-danger'>ยังไม่ชำระเงิน</span>"; }?>
				     &nbsp;&nbsp;
					<span id="btn-payment-space">
						<?php if($Data->payment_status=='0'){?>
						<button id="btnConfirmPay" type="button" class="btn btn-success btn-sm" onClick="btnConfirmPay()">ยืนยันชำระเงิน</button> 
						<?php }else if($Data->payment_status=='1'){?>
						<button id="btnCancelPay" type="button" class="btn btn-danger btn-sm" onClick="btnCancelPay()">ยกเลิกชำระเงิน</button> 
						<?php } ?>
					</span> 
					<span id="confirm-space"></span> 
					
				 
				</div>
		    </div>	
			<div class="row">
				<div class="col-4"  style="text-align: right">ปรเภทการชำระเงิน : </div>
				<div class="col-8"><?php if($Data->payment_type=='1'){ echo "credit card";}else if($Data->payment_type=='2'){  echo "โอนเงิน";}else if($Data->payment_type=='0'){ echo "ยังไม่ระบุ"; }?></div>
		    </div>
		 <hr>
		
		<div class="row" >
			<div class="col-md-12"><h5 class="card-title">สถานะคำสั่งจอง : <span id="TitleBookStatus" ><?php echo $txtbookStatus?></span></h5></div>
			
			<div class="row col-md-12" align="center" style="padding: 5px;">
	            <?php if($Data->booking_status=='1'){ ?>
				<div class="col-md-4">
					<button type="button" class="btn btn-warning btn-sm" onClick="chBookStatus('Cfcancel','<?php echo $DataID?>')"><i class="fa fa-times-circle"></i> ยกเลิกการจอง</button>
					<div id="Cfcancel"  class="cfArea"  style="padding-top: 10px; padding-bottom: 5px;"></div>
				
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-success btn-sm"  onClick="chBookStatus('CfHistory','<?php echo $DataID?>')"><i class="fa fa-folder-o"></i> จัดเก็บประวัติ</button>
					<div id="CfHistory"  class="cfArea" style="padding-top: 10px; padding-bottom: 5px;"></div>
				</div>
				<div class="col-md-4" >
					<button type="button" class="btn btn-danger btn-sm"  onClick="chBookStatus('CfDelete','<?php echo $DataID?>')"><i class="fa fa-minus-circle"></i> ลบ</button>
					 <div id="CfDelete" class="cfArea" style="padding-top: 10px;padding-bottom: 5px;"></div>
				</div>
			  <?php }?>  
				
			
		</div>
		
	</div>

</div>

<script>
	function chBookStatus(actions,DataID){
		 if(actions=='Cfcancel'){
			 var booking_status ='3';
			 var addClassTXT="text-danger";
			 var titleTXT ='ยกเลิกการจอง';
		 }else if(actions=='CfHistory'){
			 var booking_status ='2';
			 var addClassTXT="text-success"; 
			 var titleTXT ='จัดเก็บประวัติ';
		 }else if(actions=='CfDelete'){
			  var booking_status ='4';
			  var addClassTXT="text-danger";
			  var titleTXT ='ลบ';
		 }
		
		 $('.cfArea').empty();
		
		 var html = '&nbsp;<button id="cfOk" type="button" class="btn btn-success btn-sm"  title="ยืนยัน"><i class="icon-check"></i></button>';
		 var html2='&nbsp;<button type="button" id="cfNo" class="btn btn-danger btn-sm" title="ยกเลิก"><i class="icon-close"></i></button>';
		
		 $('#'+actions).empty();
		 $('#'+actions).html(html+html2);
		
		 $('#cfNo').click(function(){
			 $('#'+actions).empty();
		 })
		
		 
		 $('#cfOk').click(function(){
			 $.post('<?php echo base_url('Travelcontroller/chBookStatus')?>',{ booking_status:booking_status, DataID:DataID }
					, function(data){
				    console.log(data);
				    if(data==1){
						 $('#TitleBookStatus').empty();
						 $('#TitleBookStatus').attr('class', '');
						 $('#TitleBookStatus').html(titleTXT);
						 $('#TitleBookStatus').addClass(addClassTXT);
						 $('#'+actions).empty();
						 $('#'+actions).text(titleTXT+'เรียบร้อย');
						 searchinput();
					}else{
						alert('change status error. cod:014');
					}
			 })
		 })
		
		
	}
   //----------------------------------------------	
   function btnConfirmPay(){ 
		//console.log('btnConfirmPay click');
		 var html = '&nbsp;<button id="ConfirmPayment" type="button" class="btn btn-success btn-sm"  title="ยืนยัน"><i class="icon-check"></i></button>';
		 var html2='&nbsp;<button type="button" id="CancelBtn" class="btn btn-danger btn-sm" title="ยกเลิก"><i class="icon-close"></i></button>';
		$('#confirm-space').empty();
		$('#confirm-space').html(html+html2);
		
		$('#CancelBtn').click(function(){
			$('#confirm-space').empty();
		})
		
		$('#ConfirmPayment').click(function(){
			var DataID = $('#DataID').val();
			var bookingID = $('#bookingID').val();
			var payment_status = 1;
			$.post('<?php echo base_url('Travelcontroller/confirmTransportPayment')?>',{ DataID:DataID ,payment_status:payment_status, bookingID:bookingID}, function(data){
				
				//console.log('ConfirmPayment->'+data+' payment_status->'+payment_status+' DataID->'+DataID)
				
				if(data=='1'){
					searchinput();
					$('#confirm-space').empty();
					$('#btn-payment-space').empty();
					
					var btn3='<button id="btnCancelPay" type="button" class="btn btn-danger btn-sm" onClick="btnCancelPay()">ยกเลิกชำระเงิน</button> ';
					//console.log(btn3);
					$('#btn-payment-space').html(btn3);
					
					$('#payment_status').empty();
					$('#payment_status').html("ชำระเงินเรียบร้อย");
					
					
				}else{
					alert('error confirm payment.');
				}
			})
		})
	}

	//----------------------------------------------------------------------------- 
	
	function btnCancelPay(){ 
		 //console.log('btnCancelPay click');
		 var html = '&nbsp;<button id="CancelPayment" type="button" class="btn btn-success btn-sm"  title="ยืนยัน"><i class="icon-check"></i></button>';
		 var html2='&nbsp;<button type="button" id="CancelBtn" class="btn btn-danger btn-sm" title="ยกเลิก"><i class="icon-close"></i></button>';
		
		$('#confirm-space').empty();
		$('#confirm-space').html(html+html2);
		
		$('#CancelBtn').click(function(){
			$('#confirm-space').empty();
		})
		
		$('#CancelPayment').click(function(){
			var DataID = $('#DataID').val();
			var payment_status = 0;
			$.post('<?php echo base_url('Travelcontroller/confirmTransportPayment')?>',{ DataID:DataID ,payment_status:payment_status}, function(data){
				//console.log('CancelPayment->'+data)
				if(data=='1'){
					searchinput();
					$('#confirm-space').empty();
					$('#btn-payment-space').empty();
					
					var html3='<button id="btnConfirmPay" type="button" class="btn btn-success btn-sm" onClick="btnConfirmPay()">ยืนยันชำระเงิน</button> ';
					$('#btn-payment-space').html(html3);
					
					$('#payment_status').empty();
					$('#payment_status').html("ยังไม่ชำระเงิน");
					
				}else{
					alert('error confirm payment.');
				}
			})
		})
		
	}
	

</script>

