<?php  
require_once('../third_party/mpdf/mpdf.php');
ob_start();
?>
<!DOCTYPE html> 
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>TRAVEL LIPE, BOOKING SPEEADBOAT, TRANSPORT, PACKAGE TOUR - MOONLIGHT LIPE - KOH LIPE, SATUN THAILAND</title>

    <!-- Font Google -->
           <link rel="shortcut icon" href="http://www.ok-demo.com/akira_speedboat/assets/favicon.ico">
		<!-- X editable -->
        
        
                <!-- App css -->
        <link href="http://www.ok-demo.com/akira_speedboat/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="http://www.ok-demo.com/akira_speedboat/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="http://www.ok-demo.com/akira_speedboat/assets/css/style.css" rel="stylesheet" type="text/css" />		
	
</head>
<body>
    <?php $checkinData2 = $this->transport_model->getbooking($booking_no);
          foreach($checkinData2->result() as $Data1){}
           $DataID = $Data1->id;
		$booking_status = $Data1->booking_status;
		$payment_status = 'all';
		$payment_type = 'all';
		$partner_id = 'all';
		$dateStart = 'all';
		$dateEnd = 'all';
		$checkinData = $this->transport_model->transport_booking_list($booking_status,$payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$DataID);
                
                foreach($checkinData->result() AS $Data){}
    ?>
<div class="card" style="margin-top: -20px;" id="pdf">
  	<div class="card-body">
		 
			<h5 class="card-title">รายละเอียดลูกค้า</h5>
		
		    <div class="row">
				<div class="col-4" style="text-align: right">ชื่อลูกค้า : </div>
				<div class="col-8"><?php echo $Data->cust_name.' '.$Data->cust_lastname?> </div>
		    </div>	
			 <div class="row">
				<div class="col-4"  style="text-align: right">โทรศัพท์ :</div>
                                <div class="col-8"> <a href="<?php echo $Data->cust_telephone_num?>"><?php echo $Data->cust_telephone_num?>
											
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
		  

		<hr>
		
		<h5 class="card-title">ข้อมูลหมายเลขการจอง : <span class="text-danger"><?php echo $Data->booking_no?></span>&nbsp;วันที่จอง : <?php echo $Data->date_booking?>&nbsp;<small class="text-primary"><?php echo $txt?></small></h5>
		
		
			<div class="row">
				
				<div class="col-md-6">
					
					<table class="table" width="100%">
						<tr>
							<td colspan="2" style="background-color:#E1E1E1; ">DEPART : <span class="text-danger"><?php echo $Data->departName?></span></td>
						</tr>
						<tr>
							<td >TIME :</td>
							<td align="right">	
						    <span style="color:red;font-size: 12px;" ><?php echo $Data->dateGo?></span>
							<span ><?php echo $Data->DepartTime?></span></td>
						</tr>

						<tr>
						  <td>Duration:</td>
						  <td align="right"><?php echo $Data->DepartDuration?></td>
						</tr>
						<tr>
							<td>Adult x <?php echo $Data->NAdult?></td>
							<td align="right"><?php echo number_format($Data->DepartTotalAdult,2)?></td> 
						</tr>
						<tr>
							<td>Children x <?php echo $Data->NChild?></td>
							<td align="right"><?php echo number_format($Data->DepartTotalChildren,2)?></td>
						</tr>
						<tr>
							<td>Total depart :</td>
							<td align="right">
							<?php echo number_format($Data->totalDepartPrice,2)?>

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
														<td align="right"><?php echo number_format($Data->ReturnTotalAdult,2)?></td> 
													</tr>
													<tr>
														<td>Children x <?php echo $Data->NChild?></td>
														<td align="right"><?php echo number_format($Data->ReturnTotalChildren,2)?>
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
		     Total Price : <?php echo number_format(($Data->totalDepartPrice+$Data->totalReturnPrice),2)?>
			
		  </div>
		  
		  <hr>
		
		
				
			
		</div>
		
	</div>
    <script>
        var baseURL = "<?php echo base_url(); ?>";
function downloadPDF($pdf_id){
	$("#"+$pdf_id).css({ opacity: 1 });
	html2canvas([document.getElementById($pdf_id)], {
		onrendered: function(canvas) {
		   var image = canvas.toDataURL('image/png');
		   SaveImage(image);
		}
	});
}
function SaveImage(image){
	$.ajax({
		type: 'POST',
		url: baseURL+'pdf/save',
		data: {base64Image:image,image_name:"pdf"},
		success: function(image) {
			var d = new Date();
			var n = d.getTime();
			window.location = image+"?t="+n;
		}
	});
}
    </script>
  <!-- Library JS -->
    
    <!-- End Main Js -->
</body>
</html>
<?php 
	$html = ob_get_contents();
	ob_end_clean();
	$pdf = new mPDF('th', 'A4', '0', 'Arial,sans-serif'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
	$pdf->SetAutoFont();
	$pdf->SetDisplayMode('fullpage');
	$pdf->WriteHTML($html, 2);
	$pdf->Output('download/Booking_'.$booking_no.'.pdf');
	$pdf->Output('download/Booking__'.$booking_no.'.pdf');	
			//$pdf->Output();
                        ?>

